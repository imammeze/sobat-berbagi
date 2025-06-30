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
        Schema::create('sacrificial_transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('sacrificial_name');
            $table->string('sacrificial_type')->nullable();
            $table->uuid('user_id');
            $table->uuid('payment_method_id')->default('qris')->nullable();
            $table->string('proof')->nullable();
            $table->string('qr_code')->nullable();
            $table->string('invoice_id')->nullable();
            $table->integer('amount');
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sacrificial_transactions');
    }
};
