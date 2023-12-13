<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin@admin.com'), // You should use bcrypt() or Hash facade to hash the password
            'role' => 'admin',
        ]);

        // Create a regular user
        User::create([
            'name' => 'test User',
            'email' => 'test@test.com',
            'password' => Hash::make('test@test.com'),
            'role' => 'user',
        ]);
        // Create a regular user
        User::create([
            'name' => 'Regular User',
            'email' => 'user@user.com',
            'password' => Hash::make('user@user.com'),
            'role' => 'user',
        ]);
    }
}
