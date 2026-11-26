<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Services\CartService;
use Illuminate\Http\Request;

/**
 * Donation cart pages and AJAX actions.
 * All state changes are POST (CSRF-protected) and only touch the visitor's own rows.
 */
class CartController extends Controller
{
    public function index(CartService $cart)
    {
        [$items, $removed] = $cart->items();
        $total = $cart->total($items);

        return view('web.cart', compact('items', 'total', 'removed'));
    }

    public function add(Request $request, CartService $cart)
    {
        $data = $this->validateAmount($request, [
            'campaign_id' => 'required|integer',
        ]);

        $campaign = Campaign::query()->find($data['campaign_id']);
        if (!CartService::campaignIsDonatable($campaign)) {
            return response()->json(['message' => __('site.cart_campaign_unavailable')], 422);
        }

        $cart->add($campaign, (float) $data['amount']);

        return response()->json([
            'message' => __('site.cart_added'),
            'count' => $cart->count(),
        ]);
    }

    public function update(Request $request, CartService $cart)
    {
        $data = $this->validateAmount($request, ['id' => 'required|integer']);

        $row = $cart->find((int) $data['id']);
        abort_unless($row, 404);
        $cart->setAmount($row, (float) $data['amount']);

        [$items] = $cart->items();

        return response()->json([
            'message' => __('site.updated_successfully'),
            'count' => $items->count(),
            'total' => $cart->total($items),
        ]);
    }

    public function remove(Request $request, CartService $cart)
    {
        $data = $request->validate(['id' => 'required|integer']);

        $row = $cart->find((int) $data['id']);
        abort_unless($row, 404);
        $row->delete();

        [$items] = $cart->items();

        return response()->json([
            'message' => __('site.deleted_successfully'),
            'count' => $items->count(),
            'total' => $cart->total($items),
        ]);
    }

    private function validateAmount(Request $request, array $rules): array
    {
        // accept "1.250,50" or "1250.50"
        if (is_string($request->input('amount'))) {
            $raw = trim($request->input('amount'));
            if (str_contains($raw, ',')) {
                $raw = str_replace(['.', ','], ['', '.'], $raw);
            }
            $request->merge(['amount' => $raw]);
        }

        return $request->validate($rules + [
            'amount' => 'required|numeric|min:' . \App\Support\DonationSettings::min() . '|max:' . \App\Support\DonationSettings::max(),
        ], [], ['amount' => __('site.donation_amount')]);
    }
}
