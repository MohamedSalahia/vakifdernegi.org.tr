<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Page;
use App\Models\UserCart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Donation checkout page.
 *
 * Shows the donor a clear summary (what, how much, in TL), the legal policies
 * they agree to, and how to pay. Until a card gateway (bank Sanal POS / iyzico /
 * PayTR ...) is approved, payment is by bank transfer with a reference number.
 */
class DonationController extends WebController
{
    public const MIN_AMOUNT = 5;
    public const MAX_AMOUNT = 1000000;

    public const ZAKAT_TYPES = ['sadaka', 'zakat', 'kfaratYamin', 'kfaratSiyam', 'nzr'];

    public function campaign(Request $request, Campaign $campaign)
    {
        abort_if($campaign->status !== 'active' || $campaign->complete === 'yes', 404);

        $amount = $this->validAmount($request->input('priceLive', $request->input('amount')));
        if ($amount === null) {
            return back()->with('error', __('site.invalid_amount'));
        }

        return $this->checkout([
            'title'  => $campaign->name,
            'type'   => __('site.campaign_name'),
            'items'  => [['name' => $campaign->name, 'amount' => $amount]],
            'amount' => $amount,
        ]);
    }

    public function zakat(Request $request)
    {
        $amount = $this->validAmount($request->input('price'));
        if ($amount === null) {
            return back()->with('error', __('site.invalid_amount'));
        }

        $type = in_array($request->input('typeOfDonate'), self::ZAKAT_TYPES, true)
            ? $request->input('typeOfDonate')
            : 'sadaka';
        $typeLabel = __('site.' . ($type === 'zakat' ? 'zakat_type' : $type));

        return $this->checkout([
            'title'  => $typeLabel,
            'type'   => $typeLabel,
            'items'  => [['name' => $typeLabel, 'amount' => $amount]],
            'amount' => $amount,
        ]);
    }

    public function cart()
    {
        $userCarts = UserCart::query()->with('campaign')->where('user_id', auth()->id())->get();
        if ($userCarts->isEmpty()) {
            return redirect()->route('cart');
        }

        $items = $userCarts->map(fn ($c) => [
            'name'   => optional($c->campaign)->name,
            'amount' => (float) $c->total_price,
        ])->all();

        return $this->checkout([
            'title'  => __('site.cart_donation'),
            'type'   => __('site.cart_donation'),
            'items'  => $items,
            'amount' => (float) $userCarts->sum('total_price'),
        ]);
    }

    private function checkout(array $donation)
    {
        $donation['reference'] = 'BAG-' . now()->format('ymd') . '-' . strtoupper(Str::random(5));
        $bankPage = Page::query()->find(5); // "Bank accounts" page managed from admin
        $cardPaymentEnabled = (bool) config('donation.card_payment_enabled');

        return view('web.donation_checkout', compact('donation', 'bankPage', 'cardPaymentEnabled'));
    }

    private function validAmount($value): ?float
    {
        if (!is_numeric($value)) {
            return null;
        }
        $amount = round((float) $value, 2);

        return ($amount >= self::MIN_AMOUNT && $amount <= self::MAX_AMOUNT) ? $amount : null;
    }
}
