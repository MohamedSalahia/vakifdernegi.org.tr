<?php

namespace App\Http\Controllers;

use App\Mail\DonationReceived;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Page;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

/**
 * Donation flow:
 *  1. campaign()/zakat()/cart() build the donation (what + how much) server side,
 *     keep it in the session and show the checkout page (summary, policies, donor form);
 *  2. store() saves it as a pending Donation with a unique reference;
 *  3. show() displays the reference and how to pay (bank transfer until a card gateway is live).
 * An admin confirms the donation when the money arrives (Admin\UserDonationController).
 */
class DonationController extends WebController
{
    public const MIN_AMOUNT = 5;
    public const MAX_AMOUNT = 1000000;
    public const ZAKAT_TYPES = ['sadaka', 'zakat', 'kfaratYamin', 'kfaratSiyam', 'nzr'];
    private const SESSION_KEY = 'donation_checkout';

    public function campaign(Request $request, Campaign $campaign)
    {
        abort_if($campaign->status !== 'active' || $campaign->complete === 'yes', 404);

        $amount = $this->validAmount($request->input('priceLive', $request->input('amount')));
        if ($amount === null) {
            return back()->with('error', __('site.invalid_amount'));
        }

        return $this->checkout([
            'kind' => 'campaign',
            'title' => $campaign->name,
            'type' => __('site.campaign_name'),
            'items' => [[
                'campaign_id' => $campaign->id,
                'donation_type' => 'campaign',
                'label' => $campaign->name,
                'amount' => $amount,
            ]],
        ]);
    }

    public function zakat(Request $request)
    {
        $amount = $this->validAmount($request->input('price'));
        if ($amount === null) {
            return back()->with('error', __('site.invalid_amount'));
        }

        $type = in_array($request->input('typeOfDonate'), self::ZAKAT_TYPES, true) ? $request->input('typeOfDonate') : 'sadaka';
        $label = self::typeLabel($type);

        return $this->checkout([
            'kind' => 'zakat',
            'title' => $label,
            'type' => $label,
            'items' => [[
                'campaign_id' => null,
                'donation_type' => $type,
                'label' => $label,
                'amount' => $amount,
            ]],
        ]);
    }

    public function cart(CartService $cart)
    {
        [$items] = $cart->items();
        if ($items->isEmpty()) {
            return redirect()->route('cart');
        }

        return $this->checkout([
            'kind' => 'cart',
            'title' => __('site.cart_donation'),
            'type' => __('site.cart_donation'),
            'items' => $items->map(fn ($c) => [
                'campaign_id' => $c->campaign_id,
                'donation_type' => 'campaign',
                'label' => $c->campaign->name,
                'amount' => round((float) $c->total_price, 2),
            ])->values()->all(),
        ]);
    }

    public function store(Request $request)
    {
        $checkout = session(self::SESSION_KEY);
        if (!$checkout || empty($checkout['items'])) {
            return redirect()->route('/')->with('error', __('site.donation_session_expired'));
        }

        $data = $request->validate([
            'donor_name' => 'required|string|max:100',
            'donor_email' => 'nullable|email|max:150',
            'donor_phone' => 'nullable|string|max:30',
            'kvkk' => 'accepted',
        ], [], [
            'donor_name' => __('site.full_name'),
            'donor_email' => __('site.email'),
            'donor_phone' => __('site.phone'),
        ]);

        $donation = DB::transaction(function () use ($checkout, $data, $request) {
            $donation = Donation::create([
                'reference' => Donation::newReference(),
                'user_id' => auth()->id(),
                'amount' => collect($checkout['items'])->sum('amount'),
                'currency' => 'TRY',
                'donor_name' => $data['donor_name'],
                'donor_email' => $data['donor_email'] ?? null,
                'donor_phone' => $data['donor_phone'] ?? null,
                'payment_method' => 'bank_transfer',
                'status' => Donation::PENDING,
                'locale' => app()->getLocale(),
                'kvkk_accepted_at' => now(),
                'ip' => $request->ip(),
            ]);
            $donation->items()->createMany($checkout['items']);

            if ($checkout['kind'] === 'cart') {
                app(CartService::class)->clear();
            }

            return $donation;
        });

        session()->forget(self::SESSION_KEY);

        if ($donation->donor_email) {
            try {
                Mail::to($donation->donor_email)->send(new DonationReceived($donation));
            } catch (\Throwable $e) {
                Log::warning('Donation instructions email failed', ['reference' => $donation->reference, 'error' => $e->getMessage()]);
            }
        }

        return redirect()->to(URL::signedRoute('donate.show', ['donation' => $donation->reference]));
    }

    public function show(Donation $donation)
    {
        $donation->load('items');
        $bankPage = config('donation.bank_transfer_enabled') ? Page::query()->find(5) : null;

        return view('web.donation_thanks', compact('donation', 'bankPage'));
    }

    public static function typeLabel(string $type): string
    {
        return $type === 'campaign' ? __('site.campaign_name') : __('site.' . ($type === 'zakat' ? 'zakat_type' : $type));
    }

    private function checkout(array $donation)
    {
        $donation['amount'] = collect($donation['items'])->sum('amount');
        session([self::SESSION_KEY => $donation]);

        $bankTransferEnabled = (bool) config('donation.bank_transfer_enabled');
        $cardPaymentEnabled = (bool) config('donation.card_payment_enabled');

        return view('web.donation_checkout', compact('donation', 'cardPaymentEnabled', 'bankTransferEnabled'));
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
