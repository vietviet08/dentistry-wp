<x-slot name="title">Review Moderation</x-slot>

<div>
    <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
        <div>
        <h1 class="text-3xl font-bold text-gray-900">Review Moderation</h1>
        <p class="text-gray-600 mt-2">Moderate patient reviews</p>
            </div>
        <a href="{{ route('admin.dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            ← Back
            </a>
            </div>

            <!-- Filters -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
        <input type="text" wire:model.live.debounce.300ms="search" 
            placeholder="Search by patient name..."
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>
        <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
        <select wire:model.live="statusFilter" 
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
        <option value="">All Status</option>
                                @foreach($statuses as $status)
        <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                @endforeach
            </select>
            </div>
            </div>
            </div>

            <!-- Reviews Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
                    @if(session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 m-6 rounded">
                            {{ session('success') }}
            </div>
                    @endif

        <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comment</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
            </thead>
        <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($reviews as $review)
        <tr>
        <td class="px-6 py-4 whitespace-nowrap">
        <div class="text-sm font-medium text-gray-900">{{ $review->patient->name }}</div>
                                            @if($review->doctor)
        <div class="text-xs text-gray-500">Dr. {{ $review->doctor->name }}</div>
                                            @endif
            </td>
        <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
                                                @for($i = 0; $i < 5; $i++)
                                                    @if($i < $review->rating)
        <span class="text-yellow-400">★</span>
                                                    @else
        <span class="text-gray-300">★</span>
                                                    @endif
                                                @endfor
            </div>
            </td>
        <td class="px-6 py-4">
        <div class="text-sm text-gray-900">{{ Str::limit($review->comment, 80) }}</div>
            </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $review->created_at->format('M d, Y') }}
            </td>
        <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $review->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $review->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $review->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                                {{ ucfirst($review->status) }}
            </span>
            </td>
        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <div class="flex items-center justify-end space-x-3">
                                                @if($review->status === 'pending')
        <button wire:click="approve({{ $review->id }})" 
            class="text-green-600 hover:text-green-900">
            ✓ Approve
            </button>
        <button wire:click="reject({{ $review->id }})" 
            class="text-red-600 hover:text-red-900">
            ✕ Reject
            </button>
                                                @endif
        <button wire:click="toggleFeatured({{ $review->id }})" 
            class="text-yellow-600 hover:text-yellow-900">
                                                    {{ $review->is_featured ? '⭐ Unfeature' : '⭐ Feature' }}
            </button>
            </div>
            </td>
            </tr>
                                @empty
        <tr>
        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
            No reviews found
            </td>
            </tr>
                                @endforelse
            </tbody>
            </table>
            </div>

            <!-- Pagination -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        {{ $reviews->links() }}
            </div>
            </div>
        </div>
    </div>
</div>