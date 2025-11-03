<div class="space-y-6">
    @if($doctors->isEmpty())
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <p class="text-gray-500 text-lg font-medium">{{ __('patient.appointments.booking.no_doctors') }}</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($doctors as $doctor)
                <button 
                    wire:click="selectDoctor({{ $doctor->id }})"
                    class="group relative p-6 rounded-xl border-2 text-left transition-all duration-300 overflow-hidden
                        @if($selectedDoctor == $doctor->id) 
                            border-blue-500 bg-gradient-to-br from-blue-50 to-cyan-50 shadow-xl shadow-blue-500/20 ring-4 ring-blue-200/50 
                        @else 
                            border-gray-200 bg-white hover:border-blue-300 hover:shadow-lg hover:-translate-y-1 
                        @endif"
                >
                    <!-- Selected Indicator -->
                    @if($selectedDoctor == $doctor->id)
                        <div class="absolute top-4 right-4 w-8 h-8 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    @endif

                    <div class="flex items-center gap-4">
                        @if($doctor->photo)
                            <img 
                                src="{{ asset('storage/' . $doctor->photo) }}" 
                                alt="{{ $doctor->name }}" 
                                class="w-24 h-24 rounded-full object-cover border-4 border-gray-100 shadow-lg group-hover:scale-105 transition-transform duration-300
                                    @if($selectedDoctor == $doctor->id) border-blue-300 @endif"
                            >
                        @else
                            <div class="w-24 h-24 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full flex items-center justify-center text-3xl font-bold text-white shadow-lg border-4 border-gray-100 group-hover:scale-105 transition-transform duration-300
                                @if($selectedDoctor == $doctor->id) border-blue-300 @endif">
                                {{ $doctor->initials }}
                            </div>
                        @endif

                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-xl mb-1 text-gray-900 group-hover:text-blue-600 transition-colors">
                                Dr. {{ $doctor->name }}
                            </h4>
                            <p class="text-sm text-blue-600 font-semibold mb-2">
                                {{ $doctor->specialization }}
                            </p>
                            @if($doctor->experience_years)
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    <span>{{ $doctor->experience_years }} {{ __('patient.appointments.booking.years_experience') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </button>
            @endforeach
        </div>
    @endif

    @if($selectedDoctor)
        <div class="mt-6 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 border-l-4 border-emerald-500 rounded-lg shadow-sm">
            <p class="text-sm text-emerald-700 font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ __('patient.appointments.booking.doctor_selected') }}
            </p>
        </div>
    @endif
</div>
