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
            $table->unsignedBigInteger('podcast_id')->nullable();
            $table->unsignedBigInteger('home_section_id')->nullable();
            $table->string('status')->default('active');
            $table->string('type')->nullable();

            $table->timestamps();
            $table->foreign('podcast_id')->references('id')->on('podcasts')->onDelete('set null');
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
