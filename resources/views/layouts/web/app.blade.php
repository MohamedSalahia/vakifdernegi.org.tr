<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="author" content="@lang('site.author')">
    <meta name="description" content="@if(setting(app()->getLocale())['description']) {{setting(app()->getLocale())['description']}} @else @lang('site.site_description') @endif">
    <meta name="keywords" content="@if(setting(app()->getLocale())['site_keywords']) {{setting(app()->getLocale())['site_keywords']}} @else @lang('site.site_keywords') @endif"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="{{ app()->getLocale() == 'ar' ? 'ar_AR' : 'tr_TR' }}"/>
    <meta property="og:site_name" content="@lang('site.app')"/>
    <meta http-equiv="Expires" content="604800">
    <meta http-equiv="Pragma" content="public">
    <meta http-equiv="Cache-Control" content="public">
    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/noty/noty.css') }}">
    <script src="{{ asset('admin/assets/plugins/noty/noty.min.js') }}"></script>
    <!-- SITE TITLE -->
    <title>@if(setting(app()->getLocale())['title']){{setting(app()->getLocale())['title']}}@else@lang('site.title')@endif - @yield('page_title')</title>

    <link rel="shortcut icon" href="{{url('/thumbnail/50/50/80/storage/settings/'.setting('fav_icon'))}}" type="image/x-icon">
    <link rel="icon" href="{{url('/thumbnail/50/50/80/storage/settings/'.setting('fav_icon'))}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link href="{{asset('web/css/bootstrap'.(app()->getLocale() == 'ar' ? '_rtl': '').'.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/jquery-ui.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/swiper.min.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/flaticon.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/custom-animate.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/jquery.fancybox.min.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/owl.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/style'.(app()->getLocale() == 'ar' ? '_rtl': '').'.css?id=2')}}" rel="stylesheet">
    <link href="{{asset('web/css/responsive'.(app()->getLocale() == 'ar' ? '_rtl': '').'.css')}}" rel="stylesheet">
    <link href="{{asset('web/css/shop.css')}}" rel="stylesheet">

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="{{asset('web/js/respond.js')}}"></script><![endif]-->

    <link href="{{asset('web/css/custom.css?id=2')}}" rel="stylesheet">

    @stack('styles')
</head>

<body>
<a href="https://api.whatsapp.com/send?phone={{phone_remove_spaces_and_plus()}}" target="_blank" class="whatsapp-float"><img width="40" src="{{asset('img/whatsapp.png')}}"></a>

<div class="page-wrapper">
    <!-- Preloader -->
    <div class="loader-wrap">
        <div class="preloader style-three"></div>
        <div class="layer layer-one"><span class="overlay"></span></div>
        <div class="layer layer-two"><span class="overlay"></span></div>
        <div class="layer layer-three"><span class="overlay"></span></div>
    </div>

    <!-- Main Header-->
    @include('layouts.web.header')
    <!-- End Main Header -->

    @yield('content')

    <!-- Main Footer -->
    @include('layouts.web.footer')



</div>
<!--End pagewrapper-->

<!-- JS -->
<script src="{{asset('web/js/jquery.js')}}"></script>
<script src="{{asset('web/js/popper.min.js')}}"></script>
<script src="{{asset('web/js/bootstrap.min.js')}}"></script>
<script src="{{asset('web/js/TweenMax.min.js')}}"></script>
<script src="{{asset('web/js/wow.js')}}"></script>
<script src="{{asset('web/js/owl.js')}}"></script>
<script src="{{asset('web/js/appear.js')}}"></script>
<script src="{{asset('web/js/swiper.min.js')}}"></script>
<script src="{{asset('web/js/jquery.fancybox.js')}}"></script>
<script src="{{asset('web/js/menu-nav-btn.js')}}"></script>
<script src="{{asset('web/js/jquery-ui.js')}}"></script>
<script src="{{asset('web/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('web/js/jquery.bootstrap-touchspin.js')}}"></script>
<script src="{{asset('web/js/knob.js')}}"></script>
<!-- Custom JS -->
<script src="{{asset('web/js/script'.(app()->getLocale() == 'ar' ? '_rtl': '').'.js')}}"></script>
@stack('scripts')
@if(session('error'))
<script>new Noty({ text: @json(session('error')), type: 'error', timeout: 4000, killer: true }).show();</script>
@endif
</body>
</html>
