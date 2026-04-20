<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeStat extends Model
{
    protected $fillable = [
        'position',
        'heading',
        'value',
        'suffix',
    ];

    protected function casts(): array
    {
        return [
            'position' => 'integer',
            'value' => 'integer',
        ];
    }
}
