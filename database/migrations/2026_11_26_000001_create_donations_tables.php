<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Donation requests made on the site.
 * One donation (reference, donor, payment method, status) has one or more items
 * (a campaign or a zakat/sadaka type, with an amount).
 * Status flow: pending -> confirmed (money received, set by an admin) or cancelled.
 */
return new class extends Migration
{
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 20)->unique();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->decimal('amount', 12, 2);
            $table->string('currency', 3)->default('TRY');
            $table->string('donor_name', 100);
            $table->string('donor_email', 150)->nullable();
            $table->string('donor_phone', 30)->nullable();
            $table->string('payment_method', 20)->default('bank_transfer'); // bank_transfer | card
            $table->string('status', 20)->default('pending')->index();      // pending | confirmed | cancelled
            $table->string('locale', 5)->default('tr');
            $table->timestamp('kvkk_accepted_at')->nullable();
            $table->string('ip', 45)->nullable();
            $table->text('admin_note')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->foreignId('confirmed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();
        });

        Schema::create('donation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donation_id')->constrained('donations')->cascadeOnDelete();
            $table->foreignId('campaign_id')->nullable()->constrained('campaigns')->nullOnDelete();
            $table->string('donation_type', 30)->default('campaign'); // campaign | sadaka | zakat | kfaratYamin | kfaratSiyam | nzr
            $table->string('label', 255);                              // campaign name / type at the time of donation
            $table->decimal('amount', 12, 2);
            $table->timestamps();

            $table->index(['campaign_id', 'donation_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('donation_items');
        Schema::dropIfExists('donations');
    }
};
