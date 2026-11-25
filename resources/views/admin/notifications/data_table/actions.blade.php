@if (auth()->user()->hasPermission('delete_notifications'))

    <form action="{{ route('admin.notifications.destroy', $id) }}" class="my-1 my-xl-0" id="my_form" method="post" style="display: inline-block;">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-outline-danger delete">@lang('site.delete')</button>
    </form>
@endif