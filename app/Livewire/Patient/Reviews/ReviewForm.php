<?php

namespace App\Livewire\Patient\Reviews;

use App\Models\Appointment;
use App\Models\Review;
use Livewire\Component;

class ReviewForm extends Component
{
    public $appointment;
    public $rating = 5;
    public $comment;

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'nullable|string|max:1000',
    ];

    public function mount(Appointment $appointment)
    {
        // Check if user can review this appointment
        if ($appointment->patient_id !== auth()->id() || $appointment->status !== 'completed') {
            abort(403, 'You can only review completed appointments.');
        }

        $this->appointment = $appointment;
    }

    public function submit()
    {
        $this->validate();

        Review::create([
            'patient_id' => auth()->id(),
            'appointment_id' => $this->appointment->id,
            'doctor_id' => $this->appointment->doctor_id,
            'rating' => $this->rating,
            'comment' => $this->comment,
            'status' => 'pending',
        ]);

        session()->flash('success', 'Thank you for your review! It will be reviewed before being published.');
        return redirect()->route('reviews.index');
    }

    public function render()
    {
        return view('livewire.patient.reviews.review-form');
    }
}
