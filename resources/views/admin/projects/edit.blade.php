{{-- resources/views/admin/projects/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Project: ' . $project->title)

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-white">
                 <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-semibold text-white">Edit Project: <span class="text-teal-400">{{ $project->title }}</span></h1>
                    <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 bg-gray-700 rounded-md text-white hover:bg-gray-600 transition">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Projects
                    </a>
                </div>

                @if ($errors->any())
                    <div class="mb-4 bg-red-500/20 text-red-400 p-4 rounded-md">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.projects.update', $project->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Title</label>
                        <input id="title" class="block mt-1 w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-teal-500 focus:border-teal-500 @error('title') border-red-500 @enderror" type="text" name="title" value="{{ old('title', $project->title) }}" required autofocus />
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                        <textarea id="description" name="description" rows="4" class="block mt-1 w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-teal-500 focus:border-teal-500 @error('description') border-red-500 @enderror" required>{{ old('description', $project->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-300 mb-1">Category</label>
                            <select id="category" name="category" class="block mt-1 w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-teal-500 focus:border-teal-500 @error('category') border-red-500 @enderror" required>
                                <option value="">Select Category</option>
                                <option value="web" {{ old('category', $project->category) == 'web' ? 'selected' : '' }}>Web Development</option>
                                <option value="branding" {{ old('category', $project->category) == 'branding' ? 'selected' : '' }}>Branding</option>
                                <option value="design" {{ old('category', $project->category) == 'design' ? 'selected' : '' }}>Graphic Design</option>
                                <option value="production" {{ old('category', $project->category) == 'production' ? 'selected' : '' }}>Production</option>
                            </select>
                        </div>
                        <div id="technologies-container">
                            <label for="technologies" class="block text-sm font-medium text-gray-300 mb-1">Technologies (comma-separated)</label>
                            <input id="technologies" class="block mt-1 w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-teal-500 focus:border-teal-500 @error('technologies') border-red-500 @enderror" type="text" name="technologies" value="{{ old('technologies', implode(', ', $project->technologies_array ?? [])) }}" placeholder="Laravel, Tailwind CSS, Vue.js, MySQL" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div id="status-container">
                            <label for="status" class="block text-sm font-medium text-gray-300 mb-1">Status</label>
                            <select id="status" name="status" class="block mt-1 w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-teal-500 focus:border-teal-500 @error('status') border-red-500 @enderror">
                                <option value="">Select Status</option>
                                <option value="online" {{ old('status', $project->status) == 'online' ? 'selected' : '' }}>Online</option>
                                <option value="offline" {{ old('status', $project->status) == 'offline' ? 'selected' : '' }}>Offline</option>
                                <option value="template" {{ old('status', $project->status) == 'template' ? 'selected' : '' }}>Template</option>
                            </select>
                        </div>

                        <div class="url-field" style="display: {{ old('category', $project->category) === 'web' && old('status', $project->status) === 'online' ? 'block' : 'none' }};">
                            <label for="url" class="block text-sm font-medium text-gray-300 mb-1">Website URL (Optional if Online)</label>
                            <input id="url" class="block mt-1 w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-teal-500 focus:border-teal-500 @error('url') border-red-500 @enderror" type="url" name="url" value="{{ old('url', $project->url) }}" placeholder="https://example.com" />
                        </div>
                    </div>

                    @if($project->thumbnail)
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-300 mb-1">Current Thumbnail</label>
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="h-32 w-auto border border-gray-700 rounded-md">
                            </div>
                        </div>
                    @endif

                    <div class="mb-4">
                        <label for="thumbnail" class="block text-sm font-medium text-gray-300 mb-1">New Thumbnail Image (optional)</label>
                        <input id="thumbnail" type="file" name="thumbnail" class="block w-full text-sm text-gray-400 bg-gray-700 border-gray-600 rounded-md file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-teal-500 file:text-white hover:file:bg-teal-600 @error('thumbnail') border-red-500 @enderror" accept="image/*" />
                    </div>

                    @if($project->screenshots_array && count($project->screenshots_array) > 0)
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-300 mb-1">Current Screenshots</label>
                            <div class="mt-2 grid grid-cols-2 md:grid-cols-4 gap-4">
                                @foreach($project->screenshots_array as $index => $screenshot)
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $screenshot) }}" alt="Screenshot {{ $index + 1 }}" class="h-24 w-full object-cover border border-gray-700 rounded-md">
                                        <div class="mt-1">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox" name="delete_screenshots[]" value="{{ $index }}" class="rounded border-gray-600 bg-gray-700 text-teal-600 shadow-sm focus:ring-teal-500 focus:ring-offset-gray-800">
                                                <span class="ml-2 text-sm text-gray-400">Remove</span>
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="mb-6">
                        <label for="screenshots" class="block text-sm font-medium text-gray-300 mb-1">Add Project Screenshots (optional)</label>
                        <input id="screenshots" type="file" name="screenshots[]" multiple class="block w-full text-sm text-gray-400 bg-gray-700 border-gray-600 rounded-md file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-teal-500 file:text-white hover:file:bg-teal-600 @error('screenshots.*') border-red-500 @enderror" accept="image/*" />
                        <p class="mt-1 text-xs text-gray-400">You can select multiple screenshots to add to the project.</p>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.projects.index') }}" class="mr-4 px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-500 transition">
                            Cancel
                        </a>
                        <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 dark:focus:ring-offset-gray-800 transition">
                            Update Project
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category');
        const technologiesContainer = document.getElementById('technologies-container');
        const technologiesInput = document.getElementById('technologies');
        const statusContainer = document.getElementById('status-container');
        const statusInput = document.getElementById('status');
        const urlContainer = document.querySelector('.url-field');
        const urlInput = document.getElementById('url');

        function toggleProjectFields() {
            const selectedCategory = categorySelect.value;

            if (selectedCategory === 'web') {
                if (technologiesContainer) technologiesContainer.style.display = 'block';
                if (technologiesInput) technologiesInput.setAttribute('required', 'required');

                if (statusContainer) statusContainer.style.display = 'block';
                if (statusInput) statusInput.setAttribute('required', 'required');

                if (urlContainer) {
                    if (statusInput && statusInput.value === 'online') {
                        urlContainer.style.display = 'block';
                    } else {
                        urlContainer.style.display = 'none';
                    }
                }
            } else { // Non-web categories
                if (technologiesContainer) technologiesContainer.style.display = 'none';
                if (technologiesInput) technologiesInput.removeAttribute('required');

                if (statusContainer) statusContainer.style.display = 'none';
                if (statusInput) statusInput.removeAttribute('required');
                
                if (urlContainer) urlContainer.style.display = 'none';
                if (urlInput) urlInput.removeAttribute('required');
            }
        }

        if (categorySelect) {
            categorySelect.addEventListener('change', toggleProjectFields);
             if (statusInput) { // Ensure statusInput exists
                statusInput.addEventListener('change', toggleProjectFields);
            }
            toggleProjectFields(); // Initial call
        }
    });
</script>
@endpush
@endsection