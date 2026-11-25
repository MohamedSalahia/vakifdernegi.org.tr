<div class="mobile-menu">

    <!-- Menu Close Start -->
    <a class="menu-close" href="javascript:void(0)">
        <i class="icofont-close-line"></i>
    </a>
    <!-- Menu Close End -->

    <!-- Mobile Top Medal Start -->
    <div class="mobile-top">
        <p><i class="flaticon-phone-call"></i> <a href="tel:{{setting('phone')}}">{{setting('phone')}}</a></p>
        <p><i class="flaticon-email"></i> <a href="mailto:{{setting('email')}}">{{setting('email')}}</a></p>
    </div>
    <!-- Mobile Top Medal End -->

    <!-- Mobile Sing In & Up Start -->
    <div class="mobile-sign-in-up">
        <ul>
            <li><a class="sign-up" href="{{route('contact_us')}}">@lang('site.contact_us')</a></li>
        </ul>
    </div>
    <!-- Mobile Sing In & Up End -->

    <!-- Mobile Menu Start -->
    <div class="mobile-menu-items">
        <ul class="nav-menu">
            @foreach(\App\Models\PageCategory::all() as $cat_key=>$page_category)
                <li>
                    <a href="#">{{$page_category->name}}</a>
                    <ul class="sub-menu">
                        @foreach(\App\Models\Page::where('page_category_id', '=', $page_category->id)->get() as $page)
                            <li><a href="{{route('page.show',['page'=>$page->id,make_slug($page->name)])}}">{{$page->name}}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
            @foreach(\App\Models\Page::where('page_category_id', '=', null)->get() as $page)
                <li><a href="{{route('page.show',['page'=>$page->id,make_slug($page->name)])}}">{{$page->name}}</a></li>
            @endforeach
            <li class="{{ request()->is('*blogs*') ? 'active' : '' }}"><a href="{{route('blogs')}}">@lang('site.blogs')</a></li>
            <li>
                <a style="text-transform: uppercase" href="#">{{app()->getLocale()}}</a>
                <ul class="sub-menu">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        @if(app()->getLocale() != $localeCode)
                            <li><a style="text-transform: uppercase" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $localeCode }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </li>
        </ul>

    </div>
    <!-- Mobile Menu End -->

    <!-- Mobile Menu End -->
    <div class="mobile-social">
        <ul class="social">
            @if(setting('facebook'))
                <li><a href="{{setting('facebook')}}"><i class="flaticon-facebook"></i></a></li>
            @endif
            @if(setting('instagram'))
                <li><a href="{{setting('instagram')}}"><i class="flaticon-instagram"></i></a></li>
            @endif
            @if(setting('twitter'))
                <li><a href="{{setting('twitter')}}"><i class="flaticon-twitter"></i></a></li>
            @endif
            @if(setting('telegram'))
                <li><a href="{{setting('telegram')}}"><i class="flaticon-telegram"></i></a></li>
            @endif
        </ul>
    </div>
    <!-- Mobile Menu End -->

</div>