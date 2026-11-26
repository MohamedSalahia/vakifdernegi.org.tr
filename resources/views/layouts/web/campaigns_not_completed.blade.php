@if ($campaigns->count() > 0)
    @foreach($campaigns as $campaign)
        <div class="cause-block-four style-two col-lg-4 col-md-6">
            <div class="inner-box">
                <div class="image">
                    <img src="{{($campaign->image ? url('/thumbnail/180/180/80/storage/campaign_images/'.$campaign->image) : url('/thumbnail/180/180/80/storage/settings/'.setting('logo')) )}}" alt="">
                    @include('web.partials.campaign_badges', ['campaign' => $campaign])
                    <div class="overlay"><a href="{{route('campaign.show',['campaign'=>$campaign->id,make_slug($campaign->name_slug)])}}" class="donate-box-btn">@lang('site.campaign_details')</a></div>
                </div>
                <div class="lower-content">
                    <div class="wrapper-box">
                        <h4><a href="{{route('campaign.show',['campaign'=>$campaign->id,make_slug($campaign->name_slug)])}}">{{$campaign->name}}</a></h4>
                        <p>@lang('site.campaign_location'): {{$campaign->country}}</p>
                        <div class="text">{!! \Illuminate\Support\Str::words(strip_tags($campaign->description),5) !!}</div>
                        @include('web.partials.campaign_stats', ['campaign' => $campaign])
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




