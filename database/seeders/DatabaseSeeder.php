<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'phone_country_code' => "+92",
            'phone' => '3001234567',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'role_id' => 1,
            'is_approved' => 1
        ]);
    }
}
