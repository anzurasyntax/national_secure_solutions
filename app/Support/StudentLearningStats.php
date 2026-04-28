<?php

namespace App\Support;

use App\Models\Certificate;
use App\Models\CourseModuleProgress;
use App\Models\User;
use Illuminate\Support\Collection;

final class StudentLearningStats
{
    /**
     * Per-course progress for all enrollments.
     *
     * @return array<int, array{course_id: int, done: int, total: int, percent: int, completed: bool, active: bool}>
     */
    public static function enrollmentProgress(User $user): array
    {
        $enrollments = $user->courseEnrollments()->with(['course.modules'])->orderByDesc('enrolled_at')->get();

        $certCourseIds = Certificate::query()->where('user_id', $user->id)->pluck('course_id')->all();

        $out = [];
        foreach ($enrollments as $enrollment) {
            $course = $enrollment->course;
            if ($course === null) {
                continue;
            }
            $total = $course->modules->count();
            $done = CourseModuleProgress::query()
                ->where('user_id', $user->id)
                ->whereHas('module', fn ($q) => $q->where('course_id', $course->id))
                ->count();

            $hasCert = in_array($course->id, $certCourseIds, true);
            $modulesComplete = $total > 0 && $done >= $total;
            $completed = $hasCert || $modulesComplete;
            $percent = $total > 0 ? (int) round(($done / $total) * 100) : 0;
            $active = ! $completed && $done > 0 && $done < $total;

            $out[] = [
                'enrollment' => $enrollment,
                'course' => $course,
                'course_id' => $course->id,
                'done' => $done,
                'total' => $total,
                'percent' => $percent,
                'completed' => $completed,
                'active' => $active,
            ];
        }

        return $out;
    }

    /**
     * @param  array<int, array{course_id: int, done: int, total: int, percent: int, completed: bool, active: bool}>  $rows
     * @return array{enrolled: int, active: int, completed: int}
     */
    public static function dashboardCounts(array $rows): array
    {
        $enrolled = count($rows);
        $completed = collect($rows)->filter(fn (array $r): bool => $r['completed'])->count();
        $active = collect($rows)->filter(fn (array $r): bool => $r['active'])->count();

        return [
            'enrolled' => $enrolled,
            'active' => $active,
            'completed' => $completed,
        ];
    }

    /**
     * @param  array<int, array<string, mixed>>  $rows
     * @return Collection<int, array<string, mixed>>
     */
    public static function filterTab(array $rows, string $tab): Collection
    {
        $c = collect($rows);

        return match ($tab) {
            'active' => $c->filter(fn (array $r): bool => ($r['active'] ?? false)),
            'completed' => $c->filter(fn (array $r): bool => ($r['completed'] ?? false)),
            'all', 'enrolled' => $c,
            default => $c,
        };
    }
}
