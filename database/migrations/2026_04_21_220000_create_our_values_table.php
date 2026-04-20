<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('our_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('eyebrow');
            $table->string('line1');
            $table->string('line2');
            $table->text('image_path');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('our_values');
    }
};
