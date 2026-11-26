@extends('layouts.admin.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center flex-wrap">
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">@lang('site.donation_settings')</h5>
            </div>
        </div>
        <div class="d-flex flex-column-fluid">
            <div class="container">
                @include('admin.partials._session')
                @include('admin.partials._errors')
                <div class="card card-custom gutter-b">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.settings.donations.update') }}">
                            @csrf @method('PUT')

                            <h4 class="mb-5">@lang('site.ds_amounts')</h4>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label>@lang('site.ds_presets') *</label>
                                    <input type="text" name="presets" class="form-control" dir="ltr" required
                                           value="{{ old('presets', implode(', ', $settings['presets'])) }}" placeholder="50, 100, 250, 500">
                                    <span class="form-text text-muted">@lang('site.ds_presets_help')</span>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label>@lang('site.ds_min_amount') (TL) *</label>
                                    <input type="number" name="min_amount" class="form-control" min="1" required value="{{ old('min_amount', $settings['min_amount']) }}">
                                </div>
                                <div class="form-group col-lg-3">
                                    <label>@lang('site.ds_max_amount') (TL) *</label>
                                    <input type="number" name="max_amount" class="form-control" min="1" required value="{{ old('max_amount', $settings['max_amount']) }}">
                                </div>
                            </div>

                            <h4 class="mb-5 mt-5">@lang('site.ds_features')</h4>
                            @foreach(['quick_donate', 'dedication', 'zakat_option', 'show_name_option'] as $feature)
                                <div class="form-group">
                                    <label class="checkbox checkbox-lg">
                                        <input type="checkbox" name="{{ $feature }}_enabled" value="1" {{ old($feature.'_enabled', $settings[$feature.'_enabled']) ? 'checked' : '' }}>
                                        <span></span>&nbsp; <strong>@lang('site.ds_'.$feature)</strong>
                                    </label>
                                    <span class="form-text text-muted">@lang('site.ds_'.$feature.'_help')</span>
                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-primary mt-4">@lang('site.save')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
