<x-slot name="title">Manage Patients</x-slot>

<div>
    <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
        <div>
        <h1 class="text-3xl font-bold text-gray-900">Manage Patients</h1>
        <p class="text-gray-600 mt-2">View and manage patient information</p>
            </div>
        <a href="{{ route('admin.dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            ← Back
            </a>
            </div>

            <!-- Search -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
        <input type="text" wire:model.live.debounce.300ms="search" 
            placeholder="Search by name, email, or phone..."
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Patients Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Patient</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member Since</th>
        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
            </thead>
        <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($patients as $patient)
        <tr>
        <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
        <div class="flex-shrink-0 h-10 w-10">
                                                    @if($patient->avatar)
        <img src="{{ asset('storage/' . $patient->avatar) }}" alt="" class="h-10 w-10 rounded-full">
                                                    @else
        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
        <span class="text-gray-600">{{ substr($patient->name, 0, 1) }}</span>
            </div>
                                                    @endif
            </div>
        <div class="ml-4">
        <div class="text-sm font-medium text-gray-900">{{ $patient->name }}</div>
        <div class="text-sm text-gray-500">{{ $patient->email }}</div>
            </div>
            </div>
            </td>
        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($patient->phone)
        <p class="text-sm text-gray-900">{{ $patient->phone }}</p>
                                            @else
        <p class="text-sm text-gray-400">No phone</p>
                                            @endif
                                            @if($patient->profile && $patient->profile->address)
        <p class="text-xs text-gray-500">{{ Str::limit($patient->profile->address, 30) }}</p>
                                            @endif
            </td>
        <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $patient->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $patient->is_active ? 'Active' : 'Inactive' }}
            </span>
            </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $patient->created_at->format('M d, Y') }}
            </td>
        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
        <a href="{{ route('admin.patients.show', $patient->id) }}" 
            class="text-blue-600 hover:text-blue-900">
            View Details
            </a>
            </td>
            </tr>
                                @empty
        <tr>
        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
            No patients found
            </td>
            </tr>
                                @endforelse
            </tbody>
            </table>
            </div>

            <!-- Pagination -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        {{ $patients->links() }}
            </div>
            </div>
        </div>
    </div>
</div>