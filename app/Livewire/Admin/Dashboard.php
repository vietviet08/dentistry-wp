<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.admin')]
class Dashboard extends Component
{
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
        ]);
    }
}



