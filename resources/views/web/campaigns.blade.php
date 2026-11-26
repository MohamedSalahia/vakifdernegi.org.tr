@extends('layouts.web.app')
@section('page_title')@lang('site.campaigns')@endsection
@push('styles')
<style>
    .vk-filters { background: #fff; border: 1px solid #eee; border-radius: 10px; padding: 18px; margin-bottom: 30px; }
    .vk-filters__cats { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 14px; }
    .vk-filters__cats a { padding: 7px 16px; border-radius: 20px; border: 1px solid #ddd; color: #444; font-size: 15px; }
    .vk-filters__cats a.active { background: var(--theme-color, #8a1f5c); border-color: var(--theme-color, #8a1f5c); color: #fff; }
    .vk-filters__row { display: flex; gap: 10px; flex-wrap: wrap; align-items: center; }
    .vk-filters__row input[type=search] { flex: 1 1 220px; min-width: 0; }
    .vk-filters__row select { width: auto; }
    .vk-filters__row label { display: flex; align-items: center; gap: 6px; margin: 0; font-weight: normal; white-space: nowrap; }
    .vk-results { color: #777; margin: -10px 0 20px; }
    .vk-pagination { display: flex; justify-content: center; margin-top: 20px; }
</style>
@endpush
@section('content')
    <script src="{{asset('web/js/jquery.js')}}"></script>
    <!-- Page Title -->
    <section class="page-title" style="background-image:url({{url('/thumbnail/1920/900/80/storage/settings/'.setting('banner'))}})">
        <div class="auto-container">
            <div class="content-box">
                <h1>@lang('site.campaigns')</h1>
                <ul class="bread-crumb">
                    <li><a class="home" href="{{route('/')}}"><span class="fa fa-home"></span></a></li>
                    <li>@lang('site.campaigns')</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="causes-section-four">
        <div class="auto-container">
            <form method="get" action="{{ route('campaigns') }}" class="vk-filters" id="vk-filters">
                <div class="vk-filters__cats">
                    <a href="{{ route('campaigns', array_filter(['q' => $filters['q'], 'sort' => $filters['sort'] !== 'newest' ? $filters['sort'] : null, 'zakat' => $filters['zakat'] ? 1 : null])) }}" class="{{ $filters['category'] ? '' : 'active' }}">@lang('site.all_campaigns')</a>
                    @foreach($openCategories as $cat)
                        <a href="{{ route('campaigns', array_filter(['category' => $cat->id, 'q' => $filters['q'], 'sort' => $filters['sort'] !== 'newest' ? $filters['sort'] : null, 'zakat' => $filters['zakat'] ? 1 : null])) }}"
                           class="{{ $filters['category'] === $cat->id ? 'active' : '' }}">{{ $cat->name }}</a>
                    @endforeach
                </div>
                @if($filters['category'])<input type="hidden" name="category" value="{{ $filters['category'] }}">@endif
                <div class="vk-filters__row">
                    <input type="search" name="q" class="form-control" value="{{ $filters['q'] }}" placeholder="@lang('site.search_campaigns')">
                    <select name="sort" class="form-control" onchange="this.form.submit()" aria-label="@lang('site.sort_by')">
                        <option value="newest" {{ $filters['sort'] === 'newest' ? 'selected' : '' }}>@lang('site.sort_newest')</option>
                        <option value="urgent" {{ $filters['sort'] === 'urgent' ? 'selected' : '' }}>@lang('site.sort_urgent')</option>
                        <option value="progress" {{ $filters['sort'] === 'progress' ? 'selected' : '' }}>@lang('site.sort_progress')</option>
                        <option value="remaining" {{ $filters['sort'] === 'remaining' ? 'selected' : '' }}>@lang('site.sort_remaining')</option>
                    </select>
                    <label><input type="checkbox" name="zakat" value="1" {{ $filters['zakat'] ? 'checked' : '' }} onchange="this.form.submit()"> @lang('site.filter_zakat')</label>
                    <button type="submit" class="theme-btn btn-style-one" style="padding:8px 20px"><span>@lang('site.search')</span></button>
                </div>
            </form>

            <p class="vk-results">@lang('site.campaigns_found', ['count' => $campaigns->total()])</p>

            <div class="cause-wrapper">
                <div class="row">
                    @include('layouts.web.campaigns_not_completed')
                </div>
            </div>

            @if($campaigns->hasPages())
                <div class="vk-pagination">{{ $campaigns->links() }}</div>
            @endif
        </div>
    </section>
@endsection
