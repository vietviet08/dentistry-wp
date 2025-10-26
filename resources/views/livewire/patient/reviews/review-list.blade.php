<div>
    <x-layouts.app>
        <x-slot name="title">My Reviews</x-slot>

        <div class="py-12">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">My Reviews</h1>
                    <p class="text-gray-600 mt-2">Your feedback matters</p>
                </div>

                <!-- Reviews List -->
                <div class="space-y-4">
                    @forelse($reviews as $review)
                        <div class="bg-white rounded-lg shadow p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                            <span class="text-lg font-semibold text-blue-600">{{ substr($review->doctor->name ?? 'N/A', 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $review->doctor->name ?? 'N/A' }}</p>
                                        <p class="text-sm text-gray-600">{{ $review->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                                
                                <!-- Rating -->
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                </div>
                            </div>

                            @if($review->comment)
                                <p class="text-gray-700 mb-4">{{ $review->comment }}</p>
                            @endif

                            <!-- Status -->
                            <div class="flex items-center justify-between">
                                <span class="px-3 py-1 text-xs font-medium rounded-full
                                    @if($review->status === 'approved') bg-green-100 text-green-800
                                    @elseif($review->status === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($review->status) }}
                                </span>

                                @if($review->doctor)
                                    <p class="text-sm text-gray-600">
                                        Dr. {{ $review->doctor->name }} - {{ $review->appointment->service->name ?? 'N/A' }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-lg shadow p-12 text-center">
                            <div class="text-4xl mb-4">⭐</div>
                            <p class="text-gray-500">No reviews yet</p>
                            <p class="text-sm text-gray-400 mt-2">Your reviews will appear here</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($reviews->hasPages())
                    <div class="mt-8">
                        {{ $reviews->links() }}
                    </div>
                @endif
            </div>
        </div>
    </x-layouts.app>
</div>
</div>
