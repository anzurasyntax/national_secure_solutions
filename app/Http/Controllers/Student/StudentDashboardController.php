<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\CourseModuleProgress;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $enrollments = $user
            ->courseEnrollments()
            ->with(['course.modules'])
            ->orderByDesc('enrolled_at')
            ->get();

        $progress = [];
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
            $progress[$course->id] = [
                'done' => $done,
                'total' => $total,
            ];
        }

        $certificates = $user->certificates()->with('course')->orderByDesc('issued_at')->get();

        return view('student.dashboard', compact('enrollments', 'certificates', 'progress'));
    }
}
