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
        Schema::create('home_section_items', function (Blueprint $table) {
            $table->id();   
            $table->unsignedBigInteger('playlist_categorie_id')->nullable();
            $table->unsignedBigInteger('podcast_categorie_id')->nullable();
            $table->unsignedBigInteger('playlist_music_id')->nullable();
            $table->unsignedBigInteger('podcast_id')->nullable();
            $table->unsignedBigInteger('event_id')->nullable();
            $table->unsignedBigInteger('home_section_id')->nullable();
            $table->string('status')->default('active');
            $table->string('type')->nullable();

            $table->timestamps();
            $table->foreign('playlist_categorie_id')->references('id')->on('playlist_categories')->onDelete('set null');
            $table->foreign('podcast_categorie_id')->references('id')->on('podcast_categories')->onDelete('set null');
            $table->foreign('playlist_music_id')->references('id')->on('playlist_music')->onDelete('set null');
            $table->foreign('podcast_id')->references('id')->on('podcasts')->onDelete('set null');
            $table->foreign('event_id')->references('id')->on('event_homes')->onDelete('set null');
            $table->foreign('home_section_id')->references('id')->on('home_sections')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('home_section_items');
    }
};
