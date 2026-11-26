@extends('layouts.admin.app')
@section('page_body')
    <table class="table table-bordered">
        <thead><tr><th>#</th><th>@lang('site.faq_category')</th><th>@lang('site.faq_question')</th><th>@lang('site.published')</th><th></th></tr></thead>
        <tbody>
        @forelse($faqs as $f)
            <tr>
                <td>{{ $f->sort_order }}</td><td>@lang('site.faq_cat_'.$f->category)</td><td>{{ $f->question_tr }}@if($f->question_ar)<br><small class="text-muted" dir="rtl">{{ $f->question_ar }}</small>@endif</td>
                <td>{{ $f->is_active ? __('site.yes_option') : __('site.no_option') }}</td>
                <td class="text-nowrap">
                    <a href="{{ route('admin.faqs.edit', $f) }}" class="btn btn-sm btn-outline-primary">@lang('site.edit')</a>
                    <form method="POST" action="{{ route('admin.faqs.destroy', $f) }}" style="display:inline-block" onsubmit="return confirm(@json(__('site.confirm_delete')))">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">@lang('site.delete')</button></form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-muted">@lang('site.no_data_found')</td></tr>
        @endforelse
        </tbody>
    </table>
@endsection
@section('content')
    @include('admin.partials._page', ['title' => __('site.faqs'), 'actions' => '<a href="'.route('admin.faqs.create').'" class="btn btn-primary btn-sm">'.e(__('site.add_new')).'</a>'])
@endsection
