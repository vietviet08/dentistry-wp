<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = Carbon::now()->addDays(rand(1, 30));
        $startTime = Carbon::parse('09:00')->addMinutes(rand(0, 16) * 30); // Every 30 min slots
        $service = Service::inRandomOrder()->first();
        $endTime = $startTime->copy()->addMinutes($service->duration ?? 30);

        return [
            'patient_id' => User::factory(),
            'doctor_id' => Doctor::inRandomOrder()->first()?->id ?? Doctor::factory(),
            'service_id' => $service->id ?? Service::factory(),
            'appointment_date' => $startDate->format('Y-m-d'),
            'appointment_time' => $startTime->format('H:i:s'),
            'end_time' => $endTime->format('H:i:s'),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'completed', 'cancelled', 'no_show']),
            'notes' => $this->faker->optional(0.3)->sentence(),
            'admin_notes' => $this->faker->optional(0.2)->sentence(),
        ];
    }

    /**
     * Indicate that the appointment is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * Indicate that the appointment is confirmed.
     */
    public function confirmed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'confirmed',
            'confirmed_at' => now(),
        ]);
    }

    /**
     * Indicate that the appointment is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'confirmed_at' => now()->subDays(1),
        ]);
    }

    /**
     * Indicate that the appointment is cancelled.
     */
    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'cancellation_reason' => $this->faker->sentence(),
        ]);
    }

    /**
     * Generate an upcoming appointment (next week or later).
     */
    public function upcoming(): static
    {
        return $this->state(fn (array $attributes) => [
            'appointment_date' => now()->addWeek()->addDays(rand(0, 14))->format('Y-m-d'),
            'status' => $this->faker->randomElement(['pending', 'confirmed']),
        ]);
    }

    /**
     * Generate a past appointment.
     */
    public function past(): static
    {
        return $this->state(fn (array $attributes) => [
            'appointment_date' => now()->subDays(rand(1, 30))->format('Y-m-d'),
            'status' => 'completed',
            'confirmed_at' => now()->subDays(rand(1, 30)),
        ]);
    }
}

