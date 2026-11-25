@extends('layouts.web.app')
@section('page_title')@lang('site.cart')@endsection

@section('content')
    <script src="{{asset('web/js/jquery.js')}}"></script>
    <!-- Page Title -->
    <section class="page-title" style="background-image:url({{url('/thumbnail/1920/900/80/storage/settings/'.setting('banner'))}})">
        <div class="auto-container">
            <div class="content-box">
                <h1>@lang('site.preview_cart')</h1>
                <ul class="bread-crumb">
                    <li><a class="home" href="{{route('/')}}"><span class="fa fa-home"></span></a></li>
                    <li>@lang('site.donation_campaign')</li>
                </ul>
            </div>
        </div>
    </section>

    <!--Cart section-->
    <section class="cart-area">
        <div class="auto-container">
            @if($userCarts->count())
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <ul class="total-item-info">
                        <li><span>@lang('site.numbers_cart_items'):</span> {{$userCarts->count()}}</li>
                        <li class="totalPrice"><span>@lang('site.total'):</span>{{$totalPrice}} @lang('site.kuveyt_dinari')</li>
                    </ul>
                    <div class="table-outer">
                        <table class="cart-table">
                            <thead class="cart-header">
                            <tr>
                                <th class="prod-column">@lang('site.campaign_name')</th>
                                <th class="hide-column"></th>
                                <th>@lang('site.quantity')</th>
                                <th class="price">@lang('site.price')</th>
                                <th>@lang('site.total')</th>
                                <th>@lang('site.remove')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userCarts as $userCart)
                                <tr>
                                    <td colspan="2" class="prod-column">
                                        <div class="column-box">

                                            <div class="title">
                                                <h3 class="prod-title">{{$userCart->campaign->name}}</h3>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="qty">
                                        <span>{{$userCart->quantity}}</span>
                                        {{--<input class="quantity-spinner quantity-spinner_{{$userCart->id}}" type="text" {{($userCart->status == 1) ? 'disabled':''}} value="{{$userCart->quantity}}" name="quantity">--}}
                                    </td>
                                    <td class="price">{{$userCart->price}} @lang('site.kuveyt_dinari')
                                        <input class="price_{{$userCart->id}}" type="hidden" value="{{$userCart->price}}">
                                    </td>
                                    <td class="sub-total sub-total_{{$userCart->id}}">{{$userCart->quantity * $userCart->price}}   @lang('site.kuveyt_dinari')
                                        <input class="total_{{$userCart->id}}" type="hidden" value="{{$userCart->quantity * $userCart->price}}">
                                    </td>

                                    <input type="hidden" class="userCartId_{{$userCart->id}}" value="{{$userCart->id}}">
                                    {{--<div class="remove_{{$userCart->id}}">
                                        <div class="checkbox">
                                            <span class="flaticon-cross"></span>
                                        </div>
                                    </div>--}}

                                    <td>
                                        <div class="remove delete_{{$userCart->id}}">
                                            <div class="checkbox">
                                                <span class="flaticon-cross"></span>
                                            </div>
                                        </div>
                                    </td>

                                </tr>

                                <script>

                                    $('.delete_{{$userCart->id}}').click(function () {
                                        var userCartId = $('.userCartId_{{$userCart->id}}').val();
                                        $.ajax({
                                            type: "get",
                                            url: '{{route('cart.remove')}}',
                                            data: {
                                                userCartId: userCartId,
                                            }
                                        }).success(function (data) {
                                            console.log(data)
                                            $('.item-count').empty().append(data.count);
                                            new Noty({
                                                text: data.message,
                                                timeout: 2000,
                                                killer: true,
                                                type: "alert",
                                                theme: 'semanticui',
                                                layout: 'bottomLeft'
                                            }).show();
                                            location.reload();
                                        });

                                    })

                                    // update quantity
                                    $('.quantity-spinner_{{$userCart->id}}').change(function (){
                                        var quantity = $('.quantity-spinner_{{$userCart->id}}').val();
                                        var userCartId = $('.userCartId_{{$userCart->id}}').val();
                                        var price = $('.price_{{$userCart->id}}').val();
                                        if({{$userCart->status}} != 1){
                                            $.ajax({
                                                type: "get",
                                                url: '{{route('cart.quantity.update')}}',
                                                data: {
                                                    userCartId: userCartId,
                                                    quantity: quantity,
                                                    price: price,
                                                }
                                            }).success(function (data) {
                                                var total = $('.price_{{$userCart->id}}').val() * $('.quantity-spinner_{{$userCart->id}}').val()
                                                $('.item-count').empty().append(data.count);
                                                $('.totalPrice').empty().append('<span>' + @json(__('site.total')) + ':</span> ' + data.totalPrice + ' ' + @json(__('site.kuveyt_dinari')));
                                                $('.sub-total_{{$userCart->id}}').empty().text('$'+total);
                                                new Noty({
                                                    text: data.message,
                                                    timeout: 2000,
                                                    killer: true,
                                                    type: "alert",
                                                    theme: 'semanticui',
                                                    layout: 'bottomLeft'
                                                }).show();
                                                //location.reload();
                                            });
                                        }
                                       else {
                                           alert('can not update');
                                        }
                                    })

                                    $( document ).ready(function() {
                                        var campaignTotal = $('.total_{{$userCart->id}}').val();

                                    });
                                </script>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                <div class="text-center" style="margin-top: 80px; ">

                    <a href="{{ route('donate.cart') }}" class="theme-btn btn-style-one"><span>@lang('site.make_payment')</span></a>
                </div>
            @else
            <div class="text-center" style="margin-top: 80px; ">
                <span>@lang('site.nothing_in_cart') :</span><br><br><br>
                <div class="link-btn">
                    <a href="{{route('/')}}" class="theme-btn btn-style-one"><span>@lang('site.return_to_home_page')</span></a>
                </div>
            </div>
            @endif
        </div>



    </section>

@endsection



