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
        Schema::table('articles', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('article_categories', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('article_tags', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('banners', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('campaigns', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('campaign_categories', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('campaign_donations', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('campaign_images', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('campaign_latest_news', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('donaturs', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('faqs', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('faq_categories', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('mitras', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('payment_methods', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('teams', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('zakat_transactions', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
