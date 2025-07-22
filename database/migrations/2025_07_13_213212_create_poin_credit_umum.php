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
        Schema::create('poin_credit_umum', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('credit');
            $table->enum('type',['penelitian','pengabdian'])->default('penelitian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poin_credit_umum');
    }
};
