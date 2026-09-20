<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'phone',
        'email',
        'location',
        'map_embed_url',
        'working_time',
        'facebook_url',
        'x_url',
        'youtube_url',
        'instagram_url',
        'pinterest_url',
        'logo_path',
    ];

    /**
     * @return array<string, string>
     */
    public static function defaultAttributes(): array
    {
        return [
            'phone' => '773-319-6420',
            'email' => 'info@nationalsecuresolutions.com',
            'location' => "5062 N 19th Ave Suite 103,\nPhoenix, AZ 85015, USA.",
            'working_time' => 'Mon to Fri: 08:00AM - 08:00PM',
            'facebook_url' => '#',
            'x_url' => '#',
            'youtube_url' => '#',
            'instagram_url' => '#',
            'pinterest_url' => '#',
        ];
    }

    private static ?self $resolved = null;

    /**
     * The single row of contact / footer CMS data, or in-memory defaults if the table is empty.
     */
    public static function current(): self
    {
        if (self::$resolved instanceof self) {
            return self::$resolved;
        }

        $row = static::query()->first();
        self::$resolved = $row ?? new self(self::defaultAttributes());

        return self::$resolved;
    }

    public static function forgetResolved(): void
    {
        self::$resolved = null;
    }

    public function telHref(): string
    {
        $digits = preg_replace('/\D+/', '', (string) $this->phone);

        return $digits !== '' ? 'tel:'.$digits : '#';
    }

    public function locationQuery(): string
    {
        return trim(preg_replace('/\s+/', ' ', str_replace(["\r\n", "\r", "\n"], ', ', (string) $this->location)) ?? '');
    }

    public function mapsTrackUrl(): string
    {
        $query = $this->locationQuery();

        return $query !== ''
            ? 'https://www.google.com/maps/search/?api=1&query='.rawurlencode($query)
            : 'https://maps.google.com';
    }

    public function mapEmbedUrl(): string
    {
        $custom = trim((string) ($this->map_embed_url ?? ''));

        if ($custom !== '') {
            return $custom;
        }

        $query = $this->locationQuery();

        return $query !== ''
            ? 'https://maps.google.com/maps?q='.rawurlencode($query).'&hl=en&z=14&output=embed'
            : 'https://maps.google.com';
    }

    /**
     * Public URL for the site logo (CMS upload or bundled default).
     */
    public function logoUrl(): string
    {
        $path = $this->logo_path;

        return ($path !== null && $path !== '')
            ? asset($path)
            : asset('img/logo.png');
    }

    /**
     * Whether the header/footer use the default bundled logo (for CSS tweaks like invert on dark bars).
     */
    public function usesDefaultLogo(): bool
    {
        return $this->logo_path === null || $this->logo_path === '';
    }
}
