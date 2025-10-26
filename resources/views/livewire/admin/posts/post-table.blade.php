<x-slot name="title">Manage Blog Posts</x-slot>

<div>
            <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Manage Blog Posts</h1>
                <p class="text-gray-600 mt-2">Manage blog articles and content</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.posts.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    + Create Post
                </a>
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                    ← Back
                </a>
            </div>
        </div>

            <!-- Filters -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Search</label>
        <input type="text" wire:model.live.debounce.300ms="search" 
            placeholder="Search posts..."
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>
        <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
        <select wire:model.live="statusFilter" 
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
        <option value="">All Status</option>
                                @foreach($statuses as $status)
        <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                                @endforeach
            </select>
            </div>
            </div>
            </div>

            <!-- Posts Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
                    @if(session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 m-6 rounded">
                            {{ session('success') }}
            </div>
                    @endif

        <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
        <tr>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Views</th>
        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
            </thead>
        <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($posts as $post)
        <tr>
        <td class="px-6 py-4">
        <div class="text-sm font-medium text-gray-900">{{ $post->title }}</div>
        <div class="text-sm text-gray-500">{{ Str::limit($post->excerpt ?? strip_tags($post->content), 50) }}</div>
            </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $post->author->name }}
            </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $post->category }}
            </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $post->published_at ? $post->published_at->format('M d, Y') : 'Not published' }}
            </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $post->views_count }}
            </td>
        <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                                {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $post->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                                {{ $post->status === 'archived' ? 'bg-gray-100 text-gray-800' : '' }}">
                                                {{ ucfirst($post->status) }}
            </span>
            </td>
        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
            <div class="flex items-center justify-end space-x-2">
                <a href="{{ route('admin.posts.edit', $post->id) }}" class="text-blue-600 hover:text-blue-900">
                    Edit
                </a>
                <button wire:click="toggleStatus({{ $post->id }})" class="text-yellow-600 hover:text-yellow-900">
                    {{ $post->status === 'published' ? 'Unpublish' : 'Publish' }}
                </button>
                <button wire:click="deletePost({{ $post->id }})" 
                        wire:confirm="Are you sure you want to delete this post?"
                        class="text-red-600 hover:text-red-900">
                    Delete
                </button>
            </div>
        </td>
            </tr>
                                @empty
        <tr>
        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
            No posts found
            </td>
            </tr>
                                @endforelse
            </tbody>
            </table>
            </div>

            <!-- Pagination -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                        {{ $posts->links() }}
            </div>
            </div>
        </div>
    </div>
</div>