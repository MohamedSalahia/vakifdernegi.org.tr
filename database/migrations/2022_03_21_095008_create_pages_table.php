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
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_category_id')->nullable()->unsigned();
            $table->foreign('page_category_id')->references('id')->on('page_categories')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->boolean('header_show')->nullable();
            $table->boolean('special')->nullable();
            $table->boolean('locked')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
};
