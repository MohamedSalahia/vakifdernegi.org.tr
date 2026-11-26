<?php

namespace Tests\Feature;

use App\Models\Campaign;
use App\Models\CampaignUpdate;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/** Campaign cards, campaign page tabs, sharing, listing filters and admin management. Rolled back after each test. */
class CampaignDisplayTest extends TestCase
{
    use DatabaseTransactions;

    private function makeCampaign(array $attrs = [], string $name = null): Campaign
    {
        $id = DB::table('campaigns')->insertGetId($attrs + [
            'c_category_id' => DB::table('campaign_categories')->whereNull('deleted_at')->value('id'),
            'image' => null, 'goal' => 1000, 'status' => 'active', 'complete' => 'no',
            'created_at' => now(), 'updated_at' => now(),
        ]);
        $name = $name ?? "Gosterim Test $id";
        foreach (['tr', 'ar', 'en'] as $locale) {
            DB::table('campaign_translations')->insert([
                'campaign_id' => $id, 'locale' => $locale, 'name' => $name,
                'name_slug' => "gosterim-test-$id-$locale", 'description' => '<p>Hikaye metni</p>', 'country' => 'Nizip',
            ]);
        }

        return Campaign::findOrFail($id);
    }

    private function confirmedDonation(Campaign $c, float $amount, string $name, bool $showName): Donation
    {
        $d = Donation::create([
            'reference' => Donation::newReference(), 'amount' => $amount, 'donor_name' => $name,
            'show_name' => $showName, 'status' => Donation::CONFIRMED, 'confirmed_at' => now(),
        ]);
        $d->items()->create(['campaign_id' => $c->id, 'donation_type' => 'campaign', 'label' => 'x', 'amount' => $amount]);

        return $d;
    }

    public function test_stats_count_only_confirmed_donations()
    {
        $c = $this->makeCampaign(['goal' => 1000]);
        $this->confirmedDonation($c, 250, 'A', false);
        $pending = Donation::create(['reference' => Donation::newReference(), 'amount' => 500, 'donor_name' => 'B', 'status' => Donation::PENDING]);
        $pending->items()->create(['campaign_id' => $c->id, 'donation_type' => 'campaign', 'label' => 'x', 'amount' => 500]);

        $st = $c->fresh()->stats();
        $this->assertEquals(250, $st['raised']);
        $this->assertSame(1, $st['donors']);
        $this->assertEquals(750, $st['remaining']);
        $this->assertSame(25, $st['percent']);
    }

    public function test_card_shows_badges_and_progress()
    {
        $c = $this->makeCampaign(['is_urgent' => true, 'accepts_zakat' => true]);
        $this->confirmedDonation($c, 100, 'A', false);

        $this->get('/campaigns')->assertOk()
            ->assertSee('vk-badge--urgent', false)->assertSee('vk-badge--zakat', false)
            ->assertSee('width: 10%', false);
    }

    public function test_campaign_page_tabs_updates_and_donor_privacy()
    {
        $c = $this->makeCampaign();
        CampaignUpdate::create(['campaign_id' => $c->id, 'title_tr' => 'Ameliyat yapıldı', 'body_tr' => 'Detay', 'published_at' => now()]);
        $this->confirmedDonation($c, 50, 'Gizli Kişi', false);
        $this->confirmedDonation($c, 70, 'Ahmet Yılmaz', true);

        $this->get("/campaign/{$c->id}")->assertOk()
            ->assertSee('data-tab="updates"', false)->assertSee('Ameliyat yapıldı')
            ->assertSee('data-tab="donations"', false)
            ->assertSee('Ahmet Yılmaz')->assertSee('Hayırsever')
            ->assertDontSee('Gizli Kişi');
    }

    public function test_donors_tab_can_be_hidden_from_admin()
    {
        $c = $this->makeCampaign(['show_donors' => false]);
        $this->confirmedDonation($c, 70, 'Ahmet Yılmaz', true);

        $this->get("/campaign/{$c->id}")->assertOk()
            ->assertDontSee('data-tab="donations"', false)->assertDontSee('Ahmet Yılmaz');
    }

    public function test_share_is_counted_once_per_visitor()
    {
        $c = $this->makeCampaign();
        $this->postJson("/campaign/{$c->id}/share")->assertOk()->assertJson(['count' => 1]);
        $this->postJson("/campaign/{$c->id}/share")->assertOk()->assertJson(['count' => 1]);
        $this->assertSame(1, $c->fresh()->share_count);
    }

    public function test_listing_filters_and_sorting()
    {
        $zakat = $this->makeCampaign(['accepts_zakat' => true], 'Filtre Zekat Kampanyasi');
        $urgent = $this->makeCampaign(['is_urgent' => true], 'Filtre Acil Kampanyasi');
        $plain = $this->makeCampaign([], 'Filtre Normal Kampanyasi');

        $this->get('/campaigns?zakat=1')->assertOk()->assertSee('Filtre Zekat Kampanyasi')->assertDontSee('Filtre Normal Kampanyasi');
        $this->get('/campaigns?q=Acil+Kampanyasi')->assertOk()->assertSee('Filtre Acil Kampanyasi')->assertDontSee('Filtre Zekat Kampanyasi');

        $html = $this->get('/campaigns?sort=urgent')->assertOk()->getContent();
        $this->assertLessThan(strpos($html, 'Filtre Normal Kampanyasi'), strpos($html, 'Filtre Acil Kampanyasi'));
    }

    public function test_admin_manages_updates_and_campaign_flags()
    {
        Storage::fake('public');
        $admin = User::whereHas('roles', fn ($q) => $q->where('name', 'super_admin'))->firstOrFail();
        $c = $this->makeCampaign();

        $this->actingAs($admin)->get(route('admin.campaigns.updates.index', $c))->assertOk();
        $this->actingAs($admin)->post(route('admin.campaigns.updates.store', $c), [
            'title_tr' => 'İlk gelişme', 'title_ar' => 'أول تحديث', 'body_tr' => 'Metin', 'published_at' => now()->format('Y-m-d'),
            'image' => UploadedFile::fake()->image('u.jpg', 400, 300),
        ])->assertRedirect(route('admin.campaigns.updates.index', $c));

        $update = CampaignUpdate::where('campaign_id', $c->id)->firstOrFail();
        Storage::disk('public')->assertExists('campaign_updates/' . $update->image);

        $this->actingAs($admin)->put(route('admin.campaigns.updates.update', [$c, $update]), [
            'title_tr' => 'Güncellendi', 'body_tr' => 'Metin', 'published_at' => now()->format('Y-m-d'),
        ])->assertRedirect();
        $this->assertSame('Güncellendi', $update->fresh()->title_tr);

        // campaign flags through the admin edit form
        $payload = ['c_category_id' => $c->c_category_id, 'status' => 'active', 'complete' => 'no', 'goal' => 1000,
            'is_urgent' => '1', 'accepts_zakat' => '1', 'show_donors' => '0', 'show_in_slider' => '0'];
        foreach (config('translatable.locales') as $l) {
            $payload[$l] = ['name' => "Ad $l", 'name_slug' => "ad-$l", 'country' => 'Nizip', 'description' => 'x',
                'meta_title' => 'x', 'meta_description' => 'x', 'keywords' => 'x', 'image_alt' => 'x'];
        }
        $this->actingAs($admin)->put(route('admin.campaigns.update', $c), $payload)->assertRedirect();
        $c->refresh();
        $this->assertTrue($c->is_urgent);
        $this->assertTrue($c->accepts_zakat);
        $this->assertFalse($c->show_donors);

        $this->actingAs($admin)->delete(route('admin.campaigns.updates.destroy', [$c, $update]))->assertRedirect();
        $this->assertNull($update->fresh());
    }
}
