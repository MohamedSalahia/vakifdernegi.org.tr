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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">@lang('site.users')</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{route('admin.users.index')}}" class="text-muted">@lang('site.users')</a>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <a href="javascript:;" class="text-muted">@lang('site.add')</a>
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->
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
                        <h3 class="card-title">إنشاء جديد</h3>
                        <div class="card-toolbar justify-content-center">
                            <a href="#" class="btn btn-icon btn-sm btn-hover-light-primary mr-1" data-card-tool="toggle" data-toggle="tooltip" data-placement="top" title="" data-original-title="تكبير/تصغير">
                                <i class="ki ki-arrow-down icon-nm"></i>
                            </a>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form id="validatable-form" class="form validatable-form" method="post" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="card-body">
                            <div class="row">
                                {{--name--}}
                                <div class="form-group col-lg-3">
                                    <label>@lang('site.name')<span class="text-danger">*</span></label>
                                    <input name="name" type="text" class="form-control" placeholder="@lang('site.name')" value="{{ old('name') }}" required autofocus/>
                                </div>
                                {{--email--}}
                                <div class="form-group col-lg-3">
                                    <label>@lang('site.email') <span class="text-danger">*</span></label>
                                    <input name="email" type="email" class="form-control"  placeholder="@lang('site.email')" value="{{ old('email') }}" required/>
                                </div>
                                {{--password--}}
                                <div class="form-group col-lg-3">
                                    <label for="password">@lang('site.password') <span class="text-danger">*</span></label>
                                    <input name="password" type="password" class="form-control" id="password" placeholder="@lang('site.password')" required/>
                                </div>
                                {{--password confirmation--}}
                                <div class="form-group col-lg-3">
                                    <label for="password_confirmation">@lang('site.password_confirmation') <span class="text-danger">*</span></label>
                                    <input name="password_confirmation" type="password" class="form-control" id="password_confirmation" placeholder="@lang('site.password_confirmation')" required/>
                                </div>
                                {{--image--}}
                                <div class="form-group col-lg-3">
                                    <label for="image">@lang('site.image')</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="image-input image-input-outline image-input-circle" id="kt_image_3">
                                            <div class="image-input-wrapper" style="background-image: url('https://ui-avatars.com/api/?name=مثال&color=000&background=03A9F4');"></div>
                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="@lang('site.change_avatar')">
                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                <input type="file" name="image" accept=".png, .jpg, .jpeg">
                                            </label>
                                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="" data-original-title="@lang('site.cancel_avatar')">
                                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                                            </span>
                                        </div>
                                        <!--                                        <span class="form-text text-muted">يسمح بالصور من نوع: png, jpg, jpeg.</span>-->
                                    </div>
                                </div>
                                <div class="form-group col-lg-12">
                                    {{--permissions--}}
                                    <label for="permissions">@lang('site.permissions') <span class="text-danger">*</span></label>
                                    @php
                                        $models =
                                        [
                                            'users',
                                            'notifications',
                                            'categories',
                                            'blogs',
                                            'pages',
                                            'services',
                                            'page_categories',
                                            'service_categories',
                                            'settings',
                                            'contacts',
                                            'landings',
                                            'subscribes',
                                            'customers',
                                            'works',
                                            'sliders',
                                            'doctors',
                                            'doctor_categories',
                                            'doctor_services',
                                            'appointments',
                                            'videos',
                                            'photos',
                                            'translations',
                                        ];
                                        $maps = ['create', 'read', 'update', 'delete'];
                                    @endphp
                                    <div class="example-preview">
                                        <ul class="nav nav-pills">
                                            @foreach ($models as $index=>$model)

                                                <li class="nav-item">
                                                    <a class="nav-link {{ $index == 0 ? 'active' : '' }}" data-toggle="tab" href="#{{ $model }}">
                                                        <span class="nav-icon"><i class="flaticon2-chat-1"></i></span>
                                                        <span class="nav-text">@lang('site.' . $model)</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content mt-5">
                                            @foreach ($models as $index=>$model)
                                                <div class="tab-pane fade {{($model == 'users' ? 'active show' : '')}}" id="{{ $model }}" role="tabpanel" aria-labelledby="{{ $model }}">
                                                    <div class="form-group">
                                                        <div class="checkbox-inline">
                                                            @foreach ($maps as $map)
                                                                <label class="checkbox">
                                                                    <input value="{{ $map . '_' . $model }}" type="checkbox" name="permissions[]">
                                                                    <span></span>@lang('site.' . $map)</label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-gray-100">
                            <div class="row">
                                <div class="col text-left">
                                    <button type="submit" class="btn btn-primary mr-2">@lang('site.create')</button>
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
    @include('layouts.admin.validate')
    <script src="{{asset('admin/assets/js/pages/crud/file-upload/image-input.js?v=7.2.9')}}"></script>
@endpush
