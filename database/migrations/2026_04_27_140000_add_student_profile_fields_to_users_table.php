<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->string('username')->nullable()->unique()->after('email');
            $table->string('first_name')->nullable()->after('name');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('phone', 40)->nullable()->after('last_name');
            $table->string('skill_occupation')->nullable()->after('phone');
            $table->text('bio')->nullable()->after('skill_occupation');
            $table->string('timezone', 64)->nullable()->after('bio');
            $table->string('public_display_name')->nullable()->after('timezone');
            $table->string('avatar_path')->nullable()->after('public_display_name');
            $table->string('cover_path')->nullable()->after('avatar_path');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn([
                'username',
                'first_name',
                'last_name',
                'phone',
                'skill_occupation',
                'bio',
                'timezone',
                'public_display_name',
                'avatar_path',
                'cover_path',
            ]);
        });
    }
};
