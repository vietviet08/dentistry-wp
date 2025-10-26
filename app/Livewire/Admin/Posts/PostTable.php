<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
class PostTable extends Component
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

    public function toggleStatus($postId)
    {
        $post = Post::findOrFail($postId);
        $post->update(['status' => $post->status === 'published' ? 'draft' : 'published']);
        session()->flash('success', 'Post status updated.');
    }

    public function deletePost($postId)
    {
        $post = Post::findOrFail($postId);
        $post->delete();
        session()->flash('success', 'Post deleted successfully.');
    }

    public function render()
    {
        $posts = Post::with('author')
            ->when($this->search, fn($query) => 
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('content', 'like', '%' . $this->search . '%')
            )
            ->when($this->statusFilter, fn($query) => 
                $query->where('status', $this->statusFilter)
            )
            ->latest('published_at')
            ->paginate(15);

        $statuses = ['draft', 'published', 'archived'];

        return view('livewire.admin.posts.post-table', [
            'posts' => $posts,
            'statuses' => $statuses,
        ]);
    }
}

