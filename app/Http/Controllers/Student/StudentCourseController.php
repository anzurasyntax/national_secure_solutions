<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseModule;
use App\Services\CourseProgressService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends Controller
{
    public function __construct(
        private readonly CourseProgressService $progressService,
    ) {}

    public function learn(Course $course): View
    {
        $this->authorize('learn', $course);

        $course->load('modules');

        $completedIds = $this->progressService->completedModuleIds(Auth::user(), $course);

        $certificate = Auth::user()->certificates()->where('course_id', $course->id)->first();

        return view('student.course-learn', compact('course', 'completedIds', 'certificate'));
    }

    public function module(Course $course, CourseModule $module): View
    {
        $this->authorize('learn', $course);

        if ($module->course_id !== $course->id) {
            abort(404);
        }

        $completedIds = $this->progressService->completedModuleIds(Auth::user(), $course);
        $isDone = in_array($module->id, $completedIds, true);

        return view('student.course-module', compact('course', 'module', 'completedIds', 'isDone'));
    }

    public function completeModule(Request $request, Course $course, CourseModule $module): RedirectResponse
    {
        $this->authorize('learn', $course);

        if ($module->course_id !== $course->id) {
            abort(404);
        }

        $this->progressService->markModuleComplete(Auth::user(), $module);

        return redirect()
            ->route('student.courses.learn', $course)
            ->with('status', 'Module marked complete.');
    }
}
