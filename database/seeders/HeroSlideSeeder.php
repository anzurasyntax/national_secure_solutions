<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    /**
     * Seed hero slides with the same content as the original static home hero.
     * Image paths match files under public/ (same format as saving from admin).
     */
    public function run(): void
    {
        if (HeroSlide::query()->exists()) {
            return;
        }

        $slides = [
            [
                'sort_order' => 1,
                'image_path' => 'img/slider1.png',
                'tagline' => 'Securing is our best part of life',
                'headline' => 'THE BALANCE BETWEEN FREEDOM AND SECURITY IS A DELICATE ONE',
                'subtitle' => null,
                'button_label' => 'Get Inquiry',
                'button_url' => '#',
            ],
            [
                'sort_order' => 2,
                'image_path' => 'img/slider1.png',
                'tagline' => null,
                'headline' => 'SECURITY IS NOT THE MEANING OF LIFE, GREAT OPPORTUNITIES ARE WORTH THE RISK',
                'subtitle' => 'Welcome to Trans-World Security Guards',
                'button_label' => 'Get Inquiry',
                'button_url' => '#',
            ],
            [
                'sort_order' => 3,
                'image_path' => 'img/slider1.png',
                'tagline' => null,
                'headline' => 'BEING SECURITY IS NOT A PRODUCT, BUT IT IS A PROCESS',
                'subtitle' => 'Protection, Defense, & Access Control',
                'button_label' => 'Get Inquiry',
                'button_url' => '#',
            ],
        ];

        foreach ($slides as $data) {
            HeroSlide::query()->create($data);
        }
    }
}
