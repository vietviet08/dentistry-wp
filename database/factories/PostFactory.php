<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'author_id' => User::factory(),
            'title' => fake()->sentence(rand(5, 10)),
            'slug' => fake()->unique()->slug(),
            'excerpt' => fake()->paragraph(rand(2, 4)),
            'content' => fake()->paragraphs(rand(5, 10), true),
            'featured_image' => 'https://source.unsplash.com/random/800x600/?dentistry,dental',
            'category' => fake()->randomElement(['Thẩm mỹ răng', 'Điều trị nha khoa', 'Chăm sóc răng miệng', 'Kiến thức nha khoa']),
            'tags' => fake()->words(rand(3, 6)),
            'status' => 'published',
            'published_at' => fake()->dateTimeBetween('-30 days', 'now'),
            'views_count' => fake()->numberBetween(0, 1000),
            'meta_title' => fake()->sentence(rand(8, 12)),
            'meta_description' => fake()->paragraph(),
            'meta_keywords' => implode(', ', fake()->words(rand(5, 10))),
        ];
    }
}
