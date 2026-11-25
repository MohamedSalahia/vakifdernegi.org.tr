@extends('emails._layout')
@section('body')
    <p>{{ __('site.mail_hello', ['name' => $donation->donor_name]) }}</p>
    <p>{{ __('site.mail_confirmed_intro', ['date' => optional($donation->confirmed_at)->format('d.m.Y')]) }}</p>
    <p>{{ __('site.mail_confirmed_receipt_note') }}</p>
    <p>{{ __('site.mail_thanks') }}</p>
@endsection
