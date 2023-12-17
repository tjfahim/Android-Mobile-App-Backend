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
        Schema::create('radio_custom_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('radio_id')->nullable();

            $table->string('image')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();
            $table->foreign('radio_id')->references('id')->on('radios')->onDelete('set null');


            // Define foreign key constraints
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('radio_custom_categories');
    }
};
