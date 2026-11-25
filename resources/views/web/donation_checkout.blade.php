@extends('layouts.web.app')
@section('page_title')@lang('site.donation_checkout')@endsection

@push('styles')
    @include('web.partials.donation_styles')
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
                                <span>{{ $item['label'] }}</span>
                                <span dir="ltr">{{ number_format($item['amount'], 2, ',', '.') }} TL</span>
                            </div>
                        @endforeach
                        <div class="dc-row dc-total">
                            <span>@lang('site.total')</span>
                            <span dir="ltr">{{ number_format($donation['amount'], 2, ',', '.') }} TL</span>
                        </div>
                        <p class="dc-small">@lang('site.donation_recipient', ['name' => config('association.legal_name')])</p>
                    </div>
                </div>

                {{-- Donor + payment --}}
                <div class="col-lg-7 col-md-12">
                    <div class="dc-card">
                        @if(!$bankTransferEnabled && !$cardPaymentEnabled)
                            <h3>@lang('site.payment_method')</h3>
                            <div class="dc-note">
                                @lang('site.bank_info_unavailable')
                                <br><a href="tel:{{ preg_replace('/\s+/', '', config('association.phone')) }}" dir="ltr">{{ config('association.phone') }}</a>
                                · <a href="mailto:{{ config('association.email') }}">{{ config('association.email') }}</a>
                            </div>
                        @else
                            <h3>@lang('site.donor_info')</h3>
                            <form method="POST" action="{{ route('donate.store') }}" id="dc-form">
                                @csrf
                                <div class="dc-field">
                                    <label for="donor_name">@lang('site.full_name') *</label>
                                    <input type="text" id="donor_name" name="donor_name" class="form-control" maxlength="100" required
                                           value="{{ old('donor_name', auth()->user()->name ?? '') }}">
                                    @error('donor_name')<span class="dc-error">{{ $message }}</span>@enderror
                                </div>
                                <div class="dc-field">
                                    <label for="donor_email">@lang('site.email')</label>
                                    <input type="email" id="donor_email" name="donor_email" class="form-control" maxlength="150"
                                           value="{{ old('donor_email', auth()->user()->email ?? '') }}">
                                    <small>@lang('site.donor_email_hint')</small>
                                    @error('donor_email')<span class="dc-error">{{ $message }}</span>@enderror
                                </div>
                                <div class="dc-field">
                                    <label for="donor_phone">@lang('site.phone')</label>
                                    <input type="tel" id="donor_phone" name="donor_phone" class="form-control" maxlength="30" dir="ltr"
                                           value="{{ old('donor_phone', auth()->user()->phone ?? '') }}">
                                    @error('donor_phone')<span class="dc-error">{{ $message }}</span>@enderror
                                </div>

                                <h3 style="margin-top:24px">@lang('site.payment_method')</h3>
                                @if($bankTransferEnabled)
                                    <label class="dc-method"><input type="radio" name="payment_method" value="bank_transfer" checked> @lang('site.pay_by_bank_transfer')</label>
                                @endif
                                @unless($cardPaymentEnabled)
                                    <div class="dc-note">@lang('site.card_payment_soon')</div>
                                @endunless

                                <label class="dc-consent">
                                    <input type="checkbox" name="kvkk" value="1" required {{ old('kvkk') ? 'checked' : '' }}>
                                    <span>
                                        @lang('site.agree_policies')
                                        <a href="{{ route('donation-policy') }}" target="_blank">@lang('site.donation_policy')</a>{{ app()->getLocale() == 'ar' ? '،' : ',' }}
                                        <a href="{{ route('delivery-and-refund-policy') }}" target="_blank">@lang('site.delivery-and-refund-policy')</a>{{ app()->getLocale() == 'ar' ? '،' : ',' }}
                                        <a href="{{ route('terms-of-use') }}" target="_blank">@lang('site.term')</a>
                                        @lang('site.and')
                                        <a href="{{ route('privacy') }}" target="_blank">@lang('site.privacy')</a>.
                                    </span>
                                </label>
                                @error('kvkk')<span class="dc-error">{{ $message }}</span>@enderror

                                <button type="submit" class="theme-btn btn-style-one"><span>@lang('site.create_donation')</span></button>
                                <p class="dc-small" style="margin-top:12px">@lang('site.create_donation_hint')</p>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
