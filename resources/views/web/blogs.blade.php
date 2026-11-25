@extends('layouts.web.app')
@section('page_title')@lang('site.blogs')@endsection
@section('content')
    <!-- Page Title -->
    <section class="page-title" style="background-image:url({{url('/thumbnail/1920/900/80/storage/settings/'.setting('banner'))}})">
        <div class="auto-container">
            <div class="content-box">
                <h1>@lang('site.blogs')</h1>
                <ul class="bread-crumb">
                    <li><a class="home" href="{{route('/')}}"><span class="fa fa-home"></span></a></li>
                    <li>@lang('site.blogs')</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="blog-section">
        <div class="auto-container">
            <div class="row">
                @if ($blogs->count() > 0)
                    @foreach($blogs as $blog)
                        <!-- News Block Two -->
                        <div class="col-lg-4 col-md-6 news-block-two style-three">
                            <div class="inner-box wow fadeInUp" data-wow-delay="200ms">
                                <div class="image">
                                    {{--<div class="category"><a href="{{route('category.show',['category'=>$blog->category->id,make_slug($blog->category->name)])}}">{{$blog->category->name}}</a></div>--}}
                                    <a href="{{route('blog.show',['blog'=>$blog->id,make_slug($blog->name)])}}"><img src="{{($blog->image ? url('/thumbnail/950/450/80/storage/blog_images/'.$blog->image) : url('/thumbnail/356/267/80/storage/settings/'.setting('logo')) )}}" alt=""></a>
                                    {{--<div class="post-meta-info">
                                        <a href="#"><span class="flaticon-eye"></span>21</a>
                                        <a href="#"><span class="flaticon-comment"></span>08</a>
                                    </div>--}}
                                </div>
                                <div class="lower-content">
                                    <div class="date"><span class="flaticon-clock"></span>{{ $blog->created_at->format('d-m-Y') }}</div>
                                    <h4><a href="{{route('blog.show',['blog'=>$blog->id,make_slug($blog->name)])}}">{{$blog->name}}</a></h4>
                                    <div class="author-info">
                                        <div class="image"><img src="{{url('/thumbnail/50/50/80/storage/settings/'.setting('logo'))}}" alt=""></div>
                                        <div class="author-title"><a href="javascript:;">@lang('site.author')</a></div>
                                        {{--<div class="share-icon style-two post-share-icon">
                                            <div class="share-btn"><img src="{{asset('web/images/resource/dotted.png')}}" alt=""></div>
                                            <ul>
                                                <li><a href="javascript"><span class="fa fa-facebook"></span></a></li>
                                                <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                                                <li><a href="#"><span class="fa fa-instagram"></span></a></li>
                                            </ul>
                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-dismissible fade show" role="alert">
                        <strong><h3>@lang('site.no_data_found')</h3></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="header-sign-in-up">
                        <a href="{{route('/')}}" class="theme-btn btn-style-one"><span>@lang('site.return_to_home_page')</span></a>
                    </div>
                @endif
            </div>
            <div class="posts-pagination mb-30 mt-20">
                {{ $blogs->links('vendor.pagination.paginate') }}

            </div>
        </div>
    </section>
@endsection
