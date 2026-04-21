<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseModule;
use Illuminate\Database\Seeder;

class SampleCourseSeeder extends Seeder
{
    public function run(): void
    {
        $course = Course::query()->firstOrCreate(
            ['slug' => 'financial-security-101-demo'],
            [
                'title' => 'Financial Security 101',
                'summary' => 'Foundation-level programme covering fraud awareness, controls, and reporting.',
                'description' => "This sample course demonstrates the learner journey: checkout, modules, progress, and certificate issuance.\n\nReplace this copy with your own curriculum.",
                'price' => 49.00,
                'currency' => 'USD',
                'is_published' => true,
                'duration_minutes' => 120,
            ]
        );

        if ($course->modules()->count() > 0) {
            return;
        }

        CourseModule::query()->insert([
            [
                'course_id' => $course->id,
                'title' => 'Introduction & objectives',
                'body' => 'Welcome. Review the learning outcomes and how to mark each module complete.',
                'video_url' => null,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => $course->id,
                'title' => 'Risk identification',
                'body' => 'Study common threat patterns and how teams document findings.',
                'video_url' => null,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'course_id' => $course->id,
                'title' => 'Controls & reporting',
                'body' => 'Final module — complete this lesson to generate your certificate.',
                'video_url' => null,
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
