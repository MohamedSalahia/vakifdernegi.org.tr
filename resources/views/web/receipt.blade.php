@php($assoc = config('association'))
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>@lang('site.receipt_title') — {{ $donation->reference }}</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; color: #222; background: #f4f4f4; margin: 0; padding: 30px 12px; }
        .sheet { max-width: 760px; margin: 0 auto; background: #fff; padding: 36px; border-radius: 8px; }
        .head { display: flex; justify-content: space-between; align-items: flex-start; gap: 20px; border-bottom: 3px solid #8a1f5c; padding-bottom: 16px; margin-bottom: 22px; }
        .head h1 { font-size: 22px; margin: 0 0 6px; color: #8a1f5c; }
        .muted { color: #666; font-size: 13px; line-height: 1.6; }
        table { width: 100%; border-collapse: collapse; margin: 18px 0; }
        th, td { padding: 10px; border-bottom: 1px solid #eee; text-align: start; }
        th { background: #fafafa; }
        .total td { font-weight: bold; font-size: 17px; }
        .note { background: #f7f7f7; padding: 12px 14px; border-radius: 6px; font-size: 13px; color: #555; }
        .actions { text-align: center; margin: 20px 0 0; }
        .actions button { background: #8a1f5c; color: #fff; border: 0; padding: 10px 24px; border-radius: 6px; font-size: 15px; cursor: pointer; }
        @media print { body { background: #fff; padding: 0; } .sheet { box-shadow: none; padding: 0; } .actions { display: none; } }
    </style>
</head>
<body>
<div class="sheet">
    <div class="head">
        <div>
            <h1>{{ $assoc['legal_name'] }}</h1>
            <div class="muted">{{ $assoc['address'][app()->getLocale()] ?? $assoc['address']['tr'] }}<br>
                @lang('site.kutuk_no'): {{ $assoc['kutuk_no'] }} · @lang('site.vergi_no'): {{ $assoc['vergi_no'] }} · @lang('site.mersis_no'): {{ $assoc['mersis_no'] }}<br>
                {{ $assoc['email'] }} · <span dir="ltr">{{ $assoc['phone'] }}</span></div>
        </div>
        <div style="text-align:end">
            <strong style="font-size:18px">@lang('site.receipt_title')</strong>
            <div class="muted" dir="ltr">{{ $donation->reference }}</div>
        </div>
    </div>

    <table>
        <tr><th style="width:40%">@lang('site.full_name')</th><td>{{ $donation->donor_name }}</td></tr>
        <tr><th>@lang('site.donation_date')</th><td dir="ltr">{{ $donation->created_at->format('d.m.Y') }}</td></tr>
        <tr><th>@lang('site.confirmed_at')</th><td dir="ltr">{{ optional($donation->confirmed_at)->format('d.m.Y') }}</td></tr>
        <tr><th>@lang('site.payment_method')</th><td>@lang('site.payment_method_'.$donation->payment_method)</td></tr>
        @if($donation->is_zakat)<tr><th>@lang('site.donation_type')</th><td>@lang('site.zakat_type')</td></tr>@endif
        @if($donation->dedicationText())<tr><th>@lang('site.dedication')</th><td>{{ $donation->dedicationText() }}</td></tr>@endif
    </table>

    <table>
        <thead><tr><th>@lang('site.donation_item')</th><th style="text-align:end">@lang('site.price')</th></tr></thead>
        <tbody>
        @foreach($donation->items as $item)
            <tr><td>{{ $item->label }}</td><td style="text-align:end" dir="ltr">{{ number_format($item->amount, 2, ',', '.') }} TL</td></tr>
        @endforeach
        <tr class="total"><td>@lang('site.total')</td><td style="text-align:end" dir="ltr">{{ number_format($donation->amount, 2, ',', '.') }} TL</td></tr>
        </tbody>
    </table>

    <p class="note">@lang('site.receipt_note')</p>
    <p class="muted" style="text-align:center;margin-top:24px">@lang('site.receipt_thanks')</p>

    <div class="actions"><button onclick="window.print()">@lang('site.print_or_pdf')</button></div>
</div>
</body>
</html>
