@extends('layouts.web.app')
@section('page_title')@lang('site.login_with_code')@endsection
@push('styles') @include('web.partials.donation_styles') @endpush
@section('content')
    @include('web.partials.page_header', ['title' => __('site.login_with_code')])
    <section class="donation-checkout"><div class="auto-container"><div class="row" style="justify-content:center"><div class="col-lg-6 col-md-10">
        <div class="dc-card">
            <h3>@lang('site.enter_code')</h3>
            <p>@lang('site.login_code_check_inbox', ['email' => e($email)])</p>
            <form method="POST" action="{{ route('login.code.check') }}">
                @csrf
                <div class="dc-field">
                    <label for="code">@lang('site.code_6_digits')</label>
                    <input type="text" id="code" name="code" class="form-control" required inputmode="numeric" pattern="[0-9]{6}" maxlength="6" autocomplete="one-time-code" dir="ltr"
                           style="font-size:26px;letter-spacing:8px;text-align:center;font-family:monospace" autofocus>
                    @error('code')<span class="dc-error">{{ $message }}</span>@enderror
                </div>
                <button type="submit" class="theme-btn btn-style-one"><span>@lang('site.login')</span></button>
            </form>
            <p class="dc-small" style="margin-top:14px">@lang('site.login_code_not_received') <a href="{{ route('login.code') }}">@lang('site.send_again')</a></p>
        </div>
    </div></div></div></section>
@endsection
