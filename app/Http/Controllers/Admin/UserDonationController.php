<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\DonationConfirmed;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\DataTables;

/**
 * Admin screen for donations made on the site.
 * An admin confirms a donation once the transfer appears in the bank account
 * (the donor then receives a confirmation e-mail), or cancels it.
 */
class UserDonationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_user_donations')->only(['index', 'data', 'show']);
        $this->middleware('permission:update_user_donations')->only(['confirm', 'cancel', 'note']);
    }

    public function index()
    {
        $counts = Donation::query()->selectRaw('status, count(*) as total, sum(amount) as amount')->groupBy('status')->get()->keyBy('status');

        return view('admin.user_donations.index', compact('counts'));
    }

    public function data(Request $request)
    {
        $donations = Donation::query()->with('items')
            ->when(in_array($request->status, [Donation::PENDING, Donation::CONFIRMED, Donation::CANCELLED], true),
                fn ($q) => $q->where('status', $request->status))
            ->select('donations.*');

        return DataTables::of($donations)
            ->addColumn('items_label', fn (Donation $d) => e($d->items->pluck('label')->implode(', ')))
            ->editColumn('amount', fn (Donation $d) => number_format($d->amount, 2, ',', '.') . ' TL')
            ->editColumn('created_at', fn (Donation $d) => $d->created_at->format('Y-m-d H:i'))
            ->addColumn('status_badge', 'admin.user_donations.data_table.status')
            ->addColumn('actions', 'admin.user_donations.data_table.actions')
            ->rawColumns(['status_badge', 'actions'])
            ->toJson();
    }

    public function show(Donation $donation)
    {
        $donation->load(['items.campaign', 'user', 'confirmer']);

        return view('admin.user_donations.show', compact('donation'));
    }

    public function confirm(Request $request, Donation $donation)
    {
        $request->validate(['admin_note' => 'nullable|string|max:2000']);

        if ($donation->status !== Donation::PENDING) {
            return back()->with('error', __('site.donation_not_pending'));
        }

        $donation->update([
            'status' => Donation::CONFIRMED,
            'confirmed_at' => now(),
            'confirmed_by' => auth()->id(),
            'admin_note' => $request->admin_note ?: $donation->admin_note,
        ]);

        if ($donation->donor_email) {
            try {
                Mail::to($donation->donor_email)->send(new DonationConfirmed($donation->fresh('items')));
            } catch (\Throwable $e) {
                Log::warning('Donation confirmation email failed', ['reference' => $donation->reference, 'error' => $e->getMessage()]);
                session()->flash('error', __('site.donation_email_failed'));
            }
        }

        session()->flash('success', __('site.donation_confirmed_admin'));

        return redirect()->route('admin.user_donations.show', $donation);
    }

    public function cancel(Request $request, Donation $donation)
    {
        $request->validate(['admin_note' => 'nullable|string|max:2000']);

        if ($donation->status !== Donation::PENDING) {
            return back()->with('error', __('site.donation_not_pending'));
        }

        $donation->update([
            'status' => Donation::CANCELLED,
            'cancelled_at' => now(),
            'admin_note' => $request->admin_note ?: $donation->admin_note,
        ]);

        session()->flash('success', __('site.donation_cancelled_admin'));

        return redirect()->route('admin.user_donations.show', $donation);
    }

    public function note(Request $request, Donation $donation)
    {
        $data = $request->validate(['admin_note' => 'nullable|string|max:2000']);
        $donation->update($data);
        session()->flash('success', __('site.updated_successfully'));

        return redirect()->route('admin.user_donations.show', $donation);
    }
}
