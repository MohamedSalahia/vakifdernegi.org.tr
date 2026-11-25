@if ($campaigns->count() > 0)
    @foreach($campaigns as $campaign)
        <div class="cause-block-four style-two col-lg-4 col-md-6">
            <div class="inner-box">
                <div class="image">
                    <img src="{{($campaign->image ? url('/thumbnail/180/180/80/storage/campaign_images/'.$campaign->image) : url('/thumbnail/180/180/80/storage/settings/'.setting('logo')) )}}" alt="">
                    <div class="overlay"><a href="{{route('campaign.show',['campaign'=>$campaign->id,make_slug($campaign->name_slug)])}}" class="donate-box-btn">@lang('site.campaign_details')</a></div>
                </div>
                <div class="lower-content">
                    <div class="wrapper-box">
                        <h4><a href="{{route('campaign.show',['campaign'=>$campaign->id,make_slug($campaign->name_slug)])}}">{{$campaign->name}}</a></h4>
                        <p>@lang('site.campaign_location'): {{$campaign->country}}</p>
                        <div class="text">{!! \Illuminate\Support\Str::words(strip_tags($campaign->description),5) !!}</div>
                        <div class="info-box">
                            <div class="raised">
                                @php
                                    $userDonation = \App\Models\Donation::confirmedTotalForCampaign($campaign->id);

                                    $percentage = $campaign->goal > 0 ? min(100, round(($userDonation / $campaign->goal) * 100)) : 0

                                @endphp
                                {{--{{dd($percentage)}}--}}
                                <a href="javascript:;"><span>@lang('site.donate_total'):</span>{{ number_format((float) $userDonation, 0, ",", ".") }} @lang('site.kuveyt_dinari')</a>
                            </div>
                            <div class="count-box">
                                <span class="count-text" data-speed="3000" data-stop="{{$percentage}}">0</span><span class="affix">%</span>
                            </div>
                            <div class="goal">
                                <a href="javascript:;"><span>@lang('site.require'):</span>{{ number_format((float) $campaign->goal, 0, ",", ".") }} @lang('site.kuveyt_dinari')</a>
                            </div>
                            {{--<div class="donars"><span>@lang('site.country')</span> <br>{{$campaign->country}}</div>--}}

                        </div>

                        <form action="#" class="donate-form default-form" style="margin-top: 28px;">
                            <ul class="chicklet-list clearfix">
                                <li>
                                    <input type="radio" id="donate-amount-1-{{$campaign->id}}" value="10" name="donate-amount-{{$campaign->id}}">
                                    <label for="donate-amount-1-{{$campaign->id}}" data-amount="10">10 @lang('site.kuveyt_dinari')</label>
                                </li>
                                <li>
                                    <input type="radio" id="donate-amount-2-{{$campaign->id}}" value="20" name="donate-amount-{{$campaign->id}}" checked="checked">
                                    <label for="donate-amount-2-{{$campaign->id}}" data-amount="20">20 @lang('site.kuveyt_dinari')</label>
                                </li>
                                <li>
                                    <input type="radio" id="donate-amount-3-{{$campaign->id}}" value="30" name="donate-amount-{{$campaign->id}}">
                                    <label for="donate-amount-3-{{$campaign->id}}" data-amount="30">30 @lang('site.kuveyt_dinari')</label>
                                </li>
                                <li>
                                    <input type="radio" id="donate-amount-4-{{$campaign->id}}" value="50" name="donate-amount-{{$campaign->id}}">
                                    <label for="donate-amount-4-{{$campaign->id}}" data-amount="50">50 @lang('site.kuveyt_dinari')</label>
                                </li>
                                <li class="other-amount">
                                    <div class="input-container" data-message="Every dollar you donate helps end hunger.">
                                        <input type="number" min="5"  name="price_{{$campaign->id}}" id="other-amount-{{$campaign->id}}" class="price_{{$campaign->id}}" placeholder="@lang('site.another_require')" dir="rtl" required>
                                    </div>
                                    <input type="hidden" name="campaignId_{{$campaign->id}}" value="{{$campaign->id}}" class="form-control campaignId_{{$campaign->id}}" />
                                </li>
                            </ul>
                        </form>
                    </div>
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
        <script>
            $(document).ready(function(){
                $('.price_{{$campaign->id}}').change(function() {
                    //alert('change');
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
    @endforeach
@else
    <div class="col-lg-10" style="margin:20px auto;text-align:center">
        <div style="background:#fff;border:1px solid #e6e6e6;border-radius:8px;padding:36px 24px">
            <h3 style="margin-bottom:12px">@lang('site.no_active_campaigns')</h3>
            <p style="margin-bottom:20px">@lang('site.no_campaigns_contact')</p>
            <a href="{{ route('contact_us') }}" class="theme-btn btn-style-one"><span>@lang('site.contact_us')</span></a>
        </div>
    </div>
@endif




