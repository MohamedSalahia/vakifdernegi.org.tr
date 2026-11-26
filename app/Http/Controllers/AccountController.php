<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DonationController;
use App\Models\Campaign;
use App\Models\Donation;
use App\Services\CartService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rules\Password;

/**
 * "Hesabım": the donor's donations (made while signed in, or with the same e-mail once
 * that e-mail is verified), printable receipts, repeat donation, profile and password.
 */
class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function myDonations(): Builder
    {
        $user = auth()->user();

        return Donation::query()->where(function ($q) use ($user) {
            $q->where('user_id', $user->id);
            if ($user->email_verified_at && $user->email) {
                $q->orWhereRaw('LOWER(donor_email) = ?', [strtolower($user->email)]);
            }
        });
    }

    public function index()
    {
        $donations = $this->myDonations()->with('items')->latest('id')->paginate(15);
        $totals = [
            'confirmed' => (float) $this->myDonations()->where('status', Donation::CONFIRMED)->sum('amount'),
            'count' => $this->myDonations()->where('status', Donation::CONFIRMED)->count(),
            'pending' => $this->myDonations()->where('status', Donation::PENDING)->count(),
        ];

        return view('web.account', ['user' => auth()->user(), 'donations' => $donations, 'totals' => $totals]);
    }

    public function show(Donation $donation)
    {
        $this->authorizeDonation($donation);

        return redirect()->to($donation->thanksUrl());
    }

    public function receipt(Donation $donation)
    {
        $this->authorizeDonation($donation);
        abort_unless($donation->status === Donation::CONFIRMED, 404);
        $donation->load('items');

        return view('web.receipt', compact('donation'));
    }

    public function repeat(Donation $donation, CartService $cart)
    {
        $this->authorizeDonation($donation);
        $items = $donation->items()->get();

        if ($items->count() === 1) {
            $item = $items->first();
            if ($item->campaign_id) {
                $campaign = Campaign::find($item->campaign_id);
                if ($campaign && $campaign->isOpenForDonations()) {
                    return redirect()->route('donate.campaign', ['campaign' => $campaign->id, 'amount' => (float) $item->amount]);
                }
            } elseif (in_array($item->donation_type, DonationController::ZAKAT_TYPES, true)) {
                return redirect()->route('donate.zakat', ['price' => (float) $item->amount, 'typeOfDonate' => $item->donation_type]);
            }
        } else {
            $added = 0;
            foreach ($items as $item) {
                $campaign = $item->campaign_id ? Campaign::find($item->campaign_id) : null;
                if ($campaign && $campaign->isOpenForDonations()) {
                    $cart->add($campaign, (float) $item->amount);
                    $added++;
                }
            }
            if ($added > 0) {
                return redirect()->route('cart');
            }
        }

        return back()->with('error', __('site.repeat_unavailable'));
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:30',
        ], [], ['name' => __('site.full_name'), 'phone' => __('site.phone')]);
        $request->user()->update($data);

        return back()->with('success', __('site.updated_successfully'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)],
        ], [], ['password' => __('site.password')]);
        $request->user()->forceFill(['password' => Hash::make($request->password)])->save();

        return back()->with('success', __('site.password_updated'));
    }

    private function authorizeDonation(Donation $donation): void
    {
        abort_unless($this->myDonations()->whereKey($donation->id)->exists(), 404);
    }
}
