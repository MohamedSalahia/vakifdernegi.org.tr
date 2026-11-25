@extends('layouts.web.app')
@section('page_title')@lang('site.donation_thanks_title')@endsection

@push('styles')
    @include('web.partials.donation_styles')
@endpush

@section('content')
    <section class="page-title" style="background-image:url({{url('/thumbnail/1920/900/80/storage/settings/'.setting('banner'))}})">
        <div class="auto-container">
            <div class="content-box">
                <h1>@lang('site.donation_thanks_title')</h1>
                <ul class="bread-crumb">
                    <li><a class="home" href="{{route('/')}}"><span class="fa fa-home"></span></a></li>
                    <li>@lang('site.donation_thanks_title')</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="donation-checkout">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-5 col-md-12">
                    <div class="dc-card">
                        <h3>@lang('site.donation_summary')</h3>
                        <div class="dc-row"><span>@lang('site.reference_no')</span><span class="dc-ref" dir="ltr">{{ $donation->reference }}</span></div>
                        @foreach($donation->items as $item)
                            <div class="dc-row">
                                <span>{{ $item->label }}</span>
                                <span dir="ltr">{{ number_format($item->amount, 2, ',', '.') }} TL</span>
                            </div>
                        @endforeach
                        <div class="dc-row dc-total">
                            <span>@lang('site.total')</span>
                            <span dir="ltr">{{ number_format($donation->amount, 2, ',', '.') }} TL</span>
                        </div>
                        <div class="dc-row"><span>@lang('site.donation_status')</span><strong>@lang('site.donation_status_' . $donation->status)</strong></div>
                    </div>
                </div>

                <div class="col-lg-7 col-md-12">
                    <div class="dc-card">
                        @if($donation->status === \App\Models\Donation::CONFIRMED)
                            <div class="dc-ok">@lang('site.donation_confirmed_text')</div>
                        @elseif($donation->status === \App\Models\Donation::CANCELLED)
                            <div class="dc-note">@lang('site.donation_cancelled_text')</div>
                        @else
                            <div class="dc-ok">@lang('site.donation_received_text', ['name' => e($donation->donor_name)])</div>

                            <h3>@lang('site.pay_by_bank_transfer')</h3>
                            <ol class="dc-steps">
                                <li>@lang('site.transfer_step_1', ['amount' => number_format($donation->amount, 2, ',', '.') . ' TL'])</li>
                                <li>@lang('site.transfer_step_2', ['name' => config('association.legal_name')])</li>
                                <li>@lang('site.transfer_step_3') <strong dir="ltr">{{ $donation->reference }}</strong></li>
                                <li>@lang('site.transfer_step_4')</li>
                            </ol>

                            @if($bankPage)
                                <div class="dc-bank">{!! $bankPage->description !!}</div>
                            @else
                                <div class="dc-note">@lang('site.bank_info_unavailable')</div>
                            @endif

                            @if($donation->donor_email)
                                <p class="dc-small">@lang('site.instructions_emailed', ['email' => e($donation->donor_email)])</p>
                            @endif
                        @endif

                        <p style="margin-top:16px">@lang('site.donation_questions')
                            <a href="mailto:{{ config('association.email') }}">{{ config('association.email') }}</a> ·
                            <a href="tel:{{ preg_replace('/\s+/', '', config('association.phone')) }}" dir="ltr">{{ config('association.phone') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
