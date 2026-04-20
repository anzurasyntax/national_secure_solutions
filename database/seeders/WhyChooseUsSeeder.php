<?php

namespace Database\Seeders;

use App\Models\WhyChooseItem;
use Illuminate\Database\Seeder;

class WhyChooseUsSeeder extends Seeder
{
    public function run(): void
    {
        if (WhyChooseItem::query()->exists()) {
            return;
        }

        $rows = [
            [
                'position' => 1,
                'title' => '40 YEARS OF EXPERIENCES',
                'description' => 'Benefit from over 40 years of trusted expertise in safeguarding businesses and properties.',
                'icon_path' => 'img/chooseUs_icon1.png',
            ],
            [
                'position' => 2,
                'title' => 'SELF MOTIVATED GUARDS',
                'description' => 'Our self-motivated guards are dedicated to ensuring your safety with unwavering commitment.',
                'icon_path' => 'img/chooseUs_icon1.png',
            ],
            [
                'position' => 3,
                'title' => 'LATEST SECURITY TECHNIQUES',
                'description' => 'Utilizing the latest security techniques to keep you protected with advanced technology.',
                'icon_path' => 'img/chooseUs_icon1.png',
            ],
        ];

        foreach ($rows as $row) {
            WhyChooseItem::query()->create($row);
        }
    }
}
