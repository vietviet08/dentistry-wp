<div>
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Today's Appointments -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <span class="text-green-600">📅</span>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">{{ __('doctor.dashboard.today_appointments') }}</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $todayAppointments }}</p>
                </div>
            </div>
        </div>

        <!-- Pending Appointments -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                        <span class="text-yellow-600">⏳</span>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">{{ __('doctor.dashboard.pending_appointments') }}</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $pendingAppointments }}</p>
                </div>
            </div>
        </div>

        <!-- Upcoming Appointments -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-blue-600">📋</span>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">{{ __('doctor.dashboard.upcoming_appointments') }}</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $upcomingAppointments }}</p>
                </div>
            </div>
        </div>

        <!-- Completed Appointments -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                        <span class="text-purple-600">✅</span>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">{{ __('doctor.dashboard.completed_appointments') }}</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $completedAppointments }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-sm text-gray-600">{{ __('doctor.dashboard.total_appointments') }}</p>
            <p class="text-xl font-semibold text-gray-900">{{ $totalAppointments }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-sm text-gray-600">{{ __('doctor.dashboard.confirmed') }}</p>
            <p class="text-xl font-semibold text-green-600">{{ $confirmedAppointments }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-sm text-gray-600">{{ __('doctor.dashboard.status') }}</p>
            <p class="text-xl font-semibold {{ $doctor->is_available ? 'text-green-600' : 'text-red-600' }}">
                {{ $doctor->is_available ? __('doctor.dashboard.available') : __('doctor.dashboard.unavailable') }}
            </p>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Upcoming Appointments -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-900">{{ __('doctor.dashboard.upcoming_appointments') }}</h2>
                <a href="{{ route('doctor.appointments.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                    {{ __('common.view_all') }}
                </a>
            </div>
            <div class="p-6">
                @if($upcomingToday->count() > 0)
                    <div class="space-y-4">
                        @foreach($upcomingToday as $appointment)
                            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                <span class="text-blue-600 font-medium">{{ $appointment->patient->initials() }}</span>
                                            </div>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900">{{ $appointment->patient->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $appointment->service->name }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-2 ml-13">
                                        <p class="text-xs text-gray-600">
                                            {{ $appointment->appointment_date->format('M d, Y') }} 
                                            at {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}
                                        </p>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                            @if($appointment->status === 'confirmed') bg-green-100 text-green-800
                                            @elseif($appointment->status === 'pending') bg-yellow-100 text-yellow-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($appointment->status) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <a href="{{ route('doctor.appointments.show', $appointment) }}" 
                                       class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                        {{ __('common.view') }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">{{ __('doctor.dashboard.no_upcoming') }}</p>
                @endif
            </div>
        </div>

        <!-- Recent Appointments -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-900">{{ __('doctor.dashboard.recent_appointments') }}</h2>
                <a href="{{ route('doctor.appointments.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                    {{ __('common.view_all') }}
                </a>
            </div>
            <div class="p-6">
                @if($recentAppointments->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentAppointments as $appointment)
                            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                            <span class="text-gray-600 font-medium">{{ $appointment->patient->initials() }}</span>
                                        </div>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900">{{ $appointment->patient->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $appointment->service->name }}</p>
                                        <p class="text-xs text-gray-400 mt-1">
                                            {{ $appointment->appointment_date->format('M d, Y') }}
                                        </p>
                                    </div>
                                </div>
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                    @if($appointment->status === 'completed') bg-green-100 text-green-800
                                    @elseif($appointment->status === 'confirmed') bg-blue-100 text-blue-800
                                    @elseif($appointment->status === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">{{ __('doctor.dashboard.no_recent') }}</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="mb-8">
        <!-- Time Range Filter -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <div class="flex flex-wrap items-center gap-4">
                <span class="text-sm font-medium text-gray-700">{{ __('doctor.dashboard.time_range') }}:</span>
                <div class="flex gap-2">
                    <button wire:click="$set('timeRange', '7days')" 
                            class="px-3 py-1 rounded-md text-sm font-medium transition {{ $timeRange === '7days' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        {{ __('doctor.dashboard.last_7_days') }}
                    </button>
                    <button wire:click="$set('timeRange', '30days')" 
                            class="px-3 py-1 rounded-md text-sm font-medium transition {{ $timeRange === '30days' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        {{ __('doctor.dashboard.last_30_days') }}
                    </button>
                    <button wire:click="$set('timeRange', '3months')" 
                            class="px-3 py-1 rounded-md text-sm font-medium transition {{ $timeRange === '3months' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        {{ __('doctor.dashboard.last_3_months') }}
                    </button>
                </div>
                <div class="flex items-center gap-2 ml-auto">
                    <input type="date" wire:model.live.debounce.300ms="customStartDate" 
                           class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="{{ __('doctor.dashboard.from') }}">
                    <span class="text-gray-500">-</span>
                    <input type="date" wire:model.live.debounce.300ms="customEndDate" 
                           class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="{{ __('doctor.dashboard.to') }}">
                </div>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Daily Appointments Bar Chart -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">{{ __('doctor.dashboard.daily_appointments') }}</h2>
                </div>
                <div class="p-6">
                    <div wire:ignore id="daily-appointments-chart"></div>
                </div>
            </div>

            <!-- Appointment Status Pie Chart -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">{{ __('doctor.dashboard.appointment_status_chart') }}</h2>
                </div>
                <div class="p-6">
                    <div wire:ignore id="appointment-status-chart"></div>
                </div>
            </div>
        </div>

        <!-- Weekly Schedule Line Chart -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">{{ __('doctor.dashboard.weekly_schedule') }}</h2>
            </div>
            <div class="p-6">
                <div wire:ignore id="weekly-schedule-chart"></div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('doctor.dashboard.quick_actions') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('doctor.appointments.index') }}" 
               class="flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ __('doctor.dashboard.view_appointments') }}
            </a>
            <a href="{{ route('doctor.appointments.calendar') }}" 
               class="flex items-center justify-center px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ __('doctor.dashboard.view_calendar') }}
            </a>
            <a href="{{ route('doctor.schedule.index') }}" 
               class="flex items-center justify-center px-4 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ __('doctor.dashboard.manage_schedule') }}
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function renderCharts() {
        // Clean up existing charts
        if (window.charts) {
            Object.values(window.charts).forEach(chart => {
                if (chart && typeof chart.destroy === 'function') {
                    chart.destroy();
                }
            });
        }
        window.charts = {};
        
        // Daily Appointments Bar Chart
        window.charts['daily-appointments'] = window.renderChart('#daily-appointments-chart', {
            type: 'bar',
            height: 300,
            colors: ['#3b82f6'],
            series: [{
                name: '{{ __('doctor.dashboard.appointments') }}',
                data: @json($chartDailyData['series'])
            }],
            labels: @json($chartDailyData['labels']),
            xaxis: {
                type: 'category'
            },
            yaxis: {
                title: {
                    text: '{{ __('doctor.dashboard.appointments') }}'
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + ' {{ __('doctor.dashboard.appointments') }}'
                    }
                }
            }
        });

        // Appointment Status Pie Chart
        window.charts['appointment-status'] = window.renderChart('#appointment-status-chart', {
            type: 'pie',
            height: 300,
            series: @json($chartStatusData['series']),
            labels: @json($chartStatusData['labels']),
            colors: ['#f59e0b', '#3b82f6', '#10b981', '#ef4444', '#6b7280'],
            legend: {
                position: 'right'
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + ' {{ __('doctor.dashboard.appointments') }}'
                    }
                }
            }
        });

        // Weekly Schedule Line Chart
        window.charts['weekly-schedule'] = window.renderChart('#weekly-schedule-chart', {
            type: 'line',
            height: 300,
            colors: ['#10b981'],
            series: [{
                name: '{{ __('doctor.dashboard.appointments') }}',
                data: @json($chartWeeklyData['series'])
            }],
            labels: @json($chartWeeklyData['labels']),
            xaxis: {
                type: 'category'
            },
            yaxis: {
                title: {
                    text: '{{ __('doctor.dashboard.appointments') }}'
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + ' {{ __('doctor.dashboard.appointments') }}'
                    }
                }
            }
        });
    }

    document.addEventListener('livewire:initialized', () => {
        setTimeout(renderCharts, 250);
    });

    Livewire.on('chart-updated', () => {
        setTimeout(renderCharts, 250);
    });

    document.addEventListener('livewire:navigated', () => {
        setTimeout(() => {
            if (window.charts) {
                Object.values(window.charts).forEach(chart => chart.destroy());
                window.charts = {};
            }
        }, 100);
    });
</script>
@endpush

