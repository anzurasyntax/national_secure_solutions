<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCourseModuleRequest;
use App\Http\Requests\Admin\UpdateCourseModuleRequest;
use App\Models\Course;
use App\Models\CourseModule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CourseModuleController extends Controller
{
    public function index(Course $course): View
    {
        $modules = $course->modules()->orderBy('sort_order')->orderBy('id')->get();

        return view('admin.course-modules.index', compact('course', 'modules'));
    }

    public function create(Course $course): View
    {
        return view('admin.course-modules.create', compact('course'));
    }

    public function store(StoreCourseModuleRequest $request, Course $course): RedirectResponse
    {
        $validated = $request->validated();
        $validated['lesson_outline'] = $this->lessonOutlineFromRaw($request->input('lesson_outline_input'));
        unset($validated['lesson_outline_input']);
        $validated['course_id'] = $course->id;
        $validated['sort_order'] = $validated['sort_order']
            ?? (((int) ($course->modules()->max('sort_order') ?? 0)) + 1);

        CourseModule::query()->create($validated);

        return redirect()->route('admin.courses.modules.index', $course)->with('status', 'Module added.');
    }

    public function edit(Course $course, CourseModule $module): View
    {
        $this->assertModuleBelongs($course, $module);

        return view('admin.course-modules.edit', compact('course', 'module'));
    }

    public function update(UpdateCourseModuleRequest $request, Course $course, CourseModule $module): RedirectResponse
    {
        $this->assertModuleBelongs($course, $module);

        $validated = $request->validated();
        $validated['lesson_outline'] = $this->lessonOutlineFromRaw($request->input('lesson_outline_input'));
        unset($validated['lesson_outline_input']);

        $module->update($validated);

        return redirect()->route('admin.courses.modules.index', $course)->with('status', 'Module updated.');
    }

    public function destroy(Course $course, CourseModule $module): RedirectResponse
    {
        $this->assertModuleBelongs($course, $module);

        $module->delete();

        return redirect()->route('admin.courses.modules.index', $course)->with('status', 'Module deleted.');
    }

    private function assertModuleBelongs(Course $course, CourseModule $module): void
    {
        if ($module->course_id !== $course->id) {
            abort(404);
        }
    }

    /**
     * One line per item: "Label | optional duration" (pipe separator). Example: Presentation | 02:00:00
     *
     * @return array<int, array{label: string, duration_label: string|null}>|null
     */
    private function lessonOutlineFromRaw(mixed $raw): ?array
    {
        if (! is_string($raw) || trim($raw) === '') {
            return null;
        }

        $out = [];
        foreach (preg_split('/\r\n|\r|\n/', $raw) ?: [] as $line) {
            $line = trim((string) $line);
            if ($line === '') {
                continue;
            }
            $parts = array_map('trim', explode('|', $line, 2));
            $label = $parts[0] ?? '';
            $durationLabel = isset($parts[1]) && $parts[1] !== '' ? $parts[1] : null;
            if ($label === '') {
                continue;
            }
            $out[] = ['label' => $label, 'duration_label' => $durationLabel];
        }

        return $out === [] ? null : $out;
    }
}
