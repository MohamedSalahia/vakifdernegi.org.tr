@section('page_body')
    <form method="POST" action="{{ route('admin.settings.login.update') }}">
        @csrf @method('PUT')
        <div class="form-group">
            <label class="checkbox checkbox-lg"><input type="checkbox" name="email_code_enabled" value="1" {{ old('email_code_enabled', $settings['email_code_enabled']) ? 'checked' : '' }}><span></span>&nbsp; <strong>@lang('site.ls_email_code')</strong></label>
            <span class="form-text text-muted">@lang('site.ls_email_code_help')</span>
        </div>
        <hr>
        <div class="form-group">
            <label class="checkbox checkbox-lg"><input type="checkbox" name="google_enabled" value="1" {{ old('google_enabled', $settings['google_enabled']) ? 'checked' : '' }}><span></span>&nbsp; <strong>@lang('site.ls_google')</strong></label>
            <span class="form-text text-muted">@lang('site.ls_google_help')</span>
        </div>
        <div class="row">
            <div class="form-group col-lg-6"><label>Google Client ID</label><input type="text" name="google_client_id" class="form-control" dir="ltr" value="{{ old('google_client_id', $settings['google_client_id']) }}"></div>
            <div class="form-group col-lg-6"><label>Google Client Secret</label><input type="password" name="google_client_secret" class="form-control" dir="ltr" autocomplete="new-password" placeholder="{{ filled($settings['google_client_secret']) ? '••••••••  ('.__('site.ls_secret_saved').')' : '' }}"></div>
        </div>
        <div class="alert alert-light">
            <strong>@lang('site.ls_redirect_uri'):</strong> <code dir="ltr">{{ $redirectUri }}</code>
        </div>
        <button class="btn btn-primary">@lang('site.save')</button>
    </form>
@endsection
@extends('layouts.admin.app')
@section('content')
    @include('admin.partials._page', ['title' => __('site.login_settings')])
@endsection
