<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

#[Fillable([
    'verify_token',
    'serial_number',
    'user_id',
    'course_id',
    'student_name',
    'course_title_snapshot',
    'issued_at',
])]
class Certificate extends Model
{
    protected static function booted(): void
    {
        static::creating(function (Certificate $certificate): void {
            if ($certificate->verify_token === null || $certificate->verify_token === '') {
                $certificate->verify_token = (string) Str::uuid();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    protected function casts(): array
    {
        return [
            'issued_at' => 'datetime',
        ];
    }
}
