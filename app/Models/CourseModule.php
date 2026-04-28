<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'course_id',
    'title',
    'duration_minutes',
    'body',
    'lesson_outline',
    'video_url',
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

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'duration_minutes' => 'integer',
            'lesson_outline' => 'array',
        ];
    }
}
