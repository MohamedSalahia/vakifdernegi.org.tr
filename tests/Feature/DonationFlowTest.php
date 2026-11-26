<?php

namespace Tests\Feature;

use App\Mail\DonationConfirmed;
use App\Mail\DonationReceived;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

/**
 * End-to-end donation flow. Runs against the configured database inside a
 * transaction that is rolled back after each test (never RefreshDatabase).
 */
class DonationFlowTest extends TestCase
{
    use DatabaseTransactions;

    private function makeCampaign(int $goal = 1000): int
    {
        $id = DB::table('campaigns')->insertGetId([
            'c_category_id' => DB::table('campaign_categories')->whereNull('deleted_at')->value('id'),
            'image' => null, 'goal' => $goal, 'status' => 'active', 'complete' => 'no',
            'created_at' => now(), 'updated_at' => now(),
        ]);
        foreach (['tr', 'ar'] as $locale) {
            DB::table('campaign_translations')->insert([
                'campaign_id' => $id, 'locale' => $locale, 'name' => "Test Kampanya $locale",
                'name_slug' => "test-kampanya-$locale", 'description' => 'Test', 'country' => 'Nizip',
            ]);
        }

        return $id;
    }

    public function test_public_pages_load()
    {
        // (Arabic /ar URLs are not testable here: the locale prefix is fixed when routes load)
        foreach (['/', '/about_us', '/privacy', '/terms-of-use', '/donation-policy',
                  '/delivery-and-refund-policy', '/bank_accounts', '/contact_us', '/zakat', '/campaigns', '/login', '/login/code', '/register', '/transparency', '/reports', '/help'] as $url) {
            $this->get($url)->assertOk();
        }
        $this->get('/')->assertSee('VAKIF YARDIMLAŞMA DERNEĞİ')->assertDontSee('Kuwait');
    }

    public function test_guest_can_create_a_campaign_donation_and_get_instructions()
    {
        Mail::fake();
        $campaignId = $this->makeCampaign();

        $this->get("/donate/campaign/$campaignId?priceLive=250")->assertOk()->assertSee('Test Kampanya tr');

        $response = $this->post('/donate', [
            'donor_name' => 'Ayşe Yılmaz',
            'donor_email' => 'ayse@example.com',
            'kvkk' => '1',
        ]);

        $donation = Donation::with('items')->latest('id')->firstOrFail();
        $this->assertSame(Donation::PENDING, $donation->status);
        $this->assertEquals(250, (float) $donation->amount);
        $this->assertSame($campaignId, $donation->items->first()->campaign_id);
        $response->assertRedirect();
        $this->assertStringContainsString('/donate/thanks/' . $donation->reference, $response->headers->get('Location'));

        $this->get($response->headers->get('Location'))->assertOk()->assertSee($donation->reference)->assertSee('TR59 0001 0004 4981 0845 8500 01');
        Mail::assertSent(DonationReceived::class, fn ($m) => $m->hasTo('ayse@example.com'));
    }

    public function test_zakat_donation_records_the_type()
    {
        $this->get('/donate/zakat?price=100&typeOfDonate=zakat')->assertOk();
        $this->post('/donate', ['donor_name' => 'Ali', 'kvkk' => '1'])->assertRedirect();

        $item = Donation::with('items')->latest('id')->first()->items->first();
        $this->assertSame('zakat', $item->donation_type);
        $this->assertNull($item->campaign_id);
    }

    public function test_kvkk_consent_and_name_are_required()
    {
        $this->get('/donate/zakat?price=50')->assertOk();
        $before = Donation::count();
        $this->post('/donate', ['donor_name' => ''])->assertSessionHasErrors(['donor_name', 'kvkk']);
        $this->assertSame($before, Donation::count());
    }

    public function test_invalid_amounts_are_rejected()
    {
        $this->get('/donate/zakat?price=2')->assertRedirect();
        $this->get('/donate/zakat?price=abc')->assertRedirect();
    }

    public function test_post_without_checkout_session_is_rejected()
    {
        $before = Donation::count();
        $this->post('/donate', ['donor_name' => 'X', 'kvkk' => '1'])->assertRedirect(route('/'));
        $this->assertSame($before, Donation::count());
    }

    public function test_thanks_page_requires_the_donation_token_and_survives_language_switch()
    {
        $this->get('/donate/zakat?price=50')->assertOk();
        $this->post('/donate', ['donor_name' => 'X', 'kvkk' => '1']);
        $donation = Donation::latest('id')->firstOrFail();
        $ref = $donation->reference;

        $this->get("/donate/thanks/$ref")->assertForbidden();
        $this->get("/donate/thanks/$ref?t=wrong")->assertForbidden();
        $this->get($donation->thanksUrl())->assertOk()->assertSee($ref);

        // the token does not depend on the URL path, so the same token is valid on any localized URL
        $this->assertSame($donation->accessToken(), Donation::where('reference', $ref)->first()->accessToken());
        $this->assertStringNotContainsString('/ar/', $donation->thanksUrl());

        // links created before this change (?signature=) keep working
        $this->get(URL::signedRoute('donate.show', ['donation' => $ref]))->assertOk();
    }

    public function test_admin_confirms_donation_progress_updates_and_donor_is_emailed()
    {
        Mail::fake();
        $campaignId = $this->makeCampaign(1000);
        $this->get("/donate/campaign/$campaignId?priceLive=400")->assertOk();
        $this->post('/donate', ['donor_name' => 'Ayşe', 'donor_email' => 'ayse@example.com', 'kvkk' => '1']);
        $donation = Donation::latest('id')->firstOrFail();

        $this->assertEquals(0, Donation::confirmedTotalForCampaign($campaignId));

        $admin = User::whereHas('roles', fn ($q) => $q->where('name', 'super_admin'))->firstOrFail();
        $this->actingAs($admin)->get(route('admin.user_donations.index'))->assertOk();
        $this->actingAs($admin)->get(route('admin.user_donations.show', $donation))->assertOk()->assertSee($donation->reference);
        $this->actingAs($admin)->post(route('admin.user_donations.confirm', $donation), ['admin_note' => 'Dekont 25.11'])
            ->assertRedirect(route('admin.user_donations.show', $donation));

        $donation->refresh();
        $this->assertSame(Donation::CONFIRMED, $donation->status);
        $this->assertSame($admin->id, $donation->confirmed_by);
        $this->assertEquals(400, Donation::confirmedTotalForCampaign($campaignId));
        Mail::assertSent(DonationConfirmed::class, fn ($m) => $m->hasTo('ayse@example.com'));

        // cannot confirm twice
        $this->actingAs($admin)->post(route('admin.user_donations.cancel', $donation))->assertSessionHas('error');
        $this->assertSame(Donation::CONFIRMED, $donation->fresh()->status);
    }

    public function test_regular_users_cannot_manage_donations()
    {
        $user = User::whereHas('roles', fn ($q) => $q->where('name', 'user'))->first();
        if (!$user) {
            $this->markTestSkipped('No regular user in this database.');
        }
        $this->get('/donate/zakat?price=50');
        $this->post('/donate', ['donor_name' => 'X', 'kvkk' => '1']);
        $donation = Donation::latest('id')->firstOrFail();

        $this->actingAs($user)->post(route('admin.user_donations.confirm', $donation))->assertStatus(403);
        $this->assertSame(Donation::PENDING, $donation->fresh()->status);
    }
}
