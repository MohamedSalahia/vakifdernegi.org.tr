

<div class="col-lg-4">
    <div class="sidebar">
        <!-- Search Widget -->
        <div class="sidebar-title">
            <h4>@lang('site.search')</h4>
        </div>
        <div class="sidebar-widget search-box">
            <form method="get" action="{{route('blogs')}}">
                <div class="form-group">
                    <input type="search" name="search" value="{{request()->search}}" placeholder="@lang('site.search_placeholder')" required="">
                    <button type="submit"><span class="flaticon-magnifying-glass"></span></button>
                </div>
            </form>
        </div>
        <!-- Category Widget -->
        <div class="sidebar-widget category-widget-two">
            <div class="sidebar-title">
                <h4>@lang('site.all_categories')</h4>
            </div>
            <ul>
                @foreach($categories as $category)
                    @php
                        $cat_count=App\Models\Blog::where('category_id','=',$category->id)->count();
                    @endphp
                    <li>
                        <div class="wrapper-box">
                            <div class="image">
                                <img src="{{url('/thumbnail/80/80/80/storage/settings/'.setting('logo'))}}" alt="">
                                <span class="post-count">{{$cat_count}}</span>
                            </div>
                            <a href="{{route('category.show',['category'=>$category->id,make_slug($category->name)])}}">{{$category->name}} </a>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <!--Popular Posts-->
        <div class="sidebar-widget post-widget-three">
            <div class="sidebar-title">
                <h4>@lang('site.latest_blogs')</h4>
            </div>
            @foreach(\App\Models\Blog::query()->where('id', '!=', $blog->id)->orderBy('id', 'desc')->take(3)->get() as $blog)
                <!-- Post -->
                <article class="post">
                    <div class="thumb"><img src="{{url('/thumbnail/70/70/80/storage/blog_images/'.($blog->image ? $blog->image : 'default.png'))}}" alt=""><a class="overlay overlay-style-one" href="{{route('blog.show',['blog'=>$blog->id,make_slug($blog->name)])}}"></a></div>
                    <div class="content">
                        <div class="date">{{ $blog->created_at->format('d-m-Y') }}</div>
                        <h5><a href="{{route('blog.show',['blog'=>$blog->id,make_slug($blog->name)])}}">{{$blog->name}}</a></h5>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</div>
