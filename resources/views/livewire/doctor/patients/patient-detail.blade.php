<x-slot name="title">{{ __('doctor.patients.patient_details') }} - {{ $patient->name }}</x-slot>

<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('doctor.patients.index') }}" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">
            ← {{ __('doctor.common.back') }}
        </a>
        <h1 class="text-3xl font-bold text-gray-900">{{ __('doctor.patients.patient_details') }} - {{ $patient->name }}</h1>
    </div>

    <!-- Tabs -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="border-b border-gray-200">
            <nav class="flex -mb-px">
                <button wire:click="switchTab('info')" 
                    class="px-6 py-3 border-b-2 font-medium text-sm {{ $activeTab === 'info' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    {{ __('doctor.patients.tabs.info') }}
                </button>
                <button wire:click="switchTab('appointments')" 
                    class="px-6 py-3 border-b-2 font-medium text-sm {{ $activeTab === 'appointments' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    {{ __('doctor.patients.tabs.appointments') }}
                </button>
            </nav>
        </div>
    </div>

    <!-- Tab Content -->
    @if($activeTab === 'info')
        <!-- Patient Information -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Basic Info -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('doctor.patients.basic_info') }}</h2>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-gray-500">{{ __('doctor.patients.name') }}</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $patient->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">{{ __('doctor.patients.email') }}</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $patient->email }}</p>
                    </div>
                    @if($patient->phone)
                        <div>
                            <label class="text-sm font-medium text-gray-500">{{ __('doctor.patients.phone') }}</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $patient->phone }}</p>
                        </div>
                    @endif
                    @if($patient->date_of_birth)
                        <div>
                            <label class="text-sm font-medium text-gray-500">{{ __('doctor.patients.date_of_birth') }}</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $patient->date_of_birth->format('M d, Y') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Medical Info -->
            @if($patient->profile)
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('doctor.patients.medical_info') }}</h2>
                    <div class="space-y-4">
                        @if($patient->profile->allergies)
                            <div>
                                <label class="text-sm font-medium text-gray-500">{{ __('doctor.patients.allergies') }}</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $patient->profile->allergies }}</p>
                            </div>
                        @endif
                        @if($patient->profile->medical_conditions)
                            <div>
                                <label class="text-sm font-medium text-gray-500">{{ __('doctor.patients.medical_conditions') }}</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $patient->profile->medical_conditions }}</p>
                            </div>
                        @endif
                        @if($patient->profile->blood_type)
                            <div>
                                <label class="text-sm font-medium text-gray-500">{{ __('doctor.patients.blood_type') }}</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $patient->profile->blood_type }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    @endif

    @if($activeTab === 'appointments')
        <!-- Appointments -->
        <div class="space-y-6">
            <!-- Upcoming Appointments -->
            @if($upcomingAppointments->isNotEmpty())
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('doctor.patients.upcoming_appointments') }}</h2>
                    <div class="space-y-4">
                        @foreach($upcomingAppointments as $appointment)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $appointment->service->name }}</p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ $appointment->appointment_date->format('M d, Y') }} 
                                            at {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($appointment->status === 'confirmed') bg-green-100 text-green-800
                                            @elseif($appointment->status === 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ __('patient.appointments.status.' . $appointment->status) }}
                                        </span>
                                        <a href="{{ route('doctor.appointments.show', $appointment) }}" 
                                           class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                            {{ __('doctor.common.view') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Past Appointments -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('doctor.patients.past_appointments') }}</h2>
                @if($pastAppointments->count() > 0)
                    <div class="space-y-4">
                        @foreach($pastAppointments as $appointment)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $appointment->service->name }}</p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ $appointment->appointment_date->format('M d, Y') }} 
                                            at {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                                        </p>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($appointment->status === 'completed') bg-green-100 text-green-800
                                        @elseif($appointment->status === 'cancelled') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800
                                        @endif">
                                        {{ __('patient.appointments.status.' . $appointment->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $pastAppointments->links() }}
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">{{ __('doctor.patients.no_past_appointments') }}</p>
                @endif
            </div>
        </div>
    @endif
</div>

