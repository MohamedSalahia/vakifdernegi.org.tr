<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/**
 * Quick donate, admin donation settings, dedication and zakat intention.
 * DB changes are rolled back; the settings file is restored after each test.
 */
class EasyDonationTest extends TestCase
{
    use DatabaseTransactions;

    private ?string $settingsBackup = null;

    protected function setUp(): void
    {
        parent::setUp();
        $file = storage_path('app/settings.json');
        $this->settingsBackup = file_exists($file) ? file_get_contents($file) : null;
    }

    protected function tearDown(): void
    {
        $file = storage_path('app/settings.json');
        if ($this->settingsBackup !== null) {
            file_put_contents($file, $this->settingsBackup);
        }
        parent::tearDown();
    }

    private function donationSettings(array $overrides): void
    {
        setting()->set('donation', array_merge(\App\Support\DonationSettings::DEFAULTS, $overrides)); // in memory only
    }

    private function makeCampaign(array $attrs = []): int
    {
        $id = DB::table('campaigns')->insertGetId($attrs + [
            'c_category_id' => DB::table('campaign_categories')->whereNull('deleted_at')->value('id'),
            'image' => null, 'goal' => 1000, 'status' => 'active', 'complete' => 'no',
            'created_at' => now(), 'updated_at' => now(),
        ]);
        foreach (['tr', 'ar', 'en'] as $locale) {
            DB::table('campaign_translations')->insert([
                'campaign_id' => $id, 'locale' => $locale, 'name' => "Kolay Bagis $id",
                'name_slug' => "kolay-bagis-$id-$locale", 'description' => 'x', 'country' => 'Nizip',
            ]);
        }

        return $id;
    }

    public function test_quick_donate_redirects_to_the_right_checkout()
    {
        $c = $this->makeCampaign();
        $this->get("/donate/quick?target=campaign:$c&amount=100")->assertRedirect(route('donate.campaign', ['campaign' => $c, 'amount' => 100]));
        $this->get('/donate/quick?target=type:zakat&amount=250')->assertRedirect(route('donate.zakat', ['price' => 250, 'typeOfDonate' => 'zakat']));
    }

    public function test_quick_donate_box_follows_the_admin_switch()
    {
        $this->donationSettings(['quick_donate_enabled' => true]);
        $this->get('/')->assertOk()->assertSee('id="vk-quick-form"', false);

        $this->donationSettings(['quick_donate_enabled' => false]);
        $this->get('/')->assertOk()->assertDontSee('id="vk-quick-form"', false);
    }

    public function test_preset_amounts_and_minimum_come_from_settings()
    {
        $c = $this->makeCampaign();
        $this->donationSettings(['presets' => [70, 140], 'min_amount' => 20]);

        $this->get("/campaign/$c")->assertOk()->assertSee('data-amount="70"', false)->assertSee('data-amount="140"', false)
            ->assertDontSee('data-amount="250"', false);
        $this->get('/donate/zakat?price=10')->assertRedirect();   // below the new minimum
        $this->get('/donate/zakat?price=20')->assertOk();
    }

    public function test_dedication_and_zakat_intent_are_stored()
    {
        $c = $this->makeCampaign(['accepts_zakat' => true]);
        $this->get("/donate/campaign/$c?amount=100")->assertOk()->assertSee('name="is_zakat"', false)->assertSee('name="dedicate"', false);

        $this->post('/donate', [
            'donor_name' => 'Ali', 'kvkk' => '1', 'is_zakat' => '1',
            'dedicate' => '1', 'dedication_type' => 'memory', 'dedication_name' => 'Mehmet Dede',
        ])->assertRedirect();

        $d = Donation::latest('id')->firstOrFail();
        $this->assertTrue($d->is_zakat);
        $this->assertSame('memory', $d->dedication_type);
        $this->assertSame('Mehmet Dede', $d->dedication_name);
        $this->assertStringContainsString('Mehmet Dede', $d->dedicationText());
    }

    public function test_zakat_intent_is_ignored_for_non_eligible_campaigns_and_dedication_needs_a_name()
    {
        $c = $this->makeCampaign(['accepts_zakat' => false]);
        $this->get("/donate/campaign/$c?amount=100")->assertOk()->assertDontSee('name="is_zakat"', false);

        $this->post('/donate', ['donor_name' => 'Ali', 'kvkk' => '1', 'dedicate' => '1', 'dedication_type' => 'honor'])
            ->assertSessionHasErrors('dedication_name');

        $this->post('/donate', ['donor_name' => 'Ali', 'kvkk' => '1', 'is_zakat' => '1'])->assertRedirect();
        $this->assertFalse(Donation::latest('id')->first()->is_zakat);
    }

    public function test_zakat_type_donation_is_always_zakat()
    {
        $this->get('/donate/zakat?price=100&typeOfDonate=zakat')->assertOk();
        $this->post('/donate', ['donor_name' => 'Ali', 'kvkk' => '1'])->assertRedirect();
        $this->assertTrue(Donation::latest('id')->first()->is_zakat);
    }

    public function test_show_name_option_can_be_disabled()
    {
        $this->donationSettings(['show_name_option_enabled' => false]);
        $c = $this->makeCampaign();
        $this->get("/donate/campaign/$c?amount=100")->assertOk()->assertDontSee('name="show_name"', false);
        $this->post('/donate', ['donor_name' => 'Ali', 'kvkk' => '1', 'show_name' => '1'])->assertRedirect();
        $this->assertFalse(Donation::latest('id')->first()->show_name);
    }

    public function test_admin_can_update_donation_settings()
    {
        $admin = User::whereHas('roles', fn ($q) => $q->where('name', 'super_admin'))->firstOrFail();

        $this->actingAs($admin)->get(route('admin.settings.donations'))->assertOk()->assertSee('name="presets"', false);
        $this->actingAs($admin)->put(route('admin.settings.donations.update'), [
            'presets' => '25, 75; 150 x 3', 'min_amount' => 10, 'max_amount' => 50000,
            'quick_donate_enabled' => '1', 'dedication_enabled' => '1',
        ])->assertRedirect(route('admin.settings.donations'));

        $this->assertSame([25, 75, 150], \App\Support\DonationSettings::presets()); // "3" < min is dropped
        $this->assertEquals(10, \App\Support\DonationSettings::min());
        $this->assertFalse(\App\Support\DonationSettings::enabled('zakat_option'));

        $this->actingAs($admin)->put(route('admin.settings.donations.update'), ['presets' => '1, 2', 'min_amount' => 10, 'max_amount' => 100])
            ->assertSessionHasErrors('presets');
    }
}
