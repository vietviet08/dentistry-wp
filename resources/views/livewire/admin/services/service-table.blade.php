<x-slot name="title">Manage Services</x-slot>

<div>
            <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Manage Services</h1>
                <p class="text-gray-600 mt-2">Manage dental services and treatments</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.services.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    + Create Service
                </a>
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                    ← Back
                </a>
            </div>
        </div>

            <!-- Filters -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
            <input type="text" wire:model.live.debounce.300ms="search" 
                               placeholder="Search services..."
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    </div>
            <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
            <select wire:model.live="categoryFilter" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            <option value="">All Categories</option>
                            @foreach($categories as $category)
            <option value="{{ $category }}">{{ ucfirst($category) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Services Table -->
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
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Duration</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bookings</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($services as $service)
            <tr>
            <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900">{{ $service->name }}</div>
                                    </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ ucfirst($service->category) }}
                                        </span>
                                    </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $service->duration }} min
                                    </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        ${{ number_format($service->price, 2) }}
                                    </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $service->appointments_count }}
                                    </td>
            <td class="px-6 py-4 whitespace-nowrap">
            <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $service->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $service->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <div class="flex items-center justify-end space-x-2">
                    <a href="{{ route('admin.services.edit', $service->id) }}" class="text-blue-600 hover:text-blue-900">
                        Edit
                    </a>
                    <button wire:click="toggleActive({{ $service->id }})" class="text-yellow-600 hover:text-yellow-900">
                        {{ $service->is_active ? 'Deactivate' : 'Activate' }}
                    </button>
                    <button wire:click="deleteService({{ $service->id }})" 
                            wire:confirm="Are you sure you want to delete this service?"
                            class="text-red-600 hover:text-red-900">
                        Delete
                    </button>
                </div>
            </td>
                                </tr>
                            @empty
            <tr>
            <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                        No services found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    {{ $services->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
