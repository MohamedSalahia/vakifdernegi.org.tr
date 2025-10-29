@extends('layouts.admin.app')

@section('content')

    <div class="content-wrapper">

        <div class="content-header row">

            <div class="content-header-left col-md-9 col-12 mb-2">

                <div class="row breadcrumbs-top">

                    <div class="col-12">

                        <h2 class="content-header-title float-left mb-0">@lang('users.profile')</h2>

                        <div class="breadcrumb-wrapper">

                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">@lang('site.home')</a></li>
                                <li class="breadcrumb-item active">@lang('users.profile')</li>
                                <li class="breadcrumb-item active">@lang('users.edit_profile')</li>
                            </ol>

                        </div><!-- end of breadcrumb -->

                    </div>

                </div><!-- end of row -->

            </div><!-- end of content header -->

        </div><!-- end of content header -->

        <div class="content-body">

            <div class="row">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-body">

                            <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('put')

                                @include('admin.partials._errors')

                                {{--name--}}
                                <div class="form-group">
                                    <label>@lang('users.name')</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                                </div>

                                {{--email--}}
                                <div class="form-group">
                                    <label>@lang('users.email')</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                                </div>

                                {{--image--}}
                                <div class="form-group">
                                    <label>@lang('users.image') </label>
                                    <input type="file" name="image" class="form-control load-image">
                                    <img src="{{ auth()->user()->image_path }}" class="loaded-image" alt="" style="display: block; width: 150px; margin: 10px 0;">
                                </div>

                                {{--submit--}}
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i data-feather="edit"></i> @lang('site.edit')</button>
                                </div>

                            </form><!-- end of form -->

                        </div><!-- end of card body -->

                    </div><!-- end of card -->

                </div><!-- end of col 12 -->

            </div><!-- end of row -->

        </div><!-- end of content body -->

    </div><!-- end of content wrapper -->

@endsection