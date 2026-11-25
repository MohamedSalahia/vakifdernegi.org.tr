@php($assoc = config('association'))
<footer class="main-footer">
    <div class="auto-container">
        <div class="widget-wrapper">
            <div class="row">
                <!-- Contact -->
                <div class="col-lg-3 col-md-6 contact-widget footer-widget">
                    <h4 class="widget-title">@lang('site.footer_column1_title')</h4>
                    <ul>
                        <li>{{ $assoc['address'][app()->getLocale()] ?? $assoc['address']['tr'] }}</li>
                        <li><a href="mailto:{{ $assoc['email'] }}">{{ $assoc['email'] }}</a></li>
                    </ul>
                    <h3><a href="tel:{{ preg_replace('/\s+/', '', $assoc['phone']) }}" dir="ltr">{{ $assoc['phone'] }}</a></h3>
                </div>

                <!-- Institutional links -->
                <div class="col-lg-3 col-md-6 about-widget footer-widget">
                    <h4 class="widget-title">@lang('site.footer_column2_title')</h4>
                    <ul>
                        <li><a href="{{ route('/') }}">@lang('site.home')</a></li>
                        <li><a href="{{ route('about_us') }}">@lang('site.about_us')</a></li>
                        <li><a href="{{ route('campaigns') }}">@lang('site.campaigns')</a></li>
                        <li><a href="{{ route('bank_accounts') }}">@lang('site.bank_accounts')</a></li>
                        <li><a href="{{ route('contact_us') }}">@lang('site.contact_us')</a></li>
                    </ul>
                </div>

                <!-- Legal links -->
                <div class="col-lg-3 col-md-6 link-widget footer-widget">
                    <h4 class="widget-title">@lang('site.footer_legal_title')</h4>
                    <ul>
                        <li><a href="{{ route('privacy') }}">@lang('site.privacy')</a></li>
                        <li><a href="{{ route('terms-of-use') }}">@lang('site.term')</a></li>
                        <li><a href="{{ route('donation-policy') }}">@lang('site.donation_policy')</a></li>
                        <li><a href="{{ route('delivery-and-refund-policy') }}">@lang('site.delivery-and-refund-policy')</a></li>
                    </ul>
                </div>

                <!-- Official association details -->
                <div class="col-lg-3 col-md-6 link-widget footer-widget">
                    <h4 class="widget-title">@lang('site.footer_association_title')</h4>
                    <ul>
                        <li><strong>{{ $assoc['legal_name'] }}</strong></li>
                        <li>@lang('site.kutuk_no'): <span dir="ltr">{{ $assoc['kutuk_no'] }}</span></li>
                        <li>
                            @lang('site.vergi_no'): <span dir="ltr">{{ $assoc['vergi_no'] }}</span>
                            @if($assoc['vergi_dairesi']) ({{ $assoc['vergi_dairesi'] }}) @endif
                        </li>
                        <li>@lang('site.mersis_no'): <span dir="ltr">{{ $assoc['mersis_no'] }}</span></li>
                        <li><a href="{{ $assoc['derbis_verify_url'] }}" target="_blank" rel="noopener">@lang('site.verify_on_derbis')</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="left-content">
                {{-- Payment logos: show only after a card gateway is approved and live --}}
                @if(config('donation.card_payment_enabled'))
                <a href="javascript:void(0)"><div class="icon"><img width="150" src="{{asset('img/visa-master.png')}}" alt="Visa / Mastercard"></div></a>
                @endif
                <div class="copyright-text">© {{ date('Y') }} {{ $assoc['legal_name'] }}. @lang('site.all_rights_reserved')</div>
            </div>
            <div class="right-content">
                <ul class="social-icon-three">
                    @foreach(['facebook' => 'fa-facebook', 'twitter' => 'fa-twitter', 'instagram' => 'fa-instagram', 'youtube' => 'fa-youtube', 'telegram' => 'fa-telegram'] as $network => $icon)
                        @php($link = setting($network))
                        @if($link && $link !== '#')
                            <li><a href="{{ $link }}" target="_blank" rel="noopener"><span class="fa {{ $icon }}"></span></a></li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</footer>
