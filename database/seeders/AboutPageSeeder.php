<?php

namespace Database\Seeders;

use App\Models\AboutPage;
use Illuminate\Database\Seeder;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        if (AboutPage::query()->exists()) {
            return;
        }

        AboutPage::query()->create(AboutPage::defaultAttributes());
    }
}
