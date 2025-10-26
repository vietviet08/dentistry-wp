<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Service;
use App\Models\Doctor;
use App\Models\Post;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap.';

    public function handle()
    {
        $sitemap = Sitemap::create();

        // Static pages
        $staticPages = [
            route('home'),
            route('about-us'),
            route('services'),
            route('team'),
            route('blog'),
            route('testimonials'),
            route('faqs'),
            route('contact'),
            route('gallery'),
        ];

        foreach ($staticPages as $url) {
            $sitemap->add($url);
        }

        // Services
        foreach (Service::where('is_active', true)->get() as $service) {
            $sitemap->add(
                Url::create(route('service-detail', $service))
                    ->setPriority(0.8)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        }

        // Doctors
        foreach (Doctor::where('is_available', true)->get() as $doctor) {
            $sitemap->add(
                Url::create(route('doctor-detail', $doctor))
                    ->setPriority(0.8)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        }

        // Blog posts
        foreach (Post::where('status', 'published')->get() as $post) {
            $sitemap->add(
                Url::create(route('blog-detail', $post))
                    ->setPriority(0.7)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setLastModificationDate($post->updated_at)
            );
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully!');
        return 0;
    }
}
