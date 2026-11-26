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
    #vk-campaign-results { transition: opacity .2s ease; min-height: 200px; }
    #vk-campaign-results.is-loading { opacity: .45; pointer-events: none; }
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
                    <a href="{{ route('campaigns', array_filter(['q' => $filters['q'], 'sort' => $filters['sort'] !== 'newest' ? $filters['sort'] : null, 'zakat' => $filters['zakat'] ? 1 : null])) }}" class="{{ $filters['category'] ? '' : 'active' }}" data-category="">@lang('site.all_campaigns')</a>
                    @foreach($openCategories as $cat)
                        <a href="{{ route('campaigns', array_filter(['category' => $cat->id, 'q' => $filters['q'], 'sort' => $filters['sort'] !== 'newest' ? $filters['sort'] : null, 'zakat' => $filters['zakat'] ? 1 : null])) }}"
                           class="{{ $filters['category'] === $cat->id ? 'active' : '' }}" data-category="{{ $cat->id }}">{{ $cat->name }}</a>
                    @endforeach
                </div>
                <input type="hidden" name="category" value="{{ $filters['category'] ?: '' }}">
                <div class="vk-filters__row">
                    <input type="search" name="q" class="form-control" value="{{ $filters['q'] }}" placeholder="@lang('site.search_campaigns')">
                    <select name="sort" class="form-control" aria-label="@lang('site.sort_by')">
                        <option value="newest" {{ $filters['sort'] === 'newest' ? 'selected' : '' }}>@lang('site.sort_newest')</option>
                        <option value="urgent" {{ $filters['sort'] === 'urgent' ? 'selected' : '' }}>@lang('site.sort_urgent')</option>
                        <option value="progress" {{ $filters['sort'] === 'progress' ? 'selected' : '' }}>@lang('site.sort_progress')</option>
                        <option value="remaining" {{ $filters['sort'] === 'remaining' ? 'selected' : '' }}>@lang('site.sort_remaining')</option>
                    </select>
                    <label><input type="checkbox" name="zakat" value="1" {{ $filters['zakat'] ? 'checked' : '' }}> @lang('site.filter_zakat')</label>
                    <button type="submit" class="theme-btn btn-style-one" style="padding:8px 20px"><span>@lang('site.search')</span></button>
                </div>
            </form>

            <div id="vk-campaign-results" aria-live="polite">
                @include('web.partials.campaigns_results')
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    /* Campaign filters without page reload (falls back to normal links/forms without JS). */
    (function ($) {
        var form = document.getElementById('vk-filters');
        var box = document.getElementById('vk-campaign-results');
        if (!form || !box || !window.history || !window.fetch) return;
        var catInput = form.querySelector('input[name="category"]');
        var searchInput = form.querySelector('input[name="q"]');
        var timer = null, current = null;

        function urlFromForm() {
            var params = new URLSearchParams();
            new FormData(form).forEach(function (v, k) {
                v = String(v).trim();
                if (v === '' || (k === 'sort' && v === 'newest')) return;
                params.set(k, v);
            });
            var qs = params.toString();
            return form.getAttribute('action') + (qs ? '?' + qs : '');
        }

        function syncForm(url) {
            var p = new URL(url, location.href).searchParams;
            catInput.value = p.get('category') || '';
            searchInput.value = p.get('q') || '';
            form.querySelector('select[name="sort"]').value = p.get('sort') || 'newest';
            form.querySelector('input[name="zakat"]').checked = p.get('zakat') === '1';
            form.querySelectorAll('.vk-filters__cats a').forEach(function (a) {
                a.classList.toggle('active', (a.dataset.category || '') === catInput.value);
            });
        }

        function load(url, push, scroll) {
            if (current) current.abort();
            box.classList.add('is-loading');
            current = $.ajax({ url: url, headers: { 'X-Requested-With': 'XMLHttpRequest' }, cache: false })
                .done(function (html) {
                    $(box).html(html); // jQuery runs the cards' inline scripts (add to cart, amounts)
                    if (push) history.pushState({ vkCampaigns: true }, '', url);
                    if (scroll) box.scrollIntoView({ behavior: 'smooth', block: 'start' });
                })
                .fail(function (xhr) { if (xhr.statusText !== 'abort') window.location.href = url; })
                .always(function () { box.classList.remove('is-loading'); current = null; });
        }

        form.addEventListener('submit', function (e) { e.preventDefault(); load(urlFromForm(), true); });
        form.querySelector('select[name="sort"]').addEventListener('change', function () { load(urlFromForm(), true); });
        form.querySelector('input[name="zakat"]').addEventListener('change', function () { load(urlFromForm(), true); });
        searchInput.addEventListener('input', function () {
            clearTimeout(timer);
            timer = setTimeout(function () { load(urlFromForm(), true); }, 400);
        });
        form.querySelectorAll('.vk-filters__cats a').forEach(function (a) {
            a.addEventListener('click', function (e) {
                e.preventDefault();
                catInput.value = a.dataset.category || '';
                form.querySelectorAll('.vk-filters__cats a').forEach(function (x) { x.classList.toggle('active', x === a); });
                load(urlFromForm(), true);
            });
        });
        box.addEventListener('click', function (e) {
            var link = e.target.closest('.vk-pagination a');
            if (!link) return;
            e.preventDefault();
            load(link.href, true, true);
        });
        window.addEventListener('popstate', function () {
            syncForm(location.href);
            load(location.href, false);
        });
    })(jQuery);
</script>
@endpush

