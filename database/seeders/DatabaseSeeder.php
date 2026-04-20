<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SiteSettingSeeder::class,
            HeroSlideSeeder::class,
            HomeFeatureSeeder::class,
            HomeStatSeeder::class,
            HomeCtaSeeder::class,
            WhyChooseUsSeeder::class,
            AboutPageSeeder::class,
            ServiceSeeder::class,
            OurValueSeeder::class,
            AdminUserSeeder::class,
        ]);
    }
}
