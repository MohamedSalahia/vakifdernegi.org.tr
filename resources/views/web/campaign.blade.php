@extends('layouts.web.app')
@section('page_title'){{$campaign->name}}@endsection
@section('post_head')
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{($campaign->meta_title ? $campaign->meta_title: $campaign->name)}}"/>
    <meta property="og:description" content="{{($campaign->meta_description ? $campaign->meta_description: setting(app()->getLocale())['description'] )}}"/>
    <meta property="og:url" content="{{route('campaign.show',['campaign'=>$campaign->id,make_slug($campaign->name_slug)])}}"/>
    <meta property="og:image" content="{{($campaign->image ? url('/thumbnail/500/500/80/storage/campaign_images/'.$campaign->image) : url('/thumbnail/500/500/80/storage/settings/'.setting('logo')) )}}"/>
    <meta property="og:image:width" content="500"/>
    <meta property="og:image:height" content="500"/>
    <meta property="article:author" content="@lang('site.author')"/>
    <meta property="fb:app_id" content="111027297706500"/>
    <meta property="article:published_time" content="{{\Carbon\Carbon::parse($campaign->created_at)->format('Y-m-d H:i:s')}}"/>
    <meta property="article:modified_time" content="{{\Carbon\Carbon::parse($campaign->updated_at)->format('Y-m-d H:i:s')}}"/>

@endsection
@section('content')
    <section class="page-title" style="background-image:url({{url('/thumbnail/1920/900/80/storage/settings/'.setting('banner'))}})">
        <div class="auto-container">
            <div class="content-box">
                <h1>{{$campaign->name}}</h1>
            </div>
        </div>
    </section>

    <!-- Cause Info -->
    <div class="cause-info">
        <div class="auto-container">
            <div class="wrapper-box">
                <div class="raised">
                    @php
                        $userDonation = \App\Models\Donation::confirmedTotalForCampaign($campaign->id);
                        $percentage = $campaign->goal > 0 ? min(100, round(($userDonation / $campaign->goal) * 100)) : 0
                    @endphp
                    <span>@lang('site.donate_total'):</span> <br>{{ number_format((float) $userDonation, 0, ",", ".") }} @lang('site.kuveyt_dinari')</div>
                <div class="goal"><span>@lang('site.require'):</span> <br>{{ number_format((float) $campaign->goal, 0, ",", ".") }} @lang('site.kuveyt_dinari')</div>
                <div class="progress-block">
                    <div class="inner-box">
                        <div class="graph-outer">
                            <input type="text" class="dial" data-fgColor="#ed6221" data-bgColor="#f0edea" data-width="70" data-height="70" data-linecap="normal"  value="{{$percentage}}">
                            <div class="inner-text count-box"><span class="count-text" data-stop="{{$percentage}}" data-speed="2000"></span>%</div>
                        </div>
                    </div>
                </div>
                <div class="donars"><span>@lang('site.country')</span> <br>{{$campaign->country}}</div>
                {{--<div class="days-left"><span>Days Left</span> <br>26</div>--}}
            </div>
        </div>
    </div>

    <!-- Causes Details -->
    <div class="sidebar-page-container cause-details">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-7 content-column">
                    <div class="image mb-30" style="position:relative">
                        <img src="{{url('/thumbnail/1900/1000/80/storage/campaign_images/'.($campaign->image ? $campaign->image : 'default.png'))}}" alt="{{ $campaign->image_alt ?: $campaign->name }}">
                        @include('web.partials.campaign_badges', ['campaign' => $campaign])
                    </div>

                    @include('web.partials.campaign_share', ['campaign' => $campaign])

                    @php
                        $campaignUpdates = $campaign->updates()->get();
                        $publicDonations = $campaign->show_donors ? $campaign->confirmedDonationItems()->limit(50)->get() : collect();
                        $st = $campaign->stats();
                    @endphp
                    <ul class="vk-campaign-tabs" role="tablist">
                        <li><button type="button" class="active" data-tab="overview" role="tab">@lang('site.tab_overview')</button></li>
                        <li><button type="button" data-tab="details" role="tab">@lang('site.tab_details')</button></li>
                        <li><button type="button" data-tab="updates" role="tab">@lang('site.tab_updates')<span class="vk-count">{{ $campaignUpdates->count() }}</span></button></li>
                        @if($campaign->show_donors)
                            <li><button type="button" data-tab="donations" role="tab">@lang('site.tab_donations')<span class="vk-count">{{ $st['donors'] }}</span></button></li>
                        @endif
                    </ul>

                    <div class="vk-tab-panel active" data-panel="overview">
                        <div class="sec-title mb-40">{!! $campaign->description !!}</div>
                    </div>

                    <div class="vk-tab-panel" data-panel="details">
                        <table class="vk-details-table">
                            @if($campaign->category)<tr><th>@lang('site.category')</th><td>{{ $campaign->category->name }}</td></tr>@endif
                            <tr><th>@lang('site.country')</th><td>{{ $campaign->country }}</td></tr>
                            @if($st['goal'] > 0)
                                <tr><th>@lang('site.require')</th><td dir="ltr">{{ number_format($st['goal'], 0, ',', '.') }} TL</td></tr>
                                <tr><th>@lang('site.remaining')</th><td dir="ltr">{{ number_format($st['remaining'], 0, ',', '.') }} TL</td></tr>
                            @endif
                            <tr><th>@lang('site.donate_total')</th><td dir="ltr">{{ number_format($st['raised'], 0, ',', '.') }} TL</td></tr>
                            <tr><th>@lang('site.donors_count')</th><td>{{ $st['donors'] }}</td></tr>
                            <tr><th>@lang('site.campaign_accepts_zakat')</th><td>{{ $campaign->accepts_zakat ? __('site.yes_option') : __('site.no_option') }}</td></tr>
                            <tr><th>@lang('site.campaign_started')</th><td dir="ltr">{{ $campaign->created_at->format('d.m.Y') }}</td></tr>
                            <tr><th>@lang('site.campaign_number')</th><td dir="ltr">#{{ $campaign->id }}</td></tr>
                        </table>
                    </div>

                    <div class="vk-tab-panel" data-panel="updates">
                        @forelse($campaignUpdates as $u)
                            <div class="vk-update">
                                <div class="vk-update__date" dir="ltr">{{ $u->published_at->format('d.m.Y') }}</div>
                                <h4>{{ $u->title }}</h4>
                                <div>{!! nl2br(e($u->body)) !!}</div>
                                @if($u->image)<img src="{{ url('/thumbnail/900/600/80/storage/campaign_updates/'.$u->image) }}" alt="{{ $u->title }}" loading="lazy">@endif
                            </div>
                        @empty
                            <p class="vk-stats__muted">@lang('site.no_updates_public')</p>
                        @endforelse
                    </div>

                    @if($campaign->show_donors)
                        <div class="vk-tab-panel" data-panel="donations">
                            @forelse($publicDonations as $item)
                                <div class="vk-donor">
                                    <div>
                                        <div class="vk-donor__name">{{ $item->donation->show_name ? $item->donation->donor_name : __('site.anonymous_donor') }}</div>
                                        <div class="vk-donor__meta" dir="ltr">{{ optional($item->donation->confirmed_at ?? $item->created_at)->format('d.m.Y') }}</div>
                                    </div>
                                    <strong dir="ltr">{{ number_format((float) $item->amount, 0, ',', '.') }} TL</strong>
                                </div>
                            @empty
                                <p class="vk-stats__muted">@lang('site.no_donations_public')</p>
                            @endforelse
                        </div>
                    @endif
                </div>
                <div class="col-lg-5">
                    <div class="sidebar">
                        <div class="donate-form-area">
                            <div class="donate-form-wrapper">
                                <form action="#" class="donate-form default-form" style="margin-top: 28px;">
                                    <ul class="chicklet-list clearfix">
                                        @foreach(\App\Support\DonationSettings::presets() as $presetAmount)
                                            <li>
                                                <input type="radio" id="donate-amount-{{ $loop->iteration }}-{{$campaign->id}}" value="{{ $presetAmount }}" name="donate-amount-{{$campaign->id}}" {{ $loop->index === 1 ? 'checked' : '' }}>
                                                <label for="donate-amount-{{ $loop->iteration }}-{{$campaign->id}}" data-amount="{{ $presetAmount }}" dir="ltr">{{ number_format($presetAmount, 0, ',', '.') }} TL</label>
                                            </li>
                                        @endforeach
                                        <li class="other-amount">
                                            <div class="input-container" data-message="Every dollar you donate helps end hunger.">
                                                <input type="number" min="{{ \App\Support\DonationSettings::min() }}"  name="price_{{$campaign->id}}" id="other-amount-{{$campaign->id}}" class="price_{{$campaign->id}}" placeholder="@lang('site.another_require')" dir="rtl" required>
                                            </div>
                                            <input type="hidden" name="campaignId_{{$campaign->id}}" value="{{$campaign->id}}" class="form-control campaignId_{{$campaign->id}}" />
                                        </li>
                                    </ul>
                                </form>
                                <div class="overlay-content">
                                    <ul class="clearfix" style="display: flex;justify-content: space-evenly;">
                                        <li>
                                            <a href="javascript:;" class="theme-btn btn-style-two addToCart_{{$campaign->id}}"><span class="fa fa-shopping-cart"></span><span> @lang('site.add_to_card')</span></a>
                                        </li>

                                        <li>
                                            <form method="get" action="{{ route('donate.campaign', $campaign->id) }}">
                                                    <input type="hidden" name="priceLive" class="priceLive">
                                                    <button class="theme-btn btn-style-two quickDonate_{{$campaign->id}}" type="submit" data-loading-text="Please wait..."><span class="flaticon-heart-1"></span><span>@lang('site.direct_donation')</span></button>
                                                </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        document.querySelectorAll('.vk-campaign-tabs button').forEach(function (btn) {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.vk-campaign-tabs button').forEach(function (b) { b.classList.toggle('active', b === btn); });
                document.querySelectorAll('.vk-tab-panel').forEach(function (p) { p.classList.toggle('active', p.dataset.panel === btn.dataset.tab); });
            });
        });
    </script>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebPage",
            "name": "@if(setting(app()->getLocale())['title']){{setting(app()->getLocale())['title']}}@else@lang('site.title')@endif - {{$campaign->name}}",
            "image": "{{url('/thumbnail/200/200/80/storage/settings/'.setting('logo'))}}",
            "url": "{{route('campaign.show',['campaign'=>$campaign->id,make_slug($campaign->name_slug)])}}",
            "publisher": {
                "@type": "Organization",
                "name": "{{setting(app()->getLocale())['title']}}",
                "logo": {
                    "@type": "ImageObject",
                    "url": "{{url('/thumbnail/200/200/80/storage/settings/'.setting('logo'))}}"
                }
            }
        }
    </script>

    <script>
        $(document).ready(function(){
            $('.price_{{$campaign->id}}').change(function() {
                $('.priceLive').val($('.price_{{$campaign->id}}').val());
            });
        });
        $( ".quickDonate_{{$campaign->id}}" ).click(function() {
                var amount = $(".price_{{$campaign->id}}").val() || $('input[name="donate-amount-{{$campaign->id}}"]:checked').val();
                if (!amount) {
                vakifToast(@json(__('site.enter_amount_alert')), 'warning');
                $(".price_{{$campaign->id}}").addClass("errorInput");
                $(".price_{{$campaign->id}}").autofocus;
                return false;
                }
                $(this).closest('form').find('.priceLive').val(amount);
            });

        $('.addToCart_{{$campaign->id}}').click(function (){

            var price = $(".price_{{$campaign->id}}").val() || $('input[name="donate-amount-{{$campaign->id}}"]:checked').val();

            if (!price) {
                vakifToast(@json(__('site.enter_amount_alert')), 'warning');
                $(".price_{{$campaign->id}}").addClass("errorInput");
                $(".price_{{$campaign->id}}").autofocus;
                return false;
            }
            vakifCart.add({{ $campaign->id }}, price);

        })

        $(function() {

            $("input:radio[name=donate-amount-{{$campaign->id}}]").on("click",function() {
                var amount = $("input:radio[name=donate-amount-{{$campaign->id}}]:checked").val();
                $('#other-amount-{{$campaign->id}}').val(amount);
                $('.priceLive').val($('.price_{{$campaign->id}}').val());
            });
        });
    </script>
@endpush
