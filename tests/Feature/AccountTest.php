<?php

namespace Tests\Feature;

use App\Mail\LoginCodeMail;
use App\Models\Donation;
use App\Models\LoginCode;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

/** Passwordless e-mail code, Google sign-in, "Hesabım" page. DB rolled back; settings file restored. */
class AccountTest extends TestCase
{
    use DatabaseTransactions;

    private ?string $settingsBackup = null;

    protected function setUp(): void
    {
        parent::setUp();
        $f = storage_path('app/settings.json');
        $this->settingsBackup = file_exists($f) ? file_get_contents($f) : null;
    }

    protected function tearDown(): void
    {
        if ($this->settingsBackup !== null) {
            file_put_contents(storage_path('app/settings.json'), $this->settingsBackup);
        }
        parent::tearDown();
    }

    private function loginSettings(array $s): void
    {
        setting()->set('login', array_merge(\App\Support\LoginSettings::DEFAULTS, $s)); // in memory only
    }

    private function requestCode(string $email): string
    {
        Mail::fake();
        $this->post('/login/code', ['email' => $email])->assertRedirect(route('login.code.verify'));
        $code = null;
        Mail::assertSent(LoginCodeMail::class, function ($m) use ($email, &$code) {
            $code = $m->code;

            return $m->hasTo($email);
        });

        return $code;
    }

    public function test_email_code_signs_in_and_creates_a_verified_donor_account()
    {
        $email = 'yeni.bagisci.' . uniqid() . '@example.com';
        $code = $this->requestCode($email);

        $this->post('/login/code/verify', ['code' => $code])->assertRedirect(route('account'));
        $user = User::where('email', $email)->firstOrFail();
        $this->assertAuthenticatedAs($user);
        $this->assertNotNull($user->email_verified_at);
        $this->assertTrue($user->hasRole('user'));
        $this->assertNotNull(LoginCode::where('email', $email)->first()->used_at); // single use
    }

    public function test_wrong_codes_are_limited()
    {
        $email = 'deneme.' . uniqid() . '@example.com';
        $code = $this->requestCode($email);
        $wrong = $code === '111111' ? '222222' : '111111';

        for ($i = 0; $i < LoginCode::MAX_ATTEMPTS; $i++) {
            $this->post('/login/code/verify', ['code' => $wrong])->assertSessionHasErrors('code');
        }
        $this->post('/login/code/verify', ['code' => $code])->assertSessionHasErrors('code'); // locked now
        $this->assertGuest();
    }

    public function test_expired_code_is_rejected_and_feature_can_be_disabled()
    {
        $email = 'sure.' . uniqid() . '@example.com';
        $code = $this->requestCode($email);
        LoginCode::where('email', $email)->update(['expires_at' => now()->subMinute()]);
        $this->post('/login/code/verify', ['code' => $code])->assertSessionHasErrors('code');
        $this->assertGuest();

        $this->loginSettings(['email_code_enabled' => false]);
        $this->get('/login/code')->assertNotFound();
    }

    public function test_google_sign_in_with_verified_email()
    {
        $this->loginSettings(['google_enabled' => true, 'google_client_id' => 'cid.apps.googleusercontent.com', 'google_client_secret' => 'secret']);

        $redirect = $this->get('/auth/google')->assertRedirect()->headers->get('Location');
        $this->assertStringStartsWith('https://accounts.google.com/o/oauth2/v2/auth?', $redirect);
        parse_str(parse_url($redirect, PHP_URL_QUERY), $q);
        $this->assertSame('cid.apps.googleusercontent.com', $q['client_id']);

        $email = 'google.' . uniqid() . '@example.com';
        Http::fake([
            'oauth2.googleapis.com/*' => Http::response(['access_token' => 'tok']),
            'openidconnect.googleapis.com/*' => Http::response(['sub' => '123', 'email' => $email, 'email_verified' => true, 'name' => 'Google Kullanici']),
        ]);

        $this->get('/auth/google/callback?code=abc&state=wrong')->assertRedirect(route('login'));
        $this->assertGuest();

        $this->get('/auth/google')->assertRedirect(); // new state in session
        $state = session('google_oauth_state');
        $this->get('/auth/google/callback?code=abc&state=' . $state)->assertRedirect(route('account'));
        $user = User::where('email', $email)->firstOrFail();
        $this->assertAuthenticatedAs($user);
        $this->assertSame('Google Kullanici', $user->name);
        $this->assertSame('google:123', $user->provider_id);
    }

    public function test_google_is_hidden_until_configured()
    {
        $this->loginSettings(['google_enabled' => true, 'google_client_id' => '', 'google_client_secret' => '']);
        $this->get('/auth/google')->assertNotFound();
    }

    public function test_account_lists_own_donations_receipt_and_repeat()
    {
        $user = User::create(['name' => 'Hesap Sahibi', 'email' => 'hesap.' . uniqid() . '@example.com', 'password' => bcrypt('x'), 'email_verified_at' => now()]);
        $user->attachRole('user');
        $other = User::firstOrFail();

        $campaignId = DB::table('campaigns')->insertGetId(['c_category_id' => DB::table('campaign_categories')->whereNull('deleted_at')->value('id'),
            'goal' => 1000, 'status' => 'active', 'complete' => 'no', 'created_at' => now(), 'updated_at' => now()]);
        foreach (['tr', 'ar', 'en'] as $l) {
            DB::table('campaign_translations')->insert(['campaign_id' => $campaignId, 'locale' => $l, 'name' => 'Hesap Kampanya', 'name_slug' => "hk-$l", 'description' => 'x', 'country' => 'x']);
        }

        $mine = Donation::create(['reference' => Donation::newReference(), 'user_id' => $user->id, 'amount' => 120, 'donor_name' => 'Hesap Sahibi', 'status' => Donation::CONFIRMED, 'confirmed_at' => now()]);
        $mine->items()->create(['campaign_id' => $campaignId, 'donation_type' => 'campaign', 'label' => 'Hesap Kampanya', 'amount' => 120]);
        $byEmail = Donation::create(['reference' => Donation::newReference(), 'donor_email' => strtoupper($user->email), 'amount' => 60, 'donor_name' => 'Misafir', 'status' => Donation::PENDING]);
        $byEmail->items()->create(['donation_type' => 'zakat', 'label' => 'Zekât', 'amount' => 60]);
        $foreign = Donation::create(['reference' => Donation::newReference(), 'user_id' => $other->id, 'amount' => 999, 'donor_name' => 'Baskasi', 'status' => Donation::CONFIRMED]);

        $this->actingAs($user)->get('/account')->assertOk()
            ->assertSee($mine->reference)->assertSee($byEmail->reference)->assertDontSee($foreign->reference);

        $this->actingAs($user)->get(route('account.donations.receipt', $mine))->assertOk()->assertSee('VAKIF YARDIMLAŞMA DERNEĞİ')->assertSee('120,00');
        $this->actingAs($user)->get(route('account.donations.receipt', $byEmail))->assertNotFound(); // not confirmed
        $this->actingAs($user)->get(route('account.donations.receipt', $foreign))->assertNotFound(); // not mine

        $this->actingAs($user)->get(route('account.donations.repeat', $mine))->assertRedirect(route('donate.campaign', ['campaign' => $campaignId, 'amount' => 120.0]));
        $this->actingAs($user)->get(route('account.donations.repeat', $byEmail))->assertRedirect(route('donate.zakat', ['price' => 60.0, 'typeOfDonate' => 'zakat']));
    }

    public function test_unverified_accounts_do_not_see_donations_by_email_only()
    {
        $email = 'dogrulanmamis.' . uniqid() . '@example.com';
        $user = User::create(['name' => 'X', 'email' => $email, 'password' => bcrypt('x')]);
        $d = Donation::create(['reference' => Donation::newReference(), 'donor_email' => $email, 'amount' => 60, 'donor_name' => 'X', 'status' => Donation::PENDING]);

        $this->actingAs($user)->get('/account')->assertOk()->assertDontSee($d->reference);
    }

    public function test_profile_and_password_can_be_updated()
    {
        $user = User::create(['name' => 'Eski Ad', 'email' => 'profil.' . uniqid() . '@example.com', 'password' => bcrypt('eski-sifre')]);

        $this->actingAs($user)->put('/account/profile', ['name' => 'Yeni Ad', 'phone' => '0555'])->assertRedirect();
        $this->assertSame('Yeni Ad', $user->fresh()->name);

        $this->actingAs($user)->put('/account/password', ['password' => 'kisa', 'password_confirmation' => 'kisa'])->assertSessionHasErrors('password');
        $this->actingAs($user)->put('/account/password', ['password' => 'YeniSifre123', 'password_confirmation' => 'YeniSifre123'])->assertRedirect();
        $this->assertTrue(\Illuminate\Support\Facades\Hash::check('YeniSifre123', $user->fresh()->password));
    }

    public function test_admin_login_settings_page_saves_and_keeps_secret()
    {
        $admin = User::whereHas('roles', fn ($q) => $q->where('name', 'super_admin'))->firstOrFail();
        $this->actingAs($admin)->get(route('admin.settings.login'))->assertOk()->assertSee('/auth/google/callback');

        $this->actingAs($admin)->put(route('admin.settings.login.update'), ['google_enabled' => '1', 'google_client_id' => 'id1', 'google_client_secret' => 'sec1', 'email_code_enabled' => '1'])->assertRedirect();
        $this->actingAs($admin)->put(route('admin.settings.login.update'), ['google_enabled' => '1', 'google_client_id' => 'id2', 'google_client_secret' => '', 'email_code_enabled' => '1'])->assertRedirect();

        $s = \App\Support\LoginSettings::all();
        $this->assertSame('id2', $s['google_client_id']);
        $this->assertSame('sec1', $s['google_client_secret']); // empty field keeps the stored secret
        $this->assertTrue(\App\Support\LoginSettings::googleEnabled());
    }
}
