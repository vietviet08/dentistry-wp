<div class="space-y-6">
    <h3 class="text-2xl font-bold">Select a Service</h3>
    
    <!-- Category Filter -->
    @if($categories->count() > 1)
        <div class="flex flex-wrap gap-2">
            <button 
                wire:click="filterByCategory('')"
                class="px-4 py-2 rounded-lg border transition-colors
                    @if(!$category) bg-blue-600 text-white border-blue-600 @else bg-white text-gray-700 border-gray-300 hover:border-blue-600 @endif">
                All Services
            </button>
            @foreach($categories as $cat)
                <button 
                    wire:click="filterByCategory('{{ $cat }}')"
                    class="px-4 py-2 rounded-lg border transition-colors
                        @if($category === $cat) bg-blue-600 text-white border-blue-600 @else bg-white text-gray-700 border-gray-300 hover:border-blue-600 @endif">
                    {{ ucfirst($cat) }}
                </button>
            @endforeach
        </div>
    @endif

    <!-- Services Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($services as $service)
            <button 
                wire:click="selectService({{ $service->id }})"
                class="p-6 rounded-lg border-2 text-left transition-all hover:shadow-lg
                    @if($selectedService == $service->id) border-blue-600 bg-blue-50 @else border-gray-200 @endif">
                
                <div class="flex items-start gap-4">
                    @if($service->image)
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="w-16 h-16 rounded-lg object-cover">
                    @else
                        <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    @endif

                    <div class="flex-1">
                        <h4 class="font-bold text-lg mb-1">{{ $service->name }}</h4>
                        <p class="text-sm text-gray-600 mb-2">{{ Str::limit($service->description, 80) }}</p>
                        <div class="flex items-center gap-4 text-sm">
                            <span class="font-semibold text-blue-600">${{ number_format($service->price, 2) }}</span>
                            <span class="text-gray-500">{{ $service->duration }} min</span>
                        </div>
                    </div>
                </div>
            </button>
        @endforeach
    </div>

    @if($selectedService)
        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
            <p class="text-sm text-blue-700">✓ Service selected. Click Next to continue.</p>
        </div>
    @endif
</div>

