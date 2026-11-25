@extends('layouts.admin.app')

@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->

        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Dashboard-->
                <!--begin::Row-->
                <div class="row">
                    <div class="col-xl-12">
                        <!--begin::Mixed Widget 1-->
                        <div class="card card-custom bg-gray-100 card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0 bg-danger py-5">
                                <h3 class="card-title font-weight-bolder text-white">لوحة التحكم</h3>
                                <div class="card-toolbar"></div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body p-0 position-relative overflow-hidden">
                                <!--begin::Chart-->
                                <div id="visitors_counters_widget" class="card-rounded-bottom bg-danger" style="height: 100px !important; min-height: 100px;"><div id="apexchartspvu7vjxg" class="apexcharts-canvas apexchartspvu7vjxg apexcharts-theme-light" style="width: 1034px; height: 100px;"><svg id="SvgjsSvg1187" width="1034" height="100" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1189" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)"><defs id="SvgjsDefs1188"><clipPath id="gridRectMaskpvu7vjxg"><rect id="SvgjsRect1192" width="1041" height="103" x="-3.5" y="-1.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="gridRectMarkerMaskpvu7vjxg"><rect id="SvgjsRect1193" width="1038" height="104" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG1198" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG1199" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g></g><g id="SvgjsG1201" class="apexcharts-grid"><g id="SvgjsG1202" class="apexcharts-gridlines-horizontal" style="display: none;"><line id="SvgjsLine1204" x1="0" y1="0" x2="1034" y2="0" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1205" x1="0" y1="10" x2="1034" y2="10" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1206" x1="0" y1="20" x2="1034" y2="20" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1207" x1="0" y1="30" x2="1034" y2="30" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1208" x1="0" y1="40" x2="1034" y2="40" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1209" x1="0" y1="50" x2="1034" y2="50" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1210" x1="0" y1="60" x2="1034" y2="60" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1211" x1="0" y1="70" x2="1034" y2="70" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1212" x1="0" y1="80" x2="1034" y2="80" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1213" x1="0" y1="90" x2="1034" y2="90" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine1214" x1="0" y1="100" x2="1034" y2="100" stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line></g><g id="SvgjsG1203" class="apexcharts-gridlines-vertical" style="display: none;"></g><line id="SvgjsLine1216" x1="0" y1="100" x2="1034" y2="100" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine1215" x1="0" y1="1" x2="0" y2="100" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG1194" class="apexcharts-area-series apexcharts-plot-series"><g id="SvgjsG1195" class="apexcharts-series" seriesName="الزائرين" data:longestSeries="true" rel="1" data:realIndex="0"><g id="SvgjsG1196" class="apexcharts-series-markers-wrap" data:realIndex="0"></g></g><g id="SvgjsG1197" class="apexcharts-datalabels" data:realIndex="0"></g></g><line id="SvgjsLine1217" x1="0" y1="0" x2="1034" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1218" x1="0" y1="0" x2="1034" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG1219" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG1220" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG1221" class="apexcharts-point-annotations"></g></g><g id="SvgjsG1200" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g><g id="SvgjsG1190" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div></div></div>
                                <!--end::Chart-->
                                <!--begin::Stats-->
                                <div class="card-spacer mt-n25">
                                    <!--begin::Row-->
                                    <div class="row m-0">
                                        <div class="col bg-light-primary px-6 py-8 rounded-xl mr-7 mb-7">
                                        <span class="svg-icon svg-icon-3x d-block my-2">
                                            <!--begin::Svg Icon-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <polygon id="Shape" points="0 0 24 0 24 24 0 24"></polygon> <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" id="Mask" fill="#000000" fill-rule="nonzero"></path> <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" id="Mask-Copy" fill="#000000" fill-rule="nonzero"></path> </g> </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                            <a href="{{route('admin.users.index')}}" class="text-primary font-weight-bold font-size-h6">@lang('site.users')</a>
                                            <span class="font-weight-bold text-muted font-size-sm">({{$users}})</span>
                                        </div>
                                        <div class="col bg-light-primary px-6 py-8 rounded-xl mr-7 mb-7">
                                        <span class="svg-icon svg-icon-3x d-block my-2">
                                            <!--begin::Svg Icon-->
                                            <span class="svg-icon svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <rect x="0" y="0" width="24" height="24"></rect> <path d="M1.5,5 L4.5,5 C5.32842712,5 6,5.67157288 6,6.5 L6,17.5 C6,18.3284271 5.32842712,19 4.5,19 L1.5,19 C0.671572875,19 1.01453063e-16,18.3284271 0,17.5 L0,6.5 C-1.01453063e-16,5.67157288 0.671572875,5 1.5,5 Z M18.5,5 L22.5,5 C23.3284271,5 24,5.67157288 24,6.5 L24,17.5 C24,18.3284271 23.3284271,19 22.5,19 L18.5,19 C17.6715729,19 17,18.3284271 17,17.5 L17,6.5 C17,5.67157288 17.6715729,5 18.5,5 Z" fill="#000000"></path> <rect fill="#000000" opacity="0.3" x="8" y="5" width="7" height="14" rx="1.5"></rect> </g> </svg></span>
                                            <!--end::Svg Icon-->
                                        </span>
                                            <a href="{{route('admin.blogs.index')}}" class="text-primary font-weight-bold font-size-h6">@lang('site.blogs')</a>
                                            <span class="font-weight-bold text-muted font-size-sm">({{$blogs}})</span>
                                        </div>

                                        <div class="col bg-light-primary px-6 py-8 rounded-xl mr-7 mb-7">
                                        <span class="svg-icon svg-icon-3x d-block my-2">
                                            <!--begin::Svg Icon-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <rect x="0" y="0" width="24" height="24"></rect> <path d="M8,6 L20.5,6 C21.3284271,6 22,6.67157288 22,7.5 C22,8.32842712 21.3284271,9 20.5,9 L8,9 L8,19.5 C8,20.3284271 7.32842712,21 6.5,21 C5.67157288,21 5,20.3284271 5,19.5 L5,9 L3.5,9 C2.67157288,9 2,8.32842712 2,7.5 C2,6.67157288 2.67157288,6 3.5,6 L5,6 L5,4.5 C5,3.67157288 5.67157288,3 6.5,3 C7.32842712,3 8,3.67157288 8,4.5 L8,6 Z" fill="#000000"></path> <path d="M10,11 L20.5,11 C21.3284271,11 22,11.6715729 22,12.5 L22,15 C22,17.209139 20.209139,19 18,19 L11.5,19 C10.6715729,19 10,18.3284271 10,17.5 L10,11 Z M20,12 C19.4477153,12 19,12.4477153 19,13 L19,16 C19,16.5522847 19.4477153,17 20,17 C20.5522847,17 21,16.5522847 21,16 L21,13 C21,12.4477153 20.5522847,12 20,12 Z" fill="#000000" opacity="0.3"></path> </g> </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                            <a href="{{route('admin.pages.index')}}" class="text-primary font-weight-bold font-size-h6">@lang('site.pages')</a>
                                            <span class="font-weight-bold text-muted font-size-sm">({{$pages}})</span>
                                        </div>
                                    </div>
                                    <!--end::Row-->
                                    <!--begin::Row-->
                                    <div class="row m-0">
                                        <div class="col bg-light-primary px-6 py-8 rounded-xl mr-7 mb-7">
                                        <span class="svg-icon svg-icon-3x d-block my-2">
                                            <!--begin::Svg Icon-->
                                            <span class="svg-icon svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <rect id="bound" x="0" y="0" width="24" height="24"></rect> <path d="M15.9956071,6 L9,6 C7.34314575,6 6,7.34314575 6,9 L6,15.9956071 C4.70185442,15.9316381 4,15.1706419 4,13.8181818 L4,6.18181818 C4,4.76751186 4.76751186,4 6.18181818,4 L13.8181818,4 C15.1706419,4 15.9316381,4.70185442 15.9956071,6 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"></path> <path d="M10.1818182,8 L17.8181818,8 C19.2324881,8 20,8.76751186 20,10.1818182 L20,17.8181818 C20,19.2324881 19.2324881,20 17.8181818,20 L10.1818182,20 C8.76751186,20 8,19.2324881 8,17.8181818 L8,10.1818182 C8,8.76751186 8.76751186,8 10.1818182,8 Z" id="Rectangle-19-Copy-3" fill="#000000"></path> </g> </svg></span>
                                            <!--end::Svg Icon-->
                                        </span>
                                            <a href="{{route('admin.categories.index')}}" class="text-primary font-weight-bold font-size-h6">@lang('site.categories')</a>
                                            <span class="font-weight-bold text-muted font-size-sm">({{$blog_categories}})</span>
                                        </div>
                                        <div class="col bg-light-primary px-6 py-8 rounded-xl mr-7 mb-7">
                                        <span class="svg-icon svg-icon-3x d-block my-2">
                                            <!--begin::Svg Icon-->
                                            <span class="svg-icon svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon"> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <rect id="bound" x="0" y="0" width="24" height="24"></rect> <path d="M15.9956071,6 L9,6 C7.34314575,6 6,7.34314575 6,9 L6,15.9956071 C4.70185442,15.9316381 4,15.1706419 4,13.8181818 L4,6.18181818 C4,4.76751186 4.76751186,4 6.18181818,4 L13.8181818,4 C15.1706419,4 15.9316381,4.70185442 15.9956071,6 Z" id="Combined-Shape" fill="#000000" fill-rule="nonzero" opacity="0.3"></path> <path d="M10.1818182,8 L17.8181818,8 C19.2324881,8 20,8.76751186 20,10.1818182 L20,17.8181818 C20,19.2324881 19.2324881,20 17.8181818,20 L10.1818182,20 C8.76751186,20 8,19.2324881 8,17.8181818 L8,10.1818182 C8,8.76751186 8.76751186,8 10.1818182,8 Z" id="Rectangle-19-Copy-3" fill="#000000"></path> </g> </svg></span>
                                            <!--end::Svg Icon-->
                                        </span>
                                            <a href="{{route('admin.page_categories.index')}}" class="text-primary font-weight-bold font-size-h6">@lang('site.page_categories')</a>
                                            <span class="font-weight-bold text-muted font-size-sm">({{$page_categories}})</span>
                                        </div>
                                        <div class="col bg-light-primary px-6 py-8 rounded-xl mr-7 mb-7">
                                        <span class="svg-icon svg-icon-3x d-block my-2">
                                            <!--begin::Svg Icon-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <rect x="0" y="0" width="24" height="24"></rect> <path d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z" fill="#000000"></path> <path d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z" fill="#000000" opacity="0.3"></path> </g> </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                            <a href="{{route('admin.contacts.index')}}" class="text-primary font-weight-bold font-size-h6">@lang('site.contacts')</a>
                                            <span class="font-weight-bold text-muted font-size-sm">({{$contacts}})</span>
                                        </div>
                                        <div class="col bg-light-primary px-6 py-8 rounded-xl mr-7 mb-7">
                                        <span class="svg-icon svg-icon-3x d-block my-2">
                                            <!--begin::Svg Icon-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"> <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <rect x="0" y="0" width="24" height="24"></rect> <path d="M4,9.67471899 L10.880262,13.6470401 C10.9543486,13.689814 11.0320333,13.7207107 11.1111111,13.740321 L11.1111111,21.4444444 L4.49070127,17.526473 C4.18655139,17.3464765 4,17.0193034 4,16.6658832 L4,9.67471899 Z M20,9.56911707 L20,16.6658832 C20,17.0193034 19.8134486,17.3464765 19.5092987,17.526473 L12.8888889,21.4444444 L12.8888889,13.6728275 C12.9050191,13.6647696 12.9210067,13.6561758 12.9368301,13.6470401 L20,9.56911707 Z" fill="#000000"></path> <path d="M4.21611835,7.74669402 C4.30015839,7.64056877 4.40623188,7.55087574 4.5299008,7.48500698 L11.5299008,3.75665466 C11.8237589,3.60013944 12.1762411,3.60013944 12.4700992,3.75665466 L19.4700992,7.48500698 C19.5654307,7.53578262 19.6503066,7.60071528 19.7226939,7.67641889 L12.0479413,12.1074394 C11.9974761,12.1365754 11.9509488,12.1699127 11.9085461,12.2067543 C11.8661433,12.1699127 11.819616,12.1365754 11.7691509,12.1074394 L4.21611835,7.74669402 Z" fill="#000000" opacity="0.3"></path> </g> </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                            <a href="{{route('admin.subscribes.index')}}" class="text-primary font-weight-bold font-size-h6">@lang('site.subscribes')</a>
                                            <span class="font-weight-bold text-muted font-size-sm">({{$subscribes}})</span>
                                        </div>
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Stats-->
                                <div class="resize-triggers"><div class="expand-trigger"><div style="width: 1035px; height: 479px;"></div></div><div class="contract-trigger"></div></div></div>
                            <!--end::Body-->
                        </div>
                        <!--end::Mixed Widget 1-->
                    </div>

                </div>
                <!--end::Row-->
                <!--begin::Row-->

                <!--end::Row-->
                <!--end::Dashboard-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

@endsection
