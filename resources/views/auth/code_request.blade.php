@extends('layouts.web.app')
@section('page_title')@lang('site.login_with_code')@endsection
@push('styles') @include('web.partials.donation_styles') @endpush
@section('content')
    @include('web.partials.page_header', ['title' => __('site.login_with_code')])
    <section class="donation-checkout"><div class="auto-container"><div class="row" style="justify-content:center"><div class="col-lg-6 col-md-10">
        <div class="dc-card">
            {{-- Step 1: e-mail (without JS this posts normally and goes to the verify page) --}}
            <div id="code-step-email">
                <h3>@lang('site.login_with_code')</h3>
                <p>@lang('site.login_code_explain')</p>
                <form method="POST" action="{{ route('login.code.send') }}" data-ajax-form id="code-send-form">
                    @csrf
                    <div class="dc-field">
                        <label for="email">@lang('site.email')</label>
                        <input type="email" id="email" name="email" class="form-control" required maxlength="150" value="{{ old('email') }}" autofocus>
                        @error('email')<span class="dc-error">{{ $message }}</span>@enderror
                    </div>
                    <button type="submit" class="theme-btn btn-style-one"><span>@lang('site.send_code')</span></button>
                </form>
            </div>

            {{-- Step 2: code (shown in place after the code is sent) --}}
            <div id="code-step-verify" style="display:none">
                <h3>@lang('site.enter_code')</h3>
                <p id="code-sent-to"></p>
                <form method="POST" action="{{ route('login.code.check') }}" data-ajax-form>
                    @csrf
                    <div class="dc-field">
                        <label for="code">@lang('site.code_6_digits')</label>
                        <input type="text" id="code" name="code" class="form-control" required inputmode="numeric" pattern="[0-9]{6}" maxlength="6" autocomplete="one-time-code" dir="ltr"
                               style="font-size:26px;letter-spacing:8px;text-align:center;font-family:monospace">
                    </div>
                    <button type="submit" class="theme-btn btn-style-one"><span>@lang('site.login')</span></button>
                </form>
                <p class="dc-small" style="margin-top:14px">@lang('site.login_code_not_received')
                    <a href="#" id="code-change-email">@lang('site.send_again')</a></p>
            </div>

            @include('auth.partials.login_options', ['except' => 'code'])
        </div>
    </div></div></div></section>
@endsection
@push('scripts')
<script>
    (function () {
        var sendForm = document.getElementById('code-send-form');
        var stepEmail = document.getElementById('code-step-email');
        var stepVerify = document.getElementById('code-step-verify');
        var template = @json(__('site.login_code_check_inbox', ['email' => '__EMAIL__']));
        sendForm.addEventListener('ajax:success', function (e) {
            document.getElementById('code-sent-to').textContent = template.replace('__EMAIL__', e.detail.email || '');
            stepEmail.style.display = 'none';
            stepVerify.style.display = '';
            document.getElementById('code').focus();
        });
        document.getElementById('code-change-email').addEventListener('click', function (e) {
            e.preventDefault();
            stepVerify.style.display = 'none';
            stepEmail.style.display = '';
            document.getElementById('email').focus();
        });
    })();
</script>
@endpush
