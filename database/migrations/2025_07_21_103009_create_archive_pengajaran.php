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
        Schema::create('archive_pengajaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajaran_id')->constrained('credit_pengajaran')->onDelete('cascade');
            $table->string('path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archive_pengajaran');
    }
};
