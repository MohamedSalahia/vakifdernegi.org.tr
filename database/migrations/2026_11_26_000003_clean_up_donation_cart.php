<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Cart clean-up after the cart rewrite (App\Services\CartService):
 * - removes rows that can never be shown or paid: non-positive amounts and guest rows
 *   created with the old random 2..50 "identifier" (shared between visitors)
 * - indexes the guest token column used by the new cart.
 */
return new class extends Migration
{
    public function up()
    {
        DB::table('user_carts')->where('total_price', '<=', 0)->delete();
        DB::table('user_carts')->whereNull('user_id')
            ->where(fn ($q) => $q->whereNull('cookie_cart_identifier')->orWhereRaw('CHAR_LENGTH(cookie_cart_identifier) < 36'))
            ->delete();
        DB::table('user_carts')->whereNotNull('user_id')->update(['cookie_cart_identifier' => null]);

        Schema::table('user_carts', function (Blueprint $table) {
            $table->index(['cookie_cart_identifier', 'status'], 'user_carts_token_status_index');
            $table->index(['user_id', 'status'], 'user_carts_user_status_index');
        });
    }

    public function down()
    {
        Schema::table('user_carts', function (Blueprint $table) {
            $table->dropIndex('user_carts_token_status_index');
            $table->dropIndex('user_carts_user_status_index');
        });
    }
};
