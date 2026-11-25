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
                    <span>@lang('site.campaign_status'):</span> <br>@lang('site.complete')</div>
                <div class="goal"><span>@lang('site.total_amount'):</span> <br>{{ number_format((float) $campaign->goal, 0, ",", ".") }} @lang('site.kuveyt_dinari')</div>
                <div class="progress-block">
                    <div class="inner-box">
                        <div class="graph-outer">
                            <input type="text" class="dial" data-fgColor="#ed6221" data-bgColor="#f0edea" data-width="70" data-height="70" data-linecap="normal"  value="100">
                            <div class="inner-text count-box"><span class="count-text" data-stop="100" data-speed="2000"></span>%</div>
                        </div>
                    </div>
                </div>
                <div class="donars"><span>@lang('site.country')</span> <br>{{$campaign->country}}</div>
                {{--<div class="donars"><span>Donars</span> <br>148</div>
                <div class="days-left"><span>Days Left</span> <br>26</div>--}}
            </div>
        </div>
    </div>

    <!-- Causes Details -->
    <div class="sidebar-page-container cause-details">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-12 content-column">
                    <div class="image mb-50"><img src="{{url('/thumbnail/770/450/80/storage/campaign_images/'.($campaign->image ? $campaign->image : 'default.png'))}}{{--{{ Storage::url('campaign_images/' . $campaign->image) }}--}}" alt=""></div>
                    <div class="sec-title mb-40">
                        {!! $campaign->description !!}
                    </div>
                </div>
                {{--<div class="col-lg-6">
                    <div class="sidebar">
                        <div class="donate-form-area">
                            <div class="donate-form-wrapper">
                                <form action="#" class="donate-form default-form" style="margin-top: 28px;">
                                    <ul class="chicklet-list clearfix">
                                        <li>
                                            <input type="radio" id="donate-amount-1-{{$campaign->id}}" value="10" name="donate-amount-{{$campaign->id}}">
                                            <label for="donate-amount-1-{{$campaign->id}}" data-amount="10">10 د.ك</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="donate-amount-2-{{$campaign->id}}" value="20" name="donate-amount-{{$campaign->id}}" checked="checked">
                                            <label for="donate-amount-2-{{$campaign->id}}" data-amount="20">20 د.ك</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="donate-amount-3-{{$campaign->id}}" value="30" name="donate-amount-{{$campaign->id}}">
                                            <label for="donate-amount-3-{{$campaign->id}}" data-amount="30">30 د.ك</label>
                                        </li>
                                        <li>
                                            <input type="radio" id="donate-amount-4-{{$campaign->id}}" value="50" name="donate-amount-{{$campaign->id}}">
                                            <label for="donate-amount-4-{{$campaign->id}}" data-amount="50">50 د.ك</label>
                                        </li>
                                        <li class="other-amount">
                                            <div class="input-container" data-message="Every dollar you donate helps end hunger.">
                                                <input type="number" min="5"  name="price_{{$campaign->id}}" id="other-amount-{{$campaign->id}}" class="price_{{$campaign->id}}" placeholder="@lang('site.another_require')" dir="rtl" required>
                                            </div>
                                            <input type="hidden" name="campaignId_{{$campaign->id}}" value="{{$campaign->id}}" class="form-control campaignId_{{$campaign->id}}" />
                                        </li>
                                    </ul>
                                </form>
                                <div class="overlay-content">
                                    <ul class="clearfix" style="display: flex;justify-content: space-evenly;">

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
                </div>--}}
            </div>
        </div>
    </div>
@endsection


@push('scripts')
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
                alert(@json(__('site.enter_amount_alert')));
                $(".price_{{$campaign->id}}").addClass("errorInput");
                $(".price_{{$campaign->id}}").autofocus;
                return false;
                }
                $(this).closest('form').find('.priceLive').val(amount);
            });

        $(function() {

            $("input:radio[name=donate-amount-{{$campaign->id}}]").on("click",function() {
                var amount = $("input:radio[name=donate-amount-{{$campaign->id}}]:checked").val();
                $('#other-amount-{{$campaign->id}}').val(amount);
                $('.priceLive').val($('.price_{{$campaign->id}}').val());
            });
        });
    </script>
@endpush
