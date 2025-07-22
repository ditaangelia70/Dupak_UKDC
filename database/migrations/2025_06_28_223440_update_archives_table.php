<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('archives', function (Blueprint $table) {
            $table->text('comment')->nullable();
            $table->foreignId('commentator_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->dateTime('commented_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('archives', function (Blueprint $table) {
            $table->dropForeign(['commentator_id']);
            $table->dropColumn(['comment', 'commentator_id', 'commented_at']);
        });
    }
};
