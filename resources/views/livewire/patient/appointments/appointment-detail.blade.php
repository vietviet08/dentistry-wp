<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-cyan-50 py-8 px-4">
    <div class="max-w-5xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('appointments.index') }}" 
               class="group inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-semibold transition-colors">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                {{ __('patient.appointments.detail.back') }}
            </a>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
            <!-- Hero Header with Gradient -->
            <div class="relative bg-gradient-to-r from-blue-600 via-blue-700 to-cyan-600 px-8 py-10 overflow-hidden">
                <!-- Pattern Overlay -->
                <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
                
                <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">
                            {{ $appointment->service->name }}
                        </h1>
                        <p class="text-blue-100 text-lg">
                            {{ $appointment->appointment_date->locale(app()->getLocale())->isoFormat('dddd, MMMM D, YYYY') }} 
                            {{ __('patient.appointments.detail.at_time') }} {{ \Carbon\Carbon::parse($appointment->appointment_time)->locale(app()->getLocale())->isoFormat('h:mm A') }}
                        </p>
                    </div>
                    <span class="inline-flex items-center px-5 py-2.5 rounded-xl text-sm font-bold uppercase tracking-wide shadow-lg
                        @if($appointment->status === 'confirmed') 
                            bg-white text-green-700 border-2 border-green-200
                        @elseif($appointment->status === 'pending') 
                            bg-white text-yellow-700 border-2 border-yellow-200
                        @elseif($appointment->status === 'completed') 
                            bg-white text-blue-700 border-2 border-blue-200
                        @elseif($appointment->status === 'cancelled') 
                            bg-white text-red-700 border-2 border-red-200
                        @else 
                            bg-white text-gray-700 border-2 border-gray-200 
                        @endif">
                        {{ __('patient.appointments.status.' . $appointment->status) }}
                    </span>
                </div>
            </div>

            <!-- QR Code Section -->
            @if($appointment->qr_code && $appointment->status !== 'cancelled' && \Storage::disk('public')->exists($appointment->qr_code))
                <div class="bg-gradient-to-br from-emerald-50 to-teal-50 border-b border-emerald-100 px-8 py-8">
                    <div class="flex flex-col md:flex-row items-center justify-center gap-6">
                        <div class="relative">
                            <div class="w-48 h-48 bg-white rounded-2xl p-6 shadow-2xl ring-4 ring-emerald-200/50">
                                <div class="w-full h-full flex items-center justify-center bg-gray-50 rounded-lg overflow-hidden">
                                    <img 
                                        src="{{ \Storage::disk('public')->url($appointment->qr_code) }}" 
                                        alt="{{ __('patient.appointments.detail.alt_qr_code', ['id' => $appointment->id]) }}"
                                        class="w-full h-full object-contain"
                                    />
                                </div>
                            </div>
                            <!-- Decorative circles -->
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-emerald-500 rounded-full animate-ping"></div>
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-emerald-500 rounded-full"></div>
                        </div>
                        <div class="text-center md:text-left">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 flex items-center justify-center md:justify-start gap-2">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ __('patient.appointments.detail.qr_code_header') }}
                            </h3>
                            <p class="text-gray-600 mb-4">{{ __('patient.appointments.detail.qr_code_title') }}</p>
                            <a href="{{ \Storage::disk('public')->url($appointment->qr_code) }}" 
                               download="appointment-{{ $appointment->id }}-qr-code.png"
                               class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border-2 border-emerald-500 text-emerald-700 rounded-xl font-semibold hover:bg-emerald-50 transition-colors shadow-md">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                {{ __('patient.appointments.detail.download_qr') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Content -->
            <div class="p-8 space-y-8">
                <!-- Details Grid -->
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Service Details -->
                    <div class="group bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-6 border-2 border-blue-100 hover:border-blue-300 transition-all duration-300 hover:shadow-lg">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xs font-bold text-blue-600 uppercase tracking-wide mb-3">{{ __('patient.appointments.detail.service_details') }}</h3>
                                <h4 class="font-bold text-xl text-gray-900 mb-2">{{ $appointment->service->name }}</h4>
                                <div class="space-y-1 text-sm text-gray-600">
                                    <p class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ __('patient.appointments.detail.duration') }}: {{ __('patient.appointments.detail.duration_minutes', ['minutes' => $appointment->service->duration]) }}
                                    </p>
                                    <p class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ __('patient.appointments.detail.price') }}: ${{ number_format($appointment->service->price, 2) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Doctor Information -->
                    <div class="group bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-6 border-2 border-purple-100 hover:border-purple-300 transition-all duration-300 hover:shadow-lg">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xs font-bold text-purple-600 uppercase tracking-wide mb-3">{{ __('patient.appointments.detail.doctor_information') }}</h3>
                                <h4 class="font-bold text-xl text-gray-900 mb-1">{{ __('patient.appointments.detail.doctor_prefix') }} {{ $appointment->doctor->name }}</h4>
                                <p class="text-sm text-purple-600 font-semibold mb-2">{{ $appointment->doctor->specialization }}</p>
                                @if($appointment->doctor->experience_years)
                                    <p class="text-xs text-gray-600">{{ __('patient.appointments.detail.years_experience', ['years' => $appointment->doctor->experience_years]) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Appointment Date -->
                    <div class="group bg-gradient-to-br from-cyan-50 to-blue-50 rounded-xl p-6 border-2 border-cyan-100 hover:border-cyan-300 transition-all duration-300 hover:shadow-lg">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xs font-bold text-cyan-600 uppercase tracking-wide mb-3">{{ __('patient.appointments.detail.appointment_date') }}</h3>
                                <p class="font-bold text-lg text-gray-900 mb-1">{{ $appointment->appointment_date->locale(app()->getLocale())->isoFormat('dddd, MMMM D, YYYY') }}</p>
                                <p class="text-sm text-gray-600 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($appointment->appointment_time)->locale(app()->getLocale())->isoFormat('h:mm A') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Patient Information -->
                    <div class="group bg-gradient-to-br from-teal-50 to-emerald-50 rounded-xl p-6 border-2 border-teal-100 hover:border-teal-300 transition-all duration-300 hover:shadow-lg">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-teal-500 to-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xs font-bold text-teal-600 uppercase tracking-wide mb-3">{{ __('patient.appointments.detail.patient_information') }}</h3>
                                <p class="font-bold text-lg text-gray-900 mb-1">{{ $appointment->patient->name }}</p>
                                <p class="text-sm text-gray-600">{{ $appointment->patient->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Notes Sections -->
                @if($appointment->notes)
                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border-l-4 border-blue-500 rounded-lg p-6 shadow-sm">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-900 mb-2">{{ __('patient.appointments.detail.your_notes') }}</h3>
                                <p class="text-gray-700">{{ $appointment->notes }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if($appointment->admin_notes)
                    <div class="bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-500 rounded-lg p-6 shadow-sm">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-yellow-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-900 mb-2">{{ __('patient.appointments.detail.admin_notes') }}</h3>
                                <p class="text-gray-700">{{ $appointment->admin_notes }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if($appointment->cancellation_reason && $appointment->status === 'cancelled')
                    <div class="bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 rounded-lg p-6 shadow-sm">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-900 mb-2">{{ __('patient.appointments.detail.cancellation_reason') }}</h3>
                                <p class="text-gray-700">{{ $appointment->cancellation_reason }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Reschedule Form -->
                @if($isRescheduling)
                    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 border-2 border-blue-300 rounded-xl p-6 shadow-lg">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ __('patient.appointments.detail.reschedule_title') }}
                        </h3>
                        
                        <div class="grid md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('patient.appointments.detail.new_date') }}</label>
                                <input type="date" 
                                       wire:model="newDate" 
                                       min="{{ now()->addDay()->format('Y-m-d') }}"
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-200 transition-all @error('newDate') border-red-500 @enderror">
                                @error('newDate') 
                                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">{{ __('patient.appointments.detail.new_time') }}</label>
                                <input type="time" 
                                       wire:model="newTime" 
                                       class="w-full px-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-200 transition-all @error('newTime') border-red-500 @enderror">
                                @error('newTime') 
                                    <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> 
                                @enderror
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <button wire:click="reschedule" 
                                    wire:loading.attr="disabled"
                                    class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 text-white rounded-xl font-semibold shadow-lg shadow-emerald-500/30 hover:shadow-xl hover:shadow-emerald-600/40 hover:-translate-y-0.5 transition-all duration-300 disabled:opacity-50">
                                <svg wire:loading.remove wire:target="reschedule" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <svg wire:loading wire:target="reschedule" class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                {{ __('patient.appointments.detail.confirm_reschedule') }}
                            </button>
                            <button wire:click="cancelReschedule" 
                                    class="px-6 py-3 border-2 border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition-colors">
                                {{ __('common.cancel') }}
                            </button>
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-4 pt-6 border-t border-gray-200">
                    @if($appointment->canBeRescheduledBy(auth()->user()) && !$isRescheduling)
                        <button wire:click="startReschedule" 
                                class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 via-blue-700 to-cyan-600 text-white rounded-xl font-semibold shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-600/40 hover:-translate-y-0.5 transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ __('patient.appointments.reschedule') }}
                        </button>
                    @endif

                    @if($appointment->canBeCancelledBy(auth()->user()))
                        <button wire:click="cancel" 
                                wire:confirm="{{ __('patient.appointments.cancel_confirm') }}"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-red-600 to-pink-600 text-white rounded-xl font-semibold shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-600/40 hover:-translate-y-0.5 transition-all duration-300 disabled:opacity-50">
                            <svg wire:loading.remove wire:target="cancel" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <svg wire:loading wire:target="cancel" class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ __('patient.appointments.cancel') }}
                        </button>
                    @endif

                    @if($appointment->qr_code && $appointment->status !== 'cancelled')
                        <a href="{{ \Storage::disk('public')->url($appointment->qr_code) }}" 
                           download
                           class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-gray-600 to-gray-700 text-white rounded-xl font-semibold shadow-lg shadow-gray-500/30 hover:shadow-xl hover:shadow-gray-600/40 hover:-translate-y-0.5 transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            {{ __('patient.appointments.detail.download_qr') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
