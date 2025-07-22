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
         Schema::create('pengabdian', function (Blueprint $table) {
            $table->id();
            $table->string('kategori_kegiatan');
            $table->string('judul_kegiatan');
            $table->string('affiliasi');
            $table->string('kelompok_bidang')->nullable();
            $table->string('litabmas_sebelumnya')->nullable();
            $table->string('jenis_skim')->nullable();
            $table->string('lokasi_kegiatan')->nullable();
            $table->year('tahun_usulan');
            $table->year('tahun_kegiatan');
            $table->year('tahun_pelaksanaan');
            $table->integer('lama_kegiatan');
            $table->bigInteger('dana_dikti');
            $table->bigInteger('dana_pt');
            $table->bigInteger('dana_lain');
            $table->string('in_kind')->nullable();
            $table->string('nama_mitra')->nullable();
            $table->string('nomor_sk')->nullable();
            $table->date('tanggal_sk')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status',['pending','rejected','approved'])->default('pending');
            $table->text('review_notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengabdian');
    }
};
