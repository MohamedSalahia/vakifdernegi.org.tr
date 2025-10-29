@extends('layouts.admin.app')

@section('content')

    <div class="content-wrapper">

        <div class="content-header row">

            <div class="content-header-left col-md-9 col-12 mb-2">

                <div class="row breadcrumbs-top">

                    <div class="col-12">

                        <h2 class="content-header-title float-left mb-0">@lang('roles.roles')</h2>

                        <div class="breadcrumb-wrapper">

                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}" wire:navigate>@lang('site.home')</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}" wire:navigate>@lang('roles.roles')</a></li>
                                <li class="breadcrumb-item active">@lang('site.create')</li>
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

                            <form method="post" action="{{ route('admin.roles.store') }}" class="ajax-form">
                                @csrf
                                @method('post')

                                {{--name--}}
                                <div class="form-group">
                                    <label>@lang('roles.name') <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" value="" autofocus required>
                                </div>

                                <h5>@lang('roles.permissions')</h5>

                                @php
                                    $models = [
                                        'roles', 'admins', 'plans', 'tenants', 'settings'
                                    ];
                                @endphp

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>@lang('roles.model')</th>
                                        <th>@lang('roles.permissions') <span class="text-danger">*</span></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($models as $model)
                                        <tr>
                                            <td>@lang($model . '.' . $model)</td>
                                            <td>
                                                <div class="custom-control custom-checkbox mx-1" style="display: inline-block">
                                                    <input type="checkbox" class="custom-control-input all-permissions" id="all-permissions-{{ $model }}">
                                                    <label class="custom-control-label" for="all-permissions-{{ $model }}">@lang('site.all')</label>
                                                </div>

                                                @php
                                                    $permissionMaps = ['create', 'read', 'update', 'delete'];
                                                @endphp

                                                @foreach ($permissionMaps as $permissionMap)
                                                    <div class="custom-control custom-checkbox mx-1" style="display: inline-block">
                                                        <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{ $permissionMap . '_' . $model }}" id="{{ $permissionMap . '_' . $model }}">
                                                        <label class="custom-control-label" for="{{ $permissionMap . '_' . $model }}">@lang('site.' . $permissionMap)</label>
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table><!-- end of table -->

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i data-feather="plus"></i> @lang('site.create')</button>
                                </div>

                            </form><!-- end of form -->

                        </div><!-- end  card body-->

                    </div><!-- end of card -->

                </div><!-- end of row -->

            </div><!-- end of col -->

        </div><!-- end of content body -->

    </div><!-- end of content wrapper -->

@endsection
