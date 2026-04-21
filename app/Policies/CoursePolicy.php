<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

class CoursePolicy
{
    public function learn(User $user, Course $course): bool
    {
        if ($user->is_admin) {
            return true;
        }

        return $user->courseEnrollments()->where('course_id', $course->id)->exists();
    }
}
