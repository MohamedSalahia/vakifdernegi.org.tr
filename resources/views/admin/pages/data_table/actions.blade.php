@if (auth()->user()->hasPermission('update_pages'))

    <a href="{{ route('admin.pages.edit', $id) }}">
        <button type="button" class="btn btn-outline-primary">تعديل</button>
    </a>

@endif

{{--@if (auth()->user()->hasPermission('delete_pages'))

    @if($locked == null)
        <form action="{{ route('admin.pages.destroy', $id) }}" class="my-1 my-xl-0" id="my_form" method="post" style="display: inline-block;">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-outline-danger delete">@lang('site.delete')</button>
        </form>
    @else
        <button class="btn btn-outline-danger" disabled="disabled">@lang('site.delete')</button>
    @endif

@endif--}}


