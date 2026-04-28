<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table): void {
            $table->json('categories')->nullable()->after('description');
            $table->json('learning_outcomes')->nullable()->after('categories');
            $table->json('faq_sections')->nullable()->after('learning_outcomes');
            $table->json('material_includes')->nullable()->after('faq_sections');
            $table->json('requirements_list')->nullable()->after('material_includes');
            $table->text('audience')->nullable()->after('requirements_list');
            $table->string('level_label', 120)->nullable()->after('audience');
            $table->date('detail_last_updated_at')->nullable()->after('level_label');
        });

        Schema::table('course_modules', function (Blueprint $table): void {
            $table->unsignedSmallInteger('duration_minutes')->nullable()->after('title');
            $table->json('lesson_outline')->nullable()->after('body');
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table): void {
            $table->dropColumn([
                'categories',
                'learning_outcomes',
                'faq_sections',
                'material_includes',
                'requirements_list',
                'audience',
                'level_label',
                'detail_last_updated_at',
            ]);
        });

        Schema::table('course_modules', function (Blueprint $table): void {
            $table->dropColumn(['duration_minutes', 'lesson_outline']);
        });
    }
};
