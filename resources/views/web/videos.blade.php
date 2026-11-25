@extends('layouts.web.app')
@section('page_title')@lang('site.videos')@endsection
@section('content')

    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class=" breadcrumb-holder">

                        <!-- Breadcrumb Nav -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('/')}}">@lang('site.home')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@lang('site.videos')</li>
                            </ol>
                        </nav>

                        <!-- Title -->
                        <h4 class="h4-sm steelblue-color">@lang('site.videos')</h4>

                    </div>
                </div>
            </div>  <!-- End row -->
        </div>	<!-- End container -->
    </div>
    <!-- END BREADCRUMB -->


    <!-- VIDEO-1
        ============================================= -->
    <section id="video-1" class="wide-60 video-section division">
        <div class="container">
            <div class="row d-flex align-items-center">
                @foreach($videos as $video)
                    <div class="col-lg-6">


                    <div class="col-lg-10 offset-lg-1 section-title" style="margin-bottom: 30px;">
                        <h5 class="h3-md steelblue-color">{{$video->name}}</h5>
                    </div>

                    <div class="video-preview mb-40 text-center wow fadeInUp" data-wow-delay="0.6s">

                        <!-- Change the link HERE!!! -->
                        <a class="video-popup1" href="{{$video->url}}">
                            <script>
                                $('.video-popup1').magnificPopup({
                                    type: 'iframe',
                                    iframe: {
                                        patterns: {
                                            youtube: {
                                                index: 'youtube.com',
                                                src: '{{$video->url}}'
                                            }
                                        }
                                    }
                                });
                            </script>
                            <!-- Play Icon -->
                            <div class="video-btn play-icon-blue">
                                <div class="video-block-wrapper">
                                    <i class="fas fa-play"></i>
                                </div>
                            </div>

                            <!-- Preview -->
                            <img class="img-fluid my_border_radius" src="{{url('/thumbnail/540/405/80/storage/video_images/'.($video->image ? $video->image : 'default.png'))}}" alt="video-photo" />

                        </a>

                    </div>
                </div>
                @endforeach
            </div>	    <!-- End row -->


        </div>	    <!-- End container -->
    </section>	 <!-- END VIDEO-1 -->



@endsection
@section('script')

@endsection