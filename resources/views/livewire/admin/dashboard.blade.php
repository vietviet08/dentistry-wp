<div>
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Patients -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-blue-600">👥</span>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">{{ __('admin.dashboard.total_patients') }}</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalPatients }}</p>
                </div>
            </div>
        </div>

        <!-- Today's Appointments -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <span class="text-green-600">📅</span>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">{{ __('admin.dashboard.today_appointments') }}</p>
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
                    <p class="text-sm font-medium text-gray-500">{{ __('admin.dashboard.pending_appointments') }}</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $pendingAppointments }}</p>
                </div>
            </div>
        </div>

        <!-- Monthly Revenue -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                        <span class="text-purple-600">💰</span>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">{{ __('admin.dashboard.monthly_revenue') }}</p>
                    <p class="text-2xl font-semibold text-gray-900">${{ number_format($monthlyRevenue, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Secondary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-sm text-gray-600">{{ __('admin.dashboard.total_appointments') }}</p>
            <p class="text-xl font-semibold text-gray-900">{{ $totalAppointments }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-sm text-gray-600">{{ __('admin.dashboard.upcoming') }}</p>
            <p class="text-xl font-semibold text-green-600">{{ $upcomingAppointments }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-sm text-gray-600">{{ __('admin.dashboard.active_doctors') }}</p>
            <p class="text-xl font-semibold text-blue-600">{{ $activeDoctors }} / {{ $totalDoctors }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <p class="text-sm text-gray-600">{{ __('admin.dashboard.pending_reviews') }}</p>
            <p class="text-xl font-semibold text-orange-600">{{ $pendingReviews }}</p>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Recent Appointments -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">{{ __('admin.dashboard.recent_appointments') }}</h2>
            </div>
            <div class="p-6">
                @if($recentAppointments->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentAppointments as $appointment)
                            <div class="flex items-center justify-between border-b border-gray-100 pb-3">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        @if($appointment->patient->avatar)
                                            <img src="{{ asset('storage/' . $appointment->patient->avatar) }}" alt="" class="h-10 w-10 rounded-full">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                                <span class="text-gray-600">{{ substr($appointment->patient->name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $appointment->patient->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $appointment->service->name }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $appointment->appointment_date->format('M d') }}
                                    </p>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $appointment->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                    ">
                                        {{ __('patient.appointments.status.' . $appointment->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('admin.appointments.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                            {{ __('admin.dashboard.view_all_appointments') }} →
                        </a>
                    </div>
                @else
                    <p class="text-center text-gray-500 py-8">{{ __('admin.dashboard.no_appointments') }}</p>
                @endif
            </div>
        </div>

        <!-- Popular Services -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">{{ __('admin.dashboard.popular_services') }}</h2>
            </div>
            <div class="p-6">
                @if($popularServices->count() > 0)
                    <div class="space-y-3">
                        @foreach($popularServices as $service)
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-900">{{ $service->name }}</span>
                                <span class="text-sm font-medium text-gray-600">
                                    {{ $service->appointments_count }} {{ __('admin.dashboard.bookings') }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center text-gray-500 py-8">{{ __('admin.dashboard.no_services_data') }}</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="mb-8">
        <!-- Time Range Filter -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <div class="flex flex-wrap items-center gap-4">
                <span class="text-sm font-medium text-gray-700">{{ __('admin.dashboard.time_range') }}:</span>
                <div class="flex gap-2">
                    <button wire:click="$set('timeRange', '7days')" 
                            class="px-3 py-1 rounded-md text-sm font-medium transition {{ $timeRange === '7days' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        {{ __('admin.dashboard.last_7_days') }}
                    </button>
                    <button wire:click="$set('timeRange', '30days')" 
                            class="px-3 py-1 rounded-md text-sm font-medium transition {{ $timeRange === '30days' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        {{ __('admin.dashboard.last_30_days') }}
                    </button>
                    <button wire:click="$set('timeRange', '3months')" 
                            class="px-3 py-1 rounded-md text-sm font-medium transition {{ $timeRange === '3months' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        {{ __('admin.dashboard.last_3_months') }}
                    </button>
                    <button wire:click="$set('timeRange', '1year')" 
                            class="px-3 py-1 rounded-md text-sm font-medium transition {{ $timeRange === '1year' ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        {{ __('admin.dashboard.last_year') }}
                    </button>
                </div>
                <div class="flex items-center gap-2 ml-auto">
                    <input type="date" wire:model.live.debounce.300ms="customStartDate" 
                           class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="{{ __('admin.dashboard.from') }}">
                    <span class="text-gray-500">-</span>
                    <input type="date" wire:model.live.debounce.300ms="customEndDate" 
                           class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="{{ __('admin.dashboard.to') }}">
                </div>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Appointments Trend Line Chart -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">{{ __('admin.dashboard.appointments_trend') }}</h2>
                </div>
                <div class="p-6">
                    <div wire:ignore id="appointments-trend-chart"></div>
                </div>
            </div>

            <!-- Revenue by Month Bar Chart -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">{{ __('admin.dashboard.monthly_revenue_chart') }}</h2>
                </div>
                <div class="p-6">
                    <div wire:ignore id="revenue-month-chart"></div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Popular Services Pie Chart -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">{{ __('admin.dashboard.popular_services_chart') }}</h2>
                </div>
                <div class="p-6">
                    <div wire:ignore id="popular-services-chart"></div>
                </div>
            </div>

            <!-- Appointment Status Doughnut Chart -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">{{ __('admin.dashboard.appointment_status_chart') }}</h2>
                </div>
                <div class="p-6">
                    <div wire:ignore id="appointment-status-chart"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('admin.dashboard.quick_actions') }}</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.appointments.index') }}" class="block bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 transition text-center font-medium">
                📅 {{ __('admin.dashboard.manage_appointments') }}
            </a>
            <a href="{{ route('admin.patients.index') }}" class="block bg-green-600 text-white px-4 py-3 rounded-lg hover:bg-green-700 transition text-center font-medium">
                👥 {{ __('admin.dashboard.manage_patients') }}
            </a>
            <a href="{{ route('admin.doctors.index') }}" class="block bg-purple-600 text-white px-4 py-3 rounded-lg hover:bg-purple-700 transition text-center font-medium">
                👨‍⚕️ {{ __('admin.dashboard.manage_doctors') }}
            </a>
            <a href="{{ route('admin.services.index') }}" class="block bg-orange-600 text-white px-4 py-3 rounded-lg hover:bg-orange-700 transition text-center font-medium">
                🦷 {{ __('admin.dashboard.manage_services') }}
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
        
        // Appointments Trend Line Chart
        window.charts['appointments-trend'] = window.renderChart('#appointments-trend-chart', {
            type: 'line',
            height: 300,
            colors: ['#3b82f6'],
            series: [{
                name: '{{ __('admin.dashboard.appointments') }}',
                data: @json($chartTrendData['series'])
            }],
            labels: @json($chartTrendData['labels']),
            xaxis: {
                type: 'category'
            },
            yaxis: {
                title: {
                    text: '{{ __('admin.dashboard.appointments') }}'
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + ' {{ __('admin.dashboard.appointments') }}'
                    }
                }
            }
        });

        // Revenue by Month Bar Chart
        window.charts['revenue-month'] = window.renderChart('#revenue-month-chart', {
            type: 'bar',
            height: 300,
            colors: ['#10b981'],
            series: [{
                name: '{{ __('admin.dashboard.revenue') }}',
                data: @json($chartRevenueData['series'])
            }],
            labels: @json($chartRevenueData['labels']),
            xaxis: {
                type: 'category'
            },
            yaxis: {
                title: {
                    text: '{{ __('admin.dashboard.revenue') }} ($)'
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return '$' + val.toFixed(2)
                    }
                }
            }
        });

        // Popular Services Pie Chart
        window.charts['popular-services'] = window.renderChart('#popular-services-chart', {
            type: 'pie',
            height: 300,
            series: @json($chartPopularData['series']),
            labels: @json($chartPopularData['labels']),
            legend: {
                position: 'right'
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return val + ' {{ __('admin.dashboard.bookings') }}'
                    }
                }
            }
        });

        // Appointment Status Doughnut Chart
        window.charts['appointment-status'] = window.renderChart('#appointment-status-chart', {
            type: 'donut',
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
                        return val + ' {{ __('admin.dashboard.appointments') }}'
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


