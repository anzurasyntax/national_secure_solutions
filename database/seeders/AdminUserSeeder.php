<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the default admin account for the control panel.
     *
     * In production, set ADMIN_INITIAL_PASSWORD (and optionally ADMIN_EMAIL) or this seeder does nothing.
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL', 'admin@example.test');
        $name = env('ADMIN_NAME', 'Administrator');

        if (app()->environment('production')) {
            $password = env('ADMIN_INITIAL_PASSWORD');
            if ($password === null || $password === '') {
                return;
            }
        } else {
            $password = env('ADMIN_INITIAL_PASSWORD', 'password');
        }

        User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => $password,
                'is_admin' => true,
            ],
        );
    }
}
