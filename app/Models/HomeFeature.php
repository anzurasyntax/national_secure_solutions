<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeFeature extends Model
{
    protected $fillable = [
        'position',
        'title',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'position' => 'integer',
        ];
    }

    public function displayNumber(): string
    {
        return str_pad((string) $this->position, 2, '0', STR_PAD_LEFT);
    }
}
