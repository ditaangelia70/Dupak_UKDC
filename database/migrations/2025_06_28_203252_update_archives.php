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
        Schema::table('archives', function (Blueprint $table) {
            $table->dropForeign(['criteria_id']);
            $table->foreignId('sub_sub_criteria_id')->constrained('sub_sub_criteria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('archives', function (Blueprint $table) {
            $table->dropForeign(['sub_sub_criteria_id']);
            $table->foreignId('criteria_id')->constrained('criteria')->onDelete('cascade');
        });
    }
};
