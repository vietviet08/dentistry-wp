<?php

namespace App\Livewire\Doctor;

use App\Models\Appointment;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.doctor')]
class Dashboard extends Component
{
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
        ]);
    }
}

