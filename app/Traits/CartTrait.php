<?php

namespace App\Traits;

use App\Models\UserCart;
use Auth;

trait CartTrait
{
    public static function cartCount($request){
        //dd($request->cookie('XSRF-TOKEN'));
       //return  Auth::check() ?  UserCart::query()->where('XSRF_TOKEN', $request->cookie('XSRF-TOKEN'))->where('status',0)->count() : null;
       return UserCart::query()->where('cookie_cart_identifier', $request->cookie('XSRF-TOKEN'))->where('status',0)->count();

    }
}
