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
        Schema::create('publikasi_karya_anggota_dosen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publikasi_karya_id')->constrained('publikasi_karya')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->nullable()->onDelete('cascade');
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
        Schema::dropIfExists('publikasi_karya_anggota_dosen');
    }
};
