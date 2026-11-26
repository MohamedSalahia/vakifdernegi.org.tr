@extends('layouts.web.app')
@section('page_title')@lang('site.annual_reports')@endsection
@section('content')
    @include('web.partials.page_header', ['title' => __('site.annual_reports')])
    <section style="padding:60px 0"><div class="auto-container">
        @forelse($reports as $r)
            <div style="display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap;background:#fff;border:1px solid #eee;border-radius:12px;padding:18px 22px;margin-bottom:14px">
                <div style="display:flex;align-items:center;gap:16px">
                    <span class="fa fa-file-pdf-o" style="font-size:34px;color:#c62828"></span>
                    <div><div style="font-size:22px;font-weight:700">{{ $r->year }}</div><div>{{ $r->localized('title') }}</div></div>
                </div>
                <div style="display:flex;gap:10px">
                    <a href="{{ asset('storage/annual_reports/'.$r->file) }}" target="_blank" rel="noopener" class="theme-btn btn-style-one" style="padding:8px 18px"><span>@lang('site.view')</span></a>
                    <a href="{{ asset('storage/annual_reports/'.$r->file) }}" download class="theme-btn btn-style-two" style="padding:8px 18px"><span>@lang('site.download')</span></a>
                </div>
            </div>
        @empty
            <div style="text-align:center;padding:40px;background:#fff;border:1px solid #eee;border-radius:12px">
                <h3>@lang('site.no_reports_yet')</h3>
                <p>@lang('site.no_reports_text') <a href="{{ config('association.derbis_verify_url') }}" target="_blank" rel="noopener">DERBİS</a></p>
            </div>
        @endforelse
    </div></section>
@endsection
