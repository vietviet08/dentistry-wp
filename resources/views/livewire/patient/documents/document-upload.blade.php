<div>
    <x-layouts.app>
        <x-slot name="title">My Documents</x-slot>

        <div class="py-12">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Header -->
                <div class="mb-8 flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">My Documents</h1>
                        <p class="text-gray-600 mt-2">Manage your medical documents and records</p>
                    </div>
                    <button wire:click="$set('showUploadForm', true)" 
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Upload Document
                    </button>
                </div>

                @if (session()->has('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                        <p class="text-green-800">{{ session('success') }}</p>
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                        <p class="text-red-800">{{ session('error') }}</p>
                    </div>
                @endif

                <!-- Upload Form -->
                @if($showUploadForm)
                    <div class="bg-white rounded-lg shadow p-8 mb-8">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Upload New Document</h2>
                        
                        <form wire:submit="upload">
                            <!-- Title -->
                            <div class="mb-6">
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Document Title</label>
                                <input type="text" 
                                       id="title" 
                                       wire:model="title" 
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror">
                                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- Type -->
                            <div class="mb-6">
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Document Type</label>
                                <select id="type" 
                                        wire:model="type" 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('type') border-red-500 @enderror">
                                    <option value="xray">X-Ray</option>
                                    <option value="lab_report">Lab Report</option>
                                    <option value="insurance">Insurance Card</option>
                                    <option value="medical_certificate">Medical Certificate</option>
                                    <option value="other">Other</option>
                                </select>
                                @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <!-- File Upload -->
                            <div class="mb-6">
                                <label for="file" class="block text-sm font-medium text-gray-700 mb-2">File</label>
                                <input type="file" 
                                       id="file" 
                                       wire:model="file" 
                                       accept=".pdf,.jpg,.jpeg,.png"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('file') border-red-500 @enderror">
                                @error('file') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                @if ($file)
                                    <p class="text-sm text-gray-500 mt-2">{{ $file->getClientOriginalName() }}</p>
                                @endif
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center justify-end space-x-4">
                                <button type="button" 
                                        wire:click="$set('showUploadForm', false)" 
                                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                                    Cancel
                                </button>
                                <button type="submit" 
                                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    Upload
                                </button>
                            </div>
                        </form>
                    </div>
                @endif

                <!-- Documents List -->
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    @if($documents->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Document</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Size</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Uploaded</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($documents as $document)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded flex items-center justify-center">
                                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $document->title }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    {{ ucfirst(str_replace('_', ' ', $document->type)) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $document->file_size_human }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $document->created_at->format('M d, Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ Storage::disk(config('filesystems.default'))->url($document->file_path) }}" 
                                                   target="_blank"
                                                   class="text-blue-600 hover:text-blue-900 mr-4">View</a>
                                                <button wire:click="delete({{ $document->id }})" 
                                                        class="text-red-600 hover:text-red-900"
                                                        onclick="return confirm('Are you sure you want to delete this document?')">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="text-4xl mb-4">📄</div>
                            <p class="text-gray-500">No documents uploaded yet</p>
                            <p class="text-sm text-gray-400 mt-2">Upload your medical documents to get started</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    
</div>
