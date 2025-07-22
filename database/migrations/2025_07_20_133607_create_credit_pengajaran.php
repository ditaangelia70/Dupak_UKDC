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
        Schema::create('credit_pengajaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kredit_pengajaran_mata_kuliah_id')->constrained('kredit_pengajaran_mata_kuliah')->onDelete('cascade');
            $table->foreignId('jurusan_id')->constrained('program_studi')->onDelete('cascade');
            $table->integer('sks');
            $table->enum('type',['10 SKS Pertama','2 SKS Berikutnya'])->default('10 SKS Pertama');
            $table->string('tahun_ajaran');
            $table->enum('kelompok',['Mandiri','Tim'])->default('Mandiri');
            $table->enum('semester',['gasal','genap'])->default('gasal');
            $table->enum('status',['pending','approved','rejected'])->default('pending');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_pengajaran');
    }
};
