<x-slot name="title">Appointment Details</x-slot>

<div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
        <div class="mb-8">
        <a href="{{ route('admin.appointments.index') }}" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">
            ← Back to appointments
            </a>
        <h1 class="text-3xl font-bold text-gray-900">Appointment Details</h1>
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
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Patient Information</h2>
        <div class="grid grid-cols-2 gap-4">
        <div>
        <label class="text-sm font-medium text-gray-500">Name</label>
        <p class="mt-1 text-sm text-gray-900">{{ $appointment->patient->name }}</p>
            </div>
        <div>
        <label class="text-sm font-medium text-gray-500">Email</label>
        <p class="mt-1 text-sm text-gray-900">{{ $appointment->patient->email }}</p>
            </div>
                                @if($appointment->patient->phone)
        <div>
        <label class="text-sm font-medium text-gray-500">Phone</label>
        <p class="mt-1 text-sm text-gray-900">{{ $appointment->patient->phone }}</p>
            </div>
                                @endif
            </div>
            </div>

            <!-- Appointment Info -->
        <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Appointment Information</h2>
        <div class="grid grid-cols-2 gap-4">
        <div>
        <label class="text-sm font-medium text-gray-500">Doctor</label>
        <p class="mt-1 text-sm text-gray-900">{{ $appointment->doctor->name }}</p>
            </div>
        <div>
        <label class="text-sm font-medium text-gray-500">Service</label>
        <p class="mt-1 text-sm text-gray-900">{{ $appointment->service->name }}</p>
            </div>
        <div>
        <label class="text-sm font-medium text-gray-500">Date</label>
        <p class="mt-1 text-sm text-gray-900">{{ $appointment->appointment_date->format('M d, Y') }}</p>
            </div>
        <div>
        <label class="text-sm font-medium text-gray-500">Time</label>
        <p class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</p>
            </div>
        <div>
        <label class="text-sm font-medium text-gray-500">Status</label>
        <span class="mt-1 inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $appointment->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($appointment->status) }}
            </span>
            </div>
            </div>
            </div>

            <!-- Patient Notes -->
                        @if($appointment->notes)
        <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Patient Notes</h2>
        <p class="text-sm text-gray-900">{{ $appointment->notes }}</p>
            </div>
                        @endif

            <!-- Admin Notes -->
        <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Admin Notes</h2>
        <textarea wire:model="adminNotes" 
            rows="4" 
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"></textarea>
        <button wire:click="saveAdminNotes" 
            class="mt-3 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Save Notes
            </button>
            </div>
            </div>

            <!-- Right Column - Actions -->
        <div class="space-y-6">
        <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Actions</h2>
        <div class="space-y-3">
                                @if($appointment->status === 'pending')
        <button wire:click="confirmAppointment" 
            class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            ✓ Confirm Appointment
            </button>
                                @endif

                                @if($appointment->status === 'confirmed')
        <button wire:click="completeAppointment" 
            class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            ✓ Mark as Completed
            </button>
                                @endif

                                @if(!in_array($appointment->status, ['cancelled', 'completed', 'no_show']))
        <button wire:click="$set('showCancelModal', true)" 
            class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
            ✕ Cancel Appointment
            </button>
                                @endif
            </div>
            </div>

            <!-- Quick Info -->
        <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Quick Info</h2>
        <div class="space-y-3 text-sm">
        <div>
        <span class="text-gray-500">Created:</span>
        <span class="ml-2 text-gray-900">{{ $appointment->created_at->format('M d, Y') }}</span>
            </div>
                                @if($appointment->confirmed_at)
        <div>
        <span class="text-gray-500">Confirmed:</span>
        <span class="ml-2 text-gray-900">{{ $appointment->confirmed_at->format('M d, Y') }}</span>
            </div>
                                @endif
                                @if($appointment->qr_code)
        <div>
        <span class="text-gray-500">QR Code:</span>
        <span class="ml-2 text-green-600">✓ Generated</span>
            </div>
                                @endif
            </div>
            </div>
            </div>
            </div>
        </div>
    </div>

        <!-- Cancel Modal -->
        @if($showCancelModal)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="mt-3">
        <h3 class="text-lg font-medium text-gray-900 mb-4">Cancel Appointment</h3>
        <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Cancellation</label>
        <textarea wire:model="cancellationReason" 
            rows="3" 
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
            placeholder="Enter cancellation reason..."></textarea>
            </div>
        <div class="flex space-x-3">
        <button wire:click="$set('showCancelModal', false)" 
            class="flex-1 bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300">
            Close
            </button>
        <button wire:click="cancelAppointment" 
            class="flex-1 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
            Cancel Appointment
            </button>
            </div>
            </div>
            </div>
        </div>
        @endif
    
</div>