<x-slot name="title">Patient Details - {{ $patient->name }}</x-slot>

<div>

<div>
    <!-- Header -->
        <div class="mb-8">
        <a href="{{ route('admin.patients.index') }}" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">
            ← Back to patients
            </a>
        <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
        <div class="flex-shrink-0 h-16 w-16">
                                @if($patient->avatar)
        <img src="{{ asset('storage/' . $patient->avatar) }}" alt="" class="h-16 w-16 rounded-full">
                                @else
        <div class="h-16 w-16 rounded-full bg-gray-300 flex items-center justify-center">
        <span class="text-2xl text-gray-600">{{ $patient->initials() }}</span>
            </div>
                                @endif
            </div>
        <div>
        <h1 class="text-3xl font-bold text-gray-900">{{ $patient->name }}</h1>
        <p class="text-gray-600 mt-1">{{ $patient->email }}</p>
            </div>
            </div>
        <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full
                            {{ $patient->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $patient->is_active ? 'Active' : 'Inactive' }}
            </span>
            </div>
            </div>

            <!-- Tabs -->
        <div class="border-b border-gray-200 mb-6">
        <nav class="-mb-px flex space-x-8">
        <button wire:click="switchTab('info')" 
            class="whitespace-nowrap border-b-2 px-1 py-4 text-sm font-medium
                                {{ $activeTab === 'info' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
            Patient Information
            </button>
        <button wire:click="switchTab('appointments')" 
            class="whitespace-nowrap border-b-2 px-1 py-4 text-sm font-medium
                                {{ $activeTab === 'appointments' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
            Appointments
            </button>
        <button wire:click="switchTab('documents')" 
            class="whitespace-nowrap border-b-2 px-1 py-4 text-sm font-medium
                                {{ $activeTab === 'documents' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
            Documents
            </button>
            </nav>
            </div>

            <!-- Tab Content -->
                @if($activeTab === 'info')
            <!-- Patient Info -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Basic Information -->
        <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Basic Information</h2>
        <div class="space-y-4">
        <div>
        <label class="text-sm font-medium text-gray-500">Email</label>
        <p class="mt-1 text-sm text-gray-900">{{ $patient->email }}</p>
            </div>
                                @if($patient->phone)
        <div>
        <label class="text-sm font-medium text-gray-500">Phone</label>
        <p class="mt-1 text-sm text-gray-900">{{ $patient->phone }}</p>
            </div>
                                @endif
                                @if($patient->date_of_birth)
        <div>
        <label class="text-sm font-medium text-gray-500">Date of Birth</label>
        <p class="mt-1 text-sm text-gray-900">{{ $patient->date_of_birth->format('M d, Y') }}</p>
            </div>
                                @endif
        <div>
        <label class="text-sm font-medium text-gray-500">Member Since</label>
        <p class="mt-1 text-sm text-gray-900">{{ $patient->created_at->format('M d, Y') }}</p>
            </div>
            </div>
            </div>

            <!-- Medical Information -->
                        @if($patient->profile)
        <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Medical Information</h2>
        <div class="space-y-4">
                                    @if($patient->profile->address)
        <div>
        <label class="text-sm font-medium text-gray-500">Address</label>
        <p class="mt-1 text-sm text-gray-900">{{ $patient->profile->address }}</p>
            </div>
                                    @endif
                                    @if($patient->profile->blood_type)
        <div>
        <label class="text-sm font-medium text-gray-500">Blood Type</label>
        <p class="mt-1 text-sm text-gray-900">{{ $patient->profile->blood_type }}</p>
            </div>
                                    @endif
                                    @if($patient->profile->allergies)
        <div>
        <label class="text-sm font-medium text-gray-500">Allergies</label>
        <p class="mt-1 text-sm text-gray-900">{{ $patient->profile->allergies }}</p>
            </div>
                                    @endif
                                    @if($patient->profile->medical_conditions)
        <div>
        <label class="text-sm font-medium text-gray-500">Medical Conditions</label>
        <p class="mt-1 text-sm text-gray-900">{{ $patient->profile->medical_conditions }}</p>
            </div>
                                    @endif
                                    @if($patient->profile->insurance_provider)
        <div>
        <label class="text-sm font-medium text-gray-500">Insurance Provider</label>
        <p class="mt-1 text-sm text-gray-900">{{ $patient->profile->insurance_provider }}</p>
            </div>
                                    @endif
            </div>
            </div>
                        @endif
            </div>
                @elseif($activeTab === 'appointments')
            <!-- Appointments -->
        <div class="space-y-6">
            <!-- Upcoming Appointments -->
                        @if($upcomingAppointments->count() > 0)
        <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Upcoming Appointments</h2>
        <div class="space-y-3">
                                    @foreach($upcomingAppointments as $appointment)
        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
        <div>
        <p class="text-sm font-medium text-gray-900">{{ $appointment->service->name }}</p>
        <p class="text-xs text-gray-500">Dr. {{ $appointment->doctor->name }}</p>
            </div>
        <div class="text-right">
        <p class="text-sm text-gray-900">{{ $appointment->appointment_date->format('M d, Y') }}</p>
        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</p>
            </div>
            </div>
                                    @endforeach
            </div>
            </div>
                        @endif

            <!-- Past Appointments -->
        <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Past Appointments</h2>
                            @if($pastAppointments->count() > 0)
        <div class="space-y-3">
                                    @foreach($pastAppointments as $appointment)
        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
        <div>
        <p class="text-sm font-medium text-gray-900">{{ $appointment->service->name }}</p>
        <p class="text-xs text-gray-500">Dr. {{ $appointment->doctor->name }}</p>
            </div>
        <div class="text-right">
        <p class="text-sm text-gray-900">{{ $appointment->appointment_date->format('M d, Y') }}</p>
        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $appointment->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                                    {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                                    {{ ucfirst($appointment->status) }}
            </span>
            </div>
            </div>
                                    @endforeach
            </div>
        <div class="mt-4">
                                    {{ $pastAppointments->links() }}
            </div>
                            @else
        <p class="text-center text-gray-500 py-8">No past appointments</p>
                            @endif
            </div>
            </div>
                @elseif($activeTab === 'documents')
            <!-- Documents -->
        <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Documents</h2>
                        @if($documents->count() > 0)
        <div class="space-y-3">
                                @foreach($documents as $document)
        <div class="flex items-center justify-between border-b border-gray-100 pb-3">
        <div class="flex items-center space-x-3">
        <div class="flex-shrink-0">
        <div class="w-10 h-10 bg-blue-100 rounded flex items-center justify-center">
            📄
            </div>
            </div>
        <div>
        <p class="text-sm font-medium text-gray-900">{{ $document->title }}</p>
        <p class="text-xs text-gray-500">{{ ucfirst($document->type) }} • {{ $document->file_size_human }}</p>
            </div>
            </div>
        <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank" 
            class="text-blue-600 hover:text-blue-800 text-sm">
            View
            </a>
            </div>
                                @endforeach
            </div>
        <div class="mt-4">
                                {{ $documents->links() }}
            </div>
                        @else
        <p class="text-center text-gray-500 py-8">No documents uploaded</p>
                        @endif
            </div>
                @endif
        </div>
    </div>
    