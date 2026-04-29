<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCourseModuleRequest;
use App\Http\Requests\Admin\UpdateCourseModuleRequest;
use App\Models\Course;
use App\Models\CourseModule;
use App\Services\CourseModuleMediaService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CourseModuleController extends Controller
{
    public function __construct(
        private readonly CourseModuleMediaService $mediaService,
    ) {}

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
        unset($validated['lesson_outline_input'], $validated['material_files']);

        $validated['course_id'] = $course->id;
        $validated['sort_order'] = $validated['sort_order']
            ?? (((int) ($course->modules()->max('sort_order') ?? 0)) + 1);

        $validated['module_materials'] = $request->hasFile('material_files')
            ? $this->storeNewMaterials($request->file('material_files'))
            : [];
        $validated['video_paths'] = null;

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
        unset($validated['lesson_outline_input'], $validated['material_files'], $validated['remove_material_ids']);

        $removeIds = array_values(array_filter(array_map(
            fn ($id) => is_string($id) ? trim($id) : '',
            $request->input('remove_material_ids', []) ?? []
        )));

        $current = $module->materialsList();
        foreach ($current as $item) {
            if (in_array($item['id'], $removeIds, true)) {
                $this->deleteMaterialFromDisk($item);
            }
        }

        $kept = array_values(array_filter(
            $current,
            fn (array $item) => ! in_array($item['id'], $removeIds, true)
        ));

        $newItems = $request->hasFile('material_files')
            ? $this->storeNewMaterials($request->file('material_files'))
            : [];

        $validated['module_materials'] = array_merge($kept, $newItems);
        $validated['video_paths'] = null;

        $module->update($validated);

        return redirect()->route('admin.courses.modules.index', $course)->with('status', 'Module updated.');
    }

    public function destroy(Course $course, CourseModule $module): RedirectResponse
    {
        $this->assertModuleBelongs($course, $module);

        foreach ($module->materialsList() as $item) {
            $this->deleteMaterialFromDisk($item);
        }

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
        foreach ((preg_split('/\r\n|\r|\n/', $raw) ?: []) as $line) {
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
     * @return array<int, array<string, mixed>>
     */
    private function storeNewMaterials(array|UploadedFile|null $files): array
    {
        if ($files instanceof UploadedFile) {
            $files = [$files];
        }

        if (! is_array($files)) {
            return [];
        }

        $stored = [];
        foreach ($files as $file) {
            if (! $file instanceof UploadedFile || ! $file->isValid()) {
                continue;
            }
            $one = $this->storeOneMaterial($file);
            if ($one !== null) {
                $stored[] = $one;
            }
        }

        return $stored;
    }

    /**
     * @return array<string, mixed>|null
     */
    private function storeOneMaterial(UploadedFile $file): ?array
    {
        $type = $this->detectMaterialType($file);
        if ($type === null) {
            return null;
        }

        if ($type === 'video') {
            $path = $this->storeInSubdir(
                $file,
                'uploads/course-modules/videos',
                ['mp4', 'webm', 'ogg', 'mov', 'avi', 'mkv'],
                'mp4',
            );
            if ($path === null) {
                return null;
            }

            return [
                'id' => (string) Str::uuid(),
                'type' => 'video',
                'path' => $path,
                'name' => $file->getClientOriginalName(),
                'slides' => null,
            ];
        }

        if ($type === 'image') {
            $path = $this->storeInSubdir(
                $file,
                'uploads/course-modules/images',
                ['jpg', 'jpeg', 'png', 'gif', 'webp'],
                'jpg',
            );
            if ($path === null) {
                return null;
            }

            return [
                'id' => (string) Str::uuid(),
                'type' => 'image',
                'path' => $path,
                'name' => $file->getClientOriginalName(),
                'slides' => null,
            ];
        }

        $id = (string) Str::uuid();
        $path = $this->storeInSubdir(
            $file,
            'uploads/course-modules/documents',
            ['ppt', 'pptx'],
            'pptx',
        );
        if ($path === null) {
            return null;
        }

        $slidesRel = 'uploads/course-modules/slides/'.$id;
        $slides = $this->mediaService->extractPptSlides(public_path($path), $slidesRel);

        return [
            'id' => $id,
            'type' => 'ppt',
            'path' => $path,
            'name' => $file->getClientOriginalName(),
            'slides' => $slides,
        ];
    }

    private function storeInSubdir(
        UploadedFile $file,
        string $relativeDir,
        array $allowedExtensions,
        string $fallbackExtension,
    ): ?string {
        $dir = public_path($relativeDir);
        if (! File::isDirectory($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $extension = strtolower((string) ($file->getClientOriginalExtension() ?: $fallbackExtension));
        if ($allowedExtensions !== [] && ! in_array($extension, $allowedExtensions, true)) {
            $extension = $allowedExtensions[0];
        }

        $base = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $filename = Str::slug($base).'-'.uniqid('', true).'.'.$extension;
        $file->move($dir, $filename);

        return rtrim($relativeDir, '/').'/'.$filename;
    }

    private function detectMaterialType(UploadedFile $file): ?string
    {
        $mime = (string) $file->getMimeType();
        $ext = strtolower((string) $file->getClientOriginalExtension());

        if (in_array($ext, ['ppt', 'pptx'], true)) {
            return 'ppt';
        }

        if (in_array($ext, ['mp4', 'webm', 'ogg', 'ogv', 'mov', 'avi', 'mkv'], true)) {
            return 'video';
        }

        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'], true)) {
            return 'image';
        }

        if (str_starts_with($mime, 'video/')) {
            return 'video';
        }

        if (str_starts_with($mime, 'image/')) {
            return 'image';
        }

        if (in_array($mime, [
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            'application/vnd.ms-powerpoint.presentation.macroEnabled.12',
        ], true)) {
            return 'ppt';
        }

        if ($mime === 'application/octet-stream' && in_array($ext, ['ppt', 'pptx', 'mp4', 'mov', 'webm', 'jpg', 'jpeg', 'png', 'gif', 'webp'], true)) {
            if (in_array($ext, ['ppt', 'pptx'], true)) {
                return 'ppt';
            }
            if (in_array($ext, ['mp4', 'mov', 'webm', 'mkv', 'avi', 'ogg'], true)) {
                return 'video';
            }
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'], true)) {
                return 'image';
            }
        }

        return null;
    }

    /**
     * @param  array<string, mixed>  $material
     */
    private function deleteMaterialFromDisk(array $material): void
    {
        $type = $material['type'] ?? '';
        $id = $material['id'] ?? '';

        if ($type === 'ppt' && is_string($id) && $id !== '' && ! str_starts_with($id, 'legacy-')) {
            $slideDir = public_path('uploads/course-modules/slides/'.$id);
            if (File::isDirectory($slideDir)) {
                File::deleteDirectory($slideDir);
            }
        }

        $this->deletePublicUpload($material['path'] ?? null);
    }

    private function deletePublicUpload(mixed $path): void
    {
        if (! is_string($path) || $path === '' || ! str_starts_with($path, 'uploads/course-modules/')) {
            return;
        }

        $fullPath = public_path($path);
        if (File::exists($fullPath) && File::isFile($fullPath)) {
            File::delete($fullPath);
        }
    }
}
