<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $patients = User::where('role', 'patient')->get();
        $doctors = Doctor::all();
        $services = Service::where('is_active', true)->get();

        if ($patients->isEmpty() || $doctors->isEmpty() || $services->isEmpty()) {
            $this->command->warn('Skipping appointments seeder. Please run User, Doctor, and Service seeders first.');
            return;
        }

        // Create some past appointments (completed)
        Appointment::factory()
            ->count(15)
            ->past()
            ->create([
                'status' => 'completed',
            ]);

        // Create some upcoming confirmed appointments
        Appointment::factory()
            ->count(10)
            ->upcoming()
            ->confirmed()
            ->create();

        // Create some upcoming pending appointments
        Appointment::factory()
            ->count(5)
            ->upcoming()
            ->pending()
            ->create();

        $this->command->info('Created 30 test appointments.');
    }
}

