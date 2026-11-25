<?php

namespace App\Services;

use App\Models\Campaign;
use App\Models\UserCart;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

/**
 * Donation cart ("bağış sepeti").
 *
 * Owner: the logged-in user, otherwise a guest identified by a random, encrypted
 * "cart_token" cookie (30 days). On login the guest's items move to the account.
 * One row per campaign; the row amount is the donation for that campaign.
 * Rows use status 0 ("in cart"); the column is kept for the legacy table.
 */
class CartService
{
    public const COOKIE = 'cart_token';
    public const COOKIE_MINUTES = 60 * 24 * 30;
    public const MIN_AMOUNT = 5;
    public const MAX_AMOUNT = 1000000;

    /** Guest token from the cookie, created (and queued) on first need. */
    public function token(bool $create = false): ?string
    {
        $token = request()->cookie(self::COOKIE);
        if ($token && Str::isUuid($token)) {
            return $token;
        }
        if (!$create) {
            return null;
        }
        $token = (string) Str::uuid();
        Cookie::queue(self::COOKIE, $token, self::COOKIE_MINUTES);
        request()->cookies->set(self::COOKIE, $token); // visible for the rest of this request

        return $token;
    }

    /** Query for the current visitor's cart rows (never matches other visitors). */
    public function query(): Builder
    {
        $query = UserCart::query()->where('status', 0);

        if (auth()->check()) {
            return $query->where('user_id', auth()->id());
        }

        $token = $this->token();

        return $token
            ? $query->whereNull('user_id')->where('cookie_cart_identifier', $token)
            : $query->whereRaw('1 = 0');
    }

    public static function campaignIsDonatable(?Campaign $campaign): bool
    {
        return $campaign && !$campaign->trashed() && $campaign->status === 'active' && $campaign->complete !== 'yes';
    }

    /** Adds an amount to a campaign (summed if the campaign is already in the cart). */
    public function add(Campaign $campaign, float $amount): UserCart
    {
        $owner = auth()->check()
            ? ['user_id' => auth()->id()]
            : ['user_id' => null, 'cookie_cart_identifier' => $this->token(true)];

        $row = $this->query()->where('campaign_id', $campaign->id)->first();
        $newAmount = min(self::MAX_AMOUNT, round(($row ? (float) $row->total_price : 0) + $amount, 2));

        if ($row) {
            $row->update(['price' => $newAmount, 'total_price' => $newAmount]);

            return $row;
        }

        return UserCart::create($owner + [
            'campaign_id' => $campaign->id,
            'price' => $newAmount,
            'total_price' => $newAmount,
            'status' => 0,
        ]);
    }

    public function find(int $id): ?UserCart
    {
        return $this->query()->whereKey($id)->first();
    }

    public function setAmount(UserCart $row, float $amount): void
    {
        $row->update(['price' => $amount, 'total_price' => $amount]);
    }

    public function count(): int
    {
        return $this->query()->count();
    }

    /**
     * Current cart items, removing rows whose campaign was hidden, deleted or completed.
     * Returns [items, removedCount].
     */
    public function items(): array
    {
        $rows = $this->query()->with(['campaign' => fn ($q) => $q->withTrashed()])->orderBy('id')->get();
        $invalid = $rows->reject(fn (UserCart $r) => self::campaignIsDonatable($r->campaign));

        if ($invalid->isNotEmpty()) {
            UserCart::query()->whereIn('id', $invalid->pluck('id'))->delete();
        }

        return [$rows->diff($invalid)->values(), $invalid->count()];
    }

    public function total(Collection $items): float
    {
        return round((float) $items->sum('total_price'), 2);
    }

    public function clear(): void
    {
        $this->query()->delete();
    }

    /** Moves a guest cart to the user who just logged in (merging amounts per campaign). */
    public function mergeGuestCartInto(int $userId): void
    {
        $token = $this->token();
        if (!$token) {
            return;
        }
        $guestRows = UserCart::query()->where('status', 0)->whereNull('user_id')->where('cookie_cart_identifier', $token)->get();

        foreach ($guestRows as $guest) {
            $existing = UserCart::query()->where('status', 0)->where('user_id', $userId)->where('campaign_id', $guest->campaign_id)->first();
            if ($existing) {
                $sum = min(self::MAX_AMOUNT, round((float) $existing->total_price + (float) $guest->total_price, 2));
                $existing->update(['price' => $sum, 'total_price' => $sum]);
                $guest->delete();
            } else {
                $guest->update(['user_id' => $userId, 'cookie_cart_identifier' => null]);
            }
        }
    }
}
