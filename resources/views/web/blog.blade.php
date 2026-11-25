@extends('layouts.web.app')
@section('page_title'){{$blog->name}}@endsection
@section('post_head')
<meta property="og:type" content="article"/>
    <meta property="og:title" content="{{($blog->meta_title ? $blog->meta_title: $blog->name)}}"/>
    <meta property="og:description" content="{{($blog->meta_description ? $blog->meta_description: setting(app()->getLocale())['description'] )}}"/>
    <meta property="og:url" content="{{route('blog.show',['blog'=>$blog->id,make_slug($blog->name)])}}"/>
    <meta property="og:image" content="{{($blog->image ? url('/thumbnail/500/500/80/storage/blog_images/'.$blog->image) : url('/thumbnail/500/500/80/storage/settings/'.setting('logo')) )}}"/>
    <meta property="og:image:width" content="500"/>
    <meta property="og:image:height" content="500"/>
    <meta property="article:author" content="@lang('site.author')"/>
    <meta property="fb:app_id" content="111027297706500"/>
    @php
    $keywords = ($blog->keywords ? $blog->keywords: setting(app()->getLocale())['site_keywords']);
    $tags = explode(',', $keywords);
    @endphp
    @foreach($tags as $tag)<meta property="article:tag" content="{{$tag}}"/>
    @endforeach
<meta property="article:published_time" content="{{\Carbon\Carbon::parse($blog->created_at)->format('Y-m-d H:i:s')}}"/>
    <meta property="article:modified_time" content="{{\Carbon\Carbon::parse($blog->updated_at)->format('Y-m-d H:i:s')}}"/>

@endsection
@section('content')
    <!-- Page Title -->
    <section class="page-title" style="background-image:url({{url('/thumbnail/1920/900/80/storage/settings/'.setting('banner'))}})">
        <div class="auto-container">
            <div class="content-box">
                <h1>{{$blog->name}}</h1>
                <ul class="bread-crumb">
                    <li><a class="home" href="{{route('/')}}"><span class="fa fa-home"></span></a></li>
                    <li><a href="{{route('blogs')}}">@lang('site.blogs')</a></li>
                    <li>{{$blog->name}}</li>
                </ul>
            </div>
        </div>
    </section>

    <div class="sidebar-page-container">
        <div class="auto-container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="post-wrapper">
                        <!-- Single Blog Post -->
                        <div class="single-blog-post">
                            <div class="inner-box">
                                <div class="top-content">
                                    <h2>{{$blog->name}}</h2>
                                    <div class="post-info">
                                        <div class="author">
                                            <div class="author-thumb"><img src="{{url('/thumbnail/50/50/80/storage/settings/'.setting('logo'))}}" alt=""></div>
                                            <div class="author-title"><a href="javascript:;">@lang('site.author')</a></div>
                                        </div>
                                        <div class="date"><span class="flaticon-clock"></span> {{ $blog->created_at->format('d-m-Y') }}</div>
                                        <div class="category"><span class="flaticon-folder"></span>{{$blog->category->name}}</div>
                                        {{--<div class="views"><span class="flaticon-eye"></span>21 Views</div>--}}
                                    </div>
                                    <div class="image"><img src="{{url('/thumbnail/740/415/80/storage/blog_images/'.($blog->image ? $blog->image : 'default.png'))}}" alt=""></div>
                                    {!! $blog->description !!}

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.web.sidebar')

            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebPage",
            "name": "@if(setting(app()->getLocale())['title']){{setting(app()->getLocale())['title']}}@else@lang('site.title')@endif - {{$blog->name}}",
            "image": "{{url('/thumbnail/200/200/80/storage/settings/'.setting('logo'))}}",
            "url": "{{route('blog.show',['blog'=>$blog->id,make_slug($blog->name)])}}",
            "publisher": {
                "@type": "Organization",
                "name": "{{setting(app()->getLocale())['title']}}",
                "logo": {
                    "@type": "ImageObject",
                    "url": "{{url('/thumbnail/200/200/80/storage/settings/'.setting('logo'))}}"
                }
            }
        }
    </script>
@endsection
