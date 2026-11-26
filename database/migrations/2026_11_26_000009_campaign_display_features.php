<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Campaign display features (all managed from the admin panel):
 * - campaigns: urgent badge, zakat-eligible badge, public donors tab, share counter
 * - campaign_updates: news/progress posts shown in the campaign's "Updates" tab
 * - donations.show_name: donor's consent to appear by name in the donors list
 *   (default: shown as "Hayırsever / فاعل خير")
 */
return new class extends Migration
{
    public function up()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->boolean('is_urgent')->default(false)->after('show_in_slider');
            $table->boolean('accepts_zakat')->default(false)->after('is_urgent');
            $table->boolean('show_donors')->default(true)->after('accepts_zakat');
            $table->unsignedInteger('share_count')->default(0)->after('show_donors');
        });

        Schema::create('campaign_updates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained('campaigns')->cascadeOnDelete();
            $table->string('title_tr', 255);
            $table->string('title_ar', 255)->nullable();
            $table->text('body_tr');
            $table->text('body_ar')->nullable();
            $table->string('image')->nullable();
            $table->date('published_at');
            $table->timestamps();
            $table->index(['campaign_id', 'published_at']);
        });

        Schema::table('donations', function (Blueprint $table) {
            $table->boolean('show_name')->default(false)->after('donor_phone');
        });
    }

    public function down()
    {
        Schema::table('donations', fn (Blueprint $table) => $table->dropColumn('show_name'));
        Schema::dropIfExists('campaign_updates');
        Schema::table('campaigns', fn (Blueprint $table) => $table->dropColumn(['is_urgent', 'accepts_zakat', 'show_donors', 'share_count']));
    }
};
