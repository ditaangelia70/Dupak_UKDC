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
        Schema::create('pengabdian_anggota_dosen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengabdian_id')->constrained('pengabdian')->onDelete('cascade');
            $table->string('nama_dosen');
            $table->string('peran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengabdian_anggota_dosen');
    }
};
