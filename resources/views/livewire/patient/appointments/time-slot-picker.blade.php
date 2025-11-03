<div class="space-y-6">
    @if($slots->isEmpty())
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <p class="text-gray-500 text-lg font-medium">{{ __('patient.appointments.booking.no_slots') }}</p>
        </div>
    @else
        <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
            @foreach($slots as $slot)
                @php
                    $isSelected = $selectedTime == $slot['value'];
                @endphp
                <button 
                    wire:click="selectTime('{{ $slot['value'] }}')"
                    class="group relative px-4 py-3.5 rounded-xl border-2 text-center font-semibold text-sm transition-all duration-300 hover:scale-105
                        @if($isSelected) 
                            border-blue-500 bg-gradient-to-br from-blue-600 to-cyan-600 text-white shadow-xl shadow-blue-500/30 ring-4 ring-blue-200/50 
                        @else 
                            border-gray-200 bg-white text-gray-700 hover:border-blue-400 hover:bg-blue-50 hover:shadow-md 
                        @endif"
                >
                    <!-- Selected Indicator -->
                    @if($isSelected)
                        <div class="absolute -top-2 -right-2 w-6 h-6 bg-emerald-500 rounded-full flex items-center justify-center shadow-lg ring-2 ring-white">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    @endif

                    <span class="relative z-10">{{ $slot['display'] }}</span>
                </button>
            @endforeach
        </div>
    @endif

    @if($selectedTime)
        <div class="mt-6 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 border-l-4 border-emerald-500 rounded-lg shadow-sm">
            <p class="text-sm text-emerald-700 font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ __('patient.appointments.booking.time_selected') }}: 
                <span class="font-bold">{{ \Carbon\Carbon::parse($selectedTime)->format('g:i A') }}</span>
            </p>
        </div>
    @endif
</div>
