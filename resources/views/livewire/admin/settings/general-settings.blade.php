<x-slot name="title">{{ __('admin.settings.title') }}</x-slot>

<div>
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">
            ← {{ __('admin.common.back_to_dashboard') }}
        </a>
        <h1 class="text-3xl font-bold text-gray-900">{{ __('admin.settings.title') }}</h1>
        <p class="text-gray-600 mt-2">{{ __('admin.settings.subtitle') }}</p>
    </div>

    <!-- Settings Sections -->
    <div class="space-y-6">
        <!-- Clinic Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('admin.settings.clinic_info') }}</h2>
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.settings.clinic_name') }}</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="{{ __('admin.settings.enter_clinic_name') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.settings.phone_number') }}</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="{{ __('admin.settings.enter_phone') }}">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.settings.email') }}</label>
                    <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="{{ __('admin.settings.enter_email') }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.settings.address') }}</label>
                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg" rows="3" placeholder="{{ __('admin.settings.enter_address') }}"></textarea>
                </div>
                <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    {{ __('admin.common.save_changes') }}
                </button>
            </div>
        </div>

        <!-- Appointment Settings -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">{{ __('admin.settings.appointment_settings') }}</h2>
            <div class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Default Slot Duration (minutes)</label>
                        <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="30">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Advance Booking Limit (days)</label>
                        <input type="number" class="w-full px-3 py-2 border border-gray-300 rounded-lg" placeholder="30">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Notifications</label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" class="rounded border-gray-300">
                        <span class="text-sm text-gray-700">Send email notifications for appointments</span>
                    </label>
                </div>
                <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    {{ __('admin.common.save_changes') }}
                </button>
            </div>
        </div>

        <!-- System Information -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">System Information</h2>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Application Version</span>
                    <span class="text-gray-900 font-medium">1.0.0</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Laravel Version</span>
                    <span class="text-gray-900 font-medium">{{ app()->version() }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Database</span>
                    <span class="text-green-600 font-semibold">✓ Connected</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Cache Status</span>
                    <span class="text-green-600 font-semibold">✓ Active</span>
                </div>
            </div>
        </div>
    </div>
</div>
