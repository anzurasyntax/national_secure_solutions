<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Seed contact, hours, and social URLs to match the original static frontend.
     */
    public function run(): void
    {
        if (SiteSetting::query()->exists()) {
            return;
        }

        SiteSetting::query()->create(SiteSetting::defaultAttributes());
        SiteSetting::forgetResolved();
    }
}
