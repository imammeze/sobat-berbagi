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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('campaign_category_id');
            $table->uuid('mitra_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('thumbnail');
            $table->longText('story');
            $table->string('target');
            $table->string('raised')->default(0);
            $table->date('end_date');
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->foreign('campaign_category_id')->references('id')->on('campaign_categories')->onDelete('cascade');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
