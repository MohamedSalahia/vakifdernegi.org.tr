@if (auth()->user()->hasPermission('update_users'))
{{--
    <a href="{{ route('admin.users.edit', $id) }}" class="btn btn-warning btn-sm  mr-2"><i class="la la-edit"></i>@lang('site.edit')</a>
--}}
    <a href="{{ route('admin.users.edit', $id) }}">
        <button type="button" class="btn btn-outline-primary">تعديل</button>
    </a>


{{--
    <a href="https://demo.tajraa.com/cp/users/92/edit" class="btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="تعديل"><i class="la la-edit"></i></a>
--}}
@endif

@if (auth()->user()->hasPermission('delete_users'))

    <form action="{{ route('admin.users.destroy', $id) }}" class="my-1 my-xl-0" id="my_form" method="post" style="display: inline-block;">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-outline-danger delete">@lang('site.delete')</button>
        {{--<a href="javascript:void(0);" onclick="myFunction()" class="btn btn-sm btn-clean btn-icon datatable-record-delete delete" data-toggle="tooltip" title="حذف"><i class="la la-trash"></i></a>--}}
    </form>

@endif
@if(auth()->user()->hasPermission('update_users'))
    <!--change password -->
    <a href="{{route('admin.password.reset', $id)}}">
        <button type="button" class="btn btn-outline-dark">@lang('site.change_password')</button>
    </a>
@endif