<?php

namespace App\Livewire\Doctor;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Carbon\Carbon;

#[Layout('components.layouts.doctor')]
class Dashboard extends Component
{
    public $timeRange = '30days';
    public $customStartDate = '';
    public $customEndDate = '';
    public $chartRendered = false;

    public function updatedTimeRange($value)
    {
        $this->dispatch('chart-updated');
    }

    public function updatedCustomStartDate()
    {
        $this->dispatch('chart-updated');
    }

    public function updatedCustomEndDate()
    {
        $this->dispatch('chart-updated');
    }

    public function dailyAppointmentsData()
    {
        [$startDate, $endDate] = $this->getDateRange();
        $doctor = auth()->user()->doctor;
        
        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->whereBetween('appointment_date', [$startDate, $endDate])
            ->selectRaw('DATE(appointment_date) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date');
        
        // Fill missing dates with 0
        $labels = [];
        $series = [];
        $current = Carbon::parse($startDate);
        
        while ($current <= Carbon::parse($endDate)) {
            $dateKey = $current->format('Y-m-d');
            $labels[] = $current->format('M j');
            $series[] = $appointments[$dateKey] ?? 0;
            $current->addDay();
        }
        
        return ['labels' => $labels, 'series' => $series];
    }

    public function appointmentStatusData()
    {
        [$startDate, $endDate] = $this->getDateRange();
        $doctor = auth()->user()->doctor;
        
        $statuses = Appointment::where('doctor_id', $doctor->id)
            ->whereBetween('appointment_date', [$startDate, $endDate])
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status');
        
        return [
            'labels' => ['Pending', 'Confirmed', 'Completed', 'Cancelled', 'No Show'],
            'series' => [
                $statuses['pending'] ?? 0,
                $statuses['confirmed'] ?? 0,
                $statuses['completed'] ?? 0,
                $statuses['cancelled'] ?? 0,
                $statuses['no_show'] ?? 0,
            ]
        ];
    }

    public function weeklyScheduleData()
    {
        $doctor = auth()->user()->doctor;
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
        
        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->whereBetween('appointment_date', [$startOfWeek, $endOfWeek])
            ->whereIn('status', ['pending', 'confirmed'])
            ->selectRaw('DATE(appointment_date) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date');
        
        // Fill all 7 days of the week
        $labels = [];
        $series = [];
        $current = $startOfWeek->copy();
        
        while ($current <= $endOfWeek) {
            $dateKey = $current->format('Y-m-d');
            $labels[] = $current->format('D');
            $series[] = $appointments[$dateKey] ?? 0;
            $current->addDay();
        }
        
        return ['labels' => $labels, 'series' => $series];
    }

    private function getDateRange()
    {
        if ($this->customStartDate && $this->customEndDate) {
            return [Carbon::parse($this->customStartDate), Carbon::parse($this->customEndDate)];
        }
        
        return match($this->timeRange) {
            '7days' => [Carbon::now()->subDays(7), Carbon::now()],
            '30days' => [Carbon::now()->subDays(30), Carbon::now()],
            '3months' => [Carbon::now()->subMonths(3), Carbon::now()],
            default => [Carbon::now()->subDays(30), Carbon::now()],
        };
    }

    public function render()
    {
        $doctor = auth()->user()->doctor;
        
        if (!$doctor) {
            abort(403, 'Doctor profile not found');
        }

        // Get doctor's appointments only
        $doctorAppointments = Appointment::where('doctor_id', $doctor->id);
        
        $todayAppointments = (clone $doctorAppointments)
            ->where('appointment_date', today())
            ->whereIn('status', ['pending', 'confirmed'])
            ->count();
        
        $pendingAppointments = (clone $doctorAppointments)
            ->pending()
            ->count();
        
        $upcomingAppointments = (clone $doctorAppointments)
            ->upcoming()
            ->count();
        
        $confirmedAppointments = (clone $doctorAppointments)
            ->confirmed()
            ->count();
        
        $completedAppointments = (clone $doctorAppointments)
            ->completed()
            ->count();
        
        $totalAppointments = (clone $doctorAppointments)->count();

        // Recent appointments for this doctor
        $recentAppointments = Appointment::where('doctor_id', $doctor->id)
            ->with(['patient', 'service'])
            ->latest()
            ->take(5)
            ->get();

        // Upcoming appointments for today and next few days
        $upcomingToday = Appointment::where('doctor_id', $doctor->id)
            ->where('appointment_date', '>=', today())
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->take(5)
            ->get();

        return view('livewire.doctor.dashboard', [
            'doctor' => $doctor,
            'todayAppointments' => $todayAppointments,
            'pendingAppointments' => $pendingAppointments,
            'upcomingAppointments' => $upcomingAppointments,
            'confirmedAppointments' => $confirmedAppointments,
            'completedAppointments' => $completedAppointments,
            'totalAppointments' => $totalAppointments,
            'recentAppointments' => $recentAppointments,
            'upcomingToday' => $upcomingToday,
            'chartDailyData' => $this->dailyAppointmentsData(),
            'chartStatusData' => $this->appointmentStatusData(),
            'chartWeeklyData' => $this->weeklyScheduleData(),
        ]);
    }
}

