<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use Illuminate\Database\Seeder;

class GalleryItemSeeder extends Seeder
{
    public function run(): void
    {
        // Facility images
        GalleryItem::factory()->count(6)
            ->create(['category' => 'facility']);

        // Team images
        GalleryItem::factory()->count(4)
            ->create(['category' => 'team']);

        // Treatment images
        GalleryItem::factory()->count(8)
            ->create(['category' => 'treatments']);

        // Before/After images
        GalleryItem::factory()->count(4)
            ->beforeAfter()
            ->featured()
            ->create();

        // Some featured items from other categories
        GalleryItem::factory()->count(3)
            ->featured()
            ->create(['category' => 'treatments']);
    }
}
