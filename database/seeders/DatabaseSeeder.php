<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create the Admin User
        User::updateOrCreate(
            ['email' => 'admin123@gmail.com'], // Prevents duplicates
            [
                'name' => 'admin',
                'password' => Hash::make('admin1234546789'),
                'role' => 'admin',
            ]
        );

        echo "Admin account created successfully!\n";
    }
}