<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <link href="{{asset('web/css/custom.css?id=5')}}" rel="stylesheet">

    @stack('styles')
</head>

<body>
<a href="https://wa.me/{{ preg_replace('/\D+/', '', config('association.phone')) }}" target="_blank" class="whatsapp-float"><img width="40" src="{{asset('img/whatsapp.png')}}"></a>

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
<script src="{{asset('web/js/script'.(app()->getLocale() == 'ar' ? '_rtl': '').'.js')}}?v=2"></script>
{{-- Toast notifications: vakifToast(text, 'success' | 'error' | 'warning') --}}
<script>
    window.vakifToast = function (text, type) {
        type = ['success', 'error', 'warning'].indexOf(type) >= 0 ? type : 'success';
        var icons = { success: 'fa-check', error: 'fa-times', warning: 'fa-exclamation' };
        var box = document.querySelector('.vk-toasts');
        if (!box) { box = document.createElement('div'); box.className = 'vk-toasts'; box.setAttribute('aria-live', 'polite'); document.body.appendChild(box); }
        var el = document.createElement('div');
        el.className = 'vk-toast vk-toast--' + type;
        el.setAttribute('role', type === 'error' ? 'alert' : 'status');
        el.innerHTML = '<span class="vk-toast__icon"><span class="fa ' + icons[type] + '"></span></span><span class="vk-toast__text"></span><button type="button" class="vk-toast__close" aria-label="Close">&times;</button>';
        el.querySelector('.vk-toast__text').textContent = text;
        function hide() { el.classList.remove('vk-show'); setTimeout(function () { el.remove(); }, 250); }
        el.querySelector('.vk-toast__close').addEventListener('click', hide);
        box.appendChild(el);
        requestAnimationFrame(function () { el.classList.add('vk-show'); });
        setTimeout(hide, type === 'error' ? 6000 : 3500);
    };
</script>
{{-- Donation cart helper (POST + CSRF) --}}
<script>
    window.vakifCart = (function () {
        var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        function notify(text, type) { window.vakifToast(text, type); }
        function setCount(n) {
            document.querySelectorAll('.item-count').forEach(function (el) { el.textContent = n; el.style.display = n > 0 ? '' : 'none'; });
        }
        function post(url, data) {
            return fetch(url, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json', 'Content-Type': 'application/json' },
                credentials: 'same-origin',
                body: JSON.stringify(data)
            }).then(function (r) {
                return r.json().catch(function () { return {}; }).then(function (body) {
                    if (!r.ok) {
                        var msg = body.message || @json(__('site.cart_error'));
                        if (body.errors) { msg = Object.values(body.errors)[0][0]; }
                        notify(msg, 'error');
                        throw new Error(msg);
                    }
                    if (typeof body.count !== 'undefined') { setCount(body.count); }
                    if (body.message) { notify(body.message, 'success'); }
                    return body;
                });
            });
        }
        return {
            add: function (campaignId, amount) { return post(@json(route('add.to.cart')), { campaign_id: campaignId, amount: amount }); },
            update: function (id, amount) { return post(@json(route('cart.update')), { id: id, amount: amount }); },
            remove: function (id) { return post(@json(route('cart.remove')), { id: id }); },
            notify: notify
        };
    })();
</script>
@stack('scripts')
{{-- Cookie notice (only essential cookies are used) --}}
<div id="cookie-notice" style="display:none;position:fixed;bottom:0;left:0;right:0;z-index:9999;background:#222;color:#fff;padding:14px 20px;font-size:14px;line-height:1.6;box-shadow:0 -2px 10px rgba(0,0,0,.2)">
    <div style="max-width:1170px;margin:0 auto;display:flex;gap:16px;align-items:center;justify-content:space-between;flex-wrap:wrap">
        <span>@lang('site.cookie_notice') <a href="{{ route('privacy') }}" style="color:#fff;text-decoration:underline">@lang('site.privacy')</a></span>
        <button type="button" id="cookie-notice-ok" style="background:#fff;color:#222;border:0;border-radius:4px;padding:8px 18px;font-weight:600;cursor:pointer">@lang('site.cookie_ok')</button>
    </div>
</div>
<script>
    (function () {
        var box = document.getElementById('cookie-notice');
        try { if (localStorage.getItem('cookie_notice_ok') === '1') return; } catch (e) {}
        box.style.display = 'block';
        document.getElementById('cookie-notice-ok').addEventListener('click', function () {
            try { localStorage.setItem('cookie_notice_ok', '1'); } catch (e) {}
            box.style.display = 'none';
        });
    })();
</script>
@if(session('error'))
<script>vakifToast(@json(session('error')), 'error');</script>
@endif
@if(session('success'))
<script>vakifToast(@json(session('success')), 'success');</script>
@endif
</body>
</html>
