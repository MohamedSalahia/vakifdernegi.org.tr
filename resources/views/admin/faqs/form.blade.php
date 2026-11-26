@extends('layouts.admin.app')
@section('page_body')
    <form method="POST" action="{{ $faq->exists ? route('admin.faqs.update', $faq) : route('admin.faqs.store') }}">
        @csrf @if($faq->exists) @method('PUT') @endif
        <div class="row">
            <div class="form-group col-lg-4"><label>@lang('site.faq_category') *</label>
                <select name="category" class="form-control">@foreach(\App\Models\Faq::CATEGORIES as $cat)<option value="{{ $cat }}" {{ old('category', $faq->category) === $cat ? 'selected' : '' }}>@lang('site.faq_cat_'.$cat)</option>@endforeach</select>
            </div>
            <div class="form-group col-lg-2"><label>@lang('site.sort_order')</label><input type="number" name="sort_order" min="0" class="form-control" value="{{ old('sort_order', $faq->sort_order) }}"></div>
            <div class="form-group col-lg-6"><label class="checkbox checkbox-lg mt-8"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $faq->is_active) ? 'checked' : '' }}><span></span>&nbsp; @lang('site.published')</label></div>
            <div class="form-group col-lg-6"><label>@lang('site.faq_question') (Türkçe) *</label><input type="text" name="question_tr" class="form-control" required maxlength="500" value="{{ old('question_tr', $faq->question_tr) }}"></div>
            <div class="form-group col-lg-6"><label>@lang('site.faq_question') (العربية)</label><input type="text" name="question_ar" class="form-control" dir="rtl" maxlength="500" value="{{ old('question_ar', $faq->question_ar) }}"></div>
            <div class="form-group col-lg-6"><label>@lang('site.faq_answer') (Türkçe) *</label><textarea name="answer_tr" class="form-control" rows="6" required>{{ old('answer_tr', $faq->answer_tr) }}</textarea></div>
            <div class="form-group col-lg-6"><label>@lang('site.faq_answer') (العربية)</label><textarea name="answer_ar" class="form-control" rows="6" dir="rtl">{{ old('answer_ar', $faq->answer_ar) }}</textarea></div>
        </div>
        <button class="btn btn-primary">@lang('site.save')</button> <a href="{{ route('admin.faqs.index') }}" class="btn btn-light">@lang('site.cancel')</a>
    </form>
@endsection
@section('content')
    @include('admin.partials._page', ['title' => __('site.faqs').' — '.($faq->exists ? __('site.edit') : __('site.add_new'))])
@endsection
