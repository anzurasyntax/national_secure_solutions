<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCourseRequest;
use App\Http\Requests\Admin\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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

        $validated = array_merge($validated, $this->courseDetailFromRequest($request));
        unset(
            $validated['categories_input'],
            $validated['learning_outcomes_input'],
            $validated['material_includes_input'],
            $validated['requirements_input'],
        );

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

        $validated = array_merge($validated, $this->courseDetailFromRequest($request));
        unset(
            $validated['categories_input'],
            $validated['learning_outcomes_input'],
            $validated['material_includes_input'],
            $validated['requirements_input'],
        );

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

    /**
     * Maps admin text/list inputs into structured JSON columns for the public course page.
     *
     * @return array<string, mixed>
     */
    private function courseDetailFromRequest(Request $request): array
    {
        return [
            'categories' => $this->parseCommaSeparated($request->input('categories_input')),
            'learning_outcomes' => $this->parseLineSeparated($request->input('learning_outcomes_input')),
            'faq_sections' => $this->normalizeFaqSections($request->input('faq_sections', [])),
            'material_includes' => $this->parseLineSeparated($request->input('material_includes_input')),
            'requirements_list' => $this->parseLineSeparated($request->input('requirements_input')),
            'audience' => $this->nullableTrimmedString($request->input('audience')),
            'level_label' => $this->nullableTrimmedString($request->input('level_label')),
            'detail_last_updated_at' => $request->input('detail_last_updated_at') ?: null,
        ];
    }

    /**
     * @return array<int, string>|null
     */
    private function parseCommaSeparated(mixed $raw): ?array
    {
        if (! is_string($raw) || trim($raw) === '') {
            return null;
        }

        $parts = array_values(array_filter(array_map('trim', explode(',', $raw)), fn (string $p): bool => $p !== ''));

        return $parts === [] ? null : $parts;
    }

    /**
     * @return array<int, string>|null
     */
    private function parseLineSeparated(mixed $raw): ?array
    {
        if (! is_string($raw) || trim($raw) === '') {
            return null;
        }

        $lines = preg_split('/\r\n|\r|\n/', $raw) ?: [];
        $out = [];
        foreach ($lines as $line) {
            $line = trim((string) $line);
            if ($line !== '') {
                $out[] = $line;
            }
        }

        return $out === [] ? null : array_values($out);
    }

    /**
     * @param  array<int, mixed>  $rows
     * @return array<int, array{title: string, body: string}>|null
     */
    private function normalizeFaqSections(array $rows): ?array
    {
        $out = [];
        foreach ($rows as $row) {
            if (! is_array($row)) {
                continue;
            }
            $title = isset($row['title']) ? trim((string) $row['title']) : '';
            $body = isset($row['body']) ? trim((string) $row['body']) : '';
            if ($title === '' && $body === '') {
                continue;
            }
            $out[] = ['title' => $title, 'body' => $body];
        }

        return $out === [] ? null : $out;
    }

    private function nullableTrimmedString(mixed $value): ?string
    {
        if ($value === null || ! is_string($value)) {
            return null;
        }

        $t = trim($value);

        return $t === '' ? null : $t;
    }
}
