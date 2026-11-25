@extends('layouts.web.app')
@section('page_title')@lang('site.campaigns_completed')@endsection

@section('content')
    <script src="{{asset('web/js/jquery.js')}}"></script>
    <!-- Page Title -->
    <section class="page-title" style="background-image:url({{url('/thumbnail/1920/900/80/storage/settings/'.setting('banner'))}})">
        <div class="auto-container">
            <div class="content-box">
                <h1>@lang('site.campaigns_completed')</h1>
                <ul class="bread-crumb">
                    <li><a class="home" href="{{route('/')}}"><span class="fa fa-home"></span></a></li>
                    <li>@lang('site.campaigns_completed')</li>
                </ul>
            </div>
        </div>
    </section>
    @include('admin.partials._session')
    <!-- Causes Section Four -->
    <section class="causes-section-four">
        <div class="auto-container">
            <div class="cause-wrapper">
                <div class="row">
                    @include('layouts.web.campaigns_completed')
                </div>
            </div>
        </div>
    </section>
@endsection

