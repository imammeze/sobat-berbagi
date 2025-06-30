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
        Schema::table('campaigns', function (Blueprint $table) {
            // Ubah sementara ke nullable agar tidak error saat modifikasi
            $table->decimal('fixed_amount', 15, 2)->nullable()->change();
        });

        // Konversi data fixed_amount ke string agar tidak error saat alter column
        DB::statement('UPDATE campaigns SET fixed_amount = CAST(fixed_amount AS CHAR)');

        Schema::table('campaigns', function (Blueprint $table) {
            // Ubah tipe data menjadi VARCHAR
            $table->string('fixed_amount', 255)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('campaigns', function (Blueprint $table) {
            // Ubah kembali ke decimal jika rollback
            $table->decimal('fixed_amount', 15, 2)->nullable()->change();
        });

        // Pastikan data tetap numerik
        DB::statement('UPDATE campaigns SET fixed_amount = CAST(fixed_amount AS DECIMAL(15,2))');
    }
};
