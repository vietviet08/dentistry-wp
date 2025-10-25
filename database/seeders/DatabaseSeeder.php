<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ServiceSeeder::class,
            DoctorSeeder::class,
        ]);

        // Create test users
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@dentistry.test',
            'role' => 'admin',
            'is_active' => true,
        ]);

        User::factory()->create([
            'name' => 'Test Patient',
            'email' => 'patient@dentistry.test',
            'role' => 'patient',
            'is_active' => true,
        ]);
    }
}
