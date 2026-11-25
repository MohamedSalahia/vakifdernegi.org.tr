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
        Schema::create('campaign_translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_slug');
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('keywords')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('country')->nullable();
            $table->longText('description');
            $table->string('locale')->index();
            $table->bigInteger('campaign_id')->unsigned();
            $table->unique(['campaign_id', 'locale']);
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
            //$table->foreignId('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaign_translations');
    }
};
