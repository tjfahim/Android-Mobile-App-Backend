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
            $table->string('title')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('app_topber_logo')->nullable();
            $table->string('whats_app_logo')->nullable();
            $table->string('phone_logo')->nullable();
            $table->string('menu_bar_background')->nullable();
            $table->string('whats_app')->nullable();
            $table->string('phone')->nullable();
            $table->text('playstore_share_link')->nullable();
            $table->text('appstore_share_link')->nullable();
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
