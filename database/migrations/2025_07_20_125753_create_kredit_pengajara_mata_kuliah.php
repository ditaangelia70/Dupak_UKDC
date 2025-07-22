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
        Schema::create('kredit_pengajaran_mata_kuliah', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jabatan_id')->constrained('jabatan')->onDelete('cascade');
            $table->foreignId('jurusan_id')->constrained('program_studi')->onDelete('cascade');
            $table->string('name');
            $table->float('credit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kredit_pengajara_mata_kuliah');
    }
};
