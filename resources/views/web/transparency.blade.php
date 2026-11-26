@extends('layouts.web.app')
@section('page_title')@lang('site.transparency')@endsection
@push('styles')
<style>
    .vk-tp { padding: 60px 0; }
    .vk-tp__cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 36px; }
    .vk-tp__card { background: #fff; border: 1px solid #eee; border-radius: 12px; padding: 20px; }
    .vk-tp__card small { color: #777; display: block; margin-bottom: 6px; }
    .vk-tp__card strong { font-size: 24px; }
    .vk-tp h3 { margin: 30px 0 16px; }
    .vk-tp table { width: 100%; background: #fff; }
    .vk-tp th, .vk-tp td { padding: 10px; border-bottom: 1px solid #f0f0f0; text-align: start; }
    .vk-tp th { color: #666; font-weight: 600; background: #fafafa; }
    .vk-tp .vk-bar { height: 8px; border-radius: 6px; background: #eee; min-width: 80px; overflow: hidden; }
    .vk-tp .vk-bar span { display: block; height: 100%; background: var(--theme-color, #8a1f5c); }
    .vk-tp__note { background: #f7f7f7; border-radius: 10px; padding: 16px 18px; color: #555; }
</style>
@endpush
@section('content')
    @include('web.partials.page_header', ['title' => __('site.transparency')])
    <section class="vk-tp"><div class="auto-container">
        <p style="font-size:17px">@lang('site.transparency_intro')</p>

        <div class="vk-tp__cards">
            <div class="vk-tp__card"><small>@lang('site.tp_received_total')</small><strong dir="ltr">{{ number_format($summary['received_total'], 0, ',', '.') }} TL</strong></div>
            <div class="vk-tp__card"><small>@lang('site.tp_spent_total')</small><strong dir="ltr">{{ number_format($summary['spent_total'], 0, ',', '.') }} TL</strong></div>
            <div class="vk-tp__card"><small>@lang('site.tp_received_year', ['year' => date('Y')])</small><strong dir="ltr">{{ number_format($summary['received_year'], 0, ',', '.') }} TL</strong></div>
            <div class="vk-tp__card"><small>@lang('site.tp_spent_year', ['year' => date('Y')])</small><strong dir="ltr">{{ number_format($summary['spent_year'], 0, ',', '.') }} TL</strong></div>
            <div class="vk-tp__card"><small>@lang('site.tp_donations_count')</small><strong>{{ number_format($summary['donations_count'], 0, ',', '.') }}</strong></div>
            <div class="vk-tp__card"><small>@lang('site.tp_zakat_total')</small><strong dir="ltr">{{ number_format($summary['zakat_total'], 0, ',', '.') }} TL</strong></div>
        </div>

        <h3>@lang('site.tp_monthly')</h3>
        <div class="table-responsive"><table>
            <thead><tr><th>@lang('site.tp_month')</th><th>@lang('site.tp_received')</th><th>@lang('site.tp_spent')</th></tr></thead>
            <tbody>
            @foreach($months as $m)
                <tr>
                    <td>{{ $m['month']->locale(app()->getLocale())->translatedFormat('F Y') }}</td>
                    <td dir="ltr">{{ number_format($m['received'], 0, ',', '.') }} TL</td>
                    <td dir="ltr">{{ number_format($m['spent'], 0, ',', '.') }} TL</td>
                </tr>
            @endforeach
            </tbody>
        </table></div>

        @if($perCampaign->isNotEmpty())
            <h3>@lang('site.tp_per_campaign')</h3>
            <div class="table-responsive"><table>
                <thead><tr><th>@lang('site.campaign_name')</th><th>@lang('site.tp_received')</th><th>@lang('site.tp_spent')</th><th></th></tr></thead>
                <tbody>
                @foreach($perCampaign as $row)
                    @php $ratio = $row['raised'] > 0 ? min(100, round($row['spent'] / $row['raised'] * 100)) : 0; @endphp
                    <tr>
                        <td>{{ $row['campaign']->name }}</td>
                        <td dir="ltr">{{ number_format($row['raised'], 0, ',', '.') }} TL</td>
                        <td dir="ltr">{{ number_format($row['spent'], 0, ',', '.') }} TL</td>
                        <td style="width:160px"><div class="vk-bar" title="%{{ $ratio }}"><span style="width:{{ $ratio }}%"></span></div></td>
                    </tr>
                @endforeach
                </tbody>
            </table></div>
        @endif

        <h3>@lang('site.tp_latest_expenses')</h3>
        @if($expenses->isEmpty())
            <p class="vk-tp__note">@lang('site.tp_no_expenses')</p>
        @else
            <div class="table-responsive"><table>
                <thead><tr><th>@lang('site.update_date')</th><th>@lang('site.tp_expense')</th><th>@lang('site.campaign_name')</th><th>@lang('site.price')</th><th></th></tr></thead>
                <tbody>
                @foreach($expenses as $e)
                    <tr>
                        <td dir="ltr">{{ $e->spent_at->format('d.m.Y') }}</td>
                        <td><strong>{{ $e->localized('title') }}</strong>@if($e->localized('description'))<br><small style="color:#777">{{ $e->localized('description') }}</small>@endif</td>
                        <td>{{ optional($e->campaign)->name ?: __('site.expense_general') }}</td>
                        <td dir="ltr">{{ number_format($e->amount, 0, ',', '.') }} TL</td>
                        <td>@if($e->document)<a href="{{ asset('storage/expense_documents/'.$e->document) }}" target="_blank" rel="noopener">@lang('site.document')</a>@endif</td>
                    </tr>
                @endforeach
                </tbody>
            </table></div>
        @endif

        <p class="vk-tp__note" style="margin-top:30px">@lang('site.transparency_note') <a href="{{ route('reports') }}">@lang('site.annual_reports')</a></p>
    </div></section>
@endsection
