<?php

namespace App\Services;

use App\Models\Certificate;
use App\Models\Course;
use App\Models\CourseModule;
use App\Models\CourseModuleProgress;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CourseProgressService
{
    public function __construct(
        private readonly CertificateService $certificateService,
    ) {}

    public function markModuleComplete(User $user, CourseModule $module): void
    {
        DB::transaction(function () use ($user, $module): void {
            CourseModuleProgress::query()->firstOrCreate(
                [
                    'user_id' => $user->id,
                    'course_module_id' => $module->id,
                ],
                ['completed_at' => now()]
            );

            $this->maybeIssueCertificate($user, $module->course);
        });
    }

    public function completedModuleIds(User $user, Course $course): array
    {
        return CourseModuleProgress::query()
            ->where('user_id', $user->id)
            ->whereHas('module', fn ($q) => $q->where('course_id', $course->id))
            ->pluck('course_module_id')
            ->all();
    }

    public function hasCompletedCourse(User $user, Course $course): bool
    {
        $total = $course->modules()->count();
        if ($total === 0) {
            return false;
        }

        $done = CourseModuleProgress::query()
            ->where('user_id', $user->id)
            ->whereHas('module', fn ($q) => $q->where('course_id', $course->id))
            ->count();

        return $done >= $total;
    }

    protected function maybeIssueCertificate(User $user, Course $course): void
    {
        if (! $this->hasCompletedCourse($user, $course)) {
            return;
        }

        if (Certificate::query()->where('user_id', $user->id)->where('course_id', $course->id)->exists()) {
            return;
        }

        $this->certificateService->issue($user, $course);
    }
}
