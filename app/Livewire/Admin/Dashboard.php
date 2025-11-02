<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Carbon\Carbon;

#[Layout('components.layouts.admin')]
class Dashboard extends Component
{
    public $timeRange = '7days';
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

    public function appointmentsTrendData()
    {
        [$startDate, $endDate] = $this->getDateRange();
        $interval = $this->getInterval();
        $dateFormat = $this->getDateFormat();
        
        if ($interval === 'DATE(appointment_date)') {
            $appointments = Appointment::whereBetween('appointment_date', [$startDate, $endDate])
                ->selectRaw("DATE(appointment_date) as period, COUNT(*) as count")
                ->groupBy('period')
                ->orderBy('period')
                ->get()
                ->pluck('count', 'period');
            
            // Fill missing dates with 0
            $labels = [];
            $series = [];
            $current = Carbon::parse($startDate);
            
            while ($current <= Carbon::parse($endDate)) {
                $dateKey = $current->format('Y-m-d');
                $labels[] = $current->format($dateFormat);
                $series[] = $appointments[$dateKey] ?? 0;
                $current->addDay();
            }
        } else if ($interval === 'YEARWEEK(appointment_date)') {
            $appointments = Appointment::whereBetween('appointment_date', [$startDate, $endDate])
                ->selectRaw("TO_CHAR(appointment_date, 'IYYY-IW') as period, COUNT(*) as count")
                ->groupBy('period')
                ->orderBy('period')
                ->get()
                ->pluck('count', 'period');
            
            $labels = [];
            $series = [];
            $current = Carbon::parse($startDate)->startOfWeek();
            
            while ($current <= Carbon::parse($endDate)) {
                $weekKey = $current->format('o-W');
                $labels[] = $current->format('M j');
                $series[] = $appointments[$weekKey] ?? 0;
                $current->addWeek();
            }
        } else if ($interval === 'MONTH') {
            $appointments = Appointment::whereBetween('appointment_date', [$startDate, $endDate])
                ->selectRaw("TO_CHAR(appointment_date, 'YYYY-MM') as period, COUNT(*) as count")
                ->groupBy('period')
                ->orderBy('period')
                ->get()
                ->pluck('count', 'period');
            
            $labels = [];
            $series = [];
            $current = Carbon::parse($startDate)->startOfMonth();
            
            while ($current <= Carbon::parse($endDate)) {
                $monthKey = $current->format('Y-m');
                $labels[] = $current->format($dateFormat);
                $series[] = $appointments[$monthKey] ?? 0;
                $current->addMonth();
            }
        } else {
            // Fallback to daily for unknown intervals
            $appointments = Appointment::whereBetween('appointment_date', [$startDate, $endDate])
                ->selectRaw("DATE(appointment_date) as period, COUNT(*) as count")
                ->groupBy('period')
                ->orderBy('period')
                ->get()
                ->pluck('count', 'period');
            
            $labels = [];
            $series = [];
            $current = Carbon::parse($startDate);
            
            while ($current <= Carbon::parse($endDate)) {
                $dateKey = $current->format('Y-m-d');
                $labels[] = $current->format($dateFormat);
                $series[] = $appointments[$dateKey] ?? 0;
                $current->addDay();
            }
        }
        
        return ['labels' => $labels, 'series' => $series];
    }

    public function revenueByMonthData()
    {
        $months = [];
        $revenues = [];
        
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $months[] = $month->format('M Y');
            
            $revenue = Appointment::whereYear('appointment_date', $month->year)
                ->whereMonth('appointment_date', $month->month)
                ->whereIn('status', ['confirmed', 'completed'])
                ->with('service')
                ->get()
                ->sum(fn($apt) => $apt->service->price ?? 0);
            
            $revenues[] = round($revenue, 2);
        }
        
        return ['labels' => $months, 'series' => $revenues];
    }

    public function popularServicesData()
    {
        [$startDate, $endDate] = $this->getDateRange();
        
        $services = Service::where('is_active', true)
            ->withCount(['appointments' => function($query) use ($startDate, $endDate) {
                $query->whereBetween('appointment_date', [$startDate, $endDate]);
            }])
            ->orderBy('appointments_count', 'desc')
            ->limit(8)
            ->get();
        
        return [
            'labels' => $services->pluck('name')->toArray(),
            'series' => $services->pluck('appointments_count')->toArray()
        ];
    }

    public function appointmentStatusData()
    {
        [$startDate, $endDate] = $this->getDateRange();
        
        $statuses = Appointment::whereBetween('appointment_date', [$startDate, $endDate])
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

    private function getDateRange()
    {
        if ($this->customStartDate && $this->customEndDate) {
            return [Carbon::parse($this->customStartDate), Carbon::parse($this->customEndDate)];
        }
        
        return match($this->timeRange) {
            '7days' => [Carbon::now()->subDays(7), Carbon::now()],
            '30days' => [Carbon::now()->subDays(30), Carbon::now()],
            '3months' => [Carbon::now()->subMonths(3), Carbon::now()],
            '1year' => [Carbon::now()->subYear(), Carbon::now()],
            default => [Carbon::now()->subDays(30), Carbon::now()],
        };
    }

    private function getInterval()
    {
        if ($this->customStartDate && $this->customEndDate) {
            $days = Carbon::parse($this->customEndDate)->diffInDays(Carbon::parse($this->customStartDate));
            if ($days <= 30) return 'DATE(appointment_date)';
            if ($days <= 90) return 'YEARWEEK(appointment_date)';
            return 'MONTH';
        }
        
        return match($this->timeRange) {
            '7days', '30days' => 'DATE(appointment_date)',
            '3months' => 'YEARWEEK(appointment_date)',
            '1year' => 'MONTH',
            default => 'DATE(appointment_date)',
        };
    }

    private function getDateFormat()
    {
        if ($this->customStartDate && $this->customEndDate) {
            $days = Carbon::parse($this->customEndDate)->diffInDays(Carbon::parse($this->customStartDate));
            if ($days <= 30) return 'M j';
            if ($days <= 90) return 'M j';
            return 'M Y';
        }
        
        return match($this->timeRange) {
            '7days', '30days' => 'M j',
            '3months' => 'M j',
            '1year' => 'M Y',
            default => 'M j',
        };
    }

    public function render()
    {
        // Calculate statistics
        $totalUsers = User::count();
        $totalPatients = User::where('role', 'patient')->count();
        $totalAppointments = Appointment::count();
        $pendingAppointments = Appointment::pending()->count();
        $confirmedAppointments = Appointment::confirmed()->count();
        $todayAppointments = Appointment::where('appointment_date', today())->count();
        $upcomingAppointments = Appointment::upcoming()->count();
        
        // Revenue calculations
        $monthlyRevenue = Appointment::whereMonth('created_at', now()->month)
            ->whereIn('status', ['confirmed', 'completed'])
            ->with('service')
            ->get()
            ->sum(fn($appointment) => $appointment->service->price ?? 0);
        
        $totalServices = Service::where('is_active', true)->count();
        $totalDoctors = Doctor::count();
        $activeDoctors = Doctor::where('is_available', true)->count();
        
        // Recent appointments
        $recentAppointments = Appointment::with(['patient', 'doctor', 'service'])
            ->latest()
            ->take(5)
            ->get();
        
        // Reviews pending moderation
        $pendingReviews = Review::where('status', 'pending')->count();
        
        // Popular services
        $popularServices = Service::withCount('appointments')
            ->orderBy('appointments_count', 'desc')
            ->take(5)
            ->get();

        return view('livewire.admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalPatients' => $totalPatients,
            'totalAppointments' => $totalAppointments,
            'pendingAppointments' => $pendingAppointments,
            'confirmedAppointments' => $confirmedAppointments,
            'todayAppointments' => $todayAppointments,
            'upcomingAppointments' => $upcomingAppointments,
            'monthlyRevenue' => $monthlyRevenue ?? 0,
            'totalServices' => $totalServices,
            'totalDoctors' => $totalDoctors,
            'activeDoctors' => $activeDoctors,
            'recentAppointments' => $recentAppointments,
            'pendingReviews' => $pendingReviews,
            'popularServices' => $popularServices,
            'chartTrendData' => $this->appointmentsTrendData(),
            'chartRevenueData' => $this->revenueByMonthData(),
            'chartPopularData' => $this->popularServicesData(),
            'chartStatusData' => $this->appointmentStatusData(),
        ]);
    }
}



