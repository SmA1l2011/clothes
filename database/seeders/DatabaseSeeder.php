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
            'name' => 'Adam',
            'email' => 'adamsevastanov220@gmail.com',
            'phone' => '0634967477',
            'password' => Hash::make("12345678"),
            'role' => 'admin',
        ]);
    }
}
