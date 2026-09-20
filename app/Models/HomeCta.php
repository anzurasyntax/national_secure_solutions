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
            'headline' => 'GET FREE CONSULTATION (OR) CALL US: {phone}',
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

    public function headlineWithPhone(string $phone): string
    {
        $headline = (string) $this->headline;

        if (str_contains($headline, '{phone}')) {
            return str_replace('{phone}', $phone, $headline);
        }

        $updated = preg_replace('/\b\d{3}-\d{3}-\d{4}\b/', $phone, $headline, 1);

        return $updated ?? $headline;
    }
}
