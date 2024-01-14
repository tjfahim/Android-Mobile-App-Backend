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
        Schema::create('podcasts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('podcast_category_id');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('audio')->nullable();
            $table->text('audio_link')->nullable();
            $table->string('image')->nullable();
            $table->integer('android_listener')->default(0);
            $table->integer('ios_listener')->default(0);
            $table->integer('connected_user')->default(0);
            $table->string('status')->default('active');

            $table->timestamps();

            $table->foreign('podcast_category_id')->references('id')->on('podcast_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podcasts');
    }
};
