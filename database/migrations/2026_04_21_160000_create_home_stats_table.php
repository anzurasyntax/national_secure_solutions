<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('position')->unique();
            $table->string('heading');
            $table->unsignedInteger('value');
            $table->string('suffix', 10)->default('');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_stats');
    }
};
