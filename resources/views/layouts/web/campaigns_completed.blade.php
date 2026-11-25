@if ($campaigns_completed->count() > 0)
    @foreach($campaigns_completed as $campaign)
        <div class="cause-block-four style-two col-lg-4 col-md-6">
            <div class="inner-box">
                <div class="image">
                    <img src="{{($campaign->image ? url('/thumbnail/180/180/80/storage/campaign_images/'.$campaign->image) : url('/thumbnail/180/180/80/storage/settings/'.setting('logo')) )}}" alt="">
                    <div class="overlay"><a href="{{route('campaign-completed.show',['campaign'=>$campaign->id,make_slug($campaign->name_slug)])}}" class="donate-box-btn">@lang('site.campaign_details')</a></div>
                </div>
                <div class="lower-content">
                    <div class="wrapper-box">
                        <h4><a href="{{route('campaign-completed.show',['campaign'=>$campaign->id,make_slug($campaign->name_slug)])}}">{{$campaign->name}}</a></h4>
                        <p>@lang('site.campaign_location'): {{$campaign->country}}</p>
                        <div class="text">{!! \Illuminate\Support\Str::words(strip_tags($campaign->description),5) !!}</div>
                        <div class="info-box">

                            <div class="count-box">
                                <span class="count-text" ></span><span class="affix">@lang('site.complete')</span>
                            </div>
                            <div class="goal">
                                <a href="javascript:;"><span>@lang('site.toplam_tutar'):</span>{{ number_format((float) $campaign->goal, 0, ",", ".") }} @lang('site.kuveyt_dinari')</a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
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
            <h3 style="margin-bottom:12px">@lang('site.no_completed_campaigns')</h3>
            <p style="margin-bottom:20px">@lang('site.no_campaigns_contact')</p>
            <a href="{{ route('contact_us') }}" class="theme-btn btn-style-one"><span>@lang('site.contact_us')</span></a>
        </div>
    </div>
@endif




