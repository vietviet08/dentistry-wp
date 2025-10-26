<?php

namespace App\Livewire\Patient\Appointments;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\Doctor;
use App\Services\AppointmentService;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;

#[Layout('components.layouts.app')]
class AppointmentCreate extends Component
{
    public $step = 1;
    
    // Step 1: Service Selection
    #[Validate('required|exists:services,id')]
    public $service_id;
    
    // Step 2: Doctor Selection
    #[Validate('required|exists:doctors,id')]
    public $doctor_id;
    
    // Step 3: Date Selection
    #[Validate('required|date|after:today')]
    public $appointment_date;
    
    // Step 4: Time Slot Selection
    #[Validate('required')]
    public $appointment_time;
    
    // Step 5: Notes
    public $notes = '';
    
    // Temporary storage
    public $selectedService;
    public $selectedDoctor;
    public $selectedDate;
    public $selectedTime;

    protected $listeners = [
        'service-selected' => 'onServiceSelected',
        'doctor-selected' => 'onDoctorSelected',
        'date-selected' => 'onDateSelected',
        'time-selected' => 'onTimeSelected',
    ];

    public function onServiceSelected($serviceId)
    {
        $this->service_id = $serviceId;
        $this->selectedService = Service::find($serviceId);
    }

    public function onDoctorSelected($doctorId)
    {
        $this->doctor_id = $doctorId;
        $this->selectedDoctor = Doctor::find($doctorId);
    }

    public function onDateSelected($date)
    {
        $this->appointment_date = $date;
        $this->selectedDate = $date;
    }

    public function onTimeSelected($time)
    {
        $this->appointment_time = $time;
        $this->selectedTime = $time;
    }

    public function nextStep()
    {
        $this->validate($this->getStepValidationRules());
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function submit()
    {
        $this->validate();

        // Double-check slot availability (race condition protection)
        $service = app(AppointmentService::class);
        
        if (!$service->isSlotAvailable($this->doctor_id, $this->appointment_date, $this->appointment_time)) {
            $this->addError('appointment_time', 'This time slot is no longer available. Please select another.');
            return;
        }

        try {
            DB::beginTransaction();

            $appointment = Appointment::create([
                'patient_id' => auth()->id(),
                'doctor_id' => $this->doctor_id,
                'service_id' => $this->service_id,
                'appointment_date' => $this->appointment_date,
                'appointment_time' => $this->appointment_time,
                'notes' => $this->notes,
                'status' => 'pending',
            ]);

            // Calculate end time
            $appointment->calculateEndTime();

            // Generate QR code (simple placeholder for now)
            $qrCodeData = route('appointments.show', $appointment);
            $qrCodePath = $this->generateQRCode($qrCodeData, $appointment->id);
            
            $appointment->update(['qr_code' => $qrCodePath]);

            DB::commit();

            // Dispatch email notification
            \App\Jobs\SendAppointmentConfirmationEmail::dispatch($appointment);

            session()->flash('success', 'Appointment booked successfully! A confirmation email has been sent.');
            
            return redirect()->route('appointments.show', $appointment);

        } catch (\Exception $e) {
            DB::rollBack();
            $this->addError('general', 'An error occurred while booking your appointment. Please try again.');
            
            \Log::error('Appointment booking failed', [
                'error' => $e->getMessage(),
                'user_id' => auth()->id(),
                'appointment_data' => $this->only(['service_id', 'doctor_id', 'appointment_date', 'appointment_time']),
            ]);
        }
    }

    private function generateQRCode(string $data, int $appointmentId): string
    {
        // Simple text-based QR representation for now
        // In production, you'd use a proper QR library or API
        $filename = "appointments/qr-{$appointmentId}.txt";
        \Storage::disk('public')->put($filename, "Appointment ID: {$appointmentId}\nData: {$data}");
        
        return $filename;
    }

    private function getStepValidationRules(): array
    {
        return match($this->step) {
            1 => ['service_id' => 'required|exists:services,id'],
            2 => ['doctor_id' => 'required|exists:doctors,id'],
            3 => ['appointment_date' => 'required|date|after:today'],
            4 => ['appointment_time' => 'required'],
            default => []
        };
    }

    public function render()
    {
        return view('livewire.patient.appointments.appointment-create');
    }
}

