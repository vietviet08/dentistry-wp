<div class="space-y-6">
    @if($availableDates->isEmpty())
        <div class="text-center py-16">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <p class="text-gray-500 text-lg font-medium">{{ __('patient.appointments.booking.no_dates') }}</p>
        </div>
    @else
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-3">
            @foreach($availableDates as $dateInfo)
                @php
                    $carbonDate = \Carbon\Carbon::parse($dateInfo['date']);
                    $isToday = $carbonDate->isToday();
                    $isSelected = $selectedDate == $dateInfo['date'];
                @endphp
                <button 
                    wire:click="selectDate('{{ $dateInfo['date'] }}')"
                    class="group relative p-5 rounded-xl border-2 text-center transition-all duration-300 hover:scale-105
                        @if($isSelected) 
                            border-blue-500 bg-gradient-to-br from-blue-500 to-cyan-500 text-white shadow-xl shadow-blue-500/30 ring-4 ring-blue-200/50
                        @elseif($isToday)
                            border-blue-300 bg-blue-50 hover:border-blue-400 hover:bg-blue-100
                        @else
                            border-gray-200 bg-white hover:border-blue-300 hover:bg-blue-50 hover:shadow-md
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

                    <!-- Today Badge -->
                    @if($isToday && !$isSelected)
                        <div class="absolute -top-1 -right-1 w-3 h-3 bg-blue-500 rounded-full ring-2 ring-white"></div>
                    @endif

                    <div class="font-bold text-2xl mb-1 @if($isSelected) text-white @else text-gray-900 @endif">
                        {{ $carbonDate->format('j') }}
                    </div>
                    <div class="text-xs font-semibold mb-2 @if($isSelected) text-white/90 @else text-gray-600 @endif uppercase tracking-wide">
                        {{ $carbonDate->format('M') }}
                    </div>
                    <div class="text-xs font-medium @if($isSelected) text-white/80 @elseif($isToday) text-blue-600 @else text-gray-500 @endif">
                        {{ $dateInfo['day_of_week'] }}
                    </div>
                </button>
            @endforeach
        </div>
    @endif

    @if($selectedDate)
        <div class="mt-6 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 border-l-4 border-emerald-500 rounded-lg shadow-sm">
            <p class="text-sm text-emerald-700 font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ __('patient.appointments.booking.date_selected') }}: 
                <span class="font-bold">{{ \Carbon\Carbon::parse($selectedDate)->format('l, F j, Y') }}</span>
            </p>
        </div>
    @endif
</div>
