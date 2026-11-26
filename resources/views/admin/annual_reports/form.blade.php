@extends('layouts.admin.app')
@section('page_body')
    <form method="POST" enctype="multipart/form-data" action="{{ $report->exists ? route('admin.annual_reports.update', $report) : route('admin.annual_reports.store') }}">
        @csrf @if($report->exists) @method('PUT') @endif
        <div class="row">
            <div class="form-group col-lg-3"><label>@lang('site.report_year') *</label><input type="number" name="year" min="2000" max="2100" class="form-control" required value="{{ old('year', $report->year) }}"></div>
            <div class="form-group col-lg-9"><label>@lang('site.update_title') (Türkçe) *</label><input type="text" name="title_tr" class="form-control" required maxlength="255" value="{{ old('title_tr', $report->title_tr) }}"></div>
            <div class="form-group col-lg-9 offset-lg-3"><label>@lang('site.update_title') (العربية)</label><input type="text" name="title_ar" class="form-control" dir="rtl" maxlength="255" value="{{ old('title_ar', $report->title_ar) }}"></div>
            <div class="form-group col-lg-6"><label>PDF {{ $report->exists ? '' : '*' }}</label><input type="file" name="file" accept="application/pdf" class="form-control" {{ $report->exists ? '' : 'required' }}>
                @if($report->exists)<span class="form-text text-muted"><a href="{{ asset('storage/annual_reports/'.$report->file) }}" target="_blank">@lang('site.show')</a> — @lang('site.replace_file_help')</span>@endif
            </div>
            <div class="form-group col-lg-6"><label class="checkbox checkbox-lg mt-8"><input type="checkbox" name="is_published" value="1" {{ old('is_published', $report->is_published) ? 'checked' : '' }}><span></span>&nbsp; @lang('site.published')</label></div>
        </div>
        <button class="btn btn-primary">@lang('site.save')</button> <a href="{{ route('admin.annual_reports.index') }}" class="btn btn-light">@lang('site.cancel')</a>
    </form>
@endsection
@section('content')
    @include('admin.partials._page', ['title' => __('site.annual_reports').' — '.($report->exists ? __('site.edit') : __('site.add_new'))])
@endsection
