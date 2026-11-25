<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_carts', function (Blueprint $table) {
            $table->id();
            /*$table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');*/
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->string('cookie_cart_identifier')->nullable();
            $table->foreignId('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
            $table->float('price');
            $table->float('total_price');
            $table->boolean('status');
            //$table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_carts');
    }
};
