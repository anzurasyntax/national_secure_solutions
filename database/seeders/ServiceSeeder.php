<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        if (Service::query()->exists()) {
            return;
        }

        $rows = [
            [
                'title' => 'Security Systems',
                'excerpt' => 'Advanced security systems with real-time alerts and remote monitoring.',
                'body' => null,
                'image_path' => 'img/service1.png',
                'icon_path' => 'img/service_icon1.png',
                'sort_order' => 1,
            ],
            [
                'title' => 'Major Event Security',
                'excerpt' => 'Expert security for major events: safety, crowd control, emergency response.',
                'body' => null,
                'image_path' => 'img/service2.png',
                'icon_path' => 'img/service_icon2.png',
                'sort_order' => 2,
            ],
            [
                'title' => 'Bodyguard Services',
                'excerpt' => 'Efficient Bodyguard Services for reliable protection and safety assurance.',
                'body' => null,
                'image_path' => 'img/service3.png',
                'icon_path' => 'img/service_icon3.png',
                'sort_order' => 3,
            ],
        ];

        foreach ($rows as $row) {
            Service::query()->create($row);
        }
    }
}
