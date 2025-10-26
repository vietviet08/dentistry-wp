<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

#[Layout('components.layouts.admin')]
class PostEditor extends Component
{
    use WithFileUploads;

    public $postId = null;
    public $title = '';
    public $slug = '';
    public $excerpt = '';
    public $content = '';
    public $category = '';
    public $tags = '';
    public $status = 'draft';
    public $published_at = null;
    public $meta_title = '';
    public $meta_description = '';
    public $meta_keywords = '';
    public $featured_image;
    public $featuredImagePreview;

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('posts', 'slug')->ignore($this->postId)
            ],
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string|max:255',
            'tags' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
        ];
    }

    public function mount($post = null)
    {
        if ($post) {
            // Resolve post ID if it's a string
            $postId = is_string($post) ? $post : $post->id;
            $this->postId = $postId;
            
            $post = Post::findOrFail($postId);
            $this->title = $post->title;
            $this->slug = $post->slug;
            $this->excerpt = $post->excerpt;
            $this->content = $post->content;
            $this->category = $post->category;
            $this->tags = $post->tags ? implode(', ', $post->tags) : '';
            $this->status = $post->status;
            $this->published_at = $post->published_at ? $post->published_at->format('Y-m-d\TH:i') : null;
            $this->meta_title = $post->meta_title;
            $this->meta_description = $post->meta_description;
            $this->meta_keywords = $post->meta_keywords;
            $this->featuredImagePreview = $post->featured_image;
        }
    }

    public function updatedTitle()
    {
        if (!$this->postId) {
            $this->slug = \Str::slug($this->title);
        }
    }

    public function save()
    {
        $validated = $this->validate();

        if ($this->postId) {
            $post = Post::findOrFail($this->postId);
        } else {
            $post = new Post();
            $post->author_id = auth()->id();
        }

        $post->title = $validated['title'];
        $post->slug = $validated['slug'];
        $post->excerpt = $validated['excerpt'];
        $post->content = $validated['content'];
        $post->category = $validated['category'];
        $post->tags = $validated['tags'] ? array_map('trim', explode(',', $validated['tags'])) : [];
        $post->status = $validated['status'];
        $post->published_at = $validated['published_at'];
        $post->meta_title = $validated['meta_title'];
        $post->meta_description = $validated['meta_description'];
        $post->meta_keywords = $validated['meta_keywords'];

        if ($this->featured_image) {
            $post->featured_image = $this->featured_image->store('posts', 'public');
        }

        $post->save();

        session()->flash('success', 'Post saved successfully!');
        return redirect()->route('admin.posts.index');
    }

    public function render()
    {
        return view('livewire.admin.posts.post-editor');
    }
}

