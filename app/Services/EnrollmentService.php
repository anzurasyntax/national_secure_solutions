<?php

namespace App\Services;

use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\CourseOrder;
use App\Models\User;
use Illuminate\Database\QueryException;

class EnrollmentService
{
    public function enroll(User $user, Course $course, ?CourseOrder $order = null): CourseEnrollment
    {
        try {
            return CourseEnrollment::query()->firstOrCreate(
                [
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                ],
                [
                    'course_order_id' => $order?->id,
                    'enrolled_at' => now(),
                ]
            );
        } catch (QueryException) {
            return CourseEnrollment::query()->where('user_id', $user->id)->where('course_id', $course->id)->firstOrFail();
        }
    }

    public function isEnrolled(User $user, Course $course): bool
    {
        return CourseEnrollment::query()
            ->where('user_id', $user->id)
            ->where('course_id', $course->id)
            ->exists();
    }
}
