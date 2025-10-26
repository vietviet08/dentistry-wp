<div class="max-w-4xl mx-auto py-8">
    <div class="mb-6">
        <a href="{{ route('appointments.index') }}" class="text-blue-600 hover:text-blue-800 mb-2 inline-flex items-center">
            <flux:icon.arrow-left class="w-4 h-4 mr-2" />
            Back to Appointments
        </a>
    </div>

    <div class="bg-white rounded-lg shadow border p-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold">{{ $appointment->service->name }}</h1>
            <span class="px-4 py-2 rounded-full text-sm font-semibold
                @if($appointment->status === 'confirmed') bg-green-100 text-green-800
                @elseif($appointment->status === 'pending') bg-yellow-100 text-yellow-800
                @elseif($appointment->status === 'completed') bg-blue-100 text-blue-800
                @elseif($appointment->status === 'cancelled') bg-red-100 text-red-800
                @else bg-gray-100 text-gray-800 @endif">
                {{ strtoupper($appointment->status) }}
            </span>
        </div>

        <!-- QR Code -->
        @if($appointment->qr_code && $appointment->status !== 'cancelled')
            <div class="flex justify-center mb-8">
                <div class="text-center">
                    <div class="inline-block p-4 bg-gray-100 rounded-lg">
                        {!! \Storage::disk('public')->get($appointment->qr_code) !!}
                    </div>
                    <p class="text-sm text-gray-600 mt-2">Present this QR code at check-in</p>
                </div>
            </div>
        @endif

        <!-- Details Grid -->
        <div class="grid md:grid-cols-2 gap-6 mb-8">
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="font-semibold text-gray-700 mb-2">Service Details</h3>
                <p class="text-gray-900 mb-1">{{ $appointment->service->name }}</p>
                <p class="text-sm text-gray-600">Duration: {{ $appointment->service->duration }} minutes</p>
                <p class="text-sm text-gray-600">Price: ${{ number_format($appointment->service->price, 2) }}</p>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="font-semibold text-gray-700 mb-2">Doctor Information</h3>
                <p class="text-gray-900 mb-1">Dr. {{ $appointment->doctor->name }}</p>
                <p class="text-sm text-gray-600">{{ $appointment->doctor->specialization }}</p>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="font-semibold text-gray-700 mb-2">Appointment Date</h3>
                <p class="text-gray-900 mb-1">{{ $appointment->appointment_date->format('l, F j, Y') }}</p>
                <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</p>
            </div>

            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="font-semibold text-gray-700 mb-2">Patient Information</h3>
                <p class="text-gray-900 mb-1">{{ $appointment->patient->name }}</p>
                <p class="text-sm text-gray-600">{{ $appointment->patient->email }}</p>
            </div>
        </div>

        <!-- Notes -->
        @if($appointment->notes)
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                <h3 class="font-semibold text-gray-700 mb-2">Your Notes</h3>
                <p class="text-gray-700">{{ $appointment->notes }}</p>
            </div>
        @endif

        @if($appointment->admin_notes)
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 mb-6">
                <h3 class="font-semibold text-gray-700 mb-2">Admin Notes</h3>
                <p class="text-gray-700">{{ $appointment->admin_notes }}</p>
            </div>
        @endif

        @if($appointment->cancellation_reason && $appointment->status === 'cancelled')
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                <h3 class="font-semibold text-gray-700 mb-2">Cancellation Reason</h3>
                <p class="text-gray-700">{{ $appointment->cancellation_reason }}</p>
            </div>
        @endif

        <!-- Actions -->
        <div class="flex gap-4">
            @if($appointment->canBeCancelledBy(auth()->user()))
                <button wire:click="cancel" 
                        wire:confirm="Are you sure you want to cancel this appointment?"
                        class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700">
                    Cancel Appointment
                </button>
            @endif

            @if($appointment->qr_code)
                <a href="{{ \Storage::disk('public')->url($appointment->qr_code) }}" 
                   download
                   class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 inline-block">
                    Download QR Code
                </a>
            @endif
        </div>
    </div>
</div>

