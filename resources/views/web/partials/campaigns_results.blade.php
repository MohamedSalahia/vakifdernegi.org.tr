{{-- Campaign listing results (also returned alone for AJAX filtering) --}}
<p class="vk-results">@lang('site.campaigns_found', ['count' => $campaigns->total()])</p>

<div class="cause-wrapper">
    <div class="row">
        @include('layouts.web.campaigns_not_completed')
    </div>
</div>

@if($campaigns->hasPages())
    <div class="vk-pagination">{{ $campaigns->links() }}</div>
@endif
