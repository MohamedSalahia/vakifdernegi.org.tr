@php($assoc = config('association'))
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head><meta charset="utf-8"></head>
<body style="margin:0;padding:0;background:#f4f4f4;font-family:Arial,Helvetica,sans-serif;color:#333">
<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4;padding:24px 0">
    <tr><td align="center">
        <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;background:#fff;border-radius:8px;overflow:hidden">
            <tr><td style="background:#8a1f5c;color:#fff;padding:20px 28px;font-size:20px;font-weight:bold">{{ $assoc['legal_name'] }}</td></tr>
            <tr><td style="padding:28px;font-size:15px;line-height:1.7">
                @yield('body')

                <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse;margin:20px 0;font-size:14px">
                    <tr style="background:#f7f7f7"><td><strong>{{ __('site.reference_no') }}</strong></td><td dir="ltr" style="font-family:monospace;font-size:16px">{{ $donation->reference }}</td></tr>
                    @foreach($donation->items as $item)
                        <tr><td style="border-top:1px solid #eee">{{ $item->label }}</td><td dir="ltr" style="border-top:1px solid #eee">{{ number_format($item->amount, 2, ',', '.') }} TL</td></tr>
                    @endforeach
                    <tr style="background:#f7f7f7"><td><strong>{{ __('site.total') }}</strong></td><td dir="ltr"><strong>{{ number_format($donation->amount, 2, ',', '.') }} TL</strong></td></tr>
                </table>
            </td></tr>
            <tr><td style="background:#fafafa;padding:18px 28px;font-size:12px;color:#777;line-height:1.6;border-top:1px solid #eee">
                {{ $assoc['legal_name'] }} · {{ __('site.kutuk_no') }}: {{ $assoc['kutuk_no'] }} · {{ __('site.vergi_no') }}: {{ $assoc['vergi_no'] }}<br>
                {{ $assoc['address'][app()->getLocale()] ?? $assoc['address']['tr'] }}<br>
                {{ $assoc['email'] }} · <span dir="ltr">{{ $assoc['phone'] }}</span> · vakifdernegi.org.tr
            </td></tr>
        </table>
    </td></tr>
</table>
</body>
</html>
