<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-cyan-50 py-8 px-4">
    <div class="max-w-5xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-3">
                {{ __('patient.appointments.booking.title') }}
            </h1>
            <p class="text-lg text-gray-600">
                {{ __('patient.appointments.booking.subtitle') }}
            </p>
        </div>

        <!-- Enhanced Progress Indicator -->
        <div class="mb-10">
            <div class="flex items-center justify-between relative">
                <!-- Progress Line Background -->
                <div class="absolute top-6 left-0 right-0 h-1 bg-gray-200 rounded-full z-0"></div>
                
                <!-- Progress Line Active -->
                <div class="absolute top-6 left-0 h-1 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-full z-10 transition-all duration-500 ease-out"
                     style="width: {{ (($step - 1) / 4) * 100 }}%"></div>

                @php
                    $steps = [
                        ['icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'label' => 'patient.appointments.booking.steps.service'],
                        ['icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z', 'label' => 'patient.appointments.booking.steps.doctor'],
                        ['icon' => 'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'label' => 'patient.appointments.booking.steps.date'],
                        ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => 'patient.appointments.booking.steps.time'],
                        ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => 'patient.appointments.booking.steps.confirm'],
                    ];
                @endphp

                @foreach($steps as $index => $stepData)
                    @php
                        $stepNumber = $index + 1;
                        $isActive = $step >= $stepNumber;
                        $isCurrent = $step === $stepNumber;
                        $isCompleted = $step > $stepNumber;
                    @endphp
                    <div class="flex flex-col items-center flex-1 relative z-20">
                        <!-- Step Circle -->
                        <div class="relative">
                            <div class="w-14 h-14 rounded-full flex items-center justify-center transition-all duration-500 
                                @if($isCompleted) bg-gradient-to-br from-blue-500 to-cyan-500 shadow-lg shadow-blue-500/50 @elseif($isCurrent) bg-gradient-to-br from-blue-600 to-blue-700 shadow-xl shadow-blue-600/50 ring-4 ring-blue-200 @else bg-white border-2 border-gray-300 @endif">
                                
                                @if($isCompleted)
                                    <!-- Checkmark for completed steps -->
                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                @else
                                    <!-- Icon for current/pending steps -->
                                    <svg class="w-6 h-6 @if($isCurrent || $isActive) text-white @else text-gray-400 @endif" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stepData['icon'] }}"></path>
                                    </svg>
                                @endif
                            </div>
                            
                            <!-- Pulse animation for current step -->
                            @if($isCurrent)
                                <div class="absolute inset-0 rounded-full bg-blue-400 animate-ping opacity-75"></div>
                            @endif
                        </div>
                        
                        <!-- Step Label -->
                        <div class="mt-3 text-center">
                            <p class="text-xs font-semibold @if($isCurrent || $isCompleted) text-blue-600 @else text-gray-500 @endif">
                                {{ __($stepData['label']) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Step Content Card -->
        <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
            <!-- Card Header with Gradient -->
            <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-cyan-600 px-8 py-6">
                <h2 class="text-2xl font-bold text-white">
                    @if($step === 1)
                        {{ __('patient.appointments.booking.select_service') }}
                    @elseif($step === 2)
                        {{ __('patient.appointments.booking.select_doctor') }}
                    @elseif($step === 3)
                        {{ __('patient.appointments.booking.select_date') }}
                    @elseif($step === 4)
                        {{ __('patient.appointments.booking.select_time') }}
                    @elseif($step === 5)
                        {{ __('patient.appointments.booking.confirm_appointment') }}
                    @endif
                </h2>
            </div>

            <!-- Card Body -->
            <div class="p-8">
                <!-- Step Content with fade animation -->
                <div class="min-h-[400px] transition-opacity duration-300">
                    @if($step === 1)
                        <livewire:patient.appointments.service-selector wire:key="step-1" />
                    @elseif($step === 2)
                        <livewire:patient.appointments.doctor-selector :service-id="$service_id" wire:key="step-2" />
                    @elseif($step === 3)
                        <livewire:patient.appointments.date-picker :doctor-id="$doctor_id" wire:key="step-3" />
                    @elseif($step === 4)
                        <livewire:patient.appointments.time-slot-picker :doctor-id="$doctor_id" :appointment-date="$appointment_date" wire:key="step-4" />
                    @elseif($step === 5)
                        <!-- Enhanced Confirmation Step -->
                        <div class="space-y-6">
                            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 border-l-4 border-emerald-500 rounded-lg p-6 mb-6">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900 mb-1">{{ __('patient.appointments.booking.summary.title') }}</h3>
                                        <p class="text-sm text-gray-600">Please review your appointment details before confirming</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Summary Cards -->
                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Service Card -->
                                <div class="group bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 border-2 border-blue-100 hover:border-blue-300 transition-all duration-300 hover:shadow-lg">
                                    <div class="flex items-start gap-4">
                                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs font-semibold text-blue-600 uppercase tracking-wide mb-2">{{ __('patient.appointments.booking.summary.service') }}</p>
                                            <h4 class="font-bold text-lg text-gray-900 mb-1">{{ $selectedService->name ?? '' }}</h4>
                                            <div class="flex items-center gap-4 text-sm text-gray-600 mt-2">
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{ $selectedService->duration ?? '' }} {{ __('patient.appointments.booking.minutes') }}
                                                </span>
                                                <span class="flex items-center gap-1 font-semibold text-blue-600">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    ${{ number_format($selectedService->price ?? 0, 2) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Doctor Card -->
                                <div class="group bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-6 border-2 border-purple-100 hover:border-purple-300 transition-all duration-300 hover:shadow-lg">
                                    <div class="flex items-start gap-4">
                                        <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs font-semibold text-purple-600 uppercase tracking-wide mb-2">{{ __('patient.appointments.booking.summary.doctor') }}</p>
                                            <h4 class="font-bold text-lg text-gray-900 mb-1">Dr. {{ $selectedDoctor->name ?? '' }}</h4>
                                            <p class="text-sm text-gray-600">{{ $selectedDoctor->specialization ?? '' }}</p>
                                            @if($selectedDoctor->experience_years ?? 0)
                                                <p class="text-xs text-gray-500 mt-1">{{ $selectedDoctor->experience_years }} {{ __('patient.appointments.booking.years_experience') }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Date & Time Card -->
                                <div class="md:col-span-2 group bg-gradient-to-br from-cyan-50 to-blue-50 rounded-xl p-6 border-2 border-cyan-100 hover:border-cyan-300 transition-all duration-300 hover:shadow-lg">
                                    <div class="flex items-start gap-4">
                                        <div class="w-14 h-14 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-xs font-semibold text-cyan-600 uppercase tracking-wide mb-2">{{ __('patient.appointments.booking.summary.date_time') }}</p>
                                            <div class="flex flex-wrap items-center gap-4">
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    <span class="font-bold text-lg text-gray-900">
                                                        {{ \Carbon\Carbon::parse($selectedDate)->format('l, F j, Y') }}
                                                    </span>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    <span class="font-bold text-lg text-gray-900">
                                                        {{ \Carbon\Carbon::parse($selectedTime)->format('g:i A') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Notes Section -->
                            <div class="mt-6">
                                <flux:label for="notes" class="text-gray-700 font-semibold mb-2">
                                    {{ __('patient.appointments.booking.additional_notes') }}
                                </flux:label>
                                <flux:textarea 
                                    wire:model="notes" 
                                    id="notes" 
                                    :placeholder="__('patient.appointments.booking.notes_placeholder')" 
                                    rows="4"
                                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                />
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Navigation Buttons -->
                <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-200">
                    @if($step > 1)
                        <button 
                            wire:click="previousStep" 
                            type="button"
                            class="group inline-flex items-center gap-2 px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md"
                        >
                            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            {{ __('patient.appointments.booking.previous') }}
                        </button>
                    @else
                        <div></div>
                    @endif

                    <div>
                        @if($step < 5)
                            <button 
                                wire:click="nextStep" 
                                type="button"
                                class="group inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-blue-600 via-blue-700 to-cyan-600 text-white rounded-xl font-semibold shadow-lg shadow-blue-500/50 hover:shadow-xl hover:shadow-blue-600/50 hover:-translate-y-0.5 transition-all duration-300"
                            >
                                {{ __('patient.appointments.booking.next') }}
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        @else
                            <button 
                                wire:click="submit" 
                                type="button"
                                wire:loading.attr="disabled"
                                class="group inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-emerald-600 via-green-600 to-teal-600 text-white rounded-xl font-semibold shadow-lg shadow-emerald-500/50 hover:shadow-xl hover:shadow-emerald-600/50 hover:-translate-y-0.5 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                <span wire:loading.remove wire:target="submit">
                                    {{ __('patient.appointments.booking.confirm_button') }}
                                </span>
                                <span wire:loading wire:target="submit" class="flex items-center gap-2">
                                    <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    {{ __('patient.appointments.booking.processing') }}
                                </span>
                                <svg wire:loading.remove wire:target="submit" class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
