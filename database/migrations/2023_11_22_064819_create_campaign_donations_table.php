<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('campaign_donations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('campaign_id');
            $table->uuid('user_id');
            $table->uuid('payment_method_id')->default('qris')->nullable();
            $table->string('proof')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('invoice_id')->nullable();
            $table->boolean('is_anonymous')->default(false);
            $table->integer('amount');
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->longText('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_donations');
    }
};
