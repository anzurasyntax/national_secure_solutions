<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable([
    'name',
    'email',
    'password',
    'is_admin',
    'username',
    'first_name',
    'last_name',
    'phone',
    'skill_occupation',
    'bio',
    'timezone',
    'public_display_name',
    'avatar_path',
    'cover_path',
])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public function courseOrders(): HasMany
    {
        return $this->hasMany(CourseOrder::class);
    }

    public function courseEnrollments(): HasMany
    {
        return $this->hasMany(CourseEnrollment::class);
    }

    public function moduleProgress(): HasMany
    {
        return $this->hasMany(CourseModuleProgress::class);
    }

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }

    public function isStudentAccount(): bool
    {
        return ! $this->is_admin;
    }

    public function displayFirstName(): string
    {
        if (is_string($this->first_name) && trim($this->first_name) !== '') {
            return trim($this->first_name);
        }

        $parts = preg_split('/\s+/', trim((string) $this->name)) ?: [];

        return $parts[0] ?? 'Student';
    }

    public function displayFullName(): string
    {
        $fn = trim((string) $this->first_name);
        $ln = trim((string) $this->last_name);
        if ($fn !== '' || $ln !== '') {
            return trim($fn.' '.$ln);
        }

        return trim((string) $this->name);
    }

    public function initials(): string
    {
        $fn = trim((string) $this->first_name);
        $ln = trim((string) $this->last_name);
        if ($fn !== '' && $ln !== '') {
            return strtoupper(mb_substr($fn, 0, 1).mb_substr($ln, 0, 1));
        }

        $parts = preg_split('/\s+/', trim((string) $this->name)) ?: [];
        if (count($parts) >= 2) {
            return strtoupper(mb_substr($parts[0], 0, 1).mb_substr($parts[1], 0, 1));
        }

        return strtoupper(mb_substr((string) $this->name, 0, 2));
    }

    public function avatarAssetUrl(): ?string
    {
        if ($this->avatar_path === null || $this->avatar_path === '') {
            return null;
        }

        return asset($this->avatar_path);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }
}
