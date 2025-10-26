<?php

namespace App\Livewire\Admin\Doctors;

use App\Models\Doctor;
use App\Models\DoctorSchedule;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class ScheduleManager extends Component
{
    public Doctor $doctor;
    public $schedules = [];

    public function mount($doctor)
    {
        $this->doctor = Doctor::findOrFail($doctor);
        $this->loadSchedules();
    }

    public function loadSchedules()
    {
        $this->schedules = [];
        for ($day = 0; $day <= 6; $day++) {
            $schedule = DoctorSchedule::where('doctor_id', $this->doctor->id)
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
        $schedule = DoctorSchedule::where('doctor_id', $this->doctor->id)
            ->where('day_of_week', $day)
            ->first();

        $data = [
            'doctor_id' => $this->doctor->id,
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

        session()->flash('success', 'Schedule updated successfully.');
        $this->loadSchedules();
    }

    public function deleteSchedule($day)
    {
        DoctorSchedule::where('doctor_id', $this->doctor->id)
            ->where('day_of_week', $day)
            ->delete();

        session()->flash('success', 'Schedule deleted successfully.');
        $this->loadSchedules();
    }

    public function render()
    {
        $dayNames = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        
        return view('livewire.admin.doctors.schedule-manager', [
            'dayNames' => $dayNames,
        ]);
    }
}

