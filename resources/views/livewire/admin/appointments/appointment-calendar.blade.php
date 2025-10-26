<x-slot name="title">Appointment Calendar</x-slot>

<div>

<div>
    <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
        <div>
        <h1 class="text-3xl font-bold text-gray-900">Appointment Calendar</h1>
        <p class="text-gray-600 mt-2">View appointments by date</p>
            </div>
        <div class="flex space-x-2">
        <button wire:click="$set('selectedDate', '{{ $selectedDate->copy()->subMonth()->format('Y-m-d') }}')" 
            class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50">
            ← Previous
            </button>
        <span class="px-4 py-2 font-medium text-gray-900">
                            {{ $selectedDate->format('F Y') }}
            </span>
        <button wire:click="$set('selectedDate', '{{ $selectedDate->copy()->addMonth()->format('Y-m-d') }}')" 
            class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50">
            Next →
            </button>
        <a href="{{ route('admin.appointments.index') }}" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50">
            Table View
            </a>
            </div>
            </div>

            <!-- Calendar Grid -->
        <div class="bg-white rounded-lg shadow p-6">
            <!-- Day Headers -->
        <div class="grid grid-cols-7 gap-2 mb-4">
                        @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
        <div class="text-center text-sm font-medium text-gray-500">{{ $day }}</div>
                        @endforeach
            </div>

            <!-- Calendar -->
        <div class="grid grid-cols-7 gap-2">
                        @foreach($calendar as $day)
        <div class="border border-gray-200 rounded-lg p-2 min-h-[100px]
                                {{ !$day['isCurrentMonth'] ? 'bg-gray-50' : '' }}
                                {{ $day['isToday'] ? 'ring-2 ring-blue-500' : '' }}">
        <div class="flex items-center justify-between mb-1">
        <span class="text-sm font-medium
                                        {{ $day['isCurrentMonth'] ? 'text-gray-900' : 'text-gray-400' }}
                                        {{ $day['isToday'] ? 'text-blue-600' : '' }}">
                                        {{ $day['date']->day }}
            </span>
            </div>
        <div class="space-y-1">
                                    @foreach($day['appointments']->take(3) as $appointment)
        <button wire:click="selectAppointment({{ $appointment->id }})" 
            class="block w-full text-left text-xs px-2 py-1 rounded truncate
                                                {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
            hover:opacity-75">
                                            {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}
            - {{ Str::limit($appointment->patient->name, 15) }}
            </button>
                                    @endforeach
                                    @if($day['appointments']->count() > 3)
        <div class="text-xs text-gray-500 px-2">
            +{{ $day['appointments']->count() - 3 }} more
            </div>
                                    @endif
            </div>
            </div>
                        @endforeach
            </div>
            </div>

            <!-- Appointment Details Modal -->
                @if($selectedAppointment)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" wire:click="closeDetails">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="mt-3">
        <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-medium text-gray-900">Appointment Details</h3>
        <button wire:click="closeDetails" class="text-gray-400 hover:text-gray-500">
            ✕
            </button>
            </div>
            <div class="space-y-4">
        <div>
        <label class="text-sm font-medium text-gray-500">Patient</label>
        <p class="mt-1 text-sm text-gray-900">{{ $selectedAppointment->patient->name }}</p>
            </div>
            <div>
        <label class="text-sm font-medium text-gray-500">Doctor</label>
        <p class="mt-1 text-sm text-gray-900">{{ $selectedAppointment->doctor->name }}</p>
            </div>
            <div>
        <label class="text-sm font-medium text-gray-500">Service</label>
        <p class="mt-1 text-sm text-gray-900">{{ $selectedAppointment->service->name }}</p>
            </div>
            <div>
        <label class="text-sm font-medium text-gray-500">Date & Time</label>
        <p class="mt-1 text-sm text-gray-900">
                                            {{ $selectedAppointment->appointment_date->format('M d, Y') }} at
                                            {{ \Carbon\Carbon::parse($selectedAppointment->appointment_time)->format('g:i A') }}
            </p>
            </div>
            <div>
        <label class="text-sm font-medium text-gray-500">Status</label>
        <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                            {{ $selectedAppointment->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $selectedAppointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}">
                                            {{ ucfirst($selectedAppointment->status) }}
            </span>
            </div>
            <div class="flex space-x-2">
        <a href="{{ route('admin.appointments.show', $selectedAppointment->id) }}" 
            class="flex-1 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 text-center">
            View Full Details
            </a>
            </div>
            </div>
            </div>
            </div>
            </div>
                @endif
        </div>
    </div>
    