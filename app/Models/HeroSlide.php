<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    protected $fillable = [
        'sort_order',
        'image_path',
        'tagline',
        'headline',
        'subtitle',
        'button_label',
        'button_url',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    /**
     * Public URL for the background image (path is relative to the public/ directory).
     */
    public function imageUrl(): string
    {
        return asset($this->image_path);
    }
}
