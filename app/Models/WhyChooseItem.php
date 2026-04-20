<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseItem extends Model
{
    protected $table = 'why_choose_items';

    protected $fillable = [
        'position',
        'title',
        'description',
        'icon_path',
    ];

    protected function casts(): array
    {
        return [
            'position' => 'integer',
        ];
    }
}
