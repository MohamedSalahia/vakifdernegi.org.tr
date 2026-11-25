@extends('layouts.web.app')
@section('page_title')@lang('site.donation_checkout')@endsection

@push('styles')
<style>
    .donation-checkout { padding: 70px 0; }
    .donation-checkout .dc-card { background: #fff; border: 1px solid #e6e6e6; border-radius: 8px; padding: 28px; margin-bottom: 30px; }
    .donation-checkout h3 { font-size: 22px; margin-bottom: 20px; }
    .donation-checkout .dc-row { display: flex; justify-content: space-between; gap: 16px; padding: 10px 0; border-bottom: 1px dashed #e6e6e6; }
    .donation-checkout .dc-row:last-child { border-bottom: 0; }
    .donation-checkout .dc-total { font-size: 22px; font-weight: 700; }
    .donation-checkout .dc-ref { display: inline-block; font-family: monospace; font-size: 20px; letter-spacing: 1px; background: #f5f5f5; border: 1px solid #ddd; border-radius: 6px; padding: 6px 14px; }
    .donation-checkout .dc-note { background: #fff8e5; border: 1px solid #f1dc9c; border-radius: 6px; padding: 12px 16px; margin: 16px 0; }
    .donation-checkout .dc-bank { margin-top: 16px; }
    .donation-checkout .dc-bank table { width: 100%; }
    .donation-checkout label.dc-consent { display: flex; gap: 10px; align-items: flex-start; font-weight: normal; margin: 18px 0; }
    .donation-checkout label.dc-consent input { margin-top: 5px; }
</style>
@endpush

@section('content')
    <!-- Page Title -->
    <section class="page-title" style="background-image:url({{url('/thumbnail/1920/900/80/storage/settings/'.setting('banner'))}})">
        <div class="auto-container">
            <div class="content-box">
                <h1>@lang('site.donation_checkout')</h1>
                <ul class="bread-crumb">
                    <li><a class="home" href="{{route('/')}}"><span class="fa fa-home"></span></a></li>
                    <li>@lang('site.donation_checkout')</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="donation-checkout">
        <div class="auto-container">
            <div class="row">
                {{-- Summary --}}
                <div class="col-lg-5 col-md-12">
                    <div class="dc-card">
                        <h3>@lang('site.donation_summary')</h3>
                        <div class="dc-row"><span>@lang('site.donation_type')</span><strong>{{ $donation['type'] }}</strong></div>
                        @foreach($donation['items'] as $item)
                            <div class="dc-row">
                                <span>{{ $item['name'] }}</span>
                                <span>{{ number_format($item['amount'], 2) }} @lang('site.kuveyt_dinari')</span>
                            </div>
                        @endforeach
                        <div class="dc-row dc-total">
                            <span>@lang('site.total')</span>
                            <span>{{ number_format($donation['amount'], 2) }} @lang('site.kuveyt_dinari')</span>
                        </div>
                        <div class="dc-row">
                            <span>@lang('site.reference_no')</span>
                            <span class="dc-ref">{{ $donation['reference'] }}</span>
                        </div>
                    </div>
                </div>

                {{-- Payment --}}
                <div class="col-lg-7 col-md-12">
                    <div class="dc-card">
                        <h3>@lang('site.payment_method')</h3>

                        <label class="dc-consent">
                            <input type="checkbox" id="dc-agree">
                            <span>
                                @lang('site.agree_policies')
                                <a href="{{ route('terms-of-use') }}" target="_blank">@lang('site.term')</a>{{ app()->getLocale() == 'ar' ? '،' : ',' }}
                                <a href="{{ route('donation-policy') }}" target="_blank">@lang('site.donation_policy')</a>{{ app()->getLocale() == 'ar' ? '،' : ',' }}
                                <a href="{{ route('delivery-and-refund-policy') }}" target="_blank">@lang('site.delivery-and-refund-policy')</a>
                                @lang('site.and')
                                <a href="{{ route('privacy') }}" target="_blank">@lang('site.privacy')</a>.
                            </span>
                        </label>

                        <div id="dc-payment" style="display:none">
                            @if($cardPaymentEnabled)
                                {{-- Card gateway form goes here once a provider is integrated. --}}
                                <button type="button" class="theme-btn btn-style-one" disabled><span>@lang('site.pay_by_card')</span></button>
                            @else
                                <div class="dc-note">@lang('site.card_payment_soon')</div>
                            @endif

                            <h4 style="margin-top:20px">@lang('site.pay_by_bank_transfer')</h4>
                            <p>@lang('site.bank_transfer_note')</p>
                            <p><span class="dc-ref">{{ $donation['reference'] }}</span></p>

                            @if($bankPage)
                                <div class="dc-bank">{!! $bankPage->description !!}</div>
                            @else
                                <p><a href="{{ route('bank_accounts') }}">@lang('site.bank_accounts')</a></p>
                            @endif

                            <p style="margin-top:16px">@lang('site.contact_after_transfer')
                                <a href="{{ route('contact_us') }}">@lang('site.contact_us')</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    (function () {
        var agree = document.getElementById('dc-agree');
        var box = document.getElementById('dc-payment');
        agree.addEventListener('change', function () { box.style.display = agree.checked ? 'block' : 'none'; });
    })();
</script>
@endpush
