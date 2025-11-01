<?php

use Livewire\Volt\Component;
use App\Models\Post;

new class extends Component {
    public Post $post;

    public function mount(Post $post): void
    {
        $this->post = $post;
    }

    public function with(): array
    {
        return [
            'relatedPosts' => Post::where('status', 'published')
                                  ->where('id', '!=', $this->post->id)
                                  ->where('category', $this->post->category)
                                  ->orderBy('published_at', 'desc')
                                  ->limit(3)
                                  ->get(),
        ];
    }

    public function layout()
    {
        return 'layouts.app';
    }
}; ?>

<x-slot name="title">{{ $post->title }} - SmileLux</x-slot>

<div class="min-h-screen bg-white">
    <!-- Hero Section -->
    <div class="bg-blue-100 py-20 relative">
        <div class="absolute inset-0 overflow-hidden">
            <img src="{{ $post->featured_image ?: 'https://source.unsplash.com/random/1200x650/?dentistry,dental' }}" 
                 alt="{{ $post->title }}" 
                 class="w-full h-full object-cover opacity-20">
        </div>
        <div class="relative max-w-7xl mx-auto px-5">
            <div class="bg-blue-50 rounded-2xl p-8 md:p-12 text-center shadow-lg">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">{{ $post->title }}</span>
                </h1>
                <svg class="w-96 h-6 mx-auto" viewBox="0 0 400 6" fill="none">
                    <path d="M0 3 L400 3" stroke="url(#gradient)" stroke-width="6" stroke-linecap="round"/>
                    <defs>
                        <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                            <stop offset="0%" style="stop-color:#0071F9;stop-opacity:1" />
                            <stop offset="100%" style="stop-color:#2E3192;stop-opacity:1" />
                        </linearGradient>
                    </defs>
                </svg>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-5 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar -->
            <div class="lg:w-80 space-y-6">
                <!-- Author & Date Info -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="space-y-4">
                        <!-- Author -->
                        <div>
                            <p class="text-gray-500 text-sm mb-1">{{ __('blog.show.author') }}</p>
                            <p class="text-gray-800 font-semibold">{{ $post->author->name ?? 'Team SmileLux' }}</p>
                        </div>
                        <!-- Date -->
                        <div>
                            <p class="text-gray-500 text-sm mb-1">{{ __('blog.show.published_on') }}</p>
                            <p class="text-gray-800 font-semibold">{{ $post->published_at?->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Table of Contents -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-xl font-bold text-blue-600 mb-4">{{ __('blog.show.table_of_contents') }}</h3>
                    <div class="space-y-2">
                        <a href="#introduction" class="block p-3 rounded-xl bg-white hover:bg-blue-50 transition">
                            <span class="text-gray-800">{{ __('blog.show.introduction') }}</span>
                        </a>
                        <a href="#equipment" class="block p-3 rounded-xl bg-blue-50 text-blue-700 hover:bg-blue-100 transition">
                            <span class="font-semibold">{{ __('blog.show.equipment') }}</span>
                        </a>
                        <a href="#conclusion" class="block p-3 rounded-xl bg-white hover:bg-blue-50 transition">
                            <span class="text-gray-800">{{ __('blog.show.conclusion') }}</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Article Content -->
            <div class="flex-1">
                <article class="prose prose-lg max-w-none">
                    <!-- Excerpt -->
                    <p class="text-gray-700 text-lg leading-relaxed mb-8">
                        {{ $post->excerpt ?: Str::limit(strip_tags($post->content), 300) }}
                    </p>

                    <!-- Post Content -->
                    <div class="space-y-8 text-gray-700 leading-relaxed">
                        {!! nl2br(e($post->content)) !!}
                    </div>

                    <!-- Featured Image in Content -->
                    @if($post->featured_image)
                        <div class="my-8">
                            <img src="{{ $post->featured_image }}" 
                                 alt="{{ $post->title }}" 
                                 class="w-full h-auto rounded-2xl shadow-lg">
                        </div>
                    @endif

                    <!-- Additional Content Sections -->
                    <div class="mt-8 space-y-8">
                        <section id="equipment">
                            <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800 mb-4">
                                {{ __('blog.show.highlights') }}
                            </h2>
                            <ul class="space-y-3 text-gray-700">
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>{{ __('blog.show.highlights_item1') }}</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>{{ __('blog.show.highlights_item2') }}</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>{{ __('blog.show.highlights_item3') }}</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>{{ __('blog.show.highlights_item4') }}</span>
                                </li>
                            </ul>
                        </section>

                        <!-- Gallery Images -->
                        <div class="grid grid-cols-3 gap-4 my-8">
                            <img src="https://source.unsplash.com/random/400x300/?dentistry,dental,smile" 
                                 alt="Dental procedure" 
                                 class="w-full h-auto rounded-xl shadow-lg">
                            <img src="https://source.unsplash.com/random/400x300/?dentistry,dental,teeth" 
                                 alt="Dental care" 
                                 class="w-full h-auto rounded-xl shadow-lg">
                            <img src="https://source.unsplash.com/random/400x300/?dentistry,dental,clinic" 
                                 alt="Dental clinic" 
                                 class="w-full h-auto rounded-xl shadow-lg">
                        </div>

                        <section id="conclusion">
                            <h2 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800 mb-4">
                                {{ __('blog.show.conclusion') }}
                            </h2>
                            <p class="text-gray-700 leading-relaxed">
                                Dán sứ Veneer không chỉ mang lại một nụ cười sáng đẹp mà còn giúp bạn tìm lại sự tự tin trong cuộc sống. Với đội ngũ bác sĩ tận tâm, công nghệ hiện đại và chính sách bảo hành minh bạch, SmileLux cam kết đồng hành cùng bạn trên hành trình kiến tạo nụ cười hạnh phúc.
                            </p>
                        </section>
                    </div>
                </article>

                <!-- Related Posts -->
                @if($relatedPosts->isNotEmpty())
                    <section class="mt-16">
                        <h2 class="text-3xl md:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800 mb-8">
                            {{ __('blog.show.related_posts') }}
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($relatedPosts as $relatedPost)
                                <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
                                    <div class="relative h-48 overflow-hidden">
                                        <img src="{{ $relatedPost->featured_image ?: 'https://source.unsplash.com/random/400x300/?dentistry,dental' }}" 
                                             alt="{{ $relatedPost->title }}" 
                                             class="w-full h-full object-cover hover:scale-110 transition-transform duration-300">
                                    </div>
                                    <div class="p-5">
                                        <span class="text-blue-600 text-sm font-semibold">{{ $relatedPost->category }}</span>
                                        <h3 class="text-lg font-bold text-gray-800 mt-2 mb-3 line-clamp-2">
                                            {{ $relatedPost->title }}
                                        </h3>
                                        <div class="flex items-center justify-between text-sm text-gray-500 border-t border-gray-200 pt-3">
                                            <div class="flex items-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span>{{ $relatedPost->published_at?->format('d M Y') }}</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                <span>{{ $relatedPost->author->name ?? 'Team SmileLux' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>
                @endif
            </div>
        </div>
    </div>
</div>
