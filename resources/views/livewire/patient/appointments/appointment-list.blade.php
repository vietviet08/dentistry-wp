<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-cyan-50 py-8 px-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-4xl font-bold text-gray-900 mb-2">
                        {{ __('patient.appointments.title') }}
                    </h1>
                    <p class="text-lg text-gray-600">
                        {{ __('patient.appointments.subtitle') }}
                    </p>
                </div>
                <a href="{{ route('appointments.create') }}" 
                   class="group inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-600 via-blue-700 to-cyan-600 text-white rounded-xl font-semibold shadow-lg shadow-blue-500/50 hover:shadow-xl hover:shadow-blue-600/50 hover:-translate-y-0.5 transition-all duration-300">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    {{ __('patient.appointments.create') }}
                </a>
            </div>

            <!-- Enhanced Filter Tabs -->
            <div class="inline-flex gap-2 p-1 bg-white rounded-xl shadow-md border border-gray-200">
                @php
                    $filters = [
                        ['key' => 'all', 'label' => 'patient.appointments.all', 'icon' => 'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z'],
                        ['key' => 'upcoming', 'label' => 'patient.appointments.upcoming', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['key' => 'past', 'label' => 'patient.appointments.past', 'icon' => 'M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['key' => 'cancelled', 'label' => 'patient.appointments.cancelled', 'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z'],
                    ];
                @endphp
                
                @foreach($filters as $filter)
                    <button 
                        wire:click="setFilter('{{ $filter['key'] }}')" 
                        class="group relative px-5 py-2.5 rounded-lg font-semibold text-sm transition-all duration-200 flex items-center gap-2
                            @if($statusFilter === $filter['key']) 
                                bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-lg shadow-blue-500/30 
                            @else 
                                text-gray-700 hover:bg-gray-50 
                            @endif"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $filter['icon'] }}"></path>
                        </svg>
                        <span>{{ __($filter['label']) }}</span>
                        @if($statusFilter === $filter['key'])
                            <div class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-1 h-1 bg-white rounded-full"></div>
                        @endif
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Appointments List -->
        @if($appointments->count() > 0)
            <div class="space-y-4">
                @foreach($appointments as $appointment)
                    <div class="group bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="p-6">
                            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                                <!-- Left Content -->
                                <div class="flex-1 space-y-4">
                                    <!-- Header Row -->
                                    <div class="flex flex-wrap items-center gap-4">
                                        <h3 class="text-2xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">
                                            {{ $appointment->service->name }}
                                        </h3>
                                        <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wide
                                            @if($appointment->status === 'confirmed') 
                                                bg-gradient-to-r from-green-100 to-emerald-100 text-green-800 border border-green-200
                                            @elseif($appointment->status === 'pending') 
                                                bg-gradient-to-r from-yellow-100 to-amber-100 text-yellow-800 border border-yellow-200
                                            @elseif($appointment->status === 'completed') 
                                                bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-800 border border-blue-200
                                            @elseif($appointment->status === 'cancelled') 
                                                bg-gradient-to-r from-red-100 to-pink-100 text-red-800 border border-red-200
                                            @else 
                                                bg-gray-100 text-gray-800 border border-gray-200 
                                            @endif">
                                            {{ __('patient.appointments.status.' . $appointment->status) }}
                                        </span>
                                    </div>
                                    
                                    <!-- Info Grid -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                        <!-- Doctor -->
                                        <div class="flex items-center gap-3 p-3 bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl border border-purple-100">
                                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-xs font-semibold text-purple-600 uppercase tracking-wide">{{ __('patient.appointments.doctor_label') }}</p>
                                                <p class="text-sm font-bold text-gray-900 truncate">Dr. {{ $appointment->doctor->name }}</p>
                                            </div>
                                        </div>

                                        <!-- Date -->
                                        <div class="flex items-center gap-3 p-3 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl border border-blue-100">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-xs font-semibold text-blue-600 uppercase tracking-wide">{{ __('patient.appointments.date_label') }}</p>
                                                <p class="text-sm font-bold text-gray-900">{{ $appointment->appointment_date->format('M d, Y') }}</p>
                                            </div>
                                        </div>

                                        <!-- Time -->
                                        <div class="flex items-center gap-3 p-3 bg-gradient-to-br from-cyan-50 to-teal-50 rounded-xl border border-cyan-100">
                                            <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-teal-600 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-xs font-semibold text-cyan-600 uppercase tracking-wide">{{ __('patient.appointments.time_label') }}</p>
                                                <p class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</p>
                                            </div>
                                        </div>

                                        <!-- Duration -->
                                        <div class="flex items-center gap-3 p-3 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl border border-indigo-100">
                                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="text-xs font-semibold text-indigo-600 uppercase tracking-wide">{{ __('patient.appointments.duration_label') }}</p>
                                                <p class="text-sm font-bold text-gray-900">{{ $appointment->service->duration }} min</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Notes -->
                                    @if($appointment->notes)
                                        <div class="flex items-start gap-3 p-4 bg-gradient-to-r from-blue-50 to-cyan-50 border-l-4 border-blue-500 rounded-lg">
                                            <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            <div>
                                                <p class="text-xs font-semibold text-blue-600 uppercase tracking-wide mb-1">{{ __('patient.appointments.notes_label') }}</p>
                                                <p class="text-sm text-gray-700">{{ $appointment->notes }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Right Actions -->
                                <div class="flex flex-col gap-2 lg:min-w-[200px]">
                                    @if($appointment->status === 'pending' && $appointment->canBeCancelledBy(auth()->user()))
                                        <button 
                                            wire:click="cancel({{ $appointment->id }})" 
                                            wire:confirm="{{ __('patient.appointments.cancel_confirm') }}"
                                            wire:loading.attr="disabled"
                                            class="group inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-gradient-to-r from-red-600 to-pink-600 text-white rounded-xl font-semibold shadow-lg shadow-red-500/30 hover:shadow-xl hover:shadow-red-600/40 hover:-translate-y-0.5 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                                        >
                                            <svg wire:loading.remove wire:target="cancel({{ $appointment->id }})" class="w-4 h-4 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            <svg wire:loading wire:target="cancel({{ $appointment->id }})" class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            <span>{{ __('patient.appointments.cancel') }}</span>
                                        </button>
                                    @endif
                                    
                                    <a href="{{ route('appointments.show', $appointment) }}" 
                                       class="group inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-gradient-to-r from-blue-600 via-blue-700 to-cyan-600 text-white rounded-xl font-semibold shadow-lg shadow-blue-500/30 hover:shadow-xl hover:shadow-blue-600/40 hover:-translate-y-0.5 transition-all duration-300">
                                        <span>{{ __('patient.appointments.view_details') }}</span>
                                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $appointments->links() }}
                </div>
            </div>
        @else
            <!-- Enhanced Empty State -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-12 text-center">
                <div class="w-32 h-32 bg-gradient-to-br from-blue-100 to-cyan-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                    <svg class="w-16 h-16 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">
                    {{ __('patient.appointments.no_appointments') }}
                </h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">
                    {{ __('patient.appointments.no_appointments_desc') }}
                </p>
                <a href="{{ route('appointments.create') }}" 
                   class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-blue-600 via-blue-700 to-cyan-600 text-white rounded-xl font-semibold shadow-lg shadow-blue-500/50 hover:shadow-xl hover:shadow-blue-600/50 hover:-translate-y-0.5 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    {{ __('patient.appointments.book_first') }}
                </a>
            </div>
        @endif
    </div>
</div>
