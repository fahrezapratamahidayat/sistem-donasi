<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin default
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Mitra default
        User::factory()->create([
            'name' => 'Mitra',
            'email' => 'mitra@example.com',
            'password' => bcrypt('password'),
            'role' => 'mitra',
        ]);

        // Sample donatur
        User::factory(5)->create([
            'role' => 'donatur'
        ]);
    }
}
