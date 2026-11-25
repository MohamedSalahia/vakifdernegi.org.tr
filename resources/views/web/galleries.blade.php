@extends('layouts.web.app')
@section('page_title')@lang('site.galleries')@endsection
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
                                <li class="breadcrumb-item active" aria-current="page">@lang('site.galleries')</li>
                            </ol>
                        </nav>

                        <!-- Title -->
                        <h4 class="h4-sm steelblue-color">@lang('site.galleries')</h4>

                    </div>
                </div>
            </div>  <!-- End row -->
        </div>	<!-- End container -->
    </div>
    <!-- END BREADCRUMB -->


    <div id="gallery-1" class="gallery-section division" style="padding-top: 100px; padding-bottom: 100px;">

        <!-- GALLERY IMAGES -->
        <div class="row gallery-items-list">

            @foreach($photos as $photo)
            <div class="col-md-6 col-lg-3 gallery-item">
                <div class="hover-overlay">

                    <!-- Gallery Image -->
                    <img class="img-fluid" src="{{url('/thumbnail/480/356/80/storage/photo_images/'.$photo->image)}}" alt="gallery-image">
                    <div class="item-overlay"></div>

                    <!-- Image Zoom -->
                    <div class="image-zoom">
                        <a class="image-link" href="{{url('/thumbnail/800/600/80/storage/photo_images/'.$photo->image)}}" title=""><i class="fas fa-search-plus"></i></a>
                    </div>

                </div>
            </div>
            @endforeach

        </div>  <!-- END GALLERY IMAGES -->


    </div>
@endsection
