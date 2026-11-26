@extends('layouts.web.app')
@section('page_title')@lang('site.help_center')@endsection
@push('styles')
<style>
    .vk-faq h3 { margin: 30px 0 12px; }
    .vk-faq details { background: #fff; border: 1px solid #eee; border-radius: 10px; margin-bottom: 10px; padding: 0 18px; }
    .vk-faq summary { cursor: pointer; padding: 16px 0; font-weight: 600; font-size: 17px; list-style: none; display: flex; justify-content: space-between; gap: 12px; }
    .vk-faq summary::-webkit-details-marker { display: none; }
    .vk-faq summary:after { content: '+'; font-size: 22px; color: var(--theme-color, #8a1f5c); }
    .vk-faq details[open] summary:after { content: '−'; }
    .vk-faq .vk-faq__a { padding: 0 0 16px; color: #555; line-height: 1.8; }
</style>
@endpush
@section('content')
    @include('web.partials.page_header', ['title' => __('site.help_center')])
    <section class="vk-faq" style="padding:50px 0"><div class="auto-container">
        @forelse($categories as $cat)
            <h3>@lang('site.faq_cat_'.$cat)</h3>
            @foreach($faqs[$cat] as $f)
                <details>
                    <summary>{{ $f->localized('question') }}</summary>
                    <div class="vk-faq__a">{!! nl2br(e($f->localized('answer'))) !!}</div>
                </details>
            @endforeach
        @empty
            <p>@lang('site.no_data_found')</p>
        @endforelse
        <div style="margin-top:36px;text-align:center;background:#f7f7f7;border-radius:12px;padding:26px">
            <h4 style="margin-bottom:12px">@lang('site.help_more_questions')</h4>
            <a href="{{ route('contact_us') }}" class="theme-btn btn-style-one"><span>@lang('site.contact_us')</span></a>
        </div>
    </div></section>
@endsection
