@extends('layouts.admin.app')
@section('page_body')
    <table class="table table-bordered">
        <thead><tr><th>@lang('site.report_year')</th><th>@lang('site.update_title')</th><th>@lang('site.published')</th><th>PDF</th><th></th></tr></thead>
        <tbody>
        @forelse($reports as $r)
            <tr>
                <td>{{ $r->year }}</td><td>{{ $r->title_tr }}</td>
                <td>{{ $r->is_published ? __('site.yes_option') : __('site.no_option') }}</td>
                <td><a href="{{ asset('storage/annual_reports/'.$r->file) }}" target="_blank">@lang('site.show')</a></td>
                <td class="text-nowrap">
                    <a href="{{ route('admin.annual_reports.edit', $r) }}" class="btn btn-sm btn-outline-primary">@lang('site.edit')</a>
                    <form method="POST" action="{{ route('admin.annual_reports.destroy', $r) }}" style="display:inline-block" onsubmit="return confirm(@json(__('site.confirm_delete')))">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">@lang('site.delete')</button></form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-muted">@lang('site.no_data_found')</td></tr>
        @endforelse
        </tbody>
    </table>
@endsection
@section('content')
    @include('admin.partials._page', ['title' => __('site.annual_reports'), 'actions' => '<a href="'.route('admin.annual_reports.create').'" class="btn btn-primary btn-sm">'.e(__('site.add_new')).'</a>'])
@endsection
