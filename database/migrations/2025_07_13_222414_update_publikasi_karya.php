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
        Schema::table('publikasi_karya', function (Blueprint $table) {
            $table->dropColumn(['jenis_publikasi', 'kategori_capaian']);
            // $table->foreignId('jenis_publikasi')->constrained('poin_credit_jenis')->onDelete('cascade')->nullable();
            // $table->foreignId('kategori_capaian')->constrained('poin_credit_capaian')->onDelete('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('publikasi_karya', function (Blueprint $table) {
            $table->string('jenis_publikasi')->nullable();
            $table->string('kategori_capaian')->nullable();
        });
    }
};
