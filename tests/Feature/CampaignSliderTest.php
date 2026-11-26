<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/** "Show in slider" option for campaigns + header campaigns link. Rolled back after each test. */
class CampaignSliderTest extends TestCase
{
    use DatabaseTransactions;

    private function makeCampaign(array $attrs = []): int
    {
        $id = DB::table('campaigns')->insertGetId($attrs + [
            'c_category_id' => DB::table('campaign_categories')->whereNull('deleted_at')->value('id'),
            'image' => null, 'goal' => 5000, 'status' => 'active', 'complete' => 'no', 'show_in_slider' => false,
            'created_at' => now(), 'updated_at' => now(),
        ]);
        foreach (['tr', 'ar', 'en'] as $locale) {
            DB::table('campaign_translations')->insert([
                'campaign_id' => $id, 'locale' => $locale, 'name' => "Slider Kampanya $id",
                'name_slug' => "slider-kampanya-$id-$locale", 'description' => 'x', 'country' => 'Nizip',
            ]);
        }

        return $id;
    }

    public function test_featured_campaign_appears_in_home_slider_only_when_enabled_and_open()
    {
        $on = $this->makeCampaign(['show_in_slider' => true]);
        $off = $this->makeCampaign();
        $completed = $this->makeCampaign(['show_in_slider' => true, 'complete' => 'yes']);

        $html = $this->get('/')->assertOk()->getContent();

        $this->assertStringContainsString("Slider Kampanya $on</h1>", $html);
        $this->assertStringNotContainsString("Slider Kampanya $off</h1>", $html);
        $this->assertStringNotContainsString("Slider Kampanya $completed</h1>", $html);
    }

    public function test_header_links_to_the_campaigns_page()
    {
        $this->get('/')->assertOk()
            ->assertSee('class="allow-link"', false)
            ->assertSee(route('campaigns'), false);
    }

    public function test_admin_campaign_forms_have_the_slider_option()
    {
        $admin = User::whereHas('roles', fn ($q) => $q->where('name', 'super_admin'))->firstOrFail();
        $id = $this->makeCampaign(['show_in_slider' => true]);

        $this->actingAs($admin)->get(route('admin.campaigns.create'))->assertOk()->assertSee('name="show_in_slider"', false);
        $this->actingAs($admin)->get(route('admin.campaigns.edit', $id))->assertOk()
            ->assertSee('name="show_in_slider"', false)
            ->assertSee('<option value="1" selected', false);
    }
}
