@extends('layouts.web.app')
@section('page_title'){{$page->name}}@endsection
@section('content')

    <!-- Page Title -->
    <section class="page-title" style="background-image:url({{url('/thumbnail/1920/900/80/storage/settings/'.setting('banner'))}})">
        <div class="auto-container">
            <div class="content-box">
                <h1>{{$page->name}}</h1>
                <ul class="bread-crumb">
                    <li><a class="home" href="{{route('/')}}"><span class="fa fa-home"></span></a></li>
                    <li>{{$page->name}}</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- History Section -->
    <section class="history-section">
        <div class="auto-container">
            {!! $page->description !!}
            {{--<div class="description">
                <div class="top-content text-center">
                    <div class="icon-box"><span class="flaticon-hands-and-gestures"></span></div>
                    <h1>{{$page->name}}</h1>
                    {!! $page->description !!}
                </div>
                <div class="row">
                    {!! $page->description !!}
                    <div class="col-lg-6">
                        <h4>With more than <span>3,900 staff of 50 nationalities,</span> Concern operates in 25 of the world’s poor countries, helping people to achieve major in their lives.</h4>
                    </div>
                    <div class="col-lg-6">
                        <h3>More than 32 years experience </h3>
                        <div class="text">Beguiled and demoralized by the charms of pleasure of the moment, so by desire, that they cannot foresee the pain and trouble that are bound to ensue   to those who fail in their shrinking.</div>
                    </div>
                </div>
            </div>--}}

        </div>
    </section>

@endsection
