<x-slot name="title">{{ __('doctor.appointments.calendar') }}</x-slot>

<div>
    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ __('doctor.appointments.calendar') }}</h1>
            <p class="text-gray-600 mt-2">{{ __('doctor.appointments.calendar_subtitle') }}</p>
        </div>
        <div class="flex space-x-2">
            <button wire:click="previousMonth" 
                class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50">
                ← {{ __('doctor.common.previous') }}
            </button>
            <span class="px-4 py-2 font-medium text-gray-900">
                {{ $selectedDate->format('F Y') }}
            </span>
            <button wire:click="nextMonth" 
                class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50">
                {{ __('doctor.common.next') }} →
            </button>
            <a href="{{ route('doctor.appointments.index') }}" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50">
                {{ __('doctor.common.table_view') }}
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
                                    {{ $appointment->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                    hover:opacity-75">
                                {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
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
            <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white" wire:click.stop>
                <div class="mt-3">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">{{ __('doctor.appointments.appointment_details') }}</h3>
                        <button wire:click="closeDetails" class="text-gray-400 hover:text-gray-500">
                            ✕
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">{{ __('doctor.appointments.patient') }}</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $selectedAppointment->patient->name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">{{ __('doctor.appointments.service') }}</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $selectedAppointment->service->name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">{{ __('doctor.appointments.date_time') }}</label>
                            <p class="mt-1 text-sm text-gray-900">
                                {{ $selectedAppointment->appointment_date->format('M d, Y') }}
                                at {{ \Carbon\Carbon::parse($selectedAppointment->appointment_time)->format('H:i') }}
                            </p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">{{ __('doctor.common.status') }}</label>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-1
                                @if($selectedAppointment->status === 'completed') bg-green-100 text-green-800
                                @elseif($selectedAppointment->status === 'confirmed') bg-blue-100 text-blue-800
                                @elseif($selectedAppointment->status === 'pending') bg-yellow-100 text-yellow-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ __('patient.appointments.status.' . $selectedAppointment->status) }}
                            </span>
                        </div>
                        @if($selectedAppointment->notes)
                            <div>
                                <label class="text-sm font-medium text-gray-500">{{ __('doctor.appointments.patient_notes') }}</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $selectedAppointment->notes }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <a href="{{ route('doctor.appointments.show', $selectedAppointment) }}" 
                           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            {{ __('doctor.common.view_details') }}
                        </a>
                        <button wire:click="closeDetails" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">
                            {{ __('doctor.common.close') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

