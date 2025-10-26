<div class="space-y-6">
    <h3 class="text-2xl font-bold">Select a Date</h3>
    
    @if($availableDates->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500">No available dates for this doctor.</p>
        </div>
    @else
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-7 gap-4">
            @foreach($availableDates as $dateInfo)
                <button 
                    wire:click="selectDate('{{ $dateInfo['date'] }}')"
                    class="p-4 rounded-lg border-2 text-center transition-all hover:shadow-lg
                        @if($selectedDate == $dateInfo['date']) border-blue-600 bg-blue-50 @else border-gray-200 @endif">
                    
                    <div class="font-semibold text-lg mb-1">
                        {{ \Carbon\Carbon::parse($dateInfo['date'])->format('j') }}
                    </div>
                    <div class="text-sm text-gray-600 mb-2">
                        {{ \Carbon\Carbon::parse($dateInfo['date'])->format('M') }}
                    </div>
                    <div class="text-xs font-medium text-blue-600">
                        {{ $dateInfo['day_of_week'] }}
                    </div>
                </button>
            @endforeach
        </div>
    @endif

    @if($selectedDate)
        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
            <p class="text-sm text-blue-700">✓ Date selected: {{ \Carbon\Carbon::parse($selectedDate)->format('l, F j, Y') }}</p>
        </div>
    @endif
</div>

