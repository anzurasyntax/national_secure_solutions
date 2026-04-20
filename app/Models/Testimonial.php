<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'sort_order',
        'body',
        'name',
        'role',
        'rating',
        'avatar_path',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'rating' => 'integer',
        ];
    }

    public function avatarUrl(): string
    {
        $path = $this->avatar_path ?? '';

        return str_starts_with($path, 'http://') || str_starts_with($path, 'https://')
            ? $path
            : asset($path);
    }

    public function starsDisplay(): string
    {
        $n = max(1, min(5, (int) $this->rating));

        return str_repeat('★', $n);
    }
}
