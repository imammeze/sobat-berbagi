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
        Schema::create('article_article_category', function (Blueprint $table) {
            $table->id();
            $table->uuid('article_id');
            $table->uuid('article_category_id');
            $table->foreign('article_id')->references('id')->on('articles')->cascadeOnDelete();
            $table->foreign('article_category_id')->references('id')->on('article_categories')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_article_category');
    }
};
