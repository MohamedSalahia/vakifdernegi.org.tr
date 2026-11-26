<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** One-time e-mail sign-in codes (only a keyed hash is stored). */
return new class extends Migration
{
    public function up()
    {
        Schema::create('login_codes', function (Blueprint $table) {
            $table->id();
            $table->string('email', 150)->index();
            $table->string('code_hash', 64);
            $table->unsignedTinyInteger('attempts')->default(0);
            $table->timestamp('expires_at');
            $table->timestamp('used_at')->nullable();
            $table->string('ip', 45)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('login_codes');
    }
};
