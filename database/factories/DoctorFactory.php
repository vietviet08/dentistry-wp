<?php

namespace Database\Factories;

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

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'specialization' => fake()->randomElement($specializations),
            'qualification' => 'DDS, '.fake()->randomElement(['MSD', 'PhD', 'FAGD']),
            'experience_years' => fake()->numberBetween(2, 25),
            'bio' => fake()->paragraph(3),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'consultation_fee' => fake()->randomElement([50, 75, 100, 150, 200]),
            'is_available' => true,
            'order' => 0,
        ];
    }
}
