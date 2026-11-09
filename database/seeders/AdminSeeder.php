<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed one admin account.
     *
     * Uses updateOrCreate so re-running `db:seed` won't create duplicates
     * or throw a "unique email" error — it just updates the existing admin.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@fanhubplus.com'], // match on this field
            [
                'name' => 'Admin',
                'password' => Hash::make('Admin@123'),
                'role' => 1, // 1 = admin, 0 = regular user
                'is_banned' => 0,
                // 'email_verified_at' => now(),
            ]
        );
    }
}
