<x-slot name="title">{{ __('admin.appointments.title') }}</x-slot>

<div>
    <!-- Header -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ __('admin.appointments.title') }}</h1>
            <p class="text-gray-600 mt-2">{{ __('admin.appointments.subtitle') }}</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.appointments.calendar') }}" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50">
                📅 {{ __('admin.common.calendar_view') }}
            </a>
            <a href="{{ route('admin.dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                ← {{ __('admin.common.back') }}
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.common.search') }}</label>
                <input type="text" wire:model.live.debounce.300ms="search" 
                       placeholder="{{ __('admin.appointments.search_placeholder') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.appointments.filter_status') }}</label>
                <select wire:model.live="statusFilter" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="">{{ __('admin.appointments.all_status') }}</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}">{{ __('patient.appointments.status.' . $status) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.appointments.filter_doctor') }}</label>
                <select wire:model.live="doctorFilter" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="">{{ __('admin.appointments.all_doctors') }}</option>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('admin.appointments.filter_date') }}</label>
                <input type="date" wire:model.live="dateFilter" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>
    </div>

    <!-- Appointments Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if(session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 m-6 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('admin.appointments.table.patient') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('admin.appointments.table.doctor') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('admin.appointments.table.service') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('admin.appointments.table.datetime') }}</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('admin.common.status') }}</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('admin.common.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($appointments as $appointment)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if($appointment->patient->avatar)
                                            <img src="{{ asset('storage/' . $appointment->patient->avatar) }}" alt="" class="h-10 w-10 rounded-full">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                                <span class="text-gray-600">{{ substr($appointment->patient->name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $appointment->patient->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $appointment->patient->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $appointment->doctor->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $appointment->service->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $appointment->appointment_date->format('M d, Y') }}<br>
                                <span class="text-gray-500">{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('g:i A') }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $appointment->status === 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $appointment->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $appointment->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $appointment->status === 'cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $appointment->status === 'no_show' ? 'bg-gray-100 text-gray-800' : '' }}
                                ">
                                    {{ __('patient.appointments.status.' . $appointment->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    @if($appointment->status === 'pending')
                                        <button wire:click="confirmAppointment({{ $appointment->id }})" 
                                                class="text-green-600 hover:text-green-900" title="{{ __('admin.appointments.confirm') }}">
                                            ✓ {{ __('admin.appointments.confirm') }}
                                        </button>
                                    @endif
                                    @if($appointment->status === 'confirmed')
                                        <button wire:click="completeAppointment({{ $appointment->id }})" 
                                                class="text-blue-600 hover:text-blue-900" title="{{ __('admin.appointments.complete') }}">
                                            ✓ {{ __('admin.appointments.complete') }}
                                        </button>
                                    @endif
                                    @if(!in_array($appointment->status, ['cancelled', 'completed', 'no_show']))
                                        <button wire:click="cancelAppointment({{ $appointment->id }})" 
                                                class="text-red-600 hover:text-red-900" title="{{ __('patient.appointments.cancel') }}">
                                            ✕ {{ __('patient.appointments.cancel') }}
                                        </button>
                                    @endif
                                    <a href="{{ route('admin.appointments.show', $appointment->id) }}" 
                                       class="text-blue-600 hover:text-blue-900">{{ __('patient.appointments.view') }}</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                {{ __('admin.appointments.no_appointments') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            {{ $appointments->links() }}
        </div>
    </div>
</div>
