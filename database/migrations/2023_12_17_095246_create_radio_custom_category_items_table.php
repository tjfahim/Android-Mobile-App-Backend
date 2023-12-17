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
        Schema::create('radio_custom_category_items', function (Blueprint $table) {
            $table->id();   
            $table->unsignedBigInteger('playlist_music_id')->nullable();
            $table->unsignedBigInteger('podcast_id')->nullable();
            $table->unsignedBigInteger('radio_custom_categorie_id')->nullable();

            $table->timestamps();
            $table->foreign('playlist_music_id')->references('id')->on('playlist_music')->onDelete('set null');
            $table->foreign('podcast_id')->references('id')->on('podcasts')->onDelete('set null');
            $table->foreign('radio_custom_categorie_id')->references('id')->on('radio_custom_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('radio_custom_category_items');
    }
};
