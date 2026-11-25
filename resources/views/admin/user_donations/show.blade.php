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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">@lang('site.user_donations')</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{route('admin.user_donations.index')}}" class="text-muted">@lang('site.user_donations')</a>
                            </li>
                            <li class="breadcrumb-item text-muted">
                                <a href="javascript:;" class="text-muted">@lang('site.show')</a>
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

            <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact" data-card="true">

                    <!--begin::Form-->
                        <div class="card-body">
                            <div class="row">
                                {{--name--}}
                                <div class="form-group col-lg-6">
                                    <label>@lang('site.name')</label>
                                    <input type="text" class="form-control" placeholder="@lang('site.name')" value="{{ $knetTransaction->udf2 }}" disabled/>
                                </div>
                                {{--email--}}
                                <div class="form-group col-lg-6">
                                    <label>@lang('site.email')</label>
                                    <input type="text" class="form-control"  placeholder="@lang('site.email')" value="{{ $knetTransaction->udf3 }}" disabled/>
                                </div>

                                {{--payment ID--}}
                                <div class="form-group col-lg-6">
                                    <label>@lang('site.payment_id')</label>
                                    <input type="text" class="form-control"  placeholder="@lang('site.payment_id')" value="{{ $knetTransaction->paymentid }}" disabled/>
                                </div>
                                {{--price--}}
                                <div class="form-group col-lg-6">
                                    <label>@lang('site.price')</label>
                                    <input type="text" class="form-control" placeholder="@lang('site.price')" value="{{ $knetTransaction->amt }}" disabled/>
                                </div>
                                @if($knetTransaction->auth_resp_code == 0)
                                    <div class="form-group col-lg-6">
                                        <label>@lang('site.status')</label>
                                        <input style="background-color: #87C28D;" type="text" class="form-control" placeholder="@lang('site.status')" value="دفع ناجح" disabled/>
                                    </div>
                                @else
                                    <div class="form-group col-lg-6">
                                        <label>@lang('site.status')</label>
                                        <input style="background-color: #ff000070;" type="text" class="form-control" placeholder="@lang('site.status')" value="دفع فاشل" disabled/>
                                    </div>
                                @endif
                                {{--campaign--}}
                                <div class="form-group col-lg-6">
                                    <label>@lang('site.campaign_name')</label>
                                    <input type="text" class="form-control" placeholder="@lang('site.campaign_name')" value="{{ $knetTransaction->campaign->name }}" disabled/>
                                </div>
                            </div>
                        </div>
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
