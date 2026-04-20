<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();

            $table->string('hero_image_path')->default('img/about_us.jpg');

            $table->string('brand_title');
            $table->text('brand_intro');
            $table->string('mission_title');
            $table->text('mission_body');
            $table->string('vision_title');
            $table->text('vision_body');

            $table->string('memberships_heading');
            $table->text('memberships_body');
            $table->string('leadership_heading');
            $table->text('leadership_body');

            $table->text('statement_heading');
            $table->text('statement_list');
            $table->text('statement_footer');

            $table->string('founder_heading');
            $table->string('founder_subtitle');
            $table->text('founder_body');

            $table->string('chairman_heading');
            $table->string('chairman_subtitle');
            $table->text('chairman_body');

            $table->string('president_heading');
            $table->string('president_subtitle');
            $table->text('president_body');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};
