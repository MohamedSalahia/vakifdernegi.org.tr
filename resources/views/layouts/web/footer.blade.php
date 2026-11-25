<footer class="main-footer">
    <div class="auto-container">
        <div class="widget-wrapper">
            <div class="row">
                <!-- Contact Widget -->
                <div class="col-lg-3 col-md-6 contact-widget footer-widget">
                    <h4 class="widget-title">@lang('site.footer_column1_title')</h4>
                    <ul>
                        <li>{{setting(app()->getLocale())['address']}}</li>
                        <li><a href="mailto:{{setting('email')}}">{{setting('email')}} </a></li>
                    </ul>
                    <h3><a href="tel:{{phone_remove_spaces_and_plus()}}">{{setting('phone')}}</a></h3>
                </div>
                <!-- About Widget -->
                <div class="col-lg-3 col-md-6 about-widget footer-widget">
                    <h4 class="widget-title">@lang('site.footer_column2_title')</h4>
                    <ul>
                        <li><a href="{{route('/')}}">@lang('site.home')</a></li>
                        <li><a href="{{route('about_us')}}">@lang('site.about_us')</a></li>
                        {{--<li><a href="{{route('contact_us')}}">@lang('site.contact_us')</a></li>--}}
                        <li><a href="{{route('bank_accounts')}}">@lang('site.bank_accounts')</a></li>
                        <li><a href="{{route('said_about_us')}}">@lang('site.said_about_us')</a></li>
                        <li><a href="{{route('privacy')}}">@lang('site.privacy')</a></li>
                        <li><a href="{{route('terms-of-use')}}">@lang('site.term')</a></li>
                    </ul>
                </div>
                <!-- Link Widget -->
                <div class="col-lg-3 col-md-6 link-widget footer-widget">
                    <h4 class="widget-title">@lang('site.footer_column3_title')</h4>
                    <ul>
                        @foreach($campaignCategories as $campaignCategory)
                            <li><a href="#">{{$campaignCategory->name}}</a></li>
                        @endforeach

                    </ul>
                </div>
                <!-- Newsletter Widget -->
                <div class="col-lg-3 col-md-6 office-location-widget footer-widget">
                    <h4 class="widget-title">@lang('site.our_offices')</h4>
                    <div class="wrapper-box">
                        <div class="location-point">
                            <div class="content">
                                <div class="text">@lang('site.kuwait') </div>
                            </div>
                            <span class="point"></span>
                        </div>
                        {{--<div class="location-point">
                            <div class="content">
                                <div class="text">@lang('site.our_offices2')</div>
                            </div>
                            <span class="point"></span>
                        </div>
                        <div class="location-point">
                            <div class="content">
                                <div class="text">@lang('site.our_offices3')</div>
                            </div>
                            <span class="point"></span>
                        </div>
                        <div class="location-point">
                            <div class="content">
                                <div class="text">@lang('site.our_offices4')</div>
                            </div>
                            <span class="point"></span>
                        </div>
                        <div class="location-point">
                            <div class="content">
                                <div class="text">@lang('site.our_offices5')</div>
                            </div>
                            <span class="point"></span>
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="left-content">
                {{-- Payment logos: show only after a card gateway is approved and live --}}
                @if(config('donation.card_payment_enabled'))
                <a href="javascript:void(0)"><div class="icon"><img width="150" src="{{asset('img/visa-master.png')}}" alt="Visa / Mastercard"></div></a>
                @endif
                <!--<div class="copyright-text">@lang('site.copyright') <a href="#">{{setting(app()->getLocale())['title']}}.</a> <br>@lang('site.by') <a href="https://brandx-sa.com/">@lang('site.brandx').</a></div>-->
            </div>
            <div class="right-content">
                <ul class="social-icon-three">
                    @if(setting('facebook'))
                        <li><a href="{{setting('facebook')}}" target="_blank"><span class="fa fa-facebook"></span></a></li>
                    @endif
                    @if(setting('twitter'))
                        <li><a href="{{setting('twitter')}}" target="_blank"><span class="fa fa-twitter"></span></a></li>
                    @endif
                    @if(setting('instagram'))
                        <li><a href="{{setting('instagram')}}"><span class="fa fa-instagram"></span></a></li>
                    @endif
                                        @if(setting('telegram'))
                        <li><a href="{{setting('telegram')}}" target="_blank"><span class="fa fa-telegram"></span></a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</footer>
