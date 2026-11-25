<?php

namespace Tests\Feature;

use App\Models\Donation;
use App\Models\User;
use App\Models\UserCart;
use App\Services\CartService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/** Donation cart. Runs inside a rolled-back transaction (never RefreshDatabase). */
class CartTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withCredentials(); // send cookies with JSON requests, like the browser's fetch(credentials: 'same-origin')
    }

    private function makeCampaign(array $attrs = []): int
    {
        $id = DB::table('campaigns')->insertGetId($attrs + [
            'c_category_id' => DB::table('campaign_categories')->whereNull('deleted_at')->value('id'),
            'image' => null, 'goal' => 1000, 'status' => 'active', 'complete' => 'no',
            'created_at' => now(), 'updated_at' => now(),
        ]);
        foreach (['tr', 'ar'] as $locale) {
            DB::table('campaign_translations')->insert([
                'campaign_id' => $id, 'locale' => $locale, 'name' => "Sepet Test $id $locale",
                'name_slug' => "sepet-test-$id-$locale", 'description' => 'x', 'country' => 'Nizip',
            ]);
        }

        return $id;
    }

    private function guestToken($response): string
    {
        return $response->getCookie(CartService::COOKIE)->getValue();
    }

    public function test_guest_can_add_and_see_items_and_amounts_are_summed()
    {
        $c = $this->makeCampaign();

        $r = $this->postJson('/cart/add', ['campaign_id' => $c, 'amount' => 50])->assertOk()->assertJson(['count' => 1]);
        $token = $this->guestToken($r);

        $this->withCookie(CartService::COOKIE, $token)->postJson('/cart/add', ['campaign_id' => $c, 'amount' => '25'])
            ->assertOk()->assertJson(['count' => 1]);

        $row = UserCart::where('cookie_cart_identifier', $token)->firstOrFail();
        $this->assertEquals(75, (float) $row->total_price);

        $this->withCookie(CartService::COOKIE, $token)->get('/cart')->assertOk()->assertSee("Sepet Test $c tr")->assertSee('75,00');
    }

    public function test_invalid_requests_are_rejected_with_422()
    {
        $c = $this->makeCampaign();
        $hidden = $this->makeCampaign(['deleted_at' => now()]);
        $inactive = $this->makeCampaign(['status' => 'deactivate']);
        $completed = $this->makeCampaign(['complete' => 'yes']);

        $this->postJson('/cart/add', ['amount' => 50])->assertStatus(422);
        $this->postJson('/cart/add', ['campaign_id' => $c, 'amount' => -500])->assertStatus(422);
        $this->postJson('/cart/add', ['campaign_id' => $c, 'amount' => 2])->assertStatus(422);
        $this->postJson('/cart/add', ['campaign_id' => $c, 'amount' => 'abc'])->assertStatus(422);
        foreach ([$hidden, $inactive, $completed, 999999] as $id) {
            $this->postJson('/cart/add', ['campaign_id' => $id, 'amount' => 50])->assertStatus(422);
        }
        $this->assertSame(0, UserCart::whereIn('campaign_id', [$c, $hidden, $inactive, $completed])->count());
    }

    public function test_state_changes_are_not_possible_with_get()
    {
        $this->get('/cart/add?campaign_id=1&amount=50')->assertStatus(405);
        $this->get('/cart/remove?id=1')->assertStatus(405);
    }

    public function test_visitor_cannot_touch_someone_elses_cart_row()
    {
        $c = $this->makeCampaign();
        $owner = User::firstOrFail();
        $row = UserCart::create(['user_id' => $owner->id, 'campaign_id' => $c, 'price' => 40, 'total_price' => 40, 'status' => 0]);

        $this->postJson('/cart/remove', ['id' => $row->id])->assertNotFound();
        $this->postJson('/cart/update', ['id' => $row->id, 'amount' => 999])->assertNotFound();
        $this->assertEquals(40, (float) $row->fresh()->total_price);
    }

    public function test_logged_in_user_stays_logged_in_and_can_update_and_remove()
    {
        $c = $this->makeCampaign();
        $user = User::firstOrFail();
        UserCart::where('user_id', $user->id)->delete();

        $this->actingAs($user)->postJson('/cart/add', ['campaign_id' => $c, 'amount' => 30])->assertOk();
        $this->assertAuthenticatedAs($user); // the old code flushed the whole session (logged users out)

        $row = UserCart::where('user_id', $user->id)->where('campaign_id', $c)->firstOrFail();
        $this->actingAs($user)->postJson('/cart/update', ['id' => $row->id, 'amount' => 120])->assertOk()->assertJson(['total' => 120]);
        $this->actingAs($user)->postJson('/cart/remove', ['id' => $row->id])->assertOk()->assertJson(['count' => 0]);
        $this->assertNull($row->fresh());
    }

    public function test_cart_page_drops_items_whose_campaign_is_no_longer_available()
    {
        $c = $this->makeCampaign();
        $user = User::firstOrFail();
        UserCart::where('user_id', $user->id)->delete();
        $row = UserCart::create(['user_id' => $user->id, 'campaign_id' => $c, 'price' => 40, 'total_price' => 40, 'status' => 0]);
        DB::table('campaigns')->where('id', $c)->update(['deleted_at' => now()]);

        $this->actingAs($user)->get('/cart')->assertOk(); // used to crash with a 500
        $this->assertNull($row->fresh());
    }

    public function test_guest_cart_moves_to_account_on_login()
    {
        $c = $this->makeCampaign();
        $user = User::firstOrFail();
        UserCart::where('user_id', $user->id)->delete();

        $r = $this->postJson('/cart/add', ['campaign_id' => $c, 'amount' => 60])->assertOk();
        $token = $this->guestToken($r);

        $this->app['request']->cookies->set(CartService::COOKIE, $token);
        app(CartService::class)->mergeGuestCartInto($user->id);

        $this->assertSame(1, UserCart::where('user_id', $user->id)->where('campaign_id', $c)->count());
        $this->assertSame(0, UserCart::where('cookie_cart_identifier', $token)->count());
    }

    public function test_guest_can_donate_the_whole_cart()
    {
        $a = $this->makeCampaign();
        $b = $this->makeCampaign();

        $r = $this->postJson('/cart/add', ['campaign_id' => $a, 'amount' => 50]);
        $token = $this->guestToken($r);
        $this->withCookie(CartService::COOKIE, $token)->postJson('/cart/add', ['campaign_id' => $b, 'amount' => 70])->assertOk();

        $this->withCookie(CartService::COOKIE, $token)->get('/donate/cart')->assertOk()->assertSee('120,00');
        $this->withCookie(CartService::COOKIE, $token)->post('/donate', ['donor_name' => 'Misafir', 'kvkk' => '1'])->assertRedirect();

        $donation = Donation::with('items')->latest('id')->firstOrFail();
        $this->assertEquals(120, (float) $donation->amount);
        $this->assertEqualsCanonicalizing([$a, $b], $donation->items->pluck('campaign_id')->all());
        $this->assertSame(0, UserCart::where('cookie_cart_identifier', $token)->count()); // cart emptied
    }
}
