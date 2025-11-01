<?php

namespace App\Livewire\Doctor\Schedule;

use App\Models\DoctorSchedule;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.doctor')]
class ScheduleManager extends Component
{
    public $schedules = [];

    public function mount()
    {
        $doctor = auth()->user()->doctor;
        
        if (!$doctor) {
            abort(403, 'Doctor profile not found');
        }
        
        $this->loadSchedules();
    }

    public function loadSchedules()
    {
        $doctorId = auth()->user()->doctor->id;
        
        $this->schedules = [];
        for ($day = 0; $day <= 6; $day++) {
            $schedule = DoctorSchedule::where('doctor_id', $doctorId)
                ->where('day_of_week', $day)
                ->first();
            
            $this->schedules[$day] = [
                'exists' => $schedule !== null,
                'start_time' => $schedule?->start_time ?? '09:00',
                'end_time' => $schedule?->end_time ?? '17:00',
                'break_start' => $schedule?->break_start ?? '',
                'break_end' => $schedule?->break_end ?? '',
                'slot_duration' => $schedule?->slot_duration ?? 30,
            ];
        }
    }

    public function saveSchedule($day)
    {
        $doctorId = auth()->user()->doctor->id;
        
        $schedule = DoctorSchedule::where('doctor_id', $doctorId)
            ->where('day_of_week', $day)
            ->first();

        $data = [
            'doctor_id' => $doctorId,
            'day_of_week' => $day,
            'start_time' => $this->schedules[$day]['start_time'],
            'end_time' => $this->schedules[$day]['end_time'],
            'break_start' => $this->schedules[$day]['break_start'] ?: null,
            'break_end' => $this->schedules[$day]['break_end'] ?: null,
            'slot_duration' => $this->schedules[$day]['slot_duration'],
        ];

        if ($schedule) {
            $schedule->update($data);
        } else {
            DoctorSchedule::create($data);
        }

        session()->flash('success', __('doctor.schedule.updated_success'));
        $this->loadSchedules();
    }

    public function deleteSchedule($day)
    {
        $doctorId = auth()->user()->doctor->id;
        
        DoctorSchedule::where('doctor_id', $doctorId)
            ->where('day_of_week', $day)
            ->delete();

        session()->flash('success', __('doctor.schedule.deleted_success'));
        $this->loadSchedules();
    }

    public function render()
    {
        $dayNames = [
            __('doctor.schedule.days.sunday'),
            __('doctor.schedule.days.monday'),
            __('doctor.schedule.days.tuesday'),
            __('doctor.schedule.days.wednesday'),
            __('doctor.schedule.days.thursday'),
            __('doctor.schedule.days.friday'),
            __('doctor.schedule.days.saturday'),
        ];
        
        return view('livewire.doctor.schedule.schedule-manager', [
            'dayNames' => $dayNames,
        ]);
    }
}

