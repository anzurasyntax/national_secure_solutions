<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable([
    'course_id',
    'title',
    'duration_minutes',
    'body',
    'lesson_outline',
    'video_url',
    'video_paths',
    'module_materials',
    'sort_order',
])]
class CourseModule extends Model
{
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function progressRecords(): HasMany
    {
        return $this->hasMany(CourseModuleProgress::class);
    }

    /**
     * Normalized ordered materials (videos, images, presentations). Falls back to legacy `video_paths` when `module_materials` is empty.
     *
     * @return array<int, array{id: string, type: string, path: string, name: string, slides: array<int, string>|null}>
     */
    public function materialsList(): array
    {
        $raw = $this->module_materials;
        if (is_array($raw) && $raw !== []) {
            $out = [];
            foreach ($raw as $row) {
                $n = $this->normalizeMaterialRow(is_array($row) ? $row : []);
                if ($n !== null) {
                    $out[] = $n;
                }
            }

            return $out;
        }

        $out = [];
        foreach ($this->video_paths ?? [] as $path) {
            if (! is_string($path) || $path === '') {
                continue;
            }
            $out[] = [
                'id' => 'legacy-'.md5($path),
                'type' => 'video',
                'path' => $path,
                'name' => basename($path),
                'slides' => null,
            ];
        }

        return $out;
    }

    /**
     * @return array{id: string, type: string, path: string, name: string, slides: array<int, string>|null}|null
     */
    protected function normalizeMaterialRow(array $row): ?array
    {
        $path = isset($row['path']) && is_string($row['path']) ? $row['path'] : '';
        if ($path === '' || ! str_starts_with($path, 'uploads/course-modules/')) {
            return null;
        }

        $type = $row['type'] ?? 'video';
        if (! in_array($type, ['video', 'image', 'ppt'], true)) {
            $type = 'video';
        }

        $id = isset($row['id']) && is_string($row['id']) && $row['id'] !== ''
            ? $row['id']
            : (string) Str::uuid();

        $name = isset($row['name']) && is_string($row['name']) ? $row['name'] : basename($path);

        $slides = null;
        if (isset($row['slides']) && is_array($row['slides'])) {
            $filtered = array_values(array_filter(
                $row['slides'],
                fn ($s) => is_string($s) && str_starts_with($s, 'uploads/course-modules/')
            ));
            $slides = $filtered === [] ? null : $filtered;
        }

        return [
            'id' => $id,
            'type' => $type,
            'path' => $path,
            'name' => $name,
            'slides' => $slides,
        ];
    }

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'duration_minutes' => 'integer',
            'lesson_outline' => 'array',
            'video_paths' => 'array',
            'module_materials' => 'array',
        ];
    }
}
