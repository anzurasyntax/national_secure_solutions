<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeCta extends Model
{
    protected $table = 'home_ctas';

    protected $fillable = [
        'headline',
        'subheading',
        'button_label',
        'button_url',
        'background_color',
        'background_image_path',
    ];

    /**
     * @return array<string, string>
     */
    public static function defaultAttributes(): array
    {
        return [
            'headline' => 'GET FREE CONSULTATION (OR) CALL US: 773-319-6420',
            'subheading' => 'CONTACT US TODAY FOR A FREE CONSULTATION AND DISCOVER TAILORED SECURITY SOLUTIONS FOR YOUR NEEDS.',
            'button_label' => 'GET INQUIRY',
            'button_url' => '#',
            'background_color' => '#070E20',
            'background_image_path' => 'img/stat_bg.png',
        ];
    }

    public static function content(): self
    {
        $row = static::query()->first();

        return $row ?? new static(static::defaultAttributes());
    }

    public function backgroundImageUrl(): string
    {
        $path = $this->background_image_path ?? '';

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return $path !== '' ? asset($path) : asset('img/stat_bg.png');
    }
}
