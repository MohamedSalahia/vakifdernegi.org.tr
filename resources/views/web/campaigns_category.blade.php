@extends('layouts.web.app')
@section('page_title'){{$category->name}}@endsection

@section('content')
    <script src="{{asset('web/js/jquery.js')}}"></script>
    <!-- Page Title -->
    <section class="page-title" style="background-image:url({{url('/thumbnail/1920/900/80/storage/settings/'.setting('banner'))}})">
        <div class="auto-container">
            <div class="content-box">
                <h1>@lang('site.campaigns')</h1>
                <ul class="bread-crumb">
                    <li><a class="home" href="{{route('/')}}"><span class="fa fa-home"></span></a></li>
                    <li>{{$category->name}}</li>
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
                    @include('layouts.web.campaigns_not_completed')
                </div>
            </div>
        </div>
    </section>
@endsection

