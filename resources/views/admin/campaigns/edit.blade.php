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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">@lang('site.campaigns')</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{route('admin.campaigns.index')}}" class="text-muted">@lang('site.campaigns')</a>
                            </li>
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
                    <ul class="nav nav-light-success nav-bold nav-pills" id="myTabss">
                        @foreach(config('translatable.locales') as $locale)
                            <li class="nav-item">
                                <a class="nav-link lang-nav-link {{($locale == 'ar') ? 'active' : ''}}" data-toggle="tab" href="#{{$locale}}_campaign" data-locale="{{$locale}}">
                                    <span class="nav-icon"><i class="la la-language"></i></span>
                                    @include('layouts.admin.language_tabs')
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <!--end::Actions-->
                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
            @include('admin.partials._errors')
            <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact" data-card="true">
                    <div class="card-header">
                        <h3 class="card-title">@lang('site.edit')</h3>
                        <div class="card-toolbar justify-content-center">
                            <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="" data-original-title="تكبير/تصغير">
                                <i class="ki ki-arrow-down icon-nm"></i>
                            </a>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form id="validatable-form" class="form validatable-form" method="post" action="{{ route('admin.campaigns.update', $campaign->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="row">
                                {{--category--}}
                                <div class="form-group col-lg-12">
                                    <label for="form_select">@lang('site.category_parent')</label>
                                    <select name="c_category_id" class="form-control" id="form_select">
                                        {{--<option value="0">@lang('site.select_category')</option>--}}
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{ $category->id == $campaign->c_category_id ? 'selected' : ''  }}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="tab-content col-lg-12">
                                    @foreach(config('translatable.locales') as $locale)
                                        <div class="tab-pane lang-tab-pane fade {{($locale == 'ar') ? 'show active' : ''}}" id="{{$locale}}_campaign" role="tabpanel" aria-labelledby="kt_tab_pane_2" data-locale="{{$locale}}">
                                            {{--name--}}
                                            <div class="form-group">
                                                <label class=" ">@lang('site.' . $locale . '.name')<span class="text-danger">*</span>
                                                    <span class="m-1 text-primary la la-language" data-toggle="tooltip" title="هذة الحقول لها قيم مختلفة لكل لغة"></span>
                                                </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-square"></i></span>
                                                    </div>
                                                    <input name="{{$locale}}[name]" class="form-control lang_fields_{{$locale}}" type="text" value="{{ $campaign->translate($locale)->name }}" placeholder="أكتب العنوان" required="required">
                                                </div>
                                                <span class="form-text text-muted">قم بكتابة العنوان</span>
                                            </div>
                                            {{--name_slug--}}
                                            <div class="form-group">
                                                <label class=" ">@lang('site.' . $locale . '.name_slug')<span class="text-danger">*</span>
                                                    <span class="m-1 text-primary la la-language" data-toggle="tooltip" title="هذة الحقول لها قيم مختلفة لكل لغة"></span>
                                                </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-square"></i></span>
                                                    </div>
                                                    <input name="{{$locale}}[name_slug]" class="form-control lang_fields_{{$locale}}" type="text" value="{{ $campaign->translate($locale)->name_slug }}" placeholder="أكتب @lang('site.' . $locale . '.name_slug')" required="required">
                                                </div>
                                                <span class="form-text text-muted">قم بكتابة @lang('site.' . $locale . '.name_slug')</span>
                                            </div>
                                            {{--country--}}
                                            <div class="form-group">
                                                <label class=" ">@lang('site.' . $locale . '.country')<span class="text-danger">*</span>
                                                    <span class="m-1 text-primary la la-language" data-toggle="tooltip" title="هذة الحقول لها قيم مختلفة لكل لغة"></span>
                                                </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-square"></i></span>
                                                    </div>
                                                    <input name="{{$locale}}[country]" class="form-control lang_fields_{{$locale}}" type="text" value="{{ $campaign->translate($locale)->country }}" placeholder="أكتب @lang('site.' . $locale . '.country')" required="required">
                                                </div>
                                                <span class="form-text text-muted">قم بكتابة @lang('site.' . $locale . '.country')</span>
                                            </div>
                                            {{--description--}}
                                            <div class="form-group col-lg-12">
                                                <label>@lang('site.' . $locale . '.description')<span class="text-danger">*</span>
                                                    <span class="m-1 text-primary la la-language" data-toggle="tooltip" title="هذة الحقول لها قيم مختلفة لكل لغة"></span>
                                                </label>
                                                <textarea name="{{$locale}}[description]" id="{{$locale}}_my_tiny" rows="3" placeholder="أكتب الوصف" class="form-control">{!! $campaign->translate($locale)->description !!}</textarea>
                                            </div>
                                            {{--meta_title--}}
                                            <div class="form-group">
                                                <label class=" ">@lang('site.' . $locale . '.meta_title')<span class="text-danger">*</span>
                                                    <span class="m-1 text-primary la la-language" data-toggle="tooltip" title="هذة الحقول لها قيم مختلفة لكل لغة"></span>
                                                </label>
                                                <div class="input-group">

                                                    <input name="{{$locale}}[meta_title]" class="form-control lang_fields_{{$locale}}" type="text" value="{!! $campaign->translate($locale)->meta_title !!}" placeholder="أكتب @lang('site.' . $locale . '.meta_title')" required="required">
                                                </div>
                                                <span class="form-text text-muted">قم بكتابة @lang('site.' . $locale . '.meta_title')</span>
                                            </div>
                                            {{--meta_description--}}
                                            <div class="form-group col-lg-12">
                                                <label>@lang('site.' . $locale . '.meta_description')<span class="text-danger">*</span>
                                                    <span class="m-1 text-primary la la-language" data-toggle="tooltip" title="هذة الحقول لها قيم مختلفة لكل لغة"></span>
                                                </label>
                                                <textarea name="{{$locale}}[meta_description]" rows="3" placeholder="أكتب @lang('site.' . $locale . '.meta_description')" class="form-control lang_fields_{{$locale}}">{!! $campaign->translate($locale)->meta_description !!}</textarea>
                                                <span class="form-text text-muted">قم بكتابة @lang('site.' . $locale . '.meta_description')</span>
                                            </div>
                                            {{--keywords--}}
                                            <div class="form-group">
                                                <label class=" ">@lang('site.' . $locale . '.keywords')<span class="text-danger">*</span>
                                                    <span class="m-1 text-primary la la-language" data-toggle="tooltip" title="هذة الحقول لها قيم مختلفة لكل لغة"></span>
                                                </label>
                                                <div class="input-group">

                                                    <input name="{{$locale}}[keywords]" class="form-control lang_fields_{{$locale}}" type="text" value="{!! $campaign->translate($locale)->keywords !!}" placeholder="أكتب @lang('site.' . $locale . '.keywords')" required="required">
                                                </div>
                                                <span class="form-text text-muted">قم بكتابة @lang('site.' . $locale . '.keywords')</span>
                                            </div>
                                            {{--image_alt--}}
                                            <div class="form-group">
                                                <label class=" ">@lang('site.' . $locale . '.image_alt')<span class="text-danger">*</span>
                                                    <span class="m-1 text-primary la la-language" data-toggle="tooltip" title="هذة الحقول لها قيم مختلفة لكل لغة"></span>
                                                </label>
                                                <div class="input-group">

                                                    <input name="{{$locale}}[image_alt]" class="form-control lang_fields_{{$locale}}" type="text" value="{!! $campaign->translate($locale)->image_alt !!}" placeholder="أكتب @lang('site.' . $locale . '.image_alt')" required="required">
                                                </div>
                                                <span class="form-text text-muted">قم بكتابة @lang('site.' . $locale . '.image_alt')</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {{--goal--}}
                                <div class="form-group col-lg-4">
                                    <label>@lang('site.goal')<span class="text-danger">*</span></label>
                                    <input name="goal" type="number" class="form-control" placeholder="@lang('site.goal')" value="{{ $campaign->goal }}" required/>
                                </div>
                                {{--status--}}
                                <div class="form-group col-lg-4">
                                    <label for="form_select_status">@lang('site.status')</label>
                                    <select name="status" class="form-control" id="form_select_status">
                                        <option {{$campaign->status == 'active' ? 'selected':''}} value="active">تفعيل</option>
                                        <option {{$campaign->status == 'deactivate' ? 'selected':''}} value="deactivate">الغاء التفعيل</option>
                                    </select>
                                </div>

                                {{--complete--}}
                                <div class="form-group col-lg-4">
                                    <label for="form_select_complete">@lang('site.complete')</label>
                                    <select name="complete" class="form-control" id="form_select_complete">
                                        <option {{$campaign->complete == 'yes' ? 'selected':''}} value="yes">نعم</option>
                                        <option {{$campaign->complete == 'no' ? 'selected':''}} value="no">لا</option>
                                    </select>
                                </div>
                                {{--image--}}
                                <div class="form-group col-lg-12">
                                    <label>@lang('site.image')</label>
                                    <input type="file" name="image" class="form-control image">
                                    <span class="form-text text-muted">يرجى رفع صورة بأبعاد450 * 770</span>
                                </div>

                                <div class="form-group col-lg-12">
                                    <img src="{{($campaign->image ? url('/thumbnail/100/100/80/storage/campaign_images/'.$campaign->image) : 'https://ui-avatars.com/api/?name=مثال&color=000&background=03A9F4')}}"  style="width: 100px" class="img-thumbnail image_preview" alt="">
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
    <script src="https://cdn.tiny.cloud/1/qcr09xadljfdl3rae0j3nmcvr2i1cp414gjvk1reivd25avu/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    @include('layouts.admin.validate')
    {{--tinymce editor--}}
    <script>
        //ar
        tinymce.init({
            selector: '#ar_my_tiny',

            language: '{{app()->getLocale()}}',
            directionality : "{{(app()->getLocale() == 'ar' ? 'rtl' : 'ltr')}}",

            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',

            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | insertfile image media template link anchor codesample | charmap emoticons | fullscreen  preview save print | ltr rtl | pagebreak',
            image_class_list: [
                {title: 'None', value: ''},
                {title: 'img-fluid', value: 'img-fluid'},
            ],
            image_advtab: true,
            importcss_append: true,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            contextmenu: 'link image imagetools table',

            /* without images_upload_url set, Upload tab won't show up*/
            images_upload_url: "/post/image/upload",
            images_upload_credentials: true,
            file_picker_types: 'image',

            content_style: 'body { font-family: Cairo, sans-serif; font-size:14px }',
            rel_list: [
                { title: "No Follow", value: "nofollow" },
                { title: "Do Follow", value: "dofollow" },
                { title: "No Referrer", value: "noreferrer" },
                { title: "External Link", value: "external" },
            ]
        });
        //en
        tinymce.init({
            selector: '#en_my_tiny',

            language: '{{app()->getLocale()}}',
            directionality : "{{(app()->getLocale() == 'ar' ? 'rtl' : 'ltr')}}",
            image_class_list: [
                {title: 'None', value: ''},
                {title: 'img-fluid', value: 'img-fluid'},
            ],
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',

            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | insertfile image media template link anchor codesample | charmap emoticons | fullscreen  preview save print | ltr rtl | pagebreak',

            image_advtab: true,
            importcss_append: true,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            contextmenu: 'link image imagetools table',

            /* without images_upload_url set, Upload tab won't show up*/
            images_upload_url: "/post/image/upload",
            images_upload_credentials: true,
            file_picker_types: 'image',

            content_style: 'body { font-family: Cairo, sans-serif; font-size:14px }',
            rel_list: [
                { title: "No Follow", value: "nofollow" },
                { title: "Do Follow", value: "dofollow" },
                { title: "No Referrer", value: "noreferrer" },
                { title: "External Link", value: "external" },
            ]
        });
        //tr
        tinymce.init({
            selector: '#tr_my_tiny',

            language: '{{app()->getLocale()}}',
            directionality : "{{(app()->getLocale() == 'ar' ? 'rtl' : 'ltr')}}",
            image_class_list: [
                {title: 'None', value: ''},
                {title: 'img-fluid', value: 'img-fluid'},
            ],
            plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',

            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | insertfile image media template link anchor codesample | charmap emoticons | fullscreen  preview save print | ltr rtl | pagebreak',

            image_advtab: true,
            importcss_append: true,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: 'mceNonEditable',
            contextmenu: 'link image imagetools table',

            /* without images_upload_url set, Upload tab won't show up*/
            images_upload_url: "/post/image/upload",
            images_upload_credentials: true,
            file_picker_types: 'image',

            content_style: 'body { font-family: Cairo, sans-serif; font-size:14px }',
            rel_list: [
                { title: "No Follow", value: "nofollow" },
                { title: "Do Follow", value: "dofollow" },
                { title: "No Referrer", value: "noreferrer" },
                { title: "External Link", value: "external" },
            ]
        });
        // // image preview
        $(".image").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
    {{--image--}}
    <script src="{{asset('admin/assets/js/pages/crud/file-upload/image-input.js?v=7.2.9')}}"></script>

    {{--image preview--}}
    <script>
        // image preview
        $(".image").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('.image_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
@endpush
