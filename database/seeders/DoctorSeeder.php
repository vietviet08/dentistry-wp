<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create doctors - factory will automatically create user accounts
        $doctors = Doctor::factory()->count(5)->create();

        // Create schedules for each doctor (Mon-Fri)
        foreach ($doctors as $doctor) {
            // Ensure doctor has user account
            if (!$doctor->user_id) {
                $user = \App\Models\User::create([
                    'name' => $doctor->name,
                    'email' => $doctor->email ?? \Str::slug($doctor->name) . '@dentistry.test',
                    'password' => bcrypt('password'),
                    'role' => 'doctor',
                    'is_active' => $doctor->is_available,
                    'email_verified_at' => now(),
                    'phone' => $doctor->phone,
                ]);
                $doctor->update(['user_id' => $user->id]);
            }

            // Create schedules
            for ($day = 1; $day <= 5; $day++) {
                $doctor->schedules()->create([
                    'day_of_week' => $day,
                    'start_time' => '09:00:00',
                    'end_time' => '17:00:00',
                    'break_start' => '12:00:00',
                    'break_end' => '13:00:00',
                    'slot_duration' => 30,
                ]);
            }
        }
    }
}
