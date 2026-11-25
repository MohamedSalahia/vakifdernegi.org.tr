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
                                <a href="javascript:;"><span>@lang('site.toplam_tutar'):</span>{{$campaign->goal}} @lang('site.kuveyt_dinari')</a>
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
                    alert(@json(__('site.enter_amount_alert')));
                    $(".price_{{$campaign->id}}").addClass("errorInput");
                    $(".price_{{$campaign->id}}").autofocus;
                    return false;
                }
                $(this).closest('form').find('.priceLive').val(amount);
            });

            $('.addToCart_{{$campaign->id}}').click(function (){

                var price = $(".price_{{$campaign->id}}").val() || $('input[name="donate-amount-{{$campaign->id}}"]:checked').val();

                if (!price) {
                    alert(@json(__('site.enter_amount_alert')));
                    $(".price_{{$campaign->id}}").addClass("errorInput");
                    $(".price_{{$campaign->id}}").autofocus;
                    return false;
                }
                var campaignId = $('.campaignId_{{$campaign->id}}').val();
                if (!campaignId) {
                    alert("campaignId must be filled out");
                    return false;
                }
                $.ajax({
                    type: "get",
                    url: '{{route('add.to.cart')}}',
                    data: {
                        price: price,
                        campaignId: campaignId
                    }
                }).success(function( data ) {
                    $('.item-count').empty().append(data.count);
                    new Noty({
                        text: data.message,
                        timeout: 2000,
                        killer: true,
                        type: "alert",
                        theme: 'semanticui',
                        layout: 'bottomLeft'
                    }).show();
                });

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
    <div class="alert alert-dismissible fade show" role="alert">
        <strong><h3>@lang('site.no_data_found')</h3></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="header-sign-in-up">
        <a href="{{route('/')}}" class="theme-btn btn-style-one"><span>@lang('site.return_to_homepage')</span></a>
    </div>
@endif




