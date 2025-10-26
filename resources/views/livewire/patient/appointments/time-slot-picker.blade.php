<div class="space-y-6">
    <h3 class="text-2xl font-bold">Select a Time</h3>
    
    @if($slots->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500">No available time slots for this date.</p>
        </div>
    @else
        <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
            @foreach($slots as $slot)
                <button 
                    wire:click="selectTime('{{ $slot['value'] }}')"
                    class="px-4 py-3 rounded-lg border-2 text-center transition-all hover:shadow-lg
                        @if($selectedTime == $slot['value']) border-blue-600 bg-blue-600 text-white @else border-gray-200 hover:border-blue-600 @endif">
                    {{ $slot['display'] }}
                </button>
            @endforeach
        </div>
    @endif

    @if($selectedTime)
        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
            <p class="text-sm text-blue-700">✓ Time selected: {{ \Carbon\Carbon::parse($selectedTime)->format('g:i A') }}</p>
        </div>
    @endif
</div>

