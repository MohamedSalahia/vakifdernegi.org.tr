@php($assoc = config('association'))
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head><meta charset="utf-8"></head>
<body style="margin:0;padding:24px 0;background:#f4f4f4;font-family:Arial,Helvetica,sans-serif;color:#333">
<table width="100%" cellpadding="0" cellspacing="0"><tr><td align="center">
    <table width="520" cellpadding="0" cellspacing="0" style="max-width:520px;background:#fff;border-radius:8px;overflow:hidden">
        <tr><td style="background:#8a1f5c;color:#fff;padding:18px 26px;font-size:18px;font-weight:bold">{{ $assoc['legal_name'] }}</td></tr>
        <tr><td style="padding:28px 26px;font-size:15px;line-height:1.7;text-align:center">
            <p>{{ __('site.login_code_intro') }}</p>
            <div style="font-size:34px;letter-spacing:8px;font-weight:bold;font-family:monospace;margin:18px 0" dir="ltr">{{ $code }}</div>
            <p style="color:#777;font-size:13px">{{ __('site.login_code_expiry', ['minutes' => \App\Models\LoginCode::TTL_MINUTES]) }}</p>
            <p style="color:#777;font-size:13px">{{ __('site.login_code_ignore') }}</p>
        </td></tr>
    </table>
</td></tr></table>
</body>
</html>
