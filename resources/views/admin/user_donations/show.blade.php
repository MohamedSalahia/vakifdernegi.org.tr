@extends('layouts.admin.app')
@section('content')
    @php($colors = ['pending' => 'warning', 'confirmed' => 'success', 'cancelled' => 'dark'])
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">@lang('site.user_donations')</h5>
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm mr-4">
                        <li class="breadcrumb-item"><a href="{{ route('admin.user_donations.index') }}" class="text-muted">@lang('site.user_donations')</a></li>
                        <li class="breadcrumb-item"><span class="text-muted" dir="ltr">{{ $donation->reference }}</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column-fluid">
            <div class="container">
                @include('admin.partials._session')
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card card-custom gutter-b">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label" dir="ltr">{{ $donation->reference }}</h3>
                                    <span class="label label-light-{{ $colors[$donation->status] ?? 'dark' }} label-lg label-inline label-bold">@lang('site.donation_status_' . $donation->status)</span>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tr><th style="width:40%">@lang('site.full_name')</th><td>{{ $donation->donor_name }}</td></tr>
                                    <tr><th>@lang('site.email')</th><td>@if($donation->donor_email)<a href="mailto:{{ $donation->donor_email }}">{{ $donation->donor_email }}</a>@else — @endif</td></tr>
                                    <tr><th>@lang('site.phone')</th><td dir="ltr">{{ $donation->donor_phone ?: '—' }}</td></tr>
                                    <tr><th>@lang('site.payment_method')</th><td>@lang('site.payment_method_' . $donation->payment_method)</td></tr>
                                    <tr><th>@lang('site.donation_date')</th><td dir="ltr">{{ $donation->created_at->format('Y-m-d H:i') }}</td></tr>
                                    <tr><th>@lang('site.kvkk_accepted_at')</th><td dir="ltr">{{ optional($donation->kvkk_accepted_at)->format('Y-m-d H:i') ?: '—' }}</td></tr>
                                    @if($donation->confirmed_at)
                                        <tr><th>@lang('site.confirmed_at')</th><td dir="ltr">{{ $donation->confirmed_at->format('Y-m-d H:i') }} ({{ optional($donation->confirmer)->name }})</td></tr>
                                    @endif
                                    @if($donation->cancelled_at)
                                        <tr><th>@lang('site.cancelled_at')</th><td dir="ltr">{{ $donation->cancelled_at->format('Y-m-d H:i') }}</td></tr>
                                    @endif
                                </table>

                                <h5 class="mt-6 mb-3">@lang('site.donation_items')</h5>
                                <table class="table table-bordered">
                                    <thead><tr><th>@lang('site.campaign_name')</th><th>@lang('site.donation_type')</th><th>@lang('site.price')</th></tr></thead>
                                    <tbody>
                                    @foreach($donation->items as $item)
                                        <tr>
                                            <td>{{ $item->label }}</td>
                                            <td>{{ \App\Http\Controllers\DonationController::typeLabel($item->donation_type) }}</td>
                                            <td dir="ltr">{{ number_format($item->amount, 2, ',', '.') }} TL</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot><tr><th colspan="2">@lang('site.total')</th><th dir="ltr">{{ number_format($donation->amount, 2, ',', '.') }} TL</th></tr></tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="card card-custom gutter-b">
                            <div class="card-header"><div class="card-title"><h3 class="card-label">@lang('site.actions')</h3></div></div>
                            <div class="card-body">
                                @if($donation->status === \App\Models\Donation::PENDING && auth()->user()->hasPermission('update_user_donations'))
                                    <p class="text-muted">@lang('site.confirm_donation_help', ['ref' => $donation->reference])</p>
                                    <form method="POST" action="{{ route('admin.user_donations.confirm', $donation) }}" class="mb-4"
                                          onsubmit="return confirm(@json(__('site.confirm_donation_question')))">
                                        @csrf
                                        <textarea name="admin_note" class="form-control mb-3" rows="2" placeholder="@lang('site.admin_note')">{{ $donation->admin_note }}</textarea>
                                        <button type="submit" class="btn btn-success btn-block">@lang('site.confirm_donation')</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.user_donations.cancel', $donation) }}"
                                          onsubmit="return confirm(@json(__('site.cancel_donation_question')))">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-block">@lang('site.cancel_donation')</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('admin.user_donations.note', $donation) }}">
                                        @csrf
                                        <label>@lang('site.admin_note')</label>
                                        <textarea name="admin_note" class="form-control mb-3" rows="3">{{ $donation->admin_note }}</textarea>
                                        <button type="submit" class="btn btn-primary">@lang('site.save')</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
