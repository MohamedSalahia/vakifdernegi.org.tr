@if($campaign->is_urgent || $campaign->accepts_zakat)
    <div class="vk-badges">
        @if($campaign->is_urgent)<span class="vk-badge vk-badge--urgent"><span class="fa fa-bolt"></span> @lang('site.badge_urgent')</span>@endif
        @if($campaign->accepts_zakat)<span class="vk-badge vk-badge--zakat"><span class="fa fa-check"></span> @lang('site.badge_zakat')</span>@endif
    </div>
@endif
