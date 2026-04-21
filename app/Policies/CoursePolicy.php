<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;

/**
 * Course access for the learning area (/my-learning).
 *
 * Students may only open courses they are enrolled in (purchase fulfilled).
 *
 * Administrator accounts ({@see User::$is_admin}) intentionally bypass enrollment so the
 * sole admin can preview and support any course without buying it. There is no per-course
 * admin ACL: if you need stricter separation, introduce roles or a “preview enrollment” flag.
 */
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
