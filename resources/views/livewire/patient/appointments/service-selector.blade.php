<div class="space-y-6">
    <!-- Category Filter -->
    @if($categories->count() > 1)
        <div class="flex flex-wrap gap-3 mb-6">
            <button 
                wire:click="filterByCategory('')"
                class="px-5 py-2.5 rounded-xl border-2 font-semibold text-sm transition-all duration-200
                    @if(!$category) 
                        bg-gradient-to-r from-blue-600 to-cyan-600 text-white border-transparent shadow-lg shadow-blue-500/30 
                    @else 
                        bg-white text-gray-700 border-gray-300 hover:border-blue-400 hover:bg-blue-50 
                    @endif"
            >
                {{ __('patient.appointments.booking.all_services') }}
            </button>
            @foreach($categories as $cat)
                <button 
                    wire:click="filterByCategory('{{ $cat }}')"
                    class="px-5 py-2.5 rounded-xl border-2 font-semibold text-sm transition-all duration-200
                        @if($category === $cat) 
                            bg-gradient-to-r from-blue-600 to-cyan-600 text-white border-transparent shadow-lg shadow-blue-500/30 
                        @else 
                            bg-white text-gray-700 border-gray-300 hover:border-blue-400 hover:bg-blue-50 
                        @endif"
                >
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
                class="group relative p-6 rounded-xl border-2 text-left transition-all duration-300 overflow-hidden
                    @if($selectedService == $service->id) 
                        border-blue-500 bg-gradient-to-br from-blue-50 to-cyan-50 shadow-xl shadow-blue-500/20 ring-4 ring-blue-200/50 
                    @else 
                        border-gray-200 bg-white hover:border-blue-300 hover:shadow-lg hover:-translate-y-1 
                    @endif"
            >
                <!-- Selected Indicator -->
                @if($selectedService == $service->id)
                    <div class="absolute top-4 right-4 w-8 h-8 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                @endif

                <div class="flex items-start gap-4">
                    @if($service->image)
                        <img 
                            src="{{ asset('storage/' . $service->image) }}" 
                            alt="{{ $service->name }}" 
                            class="w-20 h-20 rounded-xl object-cover shadow-md group-hover:scale-105 transition-transform duration-300"
                        >
                    @else
                        <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-transform duration-300">
                            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    @endif

                    <div class="flex-1 min-w-0">
                        <h4 class="font-bold text-lg mb-2 text-gray-900 group-hover:text-blue-600 transition-colors">
                            {{ $service->name }}
                        </h4>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                            {{ Str::limit($service->description, 80) }}
                        </p>
                        <div class="flex items-center gap-4 text-sm">
                            <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-700 rounded-full font-semibold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                ${{ number_format($service->price, 2) }}
                            </span>
                            <span class="inline-flex items-center gap-1 text-gray-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $service->duration }} {{ __('patient.appointments.booking.minutes') }}
                            </span>
                        </div>
                    </div>
                </div>
            </button>
        @endforeach
    </div>

    @if($selectedService)
        <div class="mt-6 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 border-l-4 border-emerald-500 rounded-lg shadow-sm">
            <p class="text-sm text-emerald-700 font-semibold flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ __('patient.appointments.booking.service_selected') }}
            </p>
        </div>
    @endif
</div>
