<x-slot name="title">Manage Doctors</x-slot>

<div>
            <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Manage Doctors</h1>
                <p class="text-gray-600 mt-2">Manage doctor profiles and schedules</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.doctors.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    + Create Doctor
                </a>
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                    ← Back
                </a>
            </div>
        </div>

            <!-- Search -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="flex items-center space-x-4">
        <input type="text" wire:model.live.debounce.300ms="search" 
            placeholder="Search by name or specialization..."
            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
        <label class="flex items-center space-x-2">
        <input type="checkbox" wire:model.live="showInactive" class="rounded border-gray-300">
        <span class="text-sm text-gray-700">Show inactive doctors</span>
            </label>
            </div>
            </div>

            <!-- Doctors Table -->
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
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Doctor</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Specialization</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Experience</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fee</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Appointments</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
            </thead>
        <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($doctors as $doctor)
        <tr>
        <td class="px-6 py-4 whitespace-nowrap">
        <div class="flex items-center">
                                                @if($doctor->photo)
        <img src="{{ asset('storage/' . $doctor->photo) }}" alt="" class="h-10 w-10 rounded-full">
                                                @else
        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
        <span class="text-gray-600">{{ substr($doctor->name, 0, 1) }}</span>
            </div>
                                                @endif
        <div class="ml-4">
        <div class="text-sm font-medium text-gray-900">{{ $doctor->name }}</div>
            </div>
            </div>
            </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $doctor->specialization }}
            </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $doctor->experience_years }} years
            </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
            ${{ number_format($doctor->consultation_fee, 2) }}
            </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $doctor->appointments_count }}
            </td>
        <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $doctor->is_available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $doctor->is_available ? 'Available' : 'Unavailable' }}
            </span>
            </td>
        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <div class="flex items-center justify-end space-x-2">
                <a href="{{ route('admin.doctors.edit', $doctor->id) }}" class="text-blue-600 hover:text-blue-900">
                    Edit
                </a>
                <a href="{{ route('admin.doctors.schedule', $doctor->id) }}" class="text-green-600 hover:text-green-900">
                    Schedule
                </a>
                <button wire:click="toggleAvailability({{ $doctor->id }})" class="text-yellow-600 hover:text-yellow-900">
                    {{ $doctor->is_available ? 'Unavailable' : 'Available' }}
                </button>
                <button wire:click="deleteDoctor({{ $doctor->id }})" 
                        wire:confirm="Are you sure you want to delete this doctor?"
                        class="text-red-600 hover:text-red-900">
                    Delete
                </button>
            </div>
        </td>
            </tr>
                                @empty
        <tr>
        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
            No doctors found
            </td>
            </tr>
                                @endforelse
            </tbody>
            </table>
            </div>

            <!-- Pagination -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        {{ $doctors->links() }}
            </div>
            </div>
        </div>
    </div>
</div>