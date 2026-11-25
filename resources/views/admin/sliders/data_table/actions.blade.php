@if (auth()->user()->hasPermission('update_sliders'))
    <a href="{{ route('admin.sliders.edit', $id) }}">
        <button type="button" class="btn btn-outline-primary">تعديل</button>
    </a>
@endif

@if (auth()->user()->hasPermission('delete_sliders'))

    <form action="{{ route('admin.sliders.destroy', $id) }}" class="my-1 my-xl-0" id="my_form" method="post" style="display: inline-block;">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-outline-danger delete">@lang('site.delete')</button>
    </form>

@endif
