@extends('layouts.web.app')
@section('page_title')@lang('site.about_us')@endsection
@section('content')
    <!-- GOOGLE MAP
			============================================= -->
    {{--<div class="gmap">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d115932.13032686949!2d46.685634!3d24.765335!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2efd478b766225%3A0x5f01e7cd81e0a201!2sAlmasiaf%2C%20Riyadh%20Saudi%20Arabia!5e0!3m2!1sen!2sus!4v1661599865142!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>--}}

    <div class="map-frame">
        <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d115932.13032686949!2d46.685634!3d24.765335!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e2efd478b766225%3A0x5f01e7cd81e0a201!2sAlmasiaf%2C%20Riyadh%20Saudi%20Arabia!5e0!3m2!1sen!2sus!4v1661599865142!5m2!1sen!2sus"></iframe>
    </div>


    <!-- CONTACTS-1
    ============================================= -->
    <section id="contacts-1 contact-sent" class="wide-60 contacts-section division">
        <div class="container">


            <!-- SECTION TITLE -->
            <div class="row">
                <div class="col-lg-10 offset-lg-1 section-title">

                    <!-- Title 	-->
                    <h3 class="h3-md steelblue-color">@lang('site.have_question')</h3>

                    <!-- Text -->
                    <p>@lang('site.have_question_des')
                    </p>

                </div>
            </div>


            <div class="row">


                <!-- CONTACTS INFO -->
                <div class="col-md-5 col-lg-4" >

                    @php($assoc = config('association'))
                    <div class="contact-box mb-40">
                        <h5 class="h5-sm steelblue-color">{{ $assoc['legal_name'] }}</h5>
                        <p>{{ $assoc['address'][app()->getLocale()] ?? $assoc['address']['tr'] }}</p>
                        <p>@lang('site.phone'): <a href="tel:{{ preg_replace('/\s+/', '', $assoc['phone']) }}" class="blue-color" dir="ltr">{{ $assoc['phone'] }}</a></p>
                        <p>@lang('site.email'): <a href="mailto:{{ $assoc['email'] }}" class="blue-color">{{ $assoc['email'] }}</a></p>
                    </div>

                    <div class="contact-box mb-40">
                        <h5 class="h5-sm steelblue-color">@lang('site.footer_association_title')</h5>
                        <p>@lang('site.kutuk_no'): <span dir="ltr">{{ $assoc['kutuk_no'] }}</span></p>
                        <p>@lang('site.vergi_no'): <span dir="ltr">{{ $assoc['vergi_no'] }}</span></p>
                        <p>@lang('site.mersis_no'): <span dir="ltr">{{ $assoc['mersis_no'] }}</span></p>
                    </div>

                </div>	<!-- END CONTACTS INFO -->


                <!-- CONTACT FORM -->
                <div class="col-md-7 col-lg-8" >
                    @if(session('contact_success'))

                        <div class="alert alert-success fade show" role="alert">
                            <div class="alert-icon"></div>
                            <div class="alert-text">@lang('site.success')</div>
                        </div>
                    @endif
                    <div class=" mb-40">
                        <form name="" class="row contact-form" action="{{ route('contact.post') }}#contact-sent" method="POST">
                            {{ csrf_field() }}
                            <!-- Contact Form Input -->
                            <div  class="col-md-12 col-lg-6" >
                                <input type="text" name="name" class="form-control " placeholder="@lang('site.name')" required>
                                @if ($errors->has('name'))
                                    <span style="color: red" class="error">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div  class="col-md-12 col-lg-6">
                                <input type="email" name="email" class="form-control " placeholder="@lang('site.email')" required>
                                @if ($errors->has('email'))
                                    <span style="color: red" class="error">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div  class="col-md-12 col-lg-6">
                                <input type="text" name="phone" class="form-control " placeholder="@lang('site.phone')" required>
                                @if ($errors->has('phone'))
                                    <span style="color: red" class="error">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                            <div  class="col-lg-12">
                                <input type="text" name="subject" class="form-control " placeholder="@lang('site.subject')" required>
                            </div>

                            <div  class="col-lg-12 input-message">
                                <textarea class="form-control message" name="message" rows="6" placeholder="@lang('site.message')" required></textarea>
                            </div>

                            <div class="col-lg-12" style="margin:10px 0">
                                <label style="display:flex;gap:8px;align-items:flex-start;font-weight:normal">
                                    <input type="checkbox" name="kvkk" value="1" required style="margin-top:5px">
                                    <span>{!! __('site.contact_kvkk_consent', ['link' => '<a href="'.route('privacy').'" target="_blank">'.__('site.privacy').'</a>']) !!}</span>
                                </label>
                                @if ($errors->has('kvkk'))
                                    <span style="color: red" class="error">{{ $errors->first('kvkk') }}</span>
                                @endif
                            </div>

                            <!-- Contact Form Button -->
                            <div class="col-lg-12 mt-15 ">
                                <button type="submit" class="btn btn-blue blue-hover ">@lang('site.send')</button>
                            </div>



                        </form>

                    </div>
                </div> 	<!-- END CONTACT FORM -->


            </div>	<!-- End row -->


        </div>	   <!-- End container -->
    </section>	<!-- END CONTACTS-1 -->

@endsection
