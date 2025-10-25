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
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-blue-600">🦷</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Available Services</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $services }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <span class="text-green-600">👨‍⚕️</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Available Doctors</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $doctors }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                    <span class="text-purple-600">📅</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Upcoming Appointments</p>
                                <p class="text-2xl font-semibold text-gray-900">0</p>
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

                <!-- Recent Activity -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Recent Activity</h2>
                    <div class="text-center py-8 text-gray-500">
                        <div class="text-4xl mb-4">📋</div>
                        <p>No recent activity to display</p>
                        <p class="text-sm">Your appointments and treatments will appear here</p>
                    </div>
                </div>
            </div>
        </div>
    </x-layouts.app>
</div>

