<?php

use Livewire\Volt\Component;
use App\Models\GalleryItem;

new class extends Component {
    public $selectedCategory = 'all';

    public function selectCategory($category)
    {
        $this->selectedCategory = $category;
    }

    public function with(): array
    {
        return [
            'galleryItems' => GalleryItem::query()
                ->when($this->selectedCategory !== 'all', fn($q) => $q->where('category', $this->selectedCategory))
                ->orderBy('is_featured', 'desc')
                ->orderBy('order')
                ->get(),
            'categories' => [
                'all' => 'Tất cả',
                'facility' => 'Cơ sở vật chất',
                'team' => 'Đội ngũ',
                'treatments' => 'Điều trị',
                'before_after' => 'Trước & Sau',
            ],
            'featuredItems' => GalleryItem::where('is_featured', true)
                ->orderBy('order')
                ->limit(6)
                ->get(),
        ];
    }

    public function layout()
    {
        return 'layouts.app';
    }
}; ?>

<x-slot name="title">Thư viện ảnh - SmileLux</x-slot>

<div class="min-h-screen bg-white">
    <!-- Hero Section -->
    <div class="relative bg-cover bg-center pt-32 pb-24" style="background-image: url('https://source.unsplash.com/random/1440x600/?dentistry,clinic')">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/70 to-blue-600/70"></div>
        <div class="relative max-w-7xl mx-auto px-5">
            <div class="text-center">
                <h1 class="text-5xl md:text-6xl font-bold mb-4 text-white">
                    Thư viện ảnh
                </h1>
                <div class="flex justify-center mt-8 mb-6">
                    <svg class="w-64 h-1 text-white" viewBox="0 0 256 1" fill="none">
                        <path d="M0 0.5L256 0.5" stroke="currentColor" stroke-width="1"/>
                    </svg>
                </div>
                <p class="text-xl text-gray-200">Khám phá cơ sở vật chất và kết quả điều trị tại SmileLux</p>
            </div>
        </div>
    </div>

    <!-- Category Filter -->
    <div class="max-w-7xl mx-auto px-5 -mt-8 mb-12">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <div class="flex flex-wrap gap-3 justify-center">
                @foreach($categories as $key => $label)
                    <button wire:click="selectCategory('{{ $key }}')"
                            class="px-6 py-3 rounded-full font-semibold transition-all {{ $selectedCategory === $key ? 'bg-blue-600 text-white shadow-lg' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured Section -->
    @if($featuredItems->count() > 0 && $selectedCategory === 'all')
        <div class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-5">
                <div class="text-center mb-8">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">Hình ảnh nổi bật</span>
                    </h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($featuredItems as $item)
                        <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-xl transition-shadow">
                            @if($item->is_before_after)
                                <div class="aspect-w-16 aspect-h-9 relative">
                                    <div class="grid grid-cols-2 h-64">
                                        <img src="{{ $item->before_image }}" 
                                             alt="Before" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        <img src="{{ $item->after_image }}" 
                                             alt="After" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end">
                                        <div class="p-4 text-white">
                                            <p class="font-semibold">Trước & Sau</p>
                                            <p class="text-sm opacity-90">{{ $item->title }}</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <img src="{{ $item->image_path }}" 
                                     alt="{{ $item->title }}" 
                                     class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                                    <div class="p-4 text-white">
                                        <p class="font-semibold">{{ $item->title }}</p>
                                        @if($item->description)
                                            <p class="text-sm opacity-90 line-clamp-2">{{ Str::limit($item->description, 60) }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Gallery Grid -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-5">
            @if($galleryItems->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($galleryItems as $item)
                        <div class="group relative overflow-hidden rounded-2xl shadow-md hover:shadow-xl transition-all duration-300">
                            @if($item->is_before_after)
                                <div class="aspect-w-16 aspect-h-9 relative">
                                    <div class="grid grid-cols-2 h-48">
                                        <img src="{{ $item->before_image }}" 
                                             alt="Before" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                        <img src="{{ $item->after_image }}" 
                                             alt="After" 
                                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>
                                </div>
                            @else
                                <img src="{{ $item->image_path }}" 
                                     alt="{{ $item->title }}" 
                                     class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                            @endif
                            
                            <!-- Overlay on hover -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                                <p class="text-white font-semibold mb-1">{{ $item->title }}</p>
                                @if($item->description)
                                    <p class="text-white text-sm opacity-90 line-clamp-2">{{ Str::limit($item->description, 60) }}</p>
                                @endif
                                <span class="inline-block mt-2 px-3 py-1 bg-blue-600 text-white text-xs rounded-full">
                                    {{ ucfirst($item->category) }}
                                </span>
                            </div>

                            @if($item->is_featured)
                                <div class="absolute top-2 right-2 bg-yellow-400 text-yellow-900 px-2 py-1 rounded-full text-xs font-bold">
                                    ⭐ Nổi bật
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <p class="text-gray-500 text-lg">Không có hình ảnh nào trong danh mục này.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Booking Form -->
    @include('layouts.partials.booking-form')
</div>
