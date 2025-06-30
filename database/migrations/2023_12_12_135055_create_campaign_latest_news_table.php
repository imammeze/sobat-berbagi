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
        Schema::create('campaign_latest_news', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('campaign_id');
            $table->date('date');
            $table->string('title');
            $table->longText('content');
            $table->foreign('campaign_id')->references('id')->on('campaigns')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_latest_news');
    }
};
