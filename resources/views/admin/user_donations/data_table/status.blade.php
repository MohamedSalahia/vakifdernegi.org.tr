@php($colors = ['pending' => 'warning', 'confirmed' => 'success', 'cancelled' => 'dark'])
<span class="label label-light-{{ $colors[$status] ?? 'dark' }} label-lg label-inline label-bold">@lang('site.donation_status_' . $status)</span>
