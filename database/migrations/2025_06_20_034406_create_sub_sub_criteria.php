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
        Schema::create('sub_sub_criteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_criteria_id')->constrained('sub_criteria')->onDelete('cascade');
            $table->string('name');
            $table->string('unit');
            $table->float('credit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_sub_criteria');
    }
};
