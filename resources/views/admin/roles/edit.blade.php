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
                                <li class="breadcrumb-item active">@lang('site.edit')</li>
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

                            <form method="post" action="{{ route('admin.roles.update', $role->id) }}" class="ajax-form">
                                @csrf
                                @method('put')

                                {{--name--}}
                                <div class="form-group">
                                    <label>@lang('roles.name')<span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ $role->name }}" autofocus required>
                                    @error('name') <span class="invalid-feedback d-block mb-2">{{ $message }}</span> @enderror
                                </div>

                                <h5>@lang('roles.permissions')</h5>

                                @error('permissions') <span class="invalid-feedback d-block mb-2">{{ $message }}</span> @enderror

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

                                                @if ($model == 'queues')

                                                    @php
                                                        $permissionMaps = ['read'];
                                                    @endphp

                                                @else
                                                    @php
                                                        $permissionMaps = ['create', 'read', 'update', 'delete'];
                                                    @endphp

                                                @endif

                                                @foreach ($permissionMaps as $permissionMap)

                                                    <div class="custom-control custom-checkbox mx-1" style="display: inline-block">
                                                        <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{ $permissionMap . '_' . $model }}" id="{{ $permissionMap . '_' . $model }}" {{ $role->hasPermission( $permissionMap . '_' . $model) ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="{{ $permissionMap . '_' . $model }}">@lang('site.' . $permissionMap)</label>
                                                    </div>

                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table><!-- end of table -->

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i data-feather="edit"></i> @lang('site.update')</button>
                                </div>

                            </form><!-- end of form -->

                        </div><!-- end of card body -->

                    </div><!-- end of card -->

                </div><!-- end of col -->

            </div><!-- end of row -->

        </div><!-- end of content body -->

    </div><!-- end of content wrapper -->

@endsection
