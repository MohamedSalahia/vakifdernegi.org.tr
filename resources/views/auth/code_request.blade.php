@extends('layouts.web.app')
@section('page_title')@lang('site.login_with_code')@endsection
@push('styles') @include('web.partials.donation_styles') @endpush
@section('content')
    @include('web.partials.page_header', ['title' => __('site.login_with_code')])
    <section class="donation-checkout"><div class="auto-container"><div class="row" style="justify-content:center"><div class="col-lg-6 col-md-10">
        <div class="dc-card">
            <h3>@lang('site.login_with_code')</h3>
            <p>@lang('site.login_code_explain')</p>
            <form method="POST" action="{{ route('login.code.send') }}">
                @csrf
                <div class="dc-field">
                    <label for="email">@lang('site.email')</label>
                    <input type="email" id="email" name="email" class="form-control" required maxlength="150" value="{{ old('email') }}" autofocus>
                    @error('email')<span class="dc-error">{{ $message }}</span>@enderror
                </div>
                <button type="submit" class="theme-btn btn-style-one"><span>@lang('site.send_code')</span></button>
            </form>
            @include('auth.partials.login_options', ['except' => 'code'])
        </div>
    </div></div></div></section>
@endsection
