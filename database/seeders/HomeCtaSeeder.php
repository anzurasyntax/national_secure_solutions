<?php

namespace Database\Seeders;

use App\Models\HomeCta;
use Illuminate\Database\Seeder;

class HomeCtaSeeder extends Seeder
{
    /**
     * Matches the original static home CTA (`sections/home/cta.blade.php`).
     */
    public function run(): void
    {
        if (HomeCta::query()->exists()) {
            return;
        }

        HomeCta::query()->create(HomeCta::defaultAttributes());
    }
}
