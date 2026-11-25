@extends('layouts.web.app')
@section('page_title')@lang('site.partnerships')@endsection
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
                                <li class="breadcrumb-item active" aria-current="page">@lang('site.partnerships')</li>
                            </ol>
                        </nav>

                        <!-- Title -->
                        <h4 class="h4-sm steelblue-color">@lang('site.partnerships')</h4>

                    </div>
                </div>
            </div>  <!-- End row -->
        </div>	<!-- End container -->
    </div>	<!-- END BREADCRUMB -->

    <section id="services-2" class="bg-lightgrey wide-70 services-section division">
        <div class="container">


            <!-- SECTION TITLE -->
            <div class="row">
                <div class="col-lg-10 offset-lg-1 section-title">

                    <!-- Title 	-->
                    <h3 class="h3-md steelblue-color">هذا النص هو مثال</h3>

                    <!-- Text -->
                    <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى
                    </p>

                </div>
            </div>


            <div class="row">






                <!-- SERVICE BOX #7 -->
                <div class="col-sm-6 col-lg-6">
                    <div class="sbox-2 wow fadeInUp" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: fadeInUp;">
                        <a href="https://www.hmc.health/ar/">

                            <!-- Icon  -->
                            <div class="sbox-2-icon icon-xl">
                                {{--<span class="flaticon-076-microscope"></span>--}}
                                <img width="80" src="{{asset('img/logo-2a.jpg')}}" alt="">
                            </div>

                            <!-- Title -->
                            <h5 class="h5-sm sbox-2-title steelblue-color"> مجموعة الحمائد الطّبية</h5>

                        </a>
                    </div>
                </div>


                <!-- SERVICE BOX #8 -->
                <div class="col-sm-6 col-lg-6">
                    <div class="sbox-2 wow fadeInUp" data-wow-delay="1s" style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;">
                        <a href="https://www.lemon.sa/index.php?route=common/home">

                            <!-- Icon  -->
                            <div class="sbox-2-icon icon-xl">
                                {{--<span class="flaticon-076-microscope"></span>--}}
                                <img width="80" src="{{asset('img/lemon.png')}}" alt="">
                            </div>

                            <!-- Title -->
                            <h5 class="h5-sm sbox-2-title steelblue-color"> صيدليات ليمون </h5>

                        </a>
                    </div>
                </div>


            </div>	   <!-- End row -->


        </div>	   <!-- End container -->
    </section>

@endsection
