<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCourseRequest;
use App\Http\Requests\Admin\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index(): View
    {
        $courses = Course::query()->orderByDesc('updated_at')->withCount(['modules', 'enrollments'])->get();

        return view('admin.courses.index', compact('courses'));
    }

    public function create(): View
    {
        return view('admin.courses.create');
    }

    public function store(StoreCourseRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $slugInput = isset($validated['slug']) ? trim((string) $validated['slug']) : '';
        if ($slugInput === '') {
            $validated['slug'] = Str::slug($validated['title']).'-'.Str::lower(Str::random(5));
        } else {
            $validated['slug'] = Str::slug($slugInput);
        }

        if ($request->hasFile('image')) {
            $validated['image_path'] = $this->storeImage($request->file('image'));
        }

        unset($validated['image']);
        $validated['is_published'] = $request->boolean('is_published');

        Course::query()->create($validated);

        return redirect()->route('admin.courses.index')->with('status', 'Course saved.');
    }

    public function edit(Course $course): View
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(UpdateCourseRequest $request, Course $course): RedirectResponse
    {
        $validated = $request->validated();

        $slugInput = isset($validated['slug']) ? trim((string) $validated['slug']) : '';
        if ($slugInput !== '') {
            $validated['slug'] = Str::slug($slugInput);
        } else {
            unset($validated['slug']);
        }

        if ($request->hasFile('image')) {
            $this->deleteStoredImage($course->image_path);
            $validated['image_path'] = $this->storeImage($request->file('image'));
        }

        unset($validated['image']);

        $validated['is_published'] = $request->boolean('is_published');

        $course->update($validated);

        return redirect()->route('admin.courses.index')->with('status', 'Course updated.');
    }

    public function destroy(Course $course): RedirectResponse
    {
        $this->deleteStoredImage($course->image_path);
        $course->delete();

        return redirect()->route('admin.courses.index')->with('status', 'Course deleted.');
    }

    private function storeImage(UploadedFile $file): string
    {
        $dir = public_path('img/courses');
        if (! File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $extension = strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).'-'.uniqid('', true).'.'.$extension;
        $file->move($dir, $filename);

        return 'img/courses/'.$filename;
    }

    private function deleteStoredImage(?string $path): void
    {
        if ($path === null || $path === '' || ! str_starts_with($path, 'img/courses/')) {
            return;
        }

        $full = public_path($path);
        if (File::exists($full)) {
            File::delete($full);
        }
    }
}
