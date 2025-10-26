<x-slot name="title">{{ $doctorId ? 'Edit Doctor' : 'Create Doctor' }}</x-slot>

<div>
    <div class="mb-8">
        <a href="{{ route('admin.doctors.index') }}" class="text-blue-600 hover:text-blue-800 inline-flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to Doctors
        </a>
        <h1 class="text-3xl font-bold text-gray-900 mt-4">{{ $doctorId ? 'Edit Doctor' : 'Create New Doctor' }}</h1>
    </div>

    @if(session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit="save" class="bg-white rounded-lg shadow p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                <input type="text" wire:model="name" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Slug -->
            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug *</label>
                <input type="text" wire:model="slug" id="slug" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                @error('slug') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Specialization -->
            <div>
                <label for="specialization" class="block text-sm font-medium text-gray-700 mb-2">Specialization *</label>
                <input type="text" wire:model="specialization" id="specialization" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                @error('specialization') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Qualification -->
            <div>
                <label for="qualification" class="block text-sm font-medium text-gray-700 mb-2">Qualification *</label>
                <input type="text" wire:model="qualification" id="qualification" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                @error('qualification') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Experience -->
            <div>
                <label for="experience_years" class="block text-sm font-medium text-gray-700 mb-2">Experience (years) *</label>
                <input type="number" wire:model="experience_years" id="experience_years" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                @error('experience_years') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Consultation Fee -->
            <div>
                <label for="consultation_fee" class="block text-sm font-medium text-gray-700 mb-2">Consultation Fee ($) *</label>
                <input type="number" wire:model="consultation_fee" id="consultation_fee" step="0.01" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                @error('consultation_fee') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" wire:model="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                <input type="text" wire:model="phone" id="phone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Order -->
            <div>
                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                <input type="number" wire:model="order" id="order" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Available Status -->
            <div class="md:col-span-2">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" wire:model="is_available" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="text-sm text-gray-700">Available for appointments</span>
                </label>
            </div>

            <!-- Bio -->
            <div class="md:col-span-2">
                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Bio *</label>
                <textarea wire:model="bio" id="bio" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required></textarea>
                @error('bio') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Photo -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Doctor Photo</label>
                <input type="file" wire:model="photo" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                @error('photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                @if($photoPreview)
                    <img src="{{ asset('storage/' . $photoPreview) }}" alt="Preview" class="mt-4 h-40 rounded-lg">
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-8 flex items-center justify-end space-x-4">
            <a href="{{ route('admin.doctors.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Save Doctor
            </button>
        </div>
    </form>
</div>


