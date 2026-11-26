{{-- Simple admin page frame: $title, optional $actions (html), content in $slot via @section('page_body') --}}
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap">
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ $title }}</h5>
            <div>{!! $actions ?? '' !!}</div>
        </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            @include('admin.partials._session')
            @include('admin.partials._errors')
            <div class="card card-custom gutter-b"><div class="card-body">
                @yield('page_body')
            </div></div>
        </div>
    </div>
</div>
