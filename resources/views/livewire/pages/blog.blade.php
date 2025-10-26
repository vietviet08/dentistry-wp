<?php

use Livewire\Volt\Component;
use App\Models\Post;

new class extends Component {
    public function with(): array
    {
        return [
            'posts' => Post::where('status', 'published')
                          ->orderBy('published_at', 'desc')
                          ->paginate(10),
        ];
    }

    public function layout()
    {
        return 'layouts.app';
    }
}; ?>

<x-slot name="title">Blog - SmileLux</x-slot>

<div class="min-h-screen bg-white">
    <!-- Hero Section -->
    <div class="bg-blue-100 py-20">
        <div class="max-w-7xl mx-auto px-5">
            <div class="relative">
                <img src="https://source.unsplash.com/random/1200x600/?dentistry,dental,smile" 
                     alt="Dental Care" 
                     class="w-full h-96 object-cover rounded-2xl">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-600/80 to-transparent rounded-2xl flex items-center">
                    <div class="px-8 md:px-12 py-12 text-white">
                        <p class="text-blue-100 text-xl font-medium mb-2">BLOG - NEWS</p>
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                            Chăm sóc nụ cười của bạn
                        </h1>
                        <svg class="w-72 h-6 text-white" viewBox="0 0 284 6" fill="none">
                            <path d="M0 3 L282 3" stroke="currentColor" stroke-width="6" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Posts Grid -->
    <div class="py-16">
        <div class="max-w-7xl mx-auto px-5">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($posts as $post)
                    <a href="{{ route('blog-detail', $post) }}" class="block">
                        <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow group cursor-pointer">
                            <!-- Featured Image -->
                            <div class="relative h-56 overflow-hidden">
                                <img src="{{ $post->featured_image ?: 'https://source.unsplash.com/random/800x600/?dentistry,dental' }}" 
                                     alt="{{ $post->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            </div>
                            
                            <!-- Content -->
                            <div class="p-6">
                                <h2 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-blue-600 transition">
                                    {{ $post->title }}
                                </h2>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ $post->excerpt ?: Str::limit(strip_tags($post->content), 120) }}
                            </p>
                            
                            <!-- Meta Information -->
                            <div class="flex items-center justify-between text-sm text-gray-500 border-t border-gray-200 pt-4">
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>{{ $post->published_at?->format('d M Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span>{{ $post->author->name ?? 'Team SmileLux' }}</span>
                                </div>
                            </div>
                        </div>
                        </article>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
