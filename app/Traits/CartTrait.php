<?php

namespace App\Traits;

use App\Services\CartService;

/** Kept for older callers; the cart logic lives in App\Services\CartService. */
trait CartTrait
{
    public static function cartCount($request = null): int
    {
        return app(CartService::class)->count();
    }
}
