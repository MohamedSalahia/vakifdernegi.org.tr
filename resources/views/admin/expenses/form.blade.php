@extends('layouts.admin.app')
@section('page_body')
    <form method="POST" enctype="multipart/form-data" action="{{ $expense->exists ? route('admin.expenses.update', $expense) : route('admin.expenses.store') }}">
        @csrf @if($expense->exists) @method('PUT') @endif
        <div class="row">
            <div class="form-group col-lg-3"><label>@lang('site.update_date') *</label><input type="date" name="spent_at" class="form-control" required value="{{ old('spent_at', optional($expense->spent_at)->format('Y-m-d')) }}"></div>
            <div class="form-group col-lg-3"><label>@lang('site.price') (TL) *</label><input type="number" step="0.01" min="0.01" name="amount" class="form-control" required value="{{ old('amount', $expense->amount) }}"></div>
            <div class="form-group col-lg-6"><label>@lang('site.campaign_name')</label>
                <select name="campaign_id" class="form-control">
                    <option value="">@lang('site.expense_general')</option>
                    @foreach($campaigns as $c)<option value="{{ $c->id }}" {{ (string) old('campaign_id', $expense->campaign_id) === (string) $c->id ? 'selected' : '' }}>#{{ $c->id }} {{ $c->name }}</option>@endforeach
                </select>
            </div>
            <div class="form-group col-lg-6"><label>@lang('site.update_title') (Türkçe) *</label><input type="text" name="title_tr" class="form-control" required maxlength="255" value="{{ old('title_tr', $expense->title_tr) }}"></div>
            <div class="form-group col-lg-6"><label>@lang('site.update_title') (العربية)</label><input type="text" name="title_ar" class="form-control" dir="rtl" maxlength="255" value="{{ old('title_ar', $expense->title_ar) }}"></div>
            <div class="form-group col-lg-6"><label>@lang('site.update_body') (Türkçe)</label><textarea name="description_tr" class="form-control" rows="3">{{ old('description_tr', $expense->description_tr) }}</textarea></div>
            <div class="form-group col-lg-6"><label>@lang('site.update_body') (العربية)</label><textarea name="description_ar" class="form-control" rows="3" dir="rtl">{{ old('description_ar', $expense->description_ar) }}</textarea></div>
            <div class="form-group col-lg-6"><label>@lang('site.document') (JPG/PNG/PDF)</label><input type="file" name="document" class="form-control">
                <span class="form-text text-muted">@lang('site.document_help')</span>
                @if($expense->document)<div class="mt-2"><a href="{{ asset('storage/expense_documents/'.$expense->document) }}" target="_blank">@lang('site.show')</a> &nbsp; <label class="checkbox d-inline-flex"><input type="checkbox" name="remove_document" value="1"><span></span>&nbsp;@lang('site.remove_image')</label></div>@endif
            </div>
            <div class="form-group col-lg-6"><label class="checkbox checkbox-lg mt-8"><input type="checkbox" name="is_public" value="1" {{ old('is_public', $expense->is_public) ? 'checked' : '' }}><span></span>&nbsp; @lang('site.expense_public_help')</label></div>
        </div>
        <button class="btn btn-primary">@lang('site.save')</button> <a href="{{ route('admin.expenses.index') }}" class="btn btn-light">@lang('site.cancel')</a>
    </form>
@endsection
@section('content')
    @include('admin.partials._page', ['title' => __('site.expenses').' — '.($expense->exists ? __('site.edit') : __('site.add_new'))])
@endsection
