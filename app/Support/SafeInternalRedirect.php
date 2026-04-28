<?php

namespace App\Support;

final class SafeInternalRedirect
{
    /**
     * Allow redirects only to course checkout URLs on this app (prevents open redirects).
     */
    public static function courseCheckoutPath(?string $path): ?string
    {
        if ($path === null || $path === '') {
            return null;
        }

        if (! str_starts_with($path, '/') || str_starts_with($path, '//')) {
            return null;
        }

        return preg_match('#^/courses/[\w\-]+/checkout$#', $path) === 1 ? $path : null;
    }
}
