@extends('layouts.admin.app')
@section('page_body')
    <p class="text-muted">@lang('site.expenses_help')</p>
    <p><strong>@lang('site.total'):</strong> <span dir="ltr">{{ number_format($total, 2, ',', '.') }} TL</span></p>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead><tr><th>@lang('site.update_date')</th><th>@lang('site.update_title')</th><th>@lang('site.campaign_name')</th><th>@lang('site.price')</th><th>@lang('site.expense_public')</th><th>@lang('site.document')</th><th></th></tr></thead>
            <tbody>
            @forelse($expenses as $e)
                <tr>
                    <td dir="ltr">{{ $e->spent_at->format('d.m.Y') }}</td>
                    <td>{{ $e->title_tr }}</td>
                    <td>{{ optional($e->campaign)->name ?: '—' }}</td>
                    <td dir="ltr">{{ number_format($e->amount, 2, ',', '.') }} TL</td>
                    <td>{{ $e->is_public ? __('site.yes_option') : __('site.no_option') }}</td>
                    <td>@if($e->document)<a href="{{ asset('storage/expense_documents/'.$e->document) }}" target="_blank">@lang('site.show')</a>@else — @endif</td>
                    <td class="text-nowrap">
                        <a href="{{ route('admin.expenses.edit', $e) }}" class="btn btn-sm btn-outline-primary">@lang('site.edit')</a>
                        <form method="POST" action="{{ route('admin.expenses.destroy', $e) }}" style="display:inline-block" onsubmit="return confirm(@json(__('site.confirm_delete')))">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">@lang('site.delete')</button></form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-muted">@lang('site.no_data_found')</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $expenses->links() }}
@endsection
@section('content')
    @include('admin.partials._page', ['title' => __('site.expenses'), 'actions' => '<a href="'.route('admin.expenses.create').'" class="btn btn-primary btn-sm">'.e(__('site.add_new')).'</a>'])
@endsection
