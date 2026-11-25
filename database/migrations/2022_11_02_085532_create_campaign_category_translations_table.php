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
        Schema::create('campaign_category_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('c_category_id')->unsigned();
            $table->string('locale')->index();
            $table->string('name');
            $table->unique(['c_category_id', 'locale']);
            $table->foreign('c_category_id')->references('id')->on('campaign_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_category_translations');
    }
};
