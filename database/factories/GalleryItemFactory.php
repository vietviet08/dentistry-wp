<?php

namespace Database\Factories;

use App\Models\GalleryItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryItemFactory extends Factory
{
    protected $model = GalleryItem::class;

    public function definition(): array
    {
        $categories = ['facility', 'team', 'treatments', 'before_after'];
        
        return [
            'title' => fake()->sentence(rand(3, 6)),
            'category' => fake()->randomElement($categories),
            'image_path' => 'https://source.unsplash.com/random/800x600/?dentistry,dental',
            'thumbnail_path' => 'https://source.unsplash.com/random/400x300/?dentistry,dental',
            'description' => fake()->paragraph(),
            'is_before_after' => false,
            'before_image' => null,
            'after_image' => null,
            'order' => fake()->numberBetween(0, 100),
            'is_featured' => fake()->boolean(30),
        ];
    }

    public function beforeAfter(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'category' => 'before_after',
            'is_before_after' => true,
            'before_image' => 'https://source.unsplash.com/random/800x600/?dental-before',
            'after_image' => 'https://source.unsplash.com/random/800x600/?dental-after',
        ]);
    }

    public function featured(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }
}
