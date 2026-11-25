@extends('layouts.web.app')
@section('page_title')@lang('site.cart')@endsection

@section('content')
    <script src="{{asset('web/js/jquery.js')}}"></script>
    <!-- Page Title -->
    <section class="page-title" style="background-image:url({{url('/thumbnail/1920/900/80/storage/settings/'.setting('banner'))}})">
        <div class="auto-container">
            <div class="content-box">
                <h1>@lang('site.preview_cart')</h1>
                <ul class="bread-crumb">
                    <li><a class="home" href="{{route('/')}}"><span class="fa fa-home"></span></a></li>
                    <li>@lang('site.donation_campaign')</li>
                </ul>
            </div>
        </div>
    </section>

    <!--Cart section-->
    <section class="cart-area">
        <div class="auto-container">



            <div class="text-center" style="margin-top: 80px; ">
                <span>@lang('site.iyzico_form_payment') :</span><br><br><br>
                {{--<div class="link-btn">
                    <a href="{{route('/')}}" class="theme-btn btn-style-one"><span>@lang('site.return_to_home_page')</span></a>
                </div>--}}
            </div>

        </div>

    </section>

@endsection



