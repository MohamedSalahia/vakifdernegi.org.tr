@extends('layouts.web.app')
@section('page_title'){{$category->name}}@endsection
@section('content')
    <!-- BREADCRUMB
			============================================= -->
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class=" breadcrumb-holder">

                        <!-- Breadcrumb Nav -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('/')}}">@lang('site.home')</a></li>
                                <li class="breadcrumb-item"><a href="{{route('blogs')}}">@lang('site.blogs')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$category->name}}</li>
                            </ol>
                        </nav>

                        <!-- Title -->
                        <h4 class="h4-sm steelblue-color">{{$category->name}}</h4>

                    </div>
                </div>
            </div>  <!-- End row -->
        </div>	<!-- End container -->
    </div>	<!-- END BREADCRUMB -->




    <!-- BLOG PAGE CONTENT
    ============================================= -->
    <div id="blog-page" class="wide-100 blog-page-section division">
        <div class="container">
            <div class="row">


                <!-- BLOG POSTS HOLDER -->
                <div class="col-lg-8">
                    <div class="posts-holder pr-30">
                        @if ($blogs->count() > 0)
                            @foreach($blogs as $blog)
                                <!-- BLOG POST #1 -->
                                    <div class="blog-post">

                                        <!-- BLOG POST IMAGE -->
                                        <div class="blog-post-img">
                                            <img class="img-fluid " src="{{($blog->image ? url('/thumbnail/950/450/80/storage/blog_images/'.$blog->image) : url('/thumbnail/356/267/80/storage/settings/'.setting('logo')) )}}" alt="blog-post-image" />
                                        </div>

                                        <!-- BLOG POST TITLE -->
                                        <div class="blog-post-txt">

                                            <!-- Post Title -->
                                            <h5 class="h5-xl steelblue-color"><a href="{{route('blog.show',['blog'=>$blog->id,make_slug($blog->name)])}}">{{$blog->name}}</a></h5>

                                            <!-- Post Data -->
                                            <span>May 03, 2019 by <span>Dr.Jeremy Smith</span></span>

                                            <!-- Post Text -->
                                            <p>{!! \Illuminate\Support\Str::words(strip_tags($blog->description),15) !!}
                                            </p>

                                        </div>

                                    </div>
                                    <!-- END BLOG POST #1 -->
                                @endforeach
                        @else

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><h2>@lang('site.no_data_found')</h2></strong>

                        </div>
                        <div class="header-sign-in-up d-none d-lg-block">
                            <ul>


                                <a href="{{route('/')}}" class="btn btn-blue blue-hover mt-10">العودة للصفحة الرئيسية</a>
                            </ul>
                        </div>
                        @endif


                        <!-- BLOG PAGE PAGINATION -->
                        <div class="blog-page-pagination b-top">
                            <nav aria-label="Page navigation">
                                {{ $blogs->links('vendor.pagination.paginate') }}
                            </nav>
                        </div>



                    </div>
                </div>	 <!-- END BLOG POSTS HOLDER -->



                <!-- SIDEBAR -->
                @include('layouts.web.sidebar')
                <!-- END SIDEBAR -->

            </div>	<!-- End row -->
        </div>	 <!-- End container -->
    </div>	<!-- END BLOG PAGE CONTENT -->

@endsection
