@extends('layouts.web.app')
@section('page_title')@lang('site.cart')@endsection

@push('styles')
    @include('web.partials.donation_styles')
    <style>
        .cart-list .cart-row { display: flex; align-items: center; gap: 16px; padding: 14px 0; border-bottom: 1px solid #eee; flex-wrap: wrap; }
        .cart-list .cart-row:last-child { border-bottom: 0; }
        .cart-list .cart-name { flex: 1 1 240px; font-weight: 600; }
        .cart-list .cart-name small { display: block; color: #888; font-weight: normal; }
        .cart-list .cart-amount { display: flex; align-items: center; gap: 6px; }
        .cart-list .cart-amount input { width: 130px; text-align: center; }
        .cart-list .cart-remove { background: none; border: 0; color: #c0392b; font-size: 14px; cursor: pointer; }
        .cart-total-row { display: flex; justify-content: space-between; font-size: 22px; font-weight: 700; padding-top: 16px; }
    </style>
@endpush

@section('content')
    <section class="page-title" style="background-image:url({{url('/thumbnail/1920/900/80/storage/settings/'.setting('banner'))}})">
        <div class="auto-container">
            <div class="content-box">
                <h1>@lang('site.cart')</h1>
                <ul class="bread-crumb">
                    <li><a class="home" href="{{route('/')}}"><span class="fa fa-home"></span></a></li>
                    <li>@lang('site.cart')</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="donation-checkout">
        <div class="auto-container">
            @if($removed > 0)
                <div class="dc-note">@lang('site.cart_items_removed', ['count' => $removed])</div>
            @endif

            @if($items->isNotEmpty())
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="dc-card cart-list" id="cart-list">
                            <h3>@lang('site.cart_items_title')</h3>
                            @foreach($items as $item)
                                <div class="cart-row" data-id="{{ $item->id }}">
                                    <div class="cart-name">
                                        <a href="{{ route('campaign.show', [$item->campaign->id, make_slug($item->campaign->name)]) }}">{{ $item->campaign->name }}</a>
                                        <small>{{ $item->campaign->country }}</small>
                                    </div>
                                    <form class="cart-amount" onsubmit="return false;">
                                        <input type="number" class="form-control cart-amount-input" min="{{ \App\Support\DonationSettings::min() }}" step="1"
                                               value="{{ rtrim(rtrim(number_format($item->total_price, 2, '.', ''), '0'), '.') }}" aria-label="@lang('site.donation_amount')">
                                        <span>TL</span>
                                        <button type="button" class="theme-btn btn-style-one cart-save" style="padding:6px 14px"><span>@lang('site.save')</span></button>
                                    </form>
                                    <button type="button" class="cart-remove"><span class="flaticon-cross"></span> @lang('site.remove')</button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="dc-card">
                            <h3>@lang('site.donation_summary')</h3>
                            <div class="dc-row"><span>@lang('site.numbers_cart_items')</span><strong id="cart-count">{{ $items->count() }}</strong></div>
                            <div class="cart-total-row"><span>@lang('site.total')</span><span dir="ltr"><span id="cart-total">{{ number_format($total, 2, ',', '.') }}</span> TL</span></div>
                            <a href="{{ route('donate.cart') }}" class="theme-btn btn-style-one" style="margin-top:20px;display:block;text-align:center"><span>@lang('site.make_payment')</span></a>
                            <p class="dc-small" style="margin-top:12px">@lang('site.cart_checkout_hint')</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center" style="margin: 40px 0;">
                    <h3 style="margin-bottom:20px">@lang('site.nothing_in_cart')</h3>
                    <a href="{{ route('campaigns') }}" class="theme-btn btn-style-one"><span>@lang('site.campaigns')</span></a>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
<script>
    (function () {
        var list = document.getElementById('cart-list');
        if (!list) return;
        function fmt(n) { return Number(n).toLocaleString('tr-TR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }); }
        function refresh(body) {
            if (typeof body.total !== 'undefined') document.getElementById('cart-total').textContent = fmt(body.total);
            if (typeof body.count !== 'undefined') document.getElementById('cart-count').textContent = body.count;
            if (body.count === 0) location.reload();
        }
        list.addEventListener('click', function (e) {
            var row = e.target.closest('.cart-row');
            if (!row) return;
            var id = parseInt(row.dataset.id, 10);
            if (e.target.closest('.cart-save')) {
                vakifCart.update(id, row.querySelector('.cart-amount-input').value).then(refresh).catch(function () {});
            }
            if (e.target.closest('.cart-remove')) {
                vakifCart.remove(id).then(function (body) { row.remove(); refresh(body); }).catch(function () {});
            }
        });
    })();
</script>
@endpush
