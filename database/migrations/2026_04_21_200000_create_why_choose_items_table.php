<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('why_choose_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('position')->unique();
            $table->string('title');
            $table->text('description');
            $table->string('icon_path');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('why_choose_items');
    }
};
