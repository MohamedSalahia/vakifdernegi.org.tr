<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Donation options chosen at checkout:
 * - dedication: donate in memory of someone (deceased) or on behalf of someone (living)
 * - is_zakat: the donor intends this donation as zakat (only for zakat-eligible campaigns / zakat page)
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->string('dedication_type', 10)->nullable()->after('show_name'); // memory | honor
            $table->string('dedication_name', 100)->nullable()->after('dedication_type');
            $table->boolean('is_zakat')->default(false)->after('dedication_name');
        });
    }

    public function down()
    {
        Schema::table('donations', fn (Blueprint $table) => $table->dropColumn(['dedication_type', 'dedication_name', 'is_zakat']));
    }
};
