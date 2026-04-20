<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the default admin account for the control panel.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => 'password',
                'is_admin' => true,
            ],
        );
    }
}
