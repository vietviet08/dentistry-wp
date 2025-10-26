<div class="max-w-4xl mx-auto py-8">
    <flux:heading class="mb-8">Book an Appointment</flux:heading>

    <!-- Progress Indicator -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            @for($i = 1; $i <= 5; $i++)
                <div class="flex items-center flex-1">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full border-2 
                        @if($step >= $i) bg-blue-600 border-blue-600 text-white @else bg-white border-gray-300 text-gray-500 @endif">
                        {{ $i }}
                    </div>
                    @if($i < 5)
                        <div class="flex-1 h-1 mx-2 
                            @if($step > $i) bg-blue-600 @else bg-gray-300 @endif"></div>
                    @endif
                </div>
            @endfor
        </div>
        <div class="flex justify-between text-sm text-gray-600 mt-2">
            <span>Service</span>
            <span>Doctor</span>
            <span>Date</span>
            <span>Time</span>
            <span>Confirm</span>
        </div>
    </div>

    <!-- Step Content -->
    <div class="bg-white rounded-lg shadow-lg p-8">
        @if($step === 1)
            <livewire:patient.appointments.service-selector wire:key="step-1" />
        @elseif($step === 2)
            <livewire:patient.appointments.doctor-selector :service-id="$service_id" wire:key="step-2" />
        @elseif($step === 3)
            <livewire:patient.appointments.date-picker :doctor-id="$doctor_id" wire:key="step-3" />
        @elseif($step === 4)
            <livewire:patient.appointments.time-slot-picker :doctor-id="$doctor_id" :appointment-date="$appointment_date" wire:key="step-4" />
        @elseif($step === 5)
            <!-- Confirmation Step -->
            <div class="space-y-6">
                <h3 class="text-2xl font-bold">Confirm Your Appointment</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center gap-4 p-4 border rounded-lg">
                        <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold">{{ $selectedService->name ?? '' }}</p>
                            <p class="text-sm text-gray-600">Duration: {{ $selectedService->duration ?? '' }} minutes</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 p-4 border rounded-lg">
                        <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold">Dr. {{ $selectedDoctor->name ?? '' }}</p>
                            <p class="text-sm text-gray-600">{{ $selectedDoctor->specialization ?? '' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 p-4 border rounded-lg">
                        <div class="w-16 h-16 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold">{{ \Carbon\Carbon::parse($selectedDate)->format('l, F j, Y') }}</p>
                            <p class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($selectedTime)->format('g:i A') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Notes -->
                <div>
                    <flux:label for="notes">Additional Notes (Optional)</flux:label>
                    <flux:textarea 
                        wire:model="notes" 
                        id="notes" 
                        placeholder="Any special requirements or concerns?" 
                        rows="3"
                    />
                </div>
            </div>
        @endif

        <!-- Navigation Buttons -->
        <div class="flex justify-between mt-8">
            @if($step > 1)
                <flux:button wire:click="previousStep" variant="ghost">
                    <flux:icon.chevron-left class="w-4 h-4 mr-2" />
                    Previous
                </flux:button>
            @else
                <div></div>
            @endif

            <div>
                @if($step < 5)
                    <flux:button wire:click="nextStep" variant="primary">
                        Next
                        <flux:icon.chevron-right class="w-4 h-4 ml-2" />
                    </flux:button>
                @else
                    <flux:button wire:click="submit" variant="primary">
                        Confirm Appointment
                    </flux:button>
                @endif
            </div>
        </div>
    </div>
</div>

