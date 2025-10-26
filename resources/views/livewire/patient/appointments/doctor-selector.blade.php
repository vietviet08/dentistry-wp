<div class="space-y-6">
    <h3 class="text-2xl font-bold">Select a Doctor</h3>
    
    @if($doctors->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500">No doctors available at the moment.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($doctors as $doctor)
                <button 
                    wire:click="selectDoctor({{ $doctor->id }})"
                    class="p-6 rounded-lg border-2 text-left transition-all hover:shadow-lg
                        @if($selectedDoctor == $doctor->id) border-blue-600 bg-blue-50 @else border-gray-200 @endif">
                    
                    <div class="flex items-center gap-4">
                        @if($doctor->photo)
                            <img src="{{ asset('storage/' . $doctor->photo) }}" alt="{{ $doctor->name }}" class="w-20 h-20 rounded-full object-cover">
                        @else
                            <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center text-2xl font-bold text-gray-600">
                                {{ $doctor->initials }}
                            </div>
                        @endif

                        <div class="flex-1">
                            <h4 class="font-bold text-lg mb-1">Dr. {{ $doctor->name }}</h4>
                            <p class="text-sm text-gray-600 mb-2">{{ $doctor->specialization }}</p>
                            <div class="flex items-center gap-4 text-sm">
                                @if($doctor->experience_years)
                                    <span class="text-gray-500">{{ $doctor->experience_years }} years experience</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </button>
            @endforeach
        </div>
    @endif

    @if($selectedDoctor)
        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
            <p class="text-sm text-blue-700">✓ Doctor selected. Click Next to continue.</p>
        </div>
    @endif
</div>

