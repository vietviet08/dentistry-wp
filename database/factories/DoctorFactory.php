<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();
        $specializations = [
            'General Dentistry',
            'Orthodontics',
            'Cosmetic Dentistry',
            'Oral Surgery',
            'Pediatric Dentistry',
            'Periodontics',
            'Endodontics',
        ];

        $email = fake()->unique()->safeEmail();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'specialization' => fake()->randomElement($specializations),
            'qualification' => 'DDS, '.fake()->randomElement(['MSD', 'PhD', 'FAGD']),
            'experience_years' => fake()->numberBetween(2, 25),
            'bio' => fake()->paragraph(3),
            'email' => $email,
            'phone' => fake()->phoneNumber(),
            'consultation_fee' => fake()->randomElement([50, 75, 100, 150, 200]),
            'is_available' => true,
            'order' => 0,
        ];
    }

    /**
     * Configure the factory to create a user account for the doctor.
     */
    public function configure()
    {
        return $this->afterCreating(function ($doctor) {
            // Only create user if not already exists
            if (!$doctor->user_id) {
                $user = User::create([
                    'name' => $doctor->name,
                    'email' => $doctor->email,
                    'password' => bcrypt('password'),
                    'role' => 'doctor',
                    'is_active' => $doctor->is_available,
                    'email_verified_at' => now(),
                    'phone' => $doctor->phone,
                ]);

                $doctor->update(['user_id' => $user->id]);
            }
        });
    }
}
