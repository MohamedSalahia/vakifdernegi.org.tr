@extends('layouts.admin.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">@lang('site.campaign_updates')</h5>
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm mr-4">
                        <li class="breadcrumb-item"><a href="{{ route('admin.campaigns.index') }}" class="text-muted">@lang('site.campaigns')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.campaigns.edit', $campaign) }}" class="text-muted">{{ $campaign->name }}</a></li>
                        <li class="breadcrumb-item"><span class="text-muted">@lang('site.campaign_updates')</span></li>
                    </ul>
                </div>
                <a href="{{ route('campaign.show', [$campaign->id, make_slug($campaign->name)]) }}" target="_blank" class="btn btn-light-primary btn-sm">@lang('site.view_on_site')</a>
            </div>
        </div>

        <div class="d-flex flex-column-fluid">
            <div class="container">
                @include('admin.partials._session')
                @include('admin.partials._errors')
                <div class="row">
                    {{-- Form --}}
                    <div class="col-lg-5">
                        <div class="card card-custom gutter-b">
                            <div class="card-header">
                                <div class="card-title"><h3 class="card-label">{{ $editing ? __('site.edit_update') : __('site.add_update') }}</h3></div>
                            </div>
                            <div class="card-body">
                                <form method="POST" enctype="multipart/form-data"
                                      action="{{ $editing ? route('admin.campaigns.updates.update', [$campaign, $editing]) : route('admin.campaigns.updates.store', $campaign) }}">
                                    @csrf
                                    @if($editing) @method('PUT') @endif

                                    <div class="form-group">
                                        <label>@lang('site.update_date') *</label>
                                        <input type="date" name="published_at" class="form-control" required
                                               value="{{ old('published_at', optional(optional($editing)->published_at)->format('Y-m-d') ?? now()->format('Y-m-d')) }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.update_title') (Türkçe) *</label>
                                        <input type="text" name="title_tr" class="form-control" maxlength="255" required value="{{ old('title_tr', optional($editing)->title_tr) }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.update_body') (Türkçe) *</label>
                                        <textarea name="body_tr" class="form-control" rows="5" required>{{ old('body_tr', optional($editing)->body_tr) }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.update_title') (العربية)</label>
                                        <input type="text" name="title_ar" class="form-control" maxlength="255" dir="rtl" value="{{ old('title_ar', optional($editing)->title_ar) }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.update_body') (العربية)</label>
                                        <textarea name="body_ar" class="form-control" rows="5" dir="rtl">{{ old('body_ar', optional($editing)->body_ar) }}</textarea>
                                        <span class="form-text text-muted">@lang('site.update_ar_optional')</span>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('site.image')</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                        @if($editing && $editing->image)
                                            <div class="mt-3">
                                                <img src="{{ asset('storage/campaign_updates/'.$editing->image) }}" style="max-width:160px;border-radius:6px">
                                                <label class="checkbox mt-2"><input type="checkbox" name="remove_image" value="1"><span></span>&nbsp;@lang('site.remove_image')</label>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">@lang('site.save')</button>
                                    @if($editing)
                                        <a href="{{ route('admin.campaigns.updates.index', $campaign) }}" class="btn btn-light">@lang('site.cancel')</a>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- List --}}
                    <div class="col-lg-7">
                        <div class="card card-custom gutter-b">
                            <div class="card-header">
                                <div class="card-title"><h3 class="card-label">{{ $campaign->name }} — @lang('site.campaign_updates') ({{ $updates->count() }})</h3></div>
                            </div>
                            <div class="card-body">
                                @forelse($updates as $u)
                                    <div class="d-flex border-bottom py-4" style="gap:16px">
                                        @if($u->image)
                                            <img src="{{ asset('storage/campaign_updates/'.$u->image) }}" style="width:90px;height:70px;object-fit:cover;border-radius:6px">
                                        @endif
                                        <div class="flex-grow-1">
                                            <div class="text-muted font-size-sm" dir="ltr">{{ $u->published_at->format('d.m.Y') }}</div>
                                            <div class="font-weight-bold">{{ $u->title_tr }}</div>
                                            @if($u->title_ar)<div class="text-muted" dir="rtl">{{ $u->title_ar }}</div>@endif
                                        </div>
                                        <div class="text-nowrap">
                                            <a href="{{ route('admin.campaigns.updates.edit', [$campaign, $u]) }}" class="btn btn-sm btn-outline-primary">@lang('site.edit')</a>
                                            <form method="POST" action="{{ route('admin.campaigns.updates.destroy', [$campaign, $u]) }}" style="display:inline-block"
                                                  onsubmit="return confirm(@json(__('site.confirm_delete')))">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">@lang('site.delete')</button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted">@lang('site.no_updates_yet')</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
