@extends('layouts.web.app')
@section('page_title')@lang('site.services')@endsection
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
                                <li class="breadcrumb-item active" aria-current="page">@lang('site.services')</li>
                            </ol>
                        </nav>

                        <!-- Title -->
                        <h4 class="h4-sm steelblue-color">@lang('site.services')</h4>

                    </div>
                </div>
            </div>  <!-- End row -->
        </div>	<!-- End container -->
    </div>
    <!-- END BREADCRUMB -->

    <!-- DOCTORS-3
     ============================================= -->
    <section id="services-7" class="bg-lightgrey wide-70 servicess-section division">
        <div class="container">
            <div class="row">


                <!-- SERVICE BOXES -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 section-title">
                            <h3 class="h3-md steelblue-color">الخدمات المقدمة في مجمع سوان الطبي التخصصي</h3>
                        </div>

                        @foreach($doctor_categories as $d_category)
                            <div class="col-md-6">
                                <div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                    <!-- Icon -->
                                    {{--<span class="flaticon-137-doctor blue-color"></span>--}}

                                    <span><img src="{{url('/thumbnail/52/52/80/storage/doctor_category_images/'.$d_category->image)}}" alt=""></span>

                                    <!-- Text -->
                                    <div class="sbox-7-txt">

                                        <!-- Title -->
                                        <h5 class="h5-sm steelblue-color">{{$d_category->name}}</h5>

                                        <!-- Text -->
                                        <p class="p-sm">{!! \Illuminate\Support\Str::words(strip_tags($d_category->description),15) !!}
                                        </p><br>
                                        <a href="{{route('service.show',['category'=>$d_category->id,'slug'=>make_slug($d_category->name)])}}" class="btn btn-blue blue-hover">@lang('site.view_sevice')</a>


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
