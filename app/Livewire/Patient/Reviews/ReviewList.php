<?php

namespace App\Livewire\Patient\Reviews;

use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;

class ReviewList extends Component
{
    use WithPagination;

    public function render()
    {
        $reviews = auth()->user()->reviews()
            ->with(['doctor', 'appointment.service'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.patient.reviews.review-list', [
            'reviews' => $reviews,
        ]);
    }
}
