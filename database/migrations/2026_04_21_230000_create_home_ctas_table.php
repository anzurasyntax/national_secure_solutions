<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_ctas', function (Blueprint $table) {
            $table->id();
            $table->string('headline');
            $table->text('subheading');
            $table->string('button_label');
            $table->string('button_url', 2048)->default('#');
            $table->string('background_color', 32)->default('#070E20');
            $table->string('background_image_path')->default('img/stat_bg.png');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_ctas');
    }
};
