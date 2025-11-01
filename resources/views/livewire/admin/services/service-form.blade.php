<x-slot name="title">{{ $serviceId ? __('admin.forms.edit_service') : __('admin.forms.create_service') }}</x-slot>

<div>
    <div class="mb-8">
        <a href="{{ route('admin.services.index') }}" class="text-blue-600 hover:text-blue-800 inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            {{ __('admin.forms.back_to_services') }}
        </a>
        <h1 class="text-3xl font-bold text-gray-900 mt-4">{{ $serviceId ? __('admin.forms.edit_service') : __('admin.forms.create_service') }}</h1>
    </div>

    @if(session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit="save" class="bg-white rounded-lg shadow p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div class="md:col-span-2">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.forms.service_name') }} *</label>
                <input type="text" wire:model="name" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Slug -->
            <div class="md:col-span-2">
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.forms.slug') }} *</label>
                <input type="text" wire:model="slug" id="slug" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                @error('slug') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Category -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.forms.category') }} *</label>
                <select wire:model="category" id="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    <option value="general">General</option>
                    <option value="cosmetic">Cosmetic</option>
                    <option value="orthodontics">Orthodontics</option>
                    <option value="surgery">Surgery</option>
                    <option value="emergency">Emergency</option>
                    <option value="pediatric">Pediatric</option>
                </select>
                @error('category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Duration -->
            <div>
                <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.forms.duration_minutes') }} *</label>
                <input type="number" wire:model="duration" id="duration" min="15" step="15" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                @error('duration') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Price -->
            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.forms.price') }} *</label>
                <input type="number" wire:model="price" id="price" step="0.01" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Order -->
            <div>
                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.forms.display_order') }}</label>
                <input type="number" wire:model="order" id="order" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('order') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Icon -->
            <div>
                <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.forms.icon') }}</label>
                <input type="text" wire:model="icon" id="icon" placeholder="🦷" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Active Status -->
            <div class="md:col-span-2">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" wire:model="is_active" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="text-sm text-gray-700">{{ __('admin.forms.active_visible') }}</span>
                </label>
            </div>

            <!-- Description -->
            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.forms.description') }} *</label>
                <textarea wire:model="description" id="description" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required></textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Featured Image -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.forms.featured_image') }}</label>
                <input type="file" wire:model="image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                @if($imagePreview)
                    <img src="{{ asset('storage/' . $imagePreview) }}" alt="Preview" class="mt-4 h-40 rounded-lg">
                @endif
            </div>

            <!-- SEO Meta -->
            <div class="md:col-span-2">
                <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('admin.forms.seo_settings') }}</h3>
            </div>

            <div class="md:col-span-2">
                <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.forms.meta_title') }}</label>
                <input type="text" wire:model="meta_title" id="meta_title" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('meta_title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="md:col-span-2">
                <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.forms.meta_description') }}</label>
                <textarea wire:model="meta_description" id="meta_description" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                @error('meta_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-8 flex items-center justify-end space-x-4">
            <a href="{{ route('admin.services.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                {{ __('admin.common.cancel') }}
            </a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                {{ __('admin.forms.save_service') }}
            </button>
        </div>
    </form>
</div>


