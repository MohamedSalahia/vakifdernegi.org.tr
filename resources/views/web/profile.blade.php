@extends('layouts.web.app')
@section('page_title')@lang('site.profile')@endsection
@section('content')
    <!-- Page Title -->
    <section class="page-title" style="background-image:url({{url('/thumbnail/1920/900/80/storage/settings/'.setting('banner'))}})">
        <div class="auto-container">
            <div class="content-box">
                <h1>@lang('site.profile')</h1>
                <ul class="bread-crumb">
                    <li><a class="home" href="{{route('/')}}"><span class="fa fa-home"></span></a></li>
                    <li>@lang('site.profile_details')</li>
                </ul>
            </div>
        </div>
    </section>

    <!--Cart section-->
    <section class="cart-area">
        <div class="auto-container">

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

                        <div class="table-outer">
                            <table class="cart-table">
                                <thead class="cart-header">
                                <tr>
                                    <th class="prod-column">@lang('site.name')</th>

                                    <th>@lang('site.email')</th>

                                </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td  class="prod-column">
                                            <div class="column-box">

                                                <div class="title">
                                                    <h3 class="prod-title">{{$user->name}}</h3>
                                                </div>
                                            </div>
                                        </td>
                                        <td colspan="2" class="prod-column">
                                            <div class="column-box">

                                                <div class="title">
                                                    <h3 class="prod-title">{{$user->email}}</h3>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

        </div>

    </section>
@endsection
