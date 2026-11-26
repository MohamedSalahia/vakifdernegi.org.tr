<?php

namespace App\Http\Controllers;

use App\Models\AnnualReport;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\DonationItem;
use App\Models\Expense;
use App\Models\Faq;
use App\Support\DonationSettings;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/** Public trust pages: transparency (received vs spent), annual reports, help centre. */
class TransparencyController extends Controller
{
    public function transparency()
    {
        abort_unless(DonationSettings::enabled('transparency'), 404);

        $confirmed = Donation::query()->where('status', Donation::CONFIRMED);
        $yearStart = now()->startOfYear();

        $summary = [
            'received_total' => (float) (clone $confirmed)->sum('amount'),
            'received_year' => (float) (clone $confirmed)->where('confirmed_at', '>=', $yearStart)->sum('amount'),
            'donations_count' => (clone $confirmed)->count(),
            'zakat_total' => (float) (clone $confirmed)->where('is_zakat', true)->sum('amount'),
            'spent_total' => (float) Expense::where('is_public', true)->sum('amount'),
            'spent_year' => (float) Expense::where('is_public', true)->where('spent_at', '>=', $yearStart)->sum('amount'),
        ];

        // last 12 months: received vs spent
        $from = now()->startOfMonth()->subMonths(11);
        $received = (clone $confirmed)->where('confirmed_at', '>=', $from)
            ->selectRaw("DATE_FORMAT(confirmed_at, '%Y-%m') as ym, SUM(amount) as total")->groupBy('ym')->pluck('total', 'ym');
        $spent = Expense::where('is_public', true)->where('spent_at', '>=', $from)
            ->selectRaw("DATE_FORMAT(spent_at, '%Y-%m') as ym, SUM(amount) as total")->groupBy('ym')->pluck('total', 'ym');
        $months = collect(range(0, 11))->map(function ($i) use ($from, $received, $spent) {
            $m = (clone $from)->addMonths($i);
            $ym = $m->format('Y-m');

            return ['month' => $m, 'received' => (float) ($received[$ym] ?? 0), 'spent' => (float) ($spent[$ym] ?? 0)];
        })->reverse()->values();

        // per campaign: raised vs spent
        $raisedBy = DonationItem::query()->whereNotNull('campaign_id')
            ->whereHas('donation', fn ($q) => $q->where('status', Donation::CONFIRMED))
            ->selectRaw('campaign_id, SUM(amount) as total')->groupBy('campaign_id')->pluck('total', 'campaign_id');
        $spentBy = Expense::where('is_public', true)->whereNotNull('campaign_id')
            ->selectRaw('campaign_id, SUM(amount) as total')->groupBy('campaign_id')->pluck('total', 'campaign_id');
        $campaignIds = $raisedBy->keys()->merge($spentBy->keys())->unique();
        $perCampaign = Campaign::withTrashed()->with('translations')->whereIn('id', $campaignIds)->get()
            ->map(fn ($c) => ['campaign' => $c, 'raised' => (float) ($raisedBy[$c->id] ?? 0), 'spent' => (float) ($spentBy[$c->id] ?? 0)])
            ->sortByDesc('raised')->values();

        $expenses = Expense::with('campaign.translations')->where('is_public', true)
            ->orderByDesc('spent_at')->orderByDesc('id')->limit(30)->get();

        return view('web.transparency', compact('summary', 'months', 'perCampaign', 'expenses'));
    }

    public function reports()
    {
        $reports = AnnualReport::where('is_published', true)->orderByDesc('year')->orderByDesc('id')->get();

        return view('web.reports', compact('reports'));
    }

    public function help()
    {
        $faqs = Faq::where('is_active', true)->orderBy('sort_order')->orderBy('id')->get()->groupBy('category');
        $categories = collect(Faq::CATEGORIES)->filter(fn ($c) => $faqs->has($c));

        return view('web.help', compact('faqs', 'categories'));
    }
}
