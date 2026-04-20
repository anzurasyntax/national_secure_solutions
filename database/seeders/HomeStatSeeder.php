<?php

namespace Database\Seeders;

use App\Models\HomeStat;
use Illuminate\Database\Seeder;

class HomeStatSeeder extends Seeder
{
    public function run(): void
    {
        if (HomeStat::query()->exists()) {
            return;
        }

        $rows = [
            ['position' => 1, 'heading' => 'Total Guards', 'value' => 3500, 'suffix' => '+'],
            ['position' => 2, 'heading' => 'Happy Clients', 'value' => 2340, 'suffix' => '+'],
            ['position' => 3, 'heading' => 'Awards', 'value' => 48, 'suffix' => ''],
            ['position' => 4, 'heading' => 'Branches', 'value' => 35, 'suffix' => ''],
        ];

        foreach ($rows as $row) {
            HomeStat::query()->create($row);
        }
    }
}
