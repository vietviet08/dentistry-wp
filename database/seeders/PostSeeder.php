<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Create published posts
        Post::factory()->count(10)->create([
            'author_id' => User::first()?->id,
        ]);
    }
}
