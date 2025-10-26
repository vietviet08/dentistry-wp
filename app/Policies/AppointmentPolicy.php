<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\User;

class AppointmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Patients see their own appointments, admins see all
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Appointment $appointment): bool
    {
        return $user->isAdmin() || $user->id === $appointment->patient_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isPatient() && $user->is_active;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Appointment $appointment): bool
    {
        // Updates are done through specific actions (reschedule, cancel)
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Appointment $appointment): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can cancel the appointment.
     */
    public function cancel(User $user, Appointment $appointment): bool
    {
        return $appointment->canBeCancelledBy($user);
    }

    /**
     * Determine whether the user can reschedule the appointment.
     */
    public function reschedule(User $user, Appointment $appointment): bool
    {
        return $appointment->canBeRescheduledBy($user);
    }

    /**
     * Determine whether the user can confirm the appointment.
     */
    public function confirm(User $user, Appointment $appointment): bool
    {
        return $user->isAdmin() && $appointment->status === 'pending';
    }

    /**
     * Determine whether the user can complete the appointment.
     */
    public function complete(User $user, Appointment $appointment): bool
    {
        return $user->isAdmin() && $appointment->status === 'confirmed';
    }

    /**
     * Determine whether the user can mark appointment as no-show.
     */
    public function markAsNoShow(User $user, Appointment $appointment): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Appointment $appointment): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Appointment $appointment): bool
    {
        return $user->isAdmin();
    }
}
