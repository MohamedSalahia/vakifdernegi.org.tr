@extends('layouts.admin.app')

@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold my-1 mr-5">@lang('site.settings')</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item text-muted">
                                <a href="javascript:;" class="text-muted">@lang('site.edit')</a>
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <!--begin::Actions-->
                    <ul class="nav nav-light-success nav-bold nav-pills" id="myTabs">
                        @foreach(config('translatable.locales') as $locale)
                            <li class="nav-item">
                                <a class="nav-link {{($locale == 'ar') ? 'active' : ''}}" data-toggle="tab" href="#{{$locale}}">
                                    <span class="nav-icon"><i class="la la-language"></i></span>
                                    @include('layouts.admin.language_tabs')
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <!--end::Actions-->
                </div>
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
            @include('admin.partials._errors')
            @include('admin.partials._session')
            <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact" data-card="true">
                    <div class="card-header">
                        <h3 class="card-title">عام</h3>
                        <div class="card-toolbar justify-content-center">
                            <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="" data-original-title="تكبير/تصغير">
                                <i class="ki ki-arrow-down icon-nm"></i>
                            </a>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form id="contact_form" class="form validatable-form" method="post" action="{{ route('admin.settings.store') }}" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="card-body">
                            <div class="row">
                                @php
                                    //dd(setting('en')['title']);
                                @endphp
                                <div class="tab-content col-lg-12">
                                    @foreach(config('translatable.locales') as $locale)
                                        <div class="tab-pane fade {{($locale == 'ar') ? 'show active' : ''}}" id="{{$locale}}" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                                            {{--setting_title--}}
                                            <div class="form-group">
                                                <label class=" ">@lang('site.' . $locale . '.setting_title')<span class="text-danger">*</span>
                                                    <span class="m-1 text-primary la la-language" data-toggle="tooltip" title="هذة الحقول لها قيم مختلفة لكل لغة"></span>
                                                </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-square"></i></span>
                                                    </div>
                                                    <input name="{{$locale}}[title]" class="form-control lang_fields_{{$locale}}" type="text" value="{{setting($locale)['title']}}" placeholder="أكتب @lang('site.' . $locale . '.setting_title')" required="required">
                                                </div>
                                                <span class="form-text text-muted">قم بكتابة @lang('site.' . $locale . '.setting_title')</span>
                                            </div>

                                            {{--address--}}
                                            <div class="form-group">
                                                <label class=" ">@lang('site.' . $locale . '.office_address')<span class="text-danger">*</span>
                                                    <span class="m-1 text-primary la la-language" data-toggle="tooltip" title="هذة الحقول لها قيم مختلفة لكل لغة"></span>
                                                </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-square"></i></span>
                                                    </div>
                                                    <input name="{{$locale}}[address]" class="form-control lang_fields_{{$locale}}" type="text" value="{{setting($locale)['address']}}" placeholder="أكتب @lang('site.' . $locale . '.office_address')" required="required">
                                                </div>
                                                <span class="form-text text-muted">قم بكتابة @lang('site.' . $locale . '.office_address')</span>
                                            </div>

                                            {{--setting_description--}}
                                            <div class="form-group">
                                                <label class=" ">@lang('site.' . $locale . '.setting_description')<span class="text-danger">*</span>
                                                    <span class="m-1 text-primary la la-language" data-toggle="tooltip" title="هذة الحقول لها قيم مختلفة لكل لغة"></span>
                                                </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-square"></i></span>
                                                    </div>
                                                    <textarea name="{{$locale}}[description]" class="form-control lang_fields_{{$locale}}" type="text" placeholder="أكتب @lang('site.' . $locale . '.setting_description')" required="required">{{setting($locale)['description']}}</textarea>
                                                </div>
                                                <span class="form-text text-muted">قم بكتابة @lang('site.' . $locale . '.setting_description')</span>
                                            </div>
                                            {{--site_keywords--}}
                                            <div class="form-group">
                                                <label>@lang('site.' . $locale . '.site_keywords')<span class="text-danger">*</span>
                                                    <span class="m-1 text-primary la la-language" data-toggle="tooltip" title="هذة الحقول لها قيم مختلفة لكل لغة"></span>
                                                </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-square"></i></span>
                                                    </div>
                                                    <textarea name="{{$locale}}[site_keywords]" class="form-control lang_fields_{{$locale}}" type="text" placeholder="أكتب @lang('site.' . $locale . '.site_keywords')" required="required">{{setting($locale)['site_keywords']}}</textarea>
                                                </div>
                                                <span class="form-text text-muted">قم بكتابة @lang('site.' . $locale . '.site_keywords')</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {{--phone--}}
                                <div class="form-group col-lg-12">
                                    <label>@lang('site.phone')<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input name="phone" class="form-control" type="text" value="{{setting('phone')}}" placeholder="أكتب @lang('site.phone')" required="required">
                                    </div>
                                </div>

                                {{--iframe--}}
                                <div class="form-group col-lg-12">
                                    <label>@lang('site.iframe')<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <textarea name="iframe" class="form-control" type="text" placeholder="أكتب @lang('site.iframe')" required="required">{{setting('iframe')}}</textarea>
                                    </div>
                                </div>

                                {{--email--}}
                                <div class="form-group col-lg-12">
                                    <label>@lang('site.email')<span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input name="email" class="form-control" type="email" value="{{setting('email')}}" placeholder="أكتب @lang('site.email')" required="required">
                                    </div>
                                </div>

                                {{--facebook--}}
                                <div class="form-group col-lg-12">
                                    <label>@lang('site.facebook')</label>
                                    <div class="input-group">
                                        <input name="facebook" class="form-control" type="text" value="{{setting('facebook')}}" placeholder="أكتب @lang('site.facebook')">
                                    </div>
                                </div>

                                {{--instagram--}}
                                <div class="form-group col-lg-12">
                                    <label>@lang('site.instagram')</label>
                                    <div class="input-group">
                                        <input name="instagram" class="form-control" type="text" value="{{setting('instagram')}}" placeholder="أكتب @lang('site.instagram')">
                                    </div>
                                </div>

                                {{--telegram--}}
                                <div class="form-group col-lg-12">
                                    <label>@lang('site.telegram')</label>
                                    <div class="input-group">
                                        <input name="telegram" class="form-control" type="text" value="{{setting('telegram')}}" placeholder="أكتب @lang('site.telegram')">
                                    </div>
                                </div>

                                {{--twitter--}}
                                <div class="form-group col-lg-12">
                                    <label>@lang('site.twitter')</label>
                                    <div class="input-group">
                                        <input name="twitter" class="form-control" type="text" value="{{setting('twitter')}}" placeholder="أكتب @lang('site.twitter')">
                                    </div>
                                </div>

                                {{--youtube--}}
                                <div class="form-group col-lg-12">
                                    <label>@lang('site.youtube')</label>
                                    <div class="input-group">
                                        <input name="youtube" class="form-control" type="text" value="{{setting('youtube')}}" placeholder="أكتب @lang('site.youtube')">
                                    </div>
                                </div>

                                {{--logo--}}
                                <div class="form-group col-lg-12">
                                    <label>@lang('site.logo')</label>
                                    <input type="file" name="logo" class="form-control image_logo">
                                </div>

                                <div class="form-group col-lg-12">
                                    <img src="{{url('/thumbnail/100/100/80/storage/settings/'.setting('logo'))}}"  style="width: 100px" class="img-thumbnail image_preview_logo" alt="">
                                </div>


                                {{--fav_icon--}}
                                <div class="form-group col-lg-12">
                                    <label>@lang('site.favicon')</label>
                                    <input type="file" name="fav_icon" class="form-control image_fav_icon">
                                </div>

                                <div class="form-group col-lg-12">
                                    <img src="{{url('/thumbnail/100/100/80/storage/settings/'.setting('fav_icon'))}}"  style="width: 100px" class="img-thumbnail image_preview_fav_icon" alt="">
                                </div>

                                {{--banner--}}
                                <div class="form-group col-lg-12">
                                    <label>@lang('site.banner')</label>
                                    <input type="file" name="banner" class="form-control image_banner">
                                </div>

                                <div class="form-group col-lg-12">
                                    <img src="{{url('/thumbnail/100/100/80/storage/settings/'.setting('banner'))}}"  style="width: 100px" class="img-thumbnail image_preview_banner" alt="">
                                </div>

                                {{--zakat image--}}
                                <div class="form-group col-lg-12">
                                    <label>@lang('site.zakat')</label>
                                    <input type="file" name="zakat" class="form-control image_zakat">
                                </div>

                                <div class="form-group col-lg-12">
                                    <img src="{{url('/thumbnail/100/100/80/storage/settings/'.setting('zakat'))}}"  style="width: 100px" class="img-thumbnail image_preview_zakat" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-gray-100">
                            <div class="row">
                                <div class="col text-left">
                                    <button type="submit" class="btn btn-primary mr-2">@lang('site.edit')</button>
                                    <button type="reset" class="btn btn-secondary">إعادة</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        if ($("#contact_form").length > 0) {
            $("#contact_form").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 15,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    type: {
                        required: true,
                        minlength: 3,
                        maxlength: 15,
                    },
                    password: {
                        minlength: 8,
                        required: true,
                    },
                    password_confirmation: {
                        equalTo : "#password"
                    }
                },
                messages: {
                    name: {
                        required: "@lang('site.error_req')",
                        minlength: "@lang('site.error_min')",
                        maxlength: "@lang('site.error_max')",
                    },
                    type: {
                        required: "@lang('site.error_req')",
                        minlength: "@lang('site.error_min')",
                        maxlength: "@lang('site.error_max')",
                    },
                    email: {
                        required: "@lang('site.error_req')",
                        email: "@lang('site.email_error_req')",
                    },
                    password: {
                        required: "@lang('site.error_req')",
                        minlength: "@lang('site.error_min_8')",
                    },
                    password_confirmation: {
                        equalTo: "@lang('site.error_equal')",
                    }
                }
            })
        }
    </script>
    <script src="{{asset('admin/assets/js/pages/crud/file-upload/image-input.js?v=7.2.9')}}"></script>

    {{--image--}}
    <script>
        // // image preview
        $(".image_logo").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image_preview_logo').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
        $(".image_fav_icon").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image_preview_fav_icon').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
        $(".image_banner").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image_preview_banner').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
        $(".image_zakat").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image_preview_zakat').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

    </script>
@endpush
