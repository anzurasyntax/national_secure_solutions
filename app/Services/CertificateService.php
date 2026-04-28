<?php

namespace App\Services;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Str;

class CertificateService
{
    public function issue(User $user, Course $course): Certificate
    {
        do {
            $serial = 'NSS-'.now()->format('Y').'-'.Str::upper(Str::random(10));
        } while (Certificate::query()->where('serial_number', $serial)->exists());

        return Certificate::query()->create([
            'serial_number' => $serial,
            'user_id' => $user->id,
            'course_id' => $course->id,
            'student_name' => $user->displayFullName(),
            'course_title_snapshot' => $course->title,
            'issued_at' => now(),
        ]);
    }
}
