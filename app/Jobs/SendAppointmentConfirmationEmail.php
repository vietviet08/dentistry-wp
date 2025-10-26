<?php

namespace App\Jobs;

use App\Models\Appointment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAppointmentConfirmationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $timeout = 30;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Appointment $appointment
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $appointment = $this->appointment;
        $appointment->load(['patient', 'doctor', 'service']);

        Mail::send('emails.appointment-confirmation', [
            'appointment' => $appointment,
        ], function ($message) use ($appointment) {
            $message->to($appointment->patient->email, $appointment->patient->name)
                    ->subject('Appointment Confirmation - ' . $appointment->appointment_date->format('M d, Y'));
        });
    }
}

