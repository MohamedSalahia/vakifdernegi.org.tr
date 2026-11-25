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
        Schema::create('page_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('page_category_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name');
            $table->unique(['page_category_id', 'locale']);
            $table->foreign('page_category_id')->references('id')->on('page_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_category_translations');
    }
};
