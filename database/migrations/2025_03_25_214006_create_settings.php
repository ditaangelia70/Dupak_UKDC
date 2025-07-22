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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('hero_text');
            $table->string('hero_label');
            $table->string('video_hero');
            $table->text('about');
            $table->string('clients');
            $table->string('years');
            $table->string('projects');
            $table->string('address');
            $table->string('contact');
            $table->string('email');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('linkedin');
            $table->string('twitter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
