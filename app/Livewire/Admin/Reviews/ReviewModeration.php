<?php

namespace App\Livewire\Admin\Reviews;

use App\Models\Review;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class ReviewModeration extends Component
{
    use WithPagination;

    public $search = '';
    public $statusFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function approve($reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $review->update(['status' => 'approved']);
        session()->flash('success', __('admin.reviews.approved_success'));
    }

    public function reject($reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $review->update(['status' => 'rejected']);
        session()->flash('success', __('admin.reviews.rejected_success'));
    }

    public function toggleFeatured($reviewId)
    {
        $review = Review::findOrFail($reviewId);
        $review->update(['is_featured' => !$review->is_featured]);
        session()->flash('success', __('admin.reviews.updated_success'));
    }

    public function render()
    {
        $reviews = Review::with(['patient', 'doctor', 'appointment'])
            ->when($this->search, fn($query) => 
                $query->whereHas('patient', fn($q) => 
                    $q->where('name', 'like', '%' . $this->search . '%')
                )
            )
            ->when($this->statusFilter, fn($query) => 
                $query->where('status', $this->statusFilter)
            )
            ->latest()
            ->paginate(15);

        $statuses = ['pending', 'approved', 'rejected'];

        return view('livewire.admin.reviews.review-moderation', [
            'reviews' => $reviews,
            'statuses' => $statuses,
        ]);
    }
}

