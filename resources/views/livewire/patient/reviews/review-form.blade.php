<div>
    <x-layouts.app>
        <x-slot name="title">Write a Review</x-slot>

        <div class="py-12">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Write a Review</h1>
                    <p class="text-gray-600 mt-2">Share your experience with us</p>
                </div>

                <!-- Appointment Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Appointment Details</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Service</p>
                            <p class="font-medium text-gray-900">{{ $appointment->service->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Doctor</p>
                            <p class="font-medium text-gray-900">{{ $appointment->doctor->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Date</p>
                            <p class="font-medium text-gray-900">{{ $appointment->appointment_date->format('M d, Y') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Time</p>
                            <p class="font-medium text-gray-900">{{ $appointment->appointment_time->format('h:i A') }}</p>
                        </div>
                    </div>
                </div>

                <form wire:submit="submit" class="bg-white rounded-lg shadow p-8">
                    <!-- Rating -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-4">Rating</label>
                        <div class="flex items-center space-x-2">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" 
                                        wire:click="$set('rating', {{ $i }})"
                                        class="focus:outline-none">
                                    <svg class="w-12 h-12 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </button>
                            @endfor
                        </div>
                        @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Comment -->
                    <div class="mb-6">
                        <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Your Review</label>
                        <textarea id="comment" 
                                  wire:model="comment" 
                                  rows="6"
                                  placeholder="Share your experience with us..."
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('comment') border-red-500 @enderror"></textarea>
                        @error('comment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end space-x-4">
                        <a href="{{ route('appointments.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Submit Review
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-layouts.app>
</div>
