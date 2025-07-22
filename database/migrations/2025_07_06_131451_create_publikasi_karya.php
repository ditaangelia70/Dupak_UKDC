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
        Schema::create('publikasi_karya', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            for ($i = 1; $i <= 13; $i++) {
                $table->boolean("pk_$i")->default(false);
            }

            $table->string('jenis_publikasi');
            $table->string('kategori_capaian')->nullable();
            $table->string('aktivitas_litabmas')->nullable();

            $table->string('judul_artikel');
            $table->string('nama_seminar')->nullable();
            $table->date('tanggal_terbit');
            $table->string('penerbit_penyelenggara');
            $table->string('kota_penyelenggaraan')->nullable();

            $table->boolean('seminar')->default(false);
            $table->boolean('prosiding')->default(false);

            $table->string('bahasa')->nullable();
            $table->string('isbn')->nullable();
            $table->string('issn')->nullable();
            $table->string('e_issn')->nullable();
            $table->string('tautan_eksternal')->nullable();
            $table->text('keterangan')->nullable();

            $table->enum('status',['pending','rejected','approved'])->default('pending');
            $table->text('review_notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publikasi_karya');
    }
};
