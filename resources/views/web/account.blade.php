@extends('layouts.web.app')
@section('page_title')@lang('site.my_account')@endsection
@push('styles')
    @include('web.partials.donation_styles')
    <style>
        .acc-stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 14px; margin-bottom: 24px; }
        .acc-stats div { background: #fff; border: 1px solid #eee; border-radius: 10px; padding: 16px; }
        .acc-stats small { color: #777; display: block; }
        .acc-stats strong { font-size: 22px; }
        .acc-table { width: 100%; }
        .acc-table th, .acc-table td { padding: 10px 8px; border-bottom: 1px solid #f0f0f0; text-align: start; vertical-align: top; }
        .acc-table th { color: #777; font-weight: 600; }
        .acc-status { display: inline-block; padding: 2px 10px; border-radius: 12px; font-size: 13px; font-weight: 600; color: #fff; }
        .acc-status--pending { background: #ef6c00; } .acc-status--confirmed { background: #2e7d32; } .acc-status--cancelled { background: #777; }
        .acc-actions a { display: inline-block; margin: 0 8px 4px 0; font-size: 14px; }
    </style>
@endpush
@section('content')
    @include('web.partials.page_header', ['title' => __('site.my_account')])
    <section class="donation-checkout"><div class="auto-container">
        <p style="font-size:18px">@lang('site.account_hello', ['name' => e($user->name)])</p>

        <div class="acc-stats">
            <div><small>@lang('site.account_total_confirmed')</small><strong dir="ltr">{{ number_format($totals['confirmed'], 0, ',', '.') }} TL</strong></div>
            <div><small>@lang('site.account_count_confirmed')</small><strong>{{ $totals['count'] }}</strong></div>
            <div><small>@lang('site.account_count_pending')</small><strong>{{ $totals['pending'] }}</strong></div>
        </div>

        <div class="dc-card">
            <h3>@lang('site.my_donations')</h3>
            @if($donations->isEmpty())
                <p>@lang('site.no_donations_yet') <a href="{{ route('campaigns') }}">@lang('site.campaigns')</a></p>
                @if(!$user->email_verified_at)<p class="dc-small">@lang('site.account_verify_hint') <a href="{{ route('login.code') }}">@lang('site.login_with_code')</a></p>@endif
            @else
                <div class="table-responsive"><table class="acc-table">
                    <thead><tr><th>@lang('site.donation_date')</th><th>@lang('site.reference_no')</th><th>@lang('site.donation_items')</th><th>@lang('site.price')</th><th>@lang('site.donation_status')</th><th></th></tr></thead>
                    <tbody>
                    @foreach($donations as $d)
                        <tr>
                            <td dir="ltr">{{ $d->created_at->format('d.m.Y') }}</td>
                            <td dir="ltr" style="font-family:monospace">{{ $d->reference }}</td>
                            <td>{{ $d->items->pluck('label')->implode(', ') }}@if($d->dedicationText())<br><small style="color:#777">{{ $d->dedicationText() }}</small>@endif</td>
                            <td dir="ltr">{{ number_format($d->amount, 2, ',', '.') }} TL</td>
                            <td><span class="acc-status acc-status--{{ $d->status }}">@lang('site.donation_status_'.$d->status)</span></td>
                            <td class="acc-actions">
                                <a href="{{ route('account.donations.show', $d) }}">@lang('site.view')</a>
                                @if($d->status === \App\Models\Donation::CONFIRMED)<a href="{{ route('account.donations.receipt', $d) }}" target="_blank">@lang('site.receipt')</a>@endif
                                <a href="{{ route('account.donations.repeat', $d) }}">@lang('site.repeat_donation')</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table></div>
                {{ $donations->links() }}
            @endif
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="dc-card">
                    <h3>@lang('site.my_details')</h3>
                    <form method="POST" action="{{ route('account.profile') }}">
                        @csrf @method('PUT')
                        <div class="dc-field"><label>@lang('site.full_name')</label><input type="text" name="name" class="form-control" required maxlength="100" value="{{ old('name', $user->name) }}">@error('name')<span class="dc-error">{{ $message }}</span>@enderror</div>
                        <div class="dc-field"><label>@lang('site.email')</label><input type="email" class="form-control" value="{{ $user->email }}" disabled dir="ltr">
                            <small>{{ $user->email_verified_at ? __('site.email_verified') : __('site.email_not_verified') }}</small></div>
                        <div class="dc-field"><label>@lang('site.phone')</label><input type="tel" name="phone" class="form-control" maxlength="30" dir="ltr" value="{{ old('phone', $user->phone) }}"></div>
                        <button class="theme-btn btn-style-one"><span>@lang('site.save')</span></button>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="dc-card">
                    <h3>@lang('site.change_password')</h3>
                    <form method="POST" action="{{ route('account.password') }}">
                        @csrf @method('PUT')
                        <div class="dc-field"><label>@lang('site.new_password')</label><input type="password" name="password" class="form-control" required minlength="8" autocomplete="new-password">@error('password')<span class="dc-error">{{ $message }}</span>@enderror</div>
                        <div class="dc-field"><label>@lang('site.password_confirmation')</label><input type="password" name="password_confirmation" class="form-control" required minlength="8" autocomplete="new-password"></div>
                        <button class="theme-btn btn-style-one"><span>@lang('site.save')</span></button>
                    </form>
                    <p class="dc-small" style="margin-top:12px"><a href="{{ route('logout') }}">@lang('site.logout')</a></p>
                </div>
            </div>
        </div>
    </div></section>
@endsection
