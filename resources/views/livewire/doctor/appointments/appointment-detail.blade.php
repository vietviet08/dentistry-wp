<x-slot name="title">{{ __('doctor.appointments.details') }}</x-slot>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('doctor.appointments.index') }}" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">
            ← {{ __('doctor.common.back') }}
        </a>
        <h1 class="text-3xl font-bold text-gray-900">{{ __('doctor.appointments.details') }}</h1>
    </div>

    @if(session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Patient Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('doctor.appointments.patient_info') }}</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">{{ __('doctor.appointments.name') }}</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $appointment->patient->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">{{ __('doctor.appointments.email') }}</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $appointment->patient->email }}</p>
                    </div>
                    @if($appointment->patient->phone)
                        <div>
                            <label class="text-sm font-medium text-gray-500">{{ __('doctor.appointments.phone') }}</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $appointment->patient->phone }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Appointment Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('doctor.appointments.appointment_info') }}</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">{{ __('doctor.appointments.service') }}</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $appointment->service->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">{{ __('doctor.appointments.date') }}</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $appointment->appointment_date->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">{{ __('doctor.appointments.time') }}</label>
                        <p class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">{{ __('doctor.common.status') }}</label>
                        <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full
                            {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $appointment->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                            {{ __('patient.appointments.status.' . $appointment->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Patient Notes -->
            @if($appointment->notes)
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('doctor.appointments.patient_notes') }}</h2>
                    <p class="text-sm text-gray-900">{{ $appointment->notes }}</p>
                </div>
            @endif

            <!-- Doctor Notes -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('doctor.appointments.doctor_notes') }}</h2>
                <textarea wire:model="adminNotes" 
                    rows="4" 
                    placeholder="{{ __('doctor.appointments.notes_placeholder') }}"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
                <button wire:click="saveAdminNotes" 
                    class="mt-3 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    {{ __('doctor.appointments.save_notes') }}
                </button>
            </div>
        </div>

        <!-- Right Column - Actions -->
        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('doctor.common.actions') }}</h2>
                <div class="space-y-3">
                    @if(auth()->user()->can('confirm', $appointment) && $appointment->status === 'pending')
                        <button wire:click="confirmAppointment" 
                            class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                            ✓ {{ __('doctor.appointments.confirm') }}
                        </button>
                    @endif

                    @if(auth()->user()->can('complete', $appointment) && $appointment->status === 'confirmed')
                        <button wire:click="completeAppointment" 
                            class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            ✓ {{ __('doctor.appointments.mark_completed') }}
                        </button>
                    @endif

                    @if(auth()->user()->can('markAsNoShow', $appointment) && $appointment->status === 'confirmed')
                        <button wire:click="markAsNoShow" 
                            class="w-full bg-orange-600 text-white px-4 py-2 rounded-lg hover:bg-orange-700">
                            ⚠ {{ __('doctor.appointments.mark_no_show') }}
                        </button>
                    @endif

                    @if(auth()->user()->can('cancel', $appointment) && !in_array($appointment->status, ['cancelled', 'completed', 'no_show']))
                        <button wire:click="$set('showCancelModal', true)" 
                            class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                            ✕ {{ __('doctor.appointments.cancel') }}
                        </button>
                    @endif
                </div>
            </div>

            <!-- Quick Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('doctor.appointments.quick_info') }}</h2>
                <div class="space-y-3 text-sm">
                    <div>
                        <span class="text-gray-500">{{ __('doctor.appointments.created') }}:</span>
                        <span class="ml-2 text-gray-900">{{ $appointment->created_at->format('M d, Y') }}</span>
                    </div>
                    @if($appointment->confirmed_at)
                        <div>
                            <span class="text-gray-500">{{ __('doctor.appointments.confirmed') }}:</span>
                            <span class="ml-2 text-gray-900">{{ $appointment->confirmed_at->format('M d, Y H:i') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Modal -->
    @if($showCancelModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" wire:click="$set('showCancelModal', false)">
            <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white" wire:click.stop>
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">{{ __('doctor.appointments.cancel_appointment') }}</h3>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('doctor.appointments.cancellation_reason') }}</label>
                        <textarea wire:model="cancellationReason" 
                            rows="3" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                            placeholder="{{ __('doctor.appointments.reason_placeholder') }}"></textarea>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button wire:click="$set('showCancelModal', false)" 
                            class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">
                            {{ __('doctor.common.cancel') }}
                        </button>
                        <button wire:click="cancelAppointment" 
                            class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                            {{ __('doctor.appointments.confirm_cancel') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

