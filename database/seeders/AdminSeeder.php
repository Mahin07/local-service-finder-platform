<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $username = env('ADMIN_SEED_USERNAME');
        $password = env('ADMIN_SEED_PASSWORD');

        if (blank($username) || blank($password)) {
            throw new \RuntimeException('Set ADMIN_SEED_USERNAME and ADMIN_SEED_PASSWORD in .env before seeding an administrator.');
        }

        Admin::firstOrCreate(
            ['username' => $username],
            [
                'password' => $password,
                'image' => 'images/admin-default.png',
            ]
        );
    }
}
