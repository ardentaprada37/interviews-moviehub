<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'username' => 'aldmic',
            'name' => 'Aldmic User',
            'email' => 'aldmic@example.com',
            'password' => bcrypt('123abc123'),
        ]);
    }
}
