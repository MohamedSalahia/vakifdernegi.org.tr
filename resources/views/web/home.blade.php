@extends('layouts.web.app')
@section('page_title')@lang('site.home')@endsection

@section('content')
    <script src="{{asset('web/js/jquery.js')}}"></script>

    <!-- Bnner Section -->
    <section class="banner-section style-three">
        <div class="swiper-container banner-slider">
            <div class="swiper-wrapper">
                @foreach($sliders as $slider)

                    <!-- Slide Item -->
                    <div class="swiper-slide" style="background-image: url({{url('/thumbnail/1920/800/80/storage/slider_images/'.$slider->image)}});">
                        <div class="content-outer">
                            <div class="content-box justify-content-center">
                                <div class="inner text-center">
                                    {{--<div class="logo"><img src="{{asset('storage/settings/'.setting('logo'))}}" alt=""></div>--}}

                                    <h1>{{$slider->name}} </h1>
                                    @if($slider->button_url && $slider->button_name)
                                    <div class="link-box">
                                        <a href="{{$slider->button_url}}" class="theme-btn btn-style-ten"><span>{{$slider->button_name}}</span></a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

                @foreach($sliderCampaigns as $featured)
                    @php $featuredRaised = \App\Models\Donation::confirmedTotalForCampaign($featured->id); @endphp
                    <!-- Campaign featured in the slider (admin: campaigns > show in slider) -->
                    <div class="swiper-slide" style="background-image: url({{ $featured->image ? url('/thumbnail/1920/800/80/storage/campaign_images/'.$featured->image) : url('/thumbnail/1920/800/80/storage/settings/'.setting('banner')) }});">
                        <div class="content-outer">
                            <div class="content-box justify-content-center">
                                <div class="inner text-center">
                                    <h1>{{ $featured->name }}</h1>
                                    @if((float) $featured->goal > 0)
                                        <div class="text" style="color:#fff;font-size:20px;margin:12px 0 22px">
                                            @lang('site.require'): <span dir="ltr">{{ number_format((float) $featured->goal, 0, ',', '.') }} TL</span>
                                            · @lang('site.donate_total'): <span dir="ltr">{{ number_format($featuredRaised, 0, ',', '.') }} TL</span>
                                        </div>
                                    @endif
                                    <div class="link-box">
                                        <a href="{{ route('campaign.show', [$featured->id, make_slug($featured->name)]) }}" class="theme-btn btn-style-ten"><span>@lang('site.donate_now')</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if($sliders->isEmpty() && $sliderCampaigns->isEmpty())
                    <!-- Default hero when no slider has been added from the admin panel -->
                    <div class="swiper-slide" style="background-image: url({{ setting('banner') ? url('/thumbnail/1920/800/80/storage/settings/'.setting('banner')) : asset('web/images/background/bg-7.jpg') }});">
                        <div class="content-outer">
                            <div class="content-box justify-content-center">
                                <div class="inner text-center">
                                    <h1>@lang('site.site_name')</h1>
                                    <div class="text" style="color:#fff;font-size:20px;margin:15px 0 25px">@lang('site.hero_text')</div>
                                    <div class="link-box">
                                        <a href="{{ route('about_us') }}" class="theme-btn btn-style-ten"><span>@lang('site.about_us')</span></a>
                                        <a href="{{ route('contact_us') }}" class="theme-btn btn-style-ten"><span>@lang('site.contact_us')</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
            <div class="banner-slider-pagination style-four"></div>
            <div class="banner-slider-nav style-one">
                <div class="banner-slider-control banner-slider-button-prev"><span class="fa fa-angle-{{(app()->getLocale() == 'ar' ? 'right':'left')}}"></span></div>
                <div class="banner-slider-control banner-slider-button-next"><span class="fa fa-angle-{{(app()->getLocale() == 'ar' ? 'left':'right')}}"></span> </div>
            </div>
        </div>
    </section>
    <!-- End Bnner Section -->

    {{--Projects in progress--}}
    <section class="causes-section-four">
        <div class="auto-container">
            <div class="sec-title text-center">
                <h5>@lang('site.projects')</h5>
                <h1>@lang('site.projects_in_progress')</h1>
            </div>
            <div class="cause-wrapper">
                <div class="row" style="justify-content: center">
                    {{--@foreach($campaigns as $campaign)
                        <div class="cause-block-four style-two col-lg-4 col-md-6">
                            <div class="inner-box">
                                <div class="image">
                                    <img src="{{($campaign->image ? url('/thumbnail/180/180/80/storage/campaign_images/'.$campaign->image) : url('/thumbnail/180/180/80/storage/settings/'.setting('logo')) )}}" alt="">
                                    <div class="overlay"><a href="{{route('campaign.show',['campaign'=>$campaign->id,make_slug($campaign->name_slug)])}}" class="donate-box-btn">@lang('site.campaign_details')</a></div>
                                </div>
                                <div class="lower-content">
                                    <div class="wrapper-box">
                                        <h4><a href="{{route('campaign.show',['campaign'=>$campaign->id,make_slug($campaign->name_slug)])}}">{{$campaign->name}}</a></h4>
                                        <div class="text">{!! \Illuminate\Support\Str::words(strip_tags($campaign->description),5) !!}</div>
                                        <div class="info-box">
                                            <div class="raised">
                                                @php
                                                    $userDonation = \App\Models\Donation::confirmedTotalForCampaign($campaign->id);

                                                    $percentage = $campaign->goal > 0 ? min(100, round(($userDonation / $campaign->goal) * 100)) : 0

                                                @endphp
                                                --}}{{--{{dd($percentage)}}--}}{{--
                                                <a href="#"><span>التبرع:</span>{{ number_format((float) $userDonation, 0, ",", ".") }} د.ك</a>
                                            </div>
                                            <div class="count-box">
                                                <span class="count-text" data-speed="3000" data-stop="{{$percentage}}">0</span><span class="affix">%</span>
                                            </div>
                                            <div class="goal">
                                                <a href="#"><span>مطلوب:</span>{{ number_format((float) $campaign->goal, 0, ",", ".") }} د.ك</a>
                                            </div>
                                            --}}{{--<div class="overlay-content">
                                                <ul class="clearfix">
                                                    <li>
                                                        <div class="addToCart_{{$campaign->id}}"><span class="fa fa-shopping-cart"></span>
                                                            <div class="toltip-content">
                                                                <p>Add to Cart</p>
                                                            </div>
                                                        </div>
                                                        <input type="number" name="price_{{$campaign->id}}" class="form-control price_{{$campaign->id}}" />
                                                        <input type="hidden" name="campaignId_{{$campaign->id}}" value="{{$campaign->id}}" class="form-control campaignId_{{$campaign->id}}" />
                                                    </li>
                                                </ul>
                                            </div>--}}{{--

                                        </div>

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
                                                    <input type="radio" id="donate-amount-3-{{$campaign->id}}" value="50" name="donate-amount-{{$campaign->id}}">
                                                    <label for="donate-amount-3-{{$campaign->id}}" data-amount="50">50 د.ك</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="donate-amount-4-{{$campaign->id}}" value="100" name="donate-amount-{{$campaign->id}}">
                                                    <label for="donate-amount-4-{{$campaign->id}}" data-amount="100">100 د.ك</label>
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
                                                @if(\Illuminate\Support\Facades\Auth::check())
                                                    --}}{{--<a href="javascript:;" class="addToCart_{{$campaign->id}}"><span class="fa fa-shopping-cart"></span>
                                                        <div class="toltip-content">
                                                            <p>أضف للسلة</p>
                                                        </div>
                                                    </a>--}}{{--
                                                    <a href="javascript:;" class="theme-btn btn-style-two addToCart_{{$campaign->id}}"><span class="fa fa-shopping-cart"></span><span> أضف للسلة</span></a>
                                                @else
                                                    --}}{{--<a href="{{route('login')}}"><span class="fa fa-shopping-cart"></span>
                                                        <div class="toltip-content">
                                                            <p>أضف للسلة</p>
                                                        </div>
                                                    </a>--}}{{--

                                                    <a href="{{ route('login') }}" class="theme-btn btn-style-two"><span class="fa fa-shopping-cart"></span><span> أضف للسلة</span></a>
                                                @endif
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
                                    $('.priceLive').val($('.price_{{$campaign->id}}').val());
                                });
                            });
                            $( ".quickDonate_{{$campaign->id}}" ).click(function() {
                var amount = $(".price_{{$campaign->id}}").val() || $('input[name="donate-amount-{{$campaign->id}}"]:checked').val();
                if (!amount) {
                                    alert("يرجى ملئ حقل السعر");
                                    $(".price_{{$campaign->id}}").addClass("errorInput");
                                    $(".price_{{$campaign->id}}").autofocus;
                                    return false;
                }
                $(this).closest('form').find('.priceLive').val(amount);
            });

                            $('.addToCart_{{$campaign->id}}').click(function (){

                                var price = $(".price_{{$campaign->id}}").val() || $('input[name="donate-amount-{{$campaign->id}}"]:checked').val();

                                if (!price) {
                                    alert("يرجى ملئ حقل السعر");
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
                    @endforeach--}}

                    @include('layouts.web.campaigns_not_completed')

                        {{--<div class="link-btn">
                            <a href="http://127.0.0.1:8000/admin/home" class="theme-btn btn-style-one header_sticky_buttons"><span>لوحة التحكم</span></a>
                        </div>--}}
                </div>
            </div>
            <div class="sec-title text-center">
                <a href="{{route('campaigns')}}" class="theme-btn btn-style-one header_sticky_buttons"><span>@lang('site.show_all')</span></a>
            </div>
        </div>
    </section>
    {{--Projects finished--}}
    @if ($campaigns_completed->count() > 0)
        <section class="causes-section-four" style="background-image: url({{asset('web/images/background/bg-7.jpg')}});">
        <div class="auto-container">
            <div class="sec-title text-center">
                <h5>@lang('site.projects')</h5>
                <h1>@lang('site.projects_finished')</h1>
            </div>
            <div class="cause-wrapper">
                <div class="row" style="justify-content: center">
                    {{--@foreach($campaigns as $campaign)
                        <div class="cause-block-four style-two col-lg-4 col-md-6">
                            <div class="inner-box">
                                <div class="image">
                                    <img src="{{($campaign->image ? url('/thumbnail/180/180/80/storage/campaign_images/'.$campaign->image) : url('/thumbnail/180/180/80/storage/settings/'.setting('logo')) )}}" alt="">
                                    <div class="overlay"><a href="{{route('campaign.show',['campaign'=>$campaign->id,make_slug($campaign->name_slug)])}}" class="donate-box-btn">@lang('site.campaign_details')</a></div>
                                </div>
                                <div class="lower-content">
                                    <div class="wrapper-box">
                                        <h4><a href="{{route('campaign.show',['campaign'=>$campaign->id,make_slug($campaign->name_slug)])}}">{{$campaign->name}}</a></h4>
                                        <div class="text">{!! \Illuminate\Support\Str::words(strip_tags($campaign->description),5) !!}</div>
                                        <div class="info-box">
                                            <div class="raised">
                                                @php
                                                    $userDonation = \App\Models\Donation::confirmedTotalForCampaign($campaign->id);

                                                    $percentage = $campaign->goal > 0 ? min(100, round(($userDonation / $campaign->goal) * 100)) : 0

                                                @endphp
                                                --}}{{--{{dd($percentage)}}--}}{{--
                                                <a href="#"><span>التبرع:</span>{{ number_format((float) $userDonation, 0, ",", ".") }} د.ك</a>
                                            </div>
                                            <div class="count-box">
                                                <span class="count-text" data-speed="3000" data-stop="{{$percentage}}">0</span><span class="affix">%</span>
                                            </div>
                                            <div class="goal">
                                                <a href="#"><span>مطلوب:</span>{{ number_format((float) $campaign->goal, 0, ",", ".") }} د.ك</a>
                                            </div>
                                            --}}{{--<div class="overlay-content">
                                                <ul class="clearfix">
                                                    <li>
                                                        <div class="addToCart_{{$campaign->id}}"><span class="fa fa-shopping-cart"></span>
                                                            <div class="toltip-content">
                                                                <p>Add to Cart</p>
                                                            </div>
                                                        </div>
                                                        <input type="number" name="price_{{$campaign->id}}" class="form-control price_{{$campaign->id}}" />
                                                        <input type="hidden" name="campaignId_{{$campaign->id}}" value="{{$campaign->id}}" class="form-control campaignId_{{$campaign->id}}" />
                                                    </li>
                                                </ul>
                                            </div>--}}{{--

                                        </div>

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
                                                    <input type="radio" id="donate-amount-3-{{$campaign->id}}" value="50" name="donate-amount-{{$campaign->id}}">
                                                    <label for="donate-amount-3-{{$campaign->id}}" data-amount="50">50 د.ك</label>
                                                </li>
                                                <li>
                                                    <input type="radio" id="donate-amount-4-{{$campaign->id}}" value="100" name="donate-amount-{{$campaign->id}}">
                                                    <label for="donate-amount-4-{{$campaign->id}}" data-amount="100">100 د.ك</label>
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
                                                @if(\Illuminate\Support\Facades\Auth::check())
                                                    --}}{{--<a href="javascript:;" class="addToCart_{{$campaign->id}}"><span class="fa fa-shopping-cart"></span>
                                                        <div class="toltip-content">
                                                            <p>أضف للسلة</p>
                                                        </div>
                                                    </a>--}}{{--
                                                    <a href="javascript:;" class="theme-btn btn-style-two addToCart_{{$campaign->id}}"><span class="fa fa-shopping-cart"></span><span> أضف للسلة</span></a>
                                                @else
                                                    --}}{{--<a href="{{route('login')}}"><span class="fa fa-shopping-cart"></span>
                                                        <div class="toltip-content">
                                                            <p>أضف للسلة</p>
                                                        </div>
                                                    </a>--}}{{--

                                                    <a href="{{ route('login') }}" class="theme-btn btn-style-two"><span class="fa fa-shopping-cart"></span><span> أضف للسلة</span></a>
                                                @endif
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
                                    $('.priceLive').val($('.price_{{$campaign->id}}').val());
                                });
                            });
                            $( ".quickDonate_{{$campaign->id}}" ).click(function() {
                var amount = $(".price_{{$campaign->id}}").val() || $('input[name="donate-amount-{{$campaign->id}}"]:checked').val();
                if (!amount) {
                                    alert("يرجى ملئ حقل السعر");
                                    $(".price_{{$campaign->id}}").addClass("errorInput");
                                    $(".price_{{$campaign->id}}").autofocus;
                                    return false;
                }
                $(this).closest('form').find('.priceLive').val(amount);
            });

                            $('.addToCart_{{$campaign->id}}').click(function (){

                                var price = $(".price_{{$campaign->id}}").val() || $('input[name="donate-amount-{{$campaign->id}}"]:checked').val();

                                if (!price) {
                                    alert("يرجى ملئ حقل السعر");
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
                    @endforeach--}}

                    @include('layouts.web.campaigns_completed')

                    {{--<div class="link-btn">
                        <a href="http://127.0.0.1:8000/admin/home" class="theme-btn btn-style-one header_sticky_buttons"><span>لوحة التحكم</span></a>
                    </div>--}}
                </div>
            </div>
            <div class="sec-title text-center">
                <a href="{{route('completed-campaigns')}}" class="theme-btn btn-style-one header_sticky_buttons"><span>@lang('site.show_all')</span></a>
            </div>
        </div>
    </section>
    @endif

    <!-- Official association / transparency -->
    @php($assoc = config('association'))
    <section style="padding:70px 0;background:#f7f7f7">
        <div class="auto-container">
            <div class="sec-title text-center">
                <h5>@lang('site.about_us')</h5>
                <h1>@lang('site.home_about_title')</h1>
            </div>
            <div class="row" style="justify-content:center">
                <div class="col-lg-7" style="margin-bottom:20px">
                    <p style="font-size:17px;line-height:1.9">@lang('site.home_about_text')</p>
                    <a href="{{ route('about_us') }}" class="theme-btn btn-style-one" style="margin-top:10px"><span>@lang('site.read_more')</span></a>
                </div>
                <div class="col-lg-4">
                    <div style="background:#fff;border:1px solid #e6e6e6;border-radius:8px;padding:24px">
                        <h4 style="margin-bottom:14px">@lang('site.footer_association_title')</h4>
                        <p style="margin:0 0 6px"><strong>{{ $assoc['legal_name'] }}</strong></p>
                        <p style="margin:0 0 6px">@lang('site.kutuk_no'): <span dir="ltr">{{ $assoc['kutuk_no'] }}</span></p>
                        <p style="margin:0 0 6px">@lang('site.vergi_no'): <span dir="ltr">{{ $assoc['vergi_no'] }}</span></p>
                        <p style="margin:0 0 6px">@lang('site.founded'): {{ $assoc['founded'] }}</p>
                        <p style="margin:0 0 12px">{{ $assoc['address'][app()->getLocale()] ?? $assoc['address']['tr'] }}</p>
                        <a href="{{ $assoc['derbis_verify_url'] }}" target="_blank" rel="noopener">@lang('site.verify_on_derbis')</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($blogs->count() > 0)
    <!-- Blog Section -->
    <section class="blog-section">
        <div class="auto-container">
             <div class="sec-title text-center">
                 <h5>@lang('site.home_blogs_title')</h5>
                 <h1>@lang('site.home_blogs_description')</h1>
             </div>
            <div class="row">
                @foreach($blogs as $blog)

                    <!-- News Block Two -->
                    <div class="col-lg-4 news-block-two style-two">
                        <div class="inner-box wow fadeInUp" data-wow-delay="200ms">
                            <div class="image">
                                <a href="{{route('blog.show',['blog'=>$blog->id,make_slug($blog->name)])}}"><img src="{{($blog->image ? url('/thumbnail/950/450/80/storage/blog_images/'.$blog->image) : url('/thumbnail/356/267/80/storage/settings/'.setting('logo')) )}}" alt=""></a>
                            </div>
                            <div class="lower-content">
                                <div class="date"><span class="flaticon-clock"></span>{{ $blog->created_at->format('Y-m-d') }}</div>
                                <h4><a href="{{route('blog.show',['blog'=>$blog->id,make_slug($blog->name)])}}">{{$blog->name}}</a></h4>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{--<a href="{{route('blogs')}}" class="theme-btn btn-style-twelve"><span>@lang('site.all_blogs')</span></a>--}}
            </div>
        </div>
    </section>
    @endif
@endsection

@push('scripts')

    <script>
        $(function() {

            $("input:radio[name=amount]").on("click",function() {
                var amount = $("input:radio[name=amount]:checked").val();
                $('#textAmount').val(amount);
            });
        });
    </script>
@endpush
