<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['general', 'cosmetic', 'orthodontics', 'surgery', 'emergency', 'pediatric'];
        $services = [
            'Dental Cleaning',
            'Teeth Whitening',
            'Dental Implants',
            'Root Canal Treatment',
            'Braces Installation',
            'Tooth Extraction',
            'Dental Crown',
            'Veneer Application',
            'Gum Treatment',
            'Wisdom Tooth Removal',
            'Cosmetic Bonding',
            'Teeth Straightening',
        ];

        $name = $this->faker->randomElement($services);

        return [
            'name' => $name,
            'slug' => Str::slug($name).'-'.$this->faker->unique()->numberBetween(1000, 9999),
            'category' => $this->faker->randomElement($categories),
            'description' => $this->faker->paragraph(2),
            'duration' => $this->faker->randomElement([30, 45, 60, 90, 120]),
            'price' => $this->faker->randomElement([50, 75, 100, 150, 200, 300, 500]),
            'is_active' => true,
            'order' => 0,
        ];
    }
}
