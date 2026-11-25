<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" direction="{{ LaravelLocalization::getCurrentLocaleDirection() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}" style="direction: {{ LaravelLocalization::getCurrentLocaleDirection() }}">
<!--begin::Head-->
<head><base href="">
    <meta charset="utf-8" />
    <title>وقف الخيرية - لوحة التحكم</title>
    <meta name="description" content="وقف الخيرية - لوحة التحكم" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="https://iraq-scorer.com/" />
    <!--begin::Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    {{--noty--}}
    <link rel="stylesheet" href="{{asset('admin/assets/plugins/custom/noty/noty.css')}}">
    <script src="{{ asset('admin/assets/plugins/custom/noty/noty.min.js') }}"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />

    {{--noty--}}
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/noty/noty.css') }}">
    <script src="{{ asset('admin/assets/plugins/noty/noty.min.js') }}"></script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('styles')
<!--end::Fonts-->

    @if(app()->getLocale() == 'ar')
    <!--begin::Page Vendors Styles(used by this page)-->
        <link href="{{asset('admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
        <!--end::Page Vendors Styles-->
        <!--begin::Global Theme Styles(used by all pages)-->
        <link href="{{asset('admin/assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/assets/plugins/custom/prismjs/prismjs.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
        <!--end::Global Theme Styles-->
        <!--begin::Layout Themes(used by all pages)-->
        <link href="{{asset('admin/assets/css/themes/layout/header/base/light.rtl.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/assets/css/themes/layout/header/menu/light.rtl.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/assets/css/themes/layout/brand/dark.rtl.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/assets/css/themes/layout/aside/dark.rtl.css')}}" rel="stylesheet" type="text/css" />
        <!--end::Layout Themes-->
    @else
    <!--begin::Page Vendors Styles(used by this page)-->
        <link href="{{asset('admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
        <!--end::Page Vendors Styles-->
        <!--begin::Global Theme Styles(used by all pages)-->
        <link href="{{asset('admin/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/assets/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        <!--end::Global Theme Styles-->
        <!--begin::Layout Themes(used by all pages)-->
        <link href="{{asset('admin/assets/css/themes/layout/header/base/light.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/assets/css/themes/layout/header/menu/light.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/assets/css/themes/layout/brand/dark.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin/assets/css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css" />
    @endif
    <link rel="shortcut icon" href="{{url('/thumbnail/200/200/80/storage/settings/'.setting('fav_icon'))}}" />
    <link href="{{asset('admin/assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
<!--begin::Main-->
<div class="d-flex flex-column flex-root">

    <!--begin::Login-->
    <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
        <!--begin::Aside-->
        <div class="login-aside d-flex flex-row-auto bgi-size-cover bgi-no-repeat p-10 p-lg-10" style="background-color: #000;">
            <!--begin: Aside Container-->
            <div class="d-flex flex-row-fluid flex-column justify-content-between">
                <!--begin: Aside header-->
                <a href="{{route('/')}}" class="flex-column-auto mt-5 pb-lg-0 pb-10">
                    <img src="{{url('/thumbnail/600/600/80/storage/settings/'.setting('logo'))}}" alt="logo" class="" loading="lazy">
                </a>
                <!--end: Aside header-->
                <!--begin: Aside content-->
                <div class="flex-column-fluid d-flex flex-column justify-content-center">
                    <h3 class="font-size-h1 mb-5 text-white">@lang('site.welcome_dashboard_to_swan')</h3>
                    <p class="font-weight-lighter text-white opacity-80">@lang('site.welcome_dashboard_to_swan_des')</p>
                </div>
                <!--end: Aside content-->
                <!--begin: Aside footer for desktop-->
                <div class="d-none flex-column-auto d-lg-flex justify-content-between mt-10">
                    <div class="opacity-70 font-weight-bold text-white">@lang('site.developer') <span class="footer_heart">❤️</span> @lang('site.by') <a class="text-progiom text-hover-progiom" style="color: #891a59;" href="https://www.facebook.com/mohammed.salahia.2025/">@lang('site.websaity')</a> @lang('site.all_copy_right')</div>
                </div>
                <!--end: Aside footer for desktop-->
            </div>
            <!--end: Aside Container-->
        </div>
        <!--begin::Aside-->
        <!--begin::Content-->
        <div class="d-flex flex-column flex-row-fluid position-relative p-7 overflow-hidden">
            <!--begin::Content header-->
            <div class="position-absolute top-0 right-0 text-right mt-5 mb-15 mb-lg-0 flex-column-auto justify-content-center py-5 px-10">
                <span class="font-weight-bold text-dark-50">@lang('site.need_help')</span>
                <a href="{{route('/')}}" target="_blank" class="font-weight-bold ml-2">@lang('site.contact_us')</a>
            </div>
            <!--end::Content header-->
            <!--begin::Content body-->
            <div class="d-flex flex-column-fluid flex-center mt-30 mt-lg-0">
                <!--begin::Signin-->
                <div class="login-form login-signin">
                    <div class="text-center mb-10 mb-lg-20">
                        <h3 class="font-size-h1">@lang('site.welcome_swan')</h3>
                        <p class="text-muted font-weight-bold">@lang('site.please_enter_email_swan')</p>
                        <span class="text-muted font-weight-bold font-size-h4">@lang('site.no_have_account')
                            <a href="{{route('register')}}"  class="text-primary font-weight-bolder">@lang('site.register_now')</a></span>
                    </div>
                    <!--begin::Form-->
                    <form class="form validatable-form" novalidate="novalidate" id="kt_login_signin_form" method="POST" action="{{ route('login') }}">
                        @csrf
                        {!!  GoogleReCaptchaV3::renderField('contact_us_id','contact_us_action') !!}
                        <div class="form-group">
                            <input name="email" class="form-control form-control-solid h-auto py-5 px-6" type="text" placeholder="@lang('site.email')" value=""  required="required" autofocus="autofocus" aria-describedby="email-error" aria-invalid="false">
                        </div>
                        @if ($errors->has('email'))
                            <div class="fv-plugins-message-container">
                                <div data-field="email" data-validator="notEmpty" class="fv-help-block">{{ $errors->first('email') }}</div>
                            </div>
                        @endif
                        <div class="form-group">
                            <input name="password" class="form-control form-control-solid h-auto py-5 px-6" type="password" placeholder="@lang('site.password')"  required="required">
                        </div>
                        @if ($errors->has('password'))
                            <div class="fv-plugins-message-container">
                                <div data-field="password" data-validator="notEmpty" class="fv-help-block">{{ $errors->first('password') }}</div>
                            </div>
                    @endif
                    <!--begin::Action-->
                        <div class="form-group d-flex flex-wrap justify-content-between align-items-center">

                            <div class="form-check my-3 mr-2 px-0">
                                <label class="checkbox" for="remember">
                                    <input type="checkbox" name="remember" id="remember">
                                    <span class="m-1"></span>@lang('site.remember_me')</label>
                            </div>
                            <button type="submit" id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3">@lang('site.login')</button>
                        </div>
                        <!--end::Action-->
                    </form>
                    <!--end::Form-->

                    <div class="row mb-3 text-center">
                        <hr class="col mr-0 ml-0 mt-2 p-0">
                        <span class="col"> إختر اللغة </span>
                        <hr class="col mr-0 ml-0 mt-2 p-0">
                    </div>
                    <div class="form-group" style="text-align: center">
                        <div class="kt-login__options">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="btn btn-warning btn-elevate btn-icon-sm m-md-4 text-dark">
                                    <i class="la la-language text-dark"></i>
                                    {{ $properties['native'] }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                </div>
                <!--end::Signin-->
            </div>
            <!--end::Content body-->










        </div>
        <!--end::Content-->
    </div>
    <!--end::Login-->

</div>
<!--end::Main-->
<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="assets/plugins/global/plugins.bundle.js"></script>
<script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="assets/js/scripts.bundle.js"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Scripts(used by this page)-->
<script src="assets/js/pages/custom/login/login-general.js"></script>
<!--end::Page Scripts-->
</body>
<!--end::Body-->
{!!  GoogleReCaptchaV3::init() !!}
</html>
