<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurValue extends Model
{
    protected $table = 'our_values';

    protected $fillable = [
        'sort_order',
        'eyebrow',
        'line1',
        'line2',
        'image_path',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    public function imageSrc(): string
    {
        $path = $this->image_path ?? '';

        return str_starts_with($path, 'http://') || str_starts_with($path, 'https://')
            ? $path
            : asset($path);
    }
}
