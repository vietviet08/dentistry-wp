<?php

namespace App\Livewire\Admin\Gallery;

use App\Models\GalleryItem;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class GalleryManager extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryFilter = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryFilter' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategoryFilter()
    {
        $this->resetPage();
    }

    public function toggleFeatured($itemId)
    {
        $item = GalleryItem::findOrFail($itemId);
        $item->update(['is_featured' => !$item->is_featured]);
        session()->flash('success', 'Gallery item updated.');
    }

    public function render()
    {
        $items = GalleryItem::when($this->search, fn($query) => 
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%')
            )
            ->when($this->categoryFilter, fn($query) => 
                $query->where('category', $this->categoryFilter)
            )
            ->orderBy('order')
            ->latest()
            ->paginate(12);

        $categories = GalleryItem::distinct('category')->pluck('category');

        return view('livewire.admin.gallery.gallery-manager', [
            'items' => $items,
            'categories' => $categories,
        ]);
    }
}

