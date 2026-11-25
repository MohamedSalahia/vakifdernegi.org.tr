@extends('layouts.web.app')
@section('page_title'){{$category->name}}@endsection
@section('content')

    <!-- BREADCRUMB ============================================= -->
    <div id="breadcrumb" class="division">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class=" breadcrumb-holder">

                        <!-- Breadcrumb Nav -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('/')}}">@lang('site.home')</a></li>
                                <li class="breadcrumb-item"><a href="javascript:;">@lang('site.services')</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$category->name}}</li>
                            </ol>
                        </nav>

                        <!-- Title -->
                        <h4 class="h4-sm steelblue-color">{{$category->name}}</h4>

                    </div>
                </div>
            </div>  <!-- End row -->
        </div>	<!-- End container -->
    </div>
    <!-- END BREADCRUMB -->

    <!-- SERVICE DETAILS
			============================================= -->
    <div id="service-page" class="bg-lightgrey wide-60 service-page-section division">
        <div class="container">


            <!-- TEXT -->
            <div class="row">
                <div class="col-xl-10 offset-xl-1">
                    <div class="s1-page content-block text-center">

                        {!! $category->description !!}

                    </div>
                </div>
            </div>  <!-- End row -->

        </div>	<!-- End container -->
    </div>	<!-- END SERVICE DETAILS -->

    <!-- SERVICES-5
			============================================= -->
    {{--<section id="services-5" class="wide-100 services-section division">
        <div class="container-fluid">
            <!-- SECTION TITLE -->
            <div class="row">
                <div class="col-lg-10 offset-lg-1 section-title">
                    <!-- Title 	-->
                    <h3 class="h3-md steelblue-color">معرض الصور</h3>
                </div>
            </div>

            <!-- SERVICES CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <div class="owl-carousel owl-theme services-holder">
                        <div class="sbox-5 my_style">
                            <div class="gallery-item">
                            <div class="hover-overlay">

                                <!-- Gallery Image -->
                                <img class="img-fluid" src="{{asset('web/images/gallery/image-1.jpg')}}" alt="gallery-image">
                                <div class="item-overlay"></div>

                                <!-- Image Zoom -->
                                <div class="image-zoom">
                                    <a class="image-link" href="{{asset('web/images/gallery/image-1.jpg')}}" title=""><i class="fas fa-search-plus"></i></a>
                                </div>

                            </div>
                        </div>
                        </div>
                        <div class="sbox-5 my_style">
                            <div class="gallery-item">
                                <div class="hover-overlay">

                                    <!-- Gallery Image -->
                                    <img class="img-fluid" src="{{asset('web/images/gallery/image-2.jpg')}}" alt="gallery-image">
                                    <div class="item-overlay"></div>

                                    <!-- Image Zoom -->
                                    <div class="image-zoom">
                                        <a class="image-link" href="{{asset('web/images/gallery/image-2.jpg')}}" title=""><i class="fas fa-search-plus"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="sbox-5 my_style">
                            <div class="gallery-item">
                                <div class="hover-overlay">

                                    <!-- Gallery Image -->
                                    <img class="img-fluid" src="{{asset('web/images/gallery/image-3.jpg')}}" alt="gallery-image">
                                    <div class="item-overlay"></div>

                                    <!-- Image Zoom -->
                                    <div class="image-zoom">
                                        <a class="image-link" href="{{asset('web/images/gallery/image-3.jpg')}}" title=""><i class="fas fa-search-plus"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="sbox-5 my_style">
                            <div class="gallery-item">
                                <div class="hover-overlay">

                                    <!-- Gallery Image -->
                                    <img class="img-fluid" src="{{asset('web/images/gallery/image-4.jpg')}}" alt="gallery-image">
                                    <div class="item-overlay"></div>

                                    <!-- Image Zoom -->
                                    <div class="image-zoom">
                                        <a class="image-link" href="{{asset('web/images/gallery/image-4.jpg')}}" title=""><i class="fas fa-search-plus"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="sbox-5 my_style">
                            <div class="gallery-item">
                                <div class="hover-overlay">

                                    <!-- Gallery Image -->
                                    <img class="img-fluid" src="{{asset('web/images/gallery/image-5.jpg')}}" alt="gallery-image">
                                    <div class="item-overlay"></div>

                                    <!-- Image Zoom -->
                                    <div class="image-zoom">
                                        <a class="image-link" href="{{asset('web/images/gallery/image-5.jpg')}}" title=""><i class="fas fa-search-plus"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	<!-- END SERVICES CONTENT -->


        </div>	   <!-- End container -->
    </section>--}}	 <!-- END SERVICES-5 -->

    <section id="services-7" class="bg-lightgrey wide-70 servicess-section division">
        <div class="container">
            <div class="row">
                <!-- SERVICE BOXES -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 section-title">
                            <h3 class="h3-md steelblue-color">@lang('site.services_by')</h3>
                        </div>
                        @foreach($doctor_services as $d_service)
                            <div class="col-md-6">
                            <div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                <!-- Icon -->
                                {{--<span class="flaticon-137-doctor blue-color"></span>--}}
                                <span><img src="{{url('/thumbnail/52/52/80/storage/doctor_service_images/'.$d_service->image)}}" alt=""></span>

                                <!-- Text -->
                                <div class="sbox-7-txt">

                                    <!-- Title -->
                                    <h5 class="h5-sm steelblue-color">{{$d_service->name}}</h5>

                                    <!-- Text -->
                                   {{-- <p class="p-sm">{!! \Illuminate\Support\Str::words(strip_tags($d_service->description),15) !!}
                                    </p><br>--}}<br>
                                    <a href="{{route('doctor_services.show',['service'=>$d_service->id,'slug'=>make_slug($d_service->name)])}}" class="btn btn-blue blue-hover">@lang('site.view_this_service')</a>


                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>	<!-- END SERVICE BOXES -->
            </div>    <!-- End row -->
        </div>	   <!-- End container -->
    </section>









@endsection
