<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Transparency & trust (all managed from the admin panel):
 * - expenses: money spent (optionally per campaign) shown on the transparency page
 * - annual_reports: yearly activity/financial reports (PDF)
 * - faqs: help centre questions (TR + optional AR), seeded with initial questions
 */
return new class extends Migration
{
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->nullable()->constrained('campaigns')->nullOnDelete();
            $table->date('spent_at');
            $table->decimal('amount', 12, 2);
            $table->string('title_tr', 255);
            $table->string('title_ar', 255)->nullable();
            $table->text('description_tr')->nullable();
            $table->text('description_ar')->nullable();
            $table->string('document')->nullable(); // public proof (image/PDF), optional
            $table->boolean('is_public')->default(true);
            $table->timestamps();
            $table->index(['is_public', 'spent_at']);
        });

        Schema::create('annual_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('year');
            $table->string('title_tr', 255);
            $table->string('title_ar', 255)->nullable();
            $table->string('file');
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('category', 30)->default('general'); // donation | zakat | payment | general
            $table->string('question_tr', 500);
            $table->string('question_ar', 500)->nullable();
            $table->text('answer_tr');
            $table->text('answer_ar')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        DB::table('faqs')->insert(array_map(fn ($f) => $f + ['is_active' => true, 'created_at' => now(), 'updated_at' => now()], require database_path('content/faqs_2026_11.php')));
    }

    public function down()
    {
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('annual_reports');
        Schema::dropIfExists('expenses');
    }
};
