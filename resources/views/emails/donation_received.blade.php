@extends('emails._layout')
@section('body')
    <p>{{ __('site.mail_hello', ['name' => $donation->donor_name]) }}</p>
    <p>{{ __('site.mail_received_intro') }}</p>
    <p><strong>{{ __('site.pay_by_bank_transfer') }}</strong></p>
    <ol>
        <li>{{ __('site.transfer_step_1', ['amount' => number_format($donation->amount, 2, ',', '.') . ' TL']) }}</li>
        <li>{{ __('site.transfer_step_2', ['name' => config('association.legal_name')]) }}</li>
        <li>{{ __('site.transfer_step_3') }} <strong>{{ $donation->reference }}</strong></li>
        <li>{{ __('site.transfer_step_4') }}</li>
    </ol>
    @php($bank = \App\Models\Page::query()->find(5))
    @if($bank && config('donation.bank_transfer_enabled'))
        <div style="font-size:14px">{!! $bank->description !!}</div>
    @endif
@endsection
