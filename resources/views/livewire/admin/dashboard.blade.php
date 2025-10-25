<div>
    <x-layouts.app>
        <x-slot name="title">Admin Dashboard</x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
                    <p class="text-gray-600 mt-2">Manage your dental practice efficiently</p>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <span class="text-blue-600">👥</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Users</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalUsers }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <span class="text-green-600">🦷</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Services</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalServices }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                    <span class="text-purple-600">👨‍⚕️</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Doctors</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalDoctors }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                    <span class="text-yellow-600">✅</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Active Doctors</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $activeDoctors }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Management Sections -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <!-- Quick Management -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Quick Management</h2>
                        <div class="space-y-3">
                            <a href="/admin/services" class="block bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 transition">
                                Manage Services
                            </a>
                            <a href="/admin/doctors" class="block bg-green-600 text-white px-4 py-3 rounded-lg hover:bg-green-700 transition">
                                Manage Doctors
                            </a>
                            <a href="/admin/appointments" class="block bg-purple-600 text-white px-4 py-3 rounded-lg hover:bg-purple-700 transition">
                                Manage Appointments
                            </a>
                            <a href="/admin/users" class="block bg-gray-600 text-white px-4 py-3 rounded-lg hover:bg-gray-700 transition">
                                Manage Users
                            </a>
                        </div>
                    </div>

                    <!-- System Status -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">System Status</h2>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Database</span>
                                <span class="text-green-600 font-semibold">✓ Connected</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Services</span>
                                <span class="text-green-600 font-semibold">✓ Active</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Doctors</span>
                                <span class="text-green-600 font-semibold">✓ Available</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Appointments</span>
                                <span class="text-yellow-600 font-semibold">⚠ Pending</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Recent Activity</h2>
                    <div class="text-center py-8 text-gray-500">
                        <div class="text-4xl mb-4">📊</div>
                        <p>No recent activity to display</p>
                        <p class="text-sm">System activities and updates will appear here</p>
                    </div>
                </div>
            </div>
        </div>
    </x-layouts.app>
</div>

