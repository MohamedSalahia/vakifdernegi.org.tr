{{-- Campaign progress block: raised / goal / remaining / donors (confirmed donations only) --}}
@php $st = $campaign->stats(); @endphp
<div class="vk-stats">
    @if($st['goal'] > 0)
        <div class="vk-progress" role="progressbar" aria-valuenow="{{ $st['percent'] }}" aria-valuemin="0" aria-valuemax="100">
            <span style="width: {{ $st['percent'] }}%"></span>
        </div>
        <div class="vk-stats__row">
            <span><strong dir="ltr">{{ number_format($st['raised'], 0, ',', '.') }} TL</strong> @lang('site.raised_of') <span dir="ltr">{{ number_format($st['goal'], 0, ',', '.') }} TL</span></span>
            <strong>%{{ $st['percent'] }}</strong>
        </div>
        <div class="vk-stats__row vk-stats__muted">
            <span>@lang('site.remaining'): <span dir="ltr">{{ number_format($st['remaining'], 0, ',', '.') }} TL</span></span>
            <span><span class="fa fa-users"></span> {{ $st['donors'] }} @lang('site.donors_count')</span>
        </div>
    @else
        <div class="vk-stats__row vk-stats__muted">
            <span><strong dir="ltr">{{ number_format($st['raised'], 0, ',', '.') }} TL</strong> @lang('site.raised')</span>
            <span><span class="fa fa-users"></span> {{ $st['donors'] }} @lang('site.donors_count')</span>
        </div>
    @endif
</div>
