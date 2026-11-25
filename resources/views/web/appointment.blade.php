@extends('layouts.web.app')
@section('page_title')@lang('site.make_appointment')@endsection
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
                                <li class="breadcrumb-item active" aria-current="page">@lang('site.make_appointment')</li>
                            </ol>
                        </nav>

                        <!-- Title -->
                        <h4 class="h4-sm steelblue-color">@lang('site.make_appointment')</h4>

                    </div>
                </div>
            </div>  <!-- End row -->
        </div>	<!-- End container -->
    </div>	<!-- END BREADCRUMB -->



    <!-- APPOINTMENT PAGE
    ============================================= -->
    <div id="appointment-page appointment-sent" class="wide-60 appointment-page-section division">
        @if(session('appointment_success'))

            <div class="alert alert-success fade show" role="alert">
                <div class="alert-icon"></div>
                <div class="alert-text">@lang('site.success')</div>
            </div>
        @endif
        <div class="container">
            <div class="row">


                <!-- SERVICE DETAILS -->
                <div class="col-lg-8">
                    <div class="txt-block pr-30">

                        <!-- Title -->
                        <h3 class="h3-md steelblue-color">@lang('site.make_appointment')</h3>

                        <!-- Text -->
                        <p>@lang('site.make_appointment_des')
                        </p>

                        <!-- APPOINTMENT FORM -->
                        <div id="appointment-form-holder" class="text-center">
                            <form class="row appointment-form" action="{{ route('appointment.post') }}#appointment-sent" method="POST">
                                {{ csrf_field() }}
                                {{--<input type="hidden" value="{{auth()->user()->id}}" name="user_id">--}}

                                <!-- Form Select -->
                                <div id="input-department" class="col-md-12 input-department">
                                    <select  name="doctor_category_id" class="custom-select " required>
                                        <option>@lang('site.select_doctor_category')</option>
                                        @foreach($doctor_categories as $d_category)
                                            <option value="{{$d_category->id}}">{{$d_category->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('doctor_category_id'))
                                        <span style="color: red" class="error">{{ $errors->first('doctor_category_id') }}</span>
                                    @endif
                                </div>

                                <!-- Form Select -->
                                <div id="input-doctor" class="col-md-12 input-doctor">
                                    <select name="doctor_id" class="custom-select" required>
                                        <option>@lang('site.select_doctor')</option>
                                        @foreach($doctors as $doctor)
                                            <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                                        @endforeach

                                    </select>
                                    @if ($errors->has('doctor_id'))
                                        <span style="color: red" class="error">{{ $errors->first('doctor_id') }}</span>
                                    @endif
                                </div>

                                <!-- Contact Form Input -->
                                <div class="col-lg-12">
                                    <input id="datetimepicker" type="text" name="date" class="form-control " placeholder="@lang('site.appointment_date')" required>
                                    @if ($errors->has('date'))
                                        <span style="color: red" class="error">{{ $errors->first('date') }}</span>
                                    @endif
                                </div>

                                <!-- Contact Form Input -->
                                {{--<div class="col-lg-12">
                                    <input type="text" name="name" class="form-control " placeholder="@lang('site.name')" required>
                                    @if ($errors->has('name'))
                                        <span style="color: red" class="error">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>--}}

                                {{--<div class="col-lg-12">
                                    <input type="email" name="email" class="form-control " placeholder="@lang('site.email')" required>
                                    @if ($errors->has('email'))
                                        <span style="color: red" class="error">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>--}}

                                {{--<div class="col-lg-12">
                                    <input type="text" name="phone" class="form-control " placeholder="@lang('site.phone')" required>
                                    @if ($errors->has('phone'))
                                        <span style="color: red" class="error">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>--}}

                                <div class="col-lg-12 input-message">
                                    <textarea class="form-control message" name="message" rows="6" placeholder="@lang('site.message')" required></textarea>
                                    @if ($errors->has('message'))
                                        <span style="color: red" class="error">{{ $errors->first('message') }}</span>
                                    @endif
                                </div>

                                <!-- Contact Form Button -->
                                <div class="col-lg-12 ">
                                    <button type="submit" class="btn btn-blue blue-hover ">@lang('site.request_appointment')</button>
                                </div>



                            </form>

                        </div>	<!-- END APPOINTMENT FORM -->

                    </div>
                </div>	<!-- END SERVICE DETAILS -->


                <!-- SIDEBAR -->
                <aside id="sidebar" class="col-lg-4">

                    <!-- SIDEBAR TABLE -->
                    <div class="sidebar-table blue-table sidebar-div mb-50">

                        <!-- Title -->
                        <h5 class="h5-md">@lang('site.working_hours')</h5>

                        <!-- Text -->
                        <p class="p-sm">@lang('site.working_time_des')
                        </p>

                        <!-- Table -->
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>@lang('site.sat_fri')</td>
                                <td> - </td>
                                <td class="text-right">@lang('site.sat_fri_time')</td>
                            </tr>
                            <tr>
                                <td>@lang('site.fri')</td>
                                <td> - </td>
                                <td class="text-right">@lang('site.fri_time')</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>	<!-- END SIDEBAR TABLE -->


                </aside>   <!-- END SIDEBAR -->


            </div>	<!-- End row -->
        </div>	 <!-- End container -->
    </div>	<!-- END APPOINTMENT PAGE -->
@endsection
