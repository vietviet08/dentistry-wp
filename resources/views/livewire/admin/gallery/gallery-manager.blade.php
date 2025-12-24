<x-slot name="title">{{ __('admin.gallery.title') }}</x-slot>

<div>
    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ __('admin.gallery.title') }}</h1>
            <p class="text-gray-600 mt-2">{{ __('admin.gallery.subtitle') }}</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            ← {{ __('admin.common.back') }}
        </a>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.common.search') }}</label>
                <input type="text" wire:model.live.debounce.300ms="search" 
                       placeholder="{{ __('admin.gallery.search_placeholder') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.services.filter_category') }}</label>
                <select wire:model.live="categoryFilter" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="">{{ __('admin.services.all_categories') }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}">{{ ucfirst($category) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="bg-white rounded-lg shadow p-6">
        @if(session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-6 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if($items->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($items as $item)
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        @if($item->image_path)
                            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-400">{{ __('admin.gallery.no_image') }}</span>
                            </div>
                        @endif
                        <div class="p-4">
                            <h3 class="text-sm font-medium text-gray-900">{{ $item->title }}</h3>
                            <p class="text-xs text-gray-500 mt-1">{{ ucfirst($item->category) }}</p>
                            <div class="mt-3 flex items-center justify-between">
                                <button wire:click="toggleFeatured({{ $item->id }})" 
                                        class="text-sm px-3 py-1 rounded
                                        {{ $item->is_featured ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $item->is_featured ? __('admin.gallery.featured') : __('admin.gallery.not_featured') }}
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $items->links() }}
            </div>
        @else
            <p class="text-center text-gray-500 py-8">{{ __('admin.gallery.no_items') }}</p>
        @endif
    </div>
</div>
