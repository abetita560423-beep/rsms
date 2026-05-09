<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Use updateOrCreate to ensure we don't create duplicate accounts on redeploy
        User::updateOrCreate(
            ['email' => 'dummyaccount1@yahoo.com'], // Check for this email
            [
                'name' => 'System Admin',
                'password' => Hash::make('12345678'), // Specified password
                'role' => User::ROLE_ADMIN,
                'email_verified_at' => now(),
            ]
        );
    }
}
