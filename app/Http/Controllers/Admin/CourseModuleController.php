<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCourseModuleRequest;
use App\Http\Requests\Admin\UpdateCourseModuleRequest;
use App\Models\Course;
use App\Models\CourseModule;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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
        unset($validated['video_files']);
        $validated['course_id'] = $course->id;
        $validated['sort_order'] = $validated['sort_order']
            ?? (((int) ($course->modules()->max('sort_order') ?? 0)) + 1);

        if ($request->hasFile('video_files')) {
            $validated['video_paths'] = $this->storeVideos($request->file('video_files'));
        }

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
        unset($validated['video_files'], $validated['remove_existing_videos']);

        $removeExisting = $request->boolean('remove_existing_videos');

        if ($request->hasFile('video_files')) {
            $this->deleteStoredVideos($module->video_paths);
            $validated['video_paths'] = $this->storeVideos($request->file('video_files'));
        } elseif ($removeExisting) {
            $this->deleteStoredVideos($module->video_paths);
            $validated['video_paths'] = null;
        }

        $module->update($validated);

        return redirect()->route('admin.courses.modules.index', $course)->with('status', 'Module updated.');
    }

    public function destroy(Course $course, CourseModule $module): RedirectResponse
    {
        $this->assertModuleBelongs($course, $module);

        $this->deleteStoredVideos($module->video_paths);
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

    /**
     * @param  array<int, UploadedFile>|UploadedFile|null  $files
     * @return array<int, string>|null
     */
    private function storeVideos(array|UploadedFile|null $files): ?array
    {
        if ($files instanceof UploadedFile) {
            $files = [$files];
        }

        if (! is_array($files) || $files === []) {
            return null;
        }

        $dir = public_path('uploads/course-modules/videos');
        if (! File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $stored = [];
        foreach ($files as $file) {
            if (! $file instanceof UploadedFile) {
                continue;
            }

            $extension = strtolower($file->getClientOriginalExtension() ?: 'mp4');
            $base = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = Str::slug($base).'-'.uniqid('', true).'.'.$extension;
            $file->move($dir, $filename);
            $stored[] = 'uploads/course-modules/videos/'.$filename;
        }

        return $stored === [] ? null : $stored;
    }

    /**
     * @param  array<int, string>|null  $paths
     */
    private function deleteStoredVideos(?array $paths): void
    {
        if (! is_array($paths)) {
            return;
        }

        foreach ($paths as $path) {
            if (! is_string($path) || ! str_starts_with($path, 'uploads/course-modules/videos/')) {
                continue;
            }

            $fullPath = public_path($path);
            if (File::exists($fullPath)) {
                File::delete($fullPath);
            }
        }
    }
}
