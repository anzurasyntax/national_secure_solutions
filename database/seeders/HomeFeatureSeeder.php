<?php

namespace Database\Seeders;

use App\Models\HomeFeature;
use Illuminate\Database\Seeder;

class HomeFeatureSeeder extends Seeder
{
    /**
     * Seed the three home feature cards (same copy as the original static section).
     */
    public function run(): void
    {
        if (HomeFeature::query()->exists()) {
            return;
        }

        $rows = [
            [
                'position' => 1,
                'title' => 'Observe',
                'description' => 'The first step of the security process is Observation, what asset needs the most protection and where are the most weak points',
            ],
            [
                'position' => 2,
                'title' => 'Predict',
                'description' => 'Think like an assailant, in what ways are we vulnerable and how can we most likely to expect a threat?',
            ],
            [
                'position' => 3,
                'title' => 'Protect',
                'description' => 'Deploy the most appropriate threat deterrents to ensure client\'s assets are protected',
            ],
        ];

        foreach ($rows as $row) {
            HomeFeature::query()->create($row);
        }
    }
}
