<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Fillable([
    'title',
    'slug',
    'summary',
    'description',
    'categories',
    'learning_outcomes',
    'faq_sections',
    'material_includes',
    'requirements_list',
    'audience',
    'level_label',
    'detail_last_updated_at',
    'price',
    'currency',
    'is_published',
    'duration_minutes',
    'image_path',
])]
class Course extends Model
{
    protected static function booted(): void
    {
        static::creating(function (Course $course): void {
            if ($course->slug === null || $course->slug === '') {
                $course->slug = Str::slug($course->title).'-'.Str::lower(Str::random(6));
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function modules(): HasMany
    {
        return $this->hasMany(CourseModule::class)->orderBy('sort_order')->orderBy('id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(CourseOrder::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'price' => 'decimal:2',
            'duration_minutes' => 'integer',
            'categories' => 'array',
            'learning_outcomes' => 'array',
            'faq_sections' => 'array',
            'material_includes' => 'array',
            'requirements_list' => 'array',
            'detail_last_updated_at' => 'date',
        ];
    }
}
