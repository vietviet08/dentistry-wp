<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\DoctorSchedule;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class AppointmentService
{
    /**
     * Get available time slots for a doctor on a specific date
     */
    public function getAvailableSlots(int $doctorId, string $date): Collection
    {
        $doctor = Doctor::findOrFail($doctorId);
        $schedule = $this->getScheduleForDate($doctor, $date);

        if (!$schedule) {
            return collect();
        }

        $dateCarbon = Carbon::parse($date);
        $dayOfWeek = $dateCarbon->dayOfWeek; // 0=Sunday, 6=Saturday

        $schedule = $doctor->schedules()->where('day_of_week', $dayOfWeek)->first();

        if (!$schedule) {
            return collect();
        }

        // Get existing appointments
        $existingAppointments = Appointment::where('doctor_id', $doctorId)
            ->where('appointment_date', $date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->get()
            ->map(fn ($apt) => Carbon::parse($apt->appointment_time)->format('H:i'))
            ->toArray();

        // Generate time slots
        $startTime = Carbon::parse($schedule->start_time);
        $endTime = Carbon::parse($schedule->end_time);
        $slotDuration = $schedule->slot_duration ?? 30;

        $slots = collect();
        $currentTime = $startTime->copy();

        // If it's today, start from current time + buffer
        if ($dateCarbon->isToday()) {
            $now = now()->addMinutes(30); // 30 min buffer
            if ($currentTime->format('H:i') < $now->format('H:i')) {
                $currentTime = $now->startOfMinute();
            }
        }

        while ($currentTime < $endTime) {
            $slotEnd = $currentTime->copy()->addMinutes($slotDuration);

            // Check if slot is during break time
            $isInBreak = $schedule->break_start && $schedule->break_end
                && $this->isTimeInRange($currentTime, $schedule->break_start, $schedule->break_end);

            // Check if slot would overlap with existing appointments
            $isOccupied = in_array($currentTime->format('H:i'), $existingAppointments);

            // Check if slot would extend beyond end time
            $isValid = $slotEnd <= $endTime;

            if (!$isInBreak && !$isOccupied && $isValid) {
                $slots->push([
                    'time' => $currentTime->format('H:i'),
                    'display' => $currentTime->format('g:i A'),
                    'value' => $currentTime->format('H:i:s'),
                ]);
            }

            $currentTime->addMinutes($slotDuration);
        }

        return $slots;
    }

    /**
     * Check if a specific time slot is available
     */
    public function isSlotAvailable(int $doctorId, string $date, string $time): bool
    {
        $slots = $this->getAvailableSlots($doctorId, $date);
        
        return $slots->contains(fn ($slot) => $slot['value'] === $time);
    }

    /**
     * Get the doctor's schedule for a specific date
     */
    private function getScheduleForDate(Doctor $doctor, string $date): ?DoctorSchedule
    {
        $dateCarbon = Carbon::parse($date);
        $dayOfWeek = $dateCarbon->dayOfWeek;

        return $doctor->schedules()->where('day_of_week', $dayOfWeek)->first();
    }

    /**
     * Check if time is within a range
     */
    private function isTimeInRange(Carbon $time, string $rangeStart, string $rangeEnd): bool
    {
        $timeFormatted = $time->format('H:i:s');
        
        // Handle overnight ranges (e.g., 22:00 - 02:00)
        if ($rangeStart > $rangeEnd) {
            return $timeFormatted >= $rangeStart || $timeFormatted <= $rangeEnd;
        }
        
        return $timeFormatted >= $rangeStart && $timeFormatted <= $rangeEnd;
    }

    /**
     * Get available dates for a doctor within a range
     */
    public function getAvailableDates(int $doctorId, int $days = 30): Collection
    {
        $availableDates = collect();
        $doctor = Doctor::findOrFail($doctorId);

        for ($i = 0; $i < $days; $i++) {
            $date = today()->addDays($i);
            $dayOfWeek = $date->dayOfWeek;

            // Check if doctor has schedule for this day
            $hasSchedule = $doctor->schedules()->where('day_of_week', $dayOfWeek)->exists();

            if ($hasSchedule) {
                $availableDates->push([
                    'date' => $date->format('Y-m-d'),
                    'display' => $date->format('D, M j'),
                    'day_of_week' => $date->dayName,
                    'is_today' => $date->isToday(),
                    'is_tomorrow' => $date->isTomorrow(),
                ]);
            }
        }

        return $availableDates;
    }

    /**
     * Check if doctor is available on a specific date
     */
    public function isDoctorAvailableOnDate(int $doctorId, string $date): bool
    {
        $doctor = Doctor::findOrFail($doctorId);
        
        if (!$doctor->is_available) {
            return false;
        }

        $dateCarbon = Carbon::parse($date);
        $dayOfWeek = $dateCarbon->dayOfWeek;

        return $doctor->schedules()->where('day_of_week', $dayOfWeek)->exists();
    }

    /**
     * Get booked appointments for a doctor on a specific date
     */
    public function getBookedAppointments(int $doctorId, string $date): Collection
    {
        return Appointment::where('doctor_id', $doctorId)
            ->where('appointment_date', $date)
            ->whereIn('status', ['pending', 'confirmed'])
            ->get();
    }
}

