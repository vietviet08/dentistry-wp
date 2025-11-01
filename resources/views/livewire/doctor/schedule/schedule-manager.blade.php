<x-slot name="title">{{ __('doctor.schedule.title') }}</x-slot>

<div>
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('doctor.dashboard') }}" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">
            ← {{ __('doctor.common.back') }}
        </a>
        <h1 class="text-3xl font-bold text-gray-900">{{ __('doctor.schedule.title') }}</h1>
        <p class="text-gray-600 mt-2">{{ __('doctor.schedule.subtitle') }}</p>
    </div>

    @if(session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-6 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Schedule -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="space-y-6">
            @foreach($schedules as $day => $schedule)
                <div class="border border-gray-200 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">{{ $dayNames[$day] }}</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('doctor.schedule.start_time') }}</label>
                            <input type="time" wire:model="schedules.{{ $day }}.start_time" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('doctor.schedule.end_time') }}</label>
                            <input type="time" wire:model="schedules.{{ $day }}.end_time" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('doctor.schedule.break_start') }}</label>
                            <input type="time" wire:model="schedules.{{ $day }}.break_start" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                placeholder="{{ __('doctor.schedule.optional') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('doctor.schedule.break_end') }}</label>
                            <input type="time" wire:model="schedules.{{ $day }}.break_end" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                placeholder="{{ __('doctor.schedule.optional') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('doctor.schedule.slot_duration') }}</label>
                            <input type="number" wire:model="schedules.{{ $day }}.slot_duration" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                min="15" step="15">
                            <p class="text-xs text-gray-500 mt-1">{{ __('doctor.schedule.minutes') }}</p>
                        </div>
                    </div>

                    <div class="mt-4 flex space-x-2">
                        <button wire:click="saveSchedule({{ $day }})" 
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            {{ __('doctor.common.save') }}
                        </button>
                        <button wire:click="deleteSchedule({{ $day }})" 
                            class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                            {{ __('doctor.common.delete') }}
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

