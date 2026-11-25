@extends('layouts.web.app')
@section('page_title')@lang('site.payment_status')@endsection

@section('content')
    <!-- Page Title -->
    <section class="page-title" style="background-image:url({{url('/thumbnail/1920/900/80/storage/settings/'.setting('banner'))}})">
        <div class="auto-container">
            <div class="content-box">
                <h1>@lang('site.payment_status')</h1>
                <ul class="bread-crumb">
                    <li><a class="home" href="{{route('/')}}"><span class="fa fa-home"></span></a></li>
                    <li>@lang('site.payment_status')</li>
                </ul>
            </div>
        </div>
    </section>

    <!--Cart section-->
    <section class="cart-area">
        <div class="auto-container">
            <div class="text-center" style="margin-top: 80px; ">
                @if($transaction->auth_resp_code == "00")
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">@lang('site.payment_status'): @lang('site.payment_success')</h4>
                    <p> @lang('site.payment_status_message_success')</p>
                    <p>@lang('site.payment_id'): <span id="payment-id">{{ $transaction->paymentid }}</span></p>
                    <p>@lang('site.track_id'): <span id="payment-id">{{ $transaction->trackid }}</span></p>
                    <p>@lang('site.price'): <span id="payment-id">{{ $transaction->amt }}</span></p>
                    <p>@lang('site.transaction_date'): <span id="payment-id">{{ $transaction->created_at }}</span></p>
                </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading">@lang('site.payment_status'): @lang('site.payment_failed')</h4>
                        <p>@lang('site.payment_status_message_failed')</p>
                        <p>@lang('site.payment_id'): <span id="payment-id">{{ $transaction->paymentid }}</span></p>
                        <p>@lang('site.track_id'): <span id="payment-id">{{ $transaction->trackid }}</span></p>
                        <p>@lang('site.price'): <span id="payment-id">{{ $transaction->amt }}</span></p>
                        <p>@lang('site.transaction_date'): <span id="payment-id">{{ $transaction->created_at }}</span></p>
                    </div>
                @endif
                    <a href="{{route('/')}}" class="theme-btn btn-style-one"><span>@lang('site.return_to_home_page')</span></a>
            </div>
        </div>

    </section>

@endsection


