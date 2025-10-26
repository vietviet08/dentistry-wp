<div>
    <x-layouts.app>
        <x-slot name="title">Patient Dashboard</x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}!</h1>
                    <p class="text-gray-600 mt-2">Here's an overview of your dental care journey</p>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Appointments</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalCount }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Upcoming</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $upcomingCount }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Past Appointments</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $pastCount }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Available Doctors</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $doctors }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow p-6 mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Quick Actions</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <a href="/appointments/create" class="bg-blue-600 text-white px-4 py-3 rounded-lg text-center hover:bg-blue-700 transition">
                            Book Appointment
                        </a>
                        <a href="/appointments" class="bg-gray-600 text-white px-4 py-3 rounded-lg text-center hover:bg-gray-700 transition">
                            View Appointments
                        </a>
                        <a href="/services" class="bg-green-600 text-white px-4 py-3 rounded-lg text-center hover:bg-green-700 transition">
                            Browse Services
                        </a>
                        <a href="/profile" class="bg-purple-600 text-white px-4 py-3 rounded-lg text-center hover:bg-purple-700 transition">
                            Update Profile
                        </a>
                    </div>
                </div>

                <!-- Upcoming Appointments -->
                <div class="bg-white rounded-lg shadow p-6 mb-8">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-semibold text-gray-900">Upcoming Appointments</h2>
                        <a href="{{ route('appointments.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View All</a>
                    </div>
                    
                    @if($upcomingAppointments->count() > 0)
                        <div class="space-y-4">
                            @foreach($upcomingAppointments as $appointment)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="font-semibold text-gray-900">{{ $appointment->service->name }}</p>
                                                <p class="text-sm text-gray-600">{{ $appointment->doctor->name }}</p>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ $appointment->appointment_date->format('M d, Y') }} at {{ $appointment->appointment_time }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="px-3 py-1 text-xs font-medium rounded-full 
                                                @if($appointment->status === 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($appointment->status === 'confirmed') bg-green-100 text-green-800
                                                @else bg-gray-100 text-gray-800
                                                @endif">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                            <a href="{{ route('appointments.show', $appointment) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                View
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500">
                            <div class="text-4xl mb-4">📅</div>
                            <p>No upcoming appointments</p>
                            <p class="text-sm">Book your first appointment to get started</p>
                            <a href="{{ route('appointments.create') }}" class="mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                                Book Appointment
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </x-layouts.app>
</div>

