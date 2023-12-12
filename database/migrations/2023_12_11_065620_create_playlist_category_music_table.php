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
        Schema::create('playlist_category_music', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('playlist_category_id');
            $table->unsignedBigInteger('playlist_music_id');
            $table->timestamps();

            $table->foreign('playlist_category_id')->references('id')->on('playlist_categories')->onDelete('cascade');
            $table->foreign('playlist_music_id')->references('id')->on('playlist_music')->onDelete('cascade');

            $table->unique(['playlist_category_id', 'playlist_music_id'], 'unique_playlist_category_music');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playlist_category_music');
    }
};
