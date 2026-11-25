<header class="main-header">
    <!-- Top bar -->
    <div class="top-bar theme-bg">
        <div class="auto-container">
            <div class="wrapper-box">
                {{--<div class="left-content">
                    <div class="text"><a href="#" class="donate-box-btn">@lang('site.donate_now').</a></div>
                </div>--}}
                <div class="right-content">
                    <ul class="contact-info">
                        <li><span class="flaticon-mail"></span> <a href="mailto:{{setting('email')}}">{{setting('email')}}</a></li>
                        <li><span class="flaticon-phone"></span> <a href="tel:{{ preg_replace('/\s+/', '', config('association.phone')) }}" dir="ltr">{{ config('association.phone') }}</a></li>
                    </ul>
                    <div class="language-switcher">
                        <div class="languages">
                            <span class="current" title="{{app()->getLocale()}}">{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
                            <span class="hover">{{app()->getLocale()}}</span>
                            <ul>
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    @if(app()->getLocale() != $localeCode)
                                        <li><a hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Header Upper -->
    <div class="header-upper ">
        <div class="auto-container">
            <div class="wrapper-box">
                <div class="logo-column">
                    <div class="logo-box">
                        <div class="logo"><a href="{{route('/')}}"><img src="{{url('/thumbnail/150/60/80/storage/settings/'.setting('logo'))}}" alt="" title=""></a></div>
                    </div>
                </div>
                <div class="right-column">
                    <div class="option-wrapper">
                        <div class="nav-outer">
                            <!-- Main Menu -->
                            <nav class="main-menu navbar-expand-xl navbar-dark">

                                <div class="collapse navbar-collapse">
                                    <ul class="navigation">
                                        <li class="current"><a href="{{route('/')}}">@lang('site.home')</a>
                                        </li>
                                        {{--@foreach($campaignCategories as $campaignCategory)
                                            <li><a href="{{route('campaign.category.show',['id'=>$campaignCategory->id,make_slug($campaignCategory->name)])}}">{{$campaignCategory->name}}</a></li>
                                        @endforeach--}}

                                        <li class="dropdown"><a href="{{route('campaigns')}}">@lang('site.projects')</a>
                                            <ul>
                                                @foreach($campaignCategories as $campaignCategory)
                                                    <li><a href="{{route('campaign.category.show',['id'=>$campaignCategory->id,make_slug($campaignCategory->name)])}}">{{$campaignCategory->name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><a href="{{route('completed-campaigns')}}">@lang('site.projects_finished')</a></li>

                                        <li><a href="{{route('zakat')}}">@lang('site.zakat')</a></li>
                                        <li><a href="{{route('blogs')}}">@lang('site.blogs')</a></li>
                                        <li><a href="{{route('contact_us')}}">@lang('site.contact_us')</a></li>
                                        <li class="dropdown"><a href="javascript:;">@lang('site.about_us')</a>
                                            <ul>
                                                <li><a href="{{route('about_us')}}">@lang('site.about_us')</a></li>
                                                <li><a href="{{route('bank_accounts')}}">@lang('site.bank_accounts')</a></li>
                                                <li><a href="{{route('privacy')}}">@lang('site.privacy')</a></li>
                                                <li><a href="{{route('terms-of-use')}}">@lang('site.term')</a></li>
                                                <li><a href="{{route('donation-policy')}}">@lang('site.donation_policy')</a></li>
                                                <li><a href="{{route('delivery-and-refund-policy')}}">@lang('site.delivery-and-refund-policy')</a></li>
                                            </ul>
                                        </li>
                                        {{--<li><a href="{{route('blogs')}}">@lang('site.blogs')</a></li>
                                        <li><a href="{{route('kudus')}}">@lang('site.kudus')</a></li>
                                        <li><a href="{{route('campaigns')}}">@lang('site.campaigns')</a></li>
                                        <li><a href="{{route('contact_us')}}">@lang('site.contact_us')</a></li>--}}

                                    </ul>
                                </div>
                            </nav><!-- Main Menu End-->
                        </div>
                        <!--Search Box-->
                        <div class="search-box-outer">
                            <div class="dropdown">
                                <button class="search-box-btn dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-search"></span></button>
                                <ul class="dropdown-menu pull-right search-panel" aria-labelledby="dropdownMenu3">
                                    <li class="panel-outer">
                                        <div class="form-container">
                                            <form method="get" action="{{route('campaigns')}}">
                                                <div class="form-group">
                                                    <input type="text" name="search" value="{{request()->search}}" placeholder="@lang('site.search_placeholder')" required="">
                                                    <button type="submit" class="search-btn"><span class="fa fa-search"></span></button>
                                                </div>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="cart-btn">
                            <a href="{{route('cart')}}">
                                @php
                                //dd(session('count'));
                                @endphp
                                <div class="cart-icon"><span class="flaticon-bag"></span>{{--<span class="item-count">{{session('count') ?? 0}}</span>--}}</div>
                            </a>
                        </div>
                        @if(!Auth::check())
                            <div class="link-btn">
                                <a href="{{route('register')}}" class="theme-btn btn-style-one"><span>@lang('site.register')</span></a>
                            </div>
                        @elseif(Auth::user()->hasMultipleRoles(['super_admin', 'admin']))
                            <div class="link-btn">
                                <a href="{{route('admin.home')}}" class="theme-btn btn-style-one"><span>@lang('site.dashboard')</span></a>
                            </div>
                        @else
                            <div class="link-btn">
                                <a href="{{route('user.profile',['user'=>Auth::user()->id])}}" class="theme-btn btn-style-one"><span>@lang('site.profile')</span></a>
                            </div>
                            <div class="link-btn">
                                <a href="{{route('logout')}}" class="theme-btn btn-style-one"><span>@lang('site.logout')</span></a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End Header Upper-->

    <!--End Header Upper-->
    <div class="sticky-header ">
        <div class="auto-container">
            <div class="wrapper-box">
                <div class="logo-column">
                    <div class="logo-box">
                        <div class="logo"><a href="{{route('/')}}"><img src="{{url('/thumbnail/100/100/80/storage/settings/'.setting('logo'))}}" alt="" title=""></a></div>
                    </div>
                </div>
                <div class="menu-column">
                    <div class="nav-outer">
                        <div class="nav-inner">
                            <!-- Main Menu -->
                            <nav class="main-menu navbar-expand-xl navbar-dark">
                                <div class="collapse navbar-collapse">
                                    <ul class="navigation">
                                    </ul>
                                </div>
                            </nav><!-- Main Menu End-->
                            <!--Search Box-->
                        </div>
                    </div>
                </div>
                <div class="search-box-outer">
                    <div class="dropdown">
                        <button class="search-box-btn dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-search"></span></button>
                        <ul class="dropdown-menu pull-right search-panel" aria-labelledby="dropdownMenu3">
                            <li class="panel-outer">
                                <div class="form-container">
                                    <form method="get" action="{{route('campaigns')}}">
                                        <div class="form-group">
                                            <input type="text" name="search" value="{{request()->search}}" placeholder="@lang('site.search_placeholder')" required="">
                                            <button type="submit" class="search-btn"><span class="fa fa-search"></span></button>
                                        </div>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="cart-btn">
                    <a href="{{route('cart')}}">
                        <div class="cart-icon"><span class="flaticon-bag"></span>{{--<span class="item-count">{{session('count') ?? 0}}</span>--}}</div>
                    </a>
                </div>
                @if(!Auth::check())
                    <div class="link-btn">
                        <a href="{{route('register')}}" class="theme-btn btn-style-one header_sticky_buttons"><span>@lang('site.register')</span></a>
                    </div>
                @elseif(Auth::user()->hasMultipleRoles(['super_admin', 'admin']))
                    <div class="link-btn">
                        <a href="{{route('admin.home')}}" class="theme-btn btn-style-one header_sticky_buttons"><span>@lang('site.dashboard')</span></a>
                    </div>

                @else
                    <div class="link-btn">
                        <a href="{{route('user.profile',['user'=>Auth::user()->id])}}" class="theme-btn btn-style-one header_sticky_buttons"><span>@lang('site.profile')</span></a>
                    </div>
                    <div class="link-btn">
                        <a href="{{route('logout')}}" class="theme-btn btn-style-one header_sticky_buttons"><span>@lang('site.logout')</span></a>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <!-- Mobile Menu  -->
    <div class="mobile-menu style-one">
        <div class="menu-box">

            <div class="logo"><a href="{{route('/')}}"><img src="{{url('/thumbnail/100/100/80/storage/settings/'.setting('logo'))}}" alt="" title=""></a></div>
            <!-- Main Menu -->
            <nav class="main-menu navbar-expand-xl navbar-dark">
                <div class="navbar-header">
                    <!-- Toggle Button -->
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="flaticon-menu"></span>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navigation">

                    </ul>
                </div>
            </nav>
            <!-- Main Menu End-->
            <!--Search Box-->
            <div class="search-box-outer">
                <div class="dropdown">
                    <button class="search-box-btn dropdown-toggle" type="button" id="dropdownMenu4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fa fa-search"></span></button>
                    <ul class="dropdown-menu pull-right search-panel" aria-labelledby="dropdownMenu4">
                        <li class="panel-outer">
                            <div class="form-container">
                                <form method="get" action="{{route('campaigns')}}">
                                    <div class="form-group">
                                        <input type="text" name="search" value="{{request()->search}}" placeholder="@lang('site.search_placeholder')" required="">
                                        <button type="submit" class="search-btn"><span class="fa fa-search"></span></button>
                                    </div>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- End Mobile Menu -->

    <div class="nav-overlay">
        <div class="cursor"></div>
        <div class="cursor-follower"></div>
    </div>
</header>
