@if (auth()->user()->hasPermission('update_contacts'))
    <a href="{{ route('admin.contacts.show', $id) }}">
        <button type="button" class="btn btn-outline-primary">عرض</button>
    </a>
@endif

@if (auth()->user()->hasPermission('delete_contacts'))

    <form action="{{ route('admin.contacts.destroy', $id) }}" class="my-1 my-xl-0" id="my_form" method="post" style="display: inline-block;">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-outline-danger delete">@lang('site.delete')</button>
    </form>

@endif