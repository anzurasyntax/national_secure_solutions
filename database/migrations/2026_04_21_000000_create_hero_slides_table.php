<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('image_path');
            $table->string('tagline')->nullable();
            $table->text('headline');
            $table->string('subtitle')->nullable();
            $table->string('button_label')->default('Get Inquiry');
            $table->string('button_url')->default('#');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_slides');
    }
};
