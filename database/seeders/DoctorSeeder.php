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
        $doctors = Doctor::factory()->count(5)->create();

        // Create schedules for each doctor (Mon-Fri)
        foreach ($doctors as $doctor) {
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
