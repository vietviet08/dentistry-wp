<div class="max-w-7xl mx-auto py-8">
    <div class="flex justify-between items-center mb-8">
        <flux:heading>My Appointments</flux:heading>
        <flux:button href="{{ route('appointments.create') }}" variant="primary">
            Book Appointment
        </flux:button>
    </div>

    <!-- Filter Tabs -->
    <div class="flex gap-2 mb-6">
        <button wire:click="setFilter('all')" 
                class="px-4 py-2 rounded-lg transition-colors
                    @if($statusFilter === 'all') bg-blue-600 text-white @else bg-gray-100 hover:bg-gray-200 @endif">
            All
        </button>
        <button wire:click="setFilter('upcoming')" 
                class="px-4 py-2 rounded-lg transition-colors
                    @if($statusFilter === 'upcoming') bg-blue-600 text-white @else bg-gray-100 hover:bg-gray-200 @endif">
            Upcoming
        </button>
        <button wire:click="setFilter('past')" 
                class="px-4 py-2 rounded-lg transition-colors
                    @if($statusFilter === 'past') bg-blue-600 text-white @else bg-gray-100 hover:bg-gray-200 @endif">
            Past
        </button>
        <button wire:click="setFilter('cancelled')" 
                class="px-4 py-2 rounded-lg transition-colors
                    @if($statusFilter === 'cancelled') bg-blue-600 text-white @else bg-gray-100 hover:bg-gray-200 @endif">
            Cancelled
        </button>
    </div>

    <!-- Appointments List -->
    @if($appointments->count() > 0)
        <div class="space-y-4">
            @foreach($appointments as $appointment)
                <div class="bg-white rounded-lg shadow border p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <div class="flex items-center gap-4 mb-2">
                                <h3 class="text-xl font-bold">{{ $appointment->service->name }}</h3>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($appointment->status === 'confirmed') bg-green-100 text-green-800
                                    @elseif($appointment->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($appointment->status === 'completed') bg-blue-100 text-blue-800
                                    @elseif($appointment->status === 'cancelled') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ strtoupper($appointment->status) }}
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm text-gray-600">
                                <div>
                                    <strong>Doctor:</strong> Dr. {{ $appointment->doctor->name }}
                                </div>
                                <div>
                                    <strong>Date:</strong> {{ $appointment->appointment_date->format('M d, Y') }}
                                </div>
                                <div>
                                    <strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
                                </div>
                                <div>
                                    <strong>Duration:</strong> {{ $appointment->service->duration }} min
                                </div>
                            </div>

                            @if($appointment->notes)
                                <div class="mt-2 text-sm text-gray-600">
                                    <strong>Notes:</strong> {{ $appointment->notes }}
                                </div>
                            @endif
                        </div>

                        <div class="flex flex-col gap-2">
                            @if($appointment->status === 'pending' && $appointment->canBeCancelledBy(auth()->user()))
                                <button wire:click="cancel({{ $appointment->id }})" 
                                        wire:confirm="Are you sure you want to cancel this appointment?"
                                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                    Cancel
                                </button>
                            @endif
                            
                            <a href="{{ route('appointments.show', $appointment) }}" 
                               class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-center">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            <div class="mt-6">
                {{ $appointments->links() }}
            </div>
        </div>
    @else
        <div class="text-center py-12 bg-white rounded-lg">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">No Appointments Found</h3>
            <p class="text-gray-600 mb-4">You don't have any appointments yet.</p>
            <flux:button href="{{ route('appointments.create') }}" variant="primary">
                Book Your First Appointment
            </flux:button>
        </div>
    @endif
</div>

