{{-- resources/views/admin/projects/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Add New Project - Admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-white">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-semibold text-white">Add New Project</h1>
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

                <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Project Title</label>
                            <input
                                type="text"
                                name="title"
                                id="title"
                                class="w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-teal-500 focus:border-teal-500 @error('title') border-red-500 @enderror"
                                value="{{ old('title') }}"
                                required
                            >
                        </div>

                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-300 mb-1">Category</label>
                            <select
                                name="category"
                                id="category"
                                class="w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-teal-500 focus:border-teal-500 @error('category') border-red-500 @enderror"
                                required
                            >
                                <option value="">Select Category</option>
                                <option value="web" {{ old('category') == 'web' ? 'selected' : '' }}>Web Development</option>
                                <option value="branding" {{ old('category') == 'branding' ? 'selected' : '' }}>Branding</option>
                                <option value="design" {{ old('category') == 'design' ? 'selected' : '' }}>Graphic Design</option>
                                <option value="production" {{ old('category') == 'production' ? 'selected' : '' }}>Production</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            class="w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-teal-500 focus:border-teal-500 @error('description') border-red-500 @enderror"
                            required
                        >{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div id="technologies-container">
                            <label for="technologies" class="block text-sm font-medium text-gray-300 mb-1">Technologies (comma-separated)</label>
                            <input
                                type="text"
                                name="technologies"
                                id="technologies"
                                class="w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-teal-500 focus:border-teal-500 @error('technologies') border-red-500 @enderror"
                                value="{{ old('technologies') }}"
                                placeholder="Laravel, Tailwind CSS, Alpine.js, MySQL"
                            >
                        </div>

                        <div id="status-container">
                            <label for="status" class="block text-sm font-medium text-gray-300 mb-1">Status</label>
                            <select
                                name="status"
                                id="status"
                                class="w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-teal-500 focus:border-teal-500 @error('status') border-red-500 @enderror"
                            >
                                <option value="">Select Status</option>
                                <option value="online" {{ old('status') == 'online' ? 'selected' : '' }}>Online</option>
                                <option value="offline" {{ old('status') == 'offline' ? 'selected' : '' }}>Offline</option>
                                <option value="template" {{ old('status') == 'template' ? 'selected' : '' }}>Template</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-6 url-field" style="display: {{ old('category') === 'web' && old('status') === 'online' ? 'block' : 'none' }};">
                        <label for="url" class="block text-sm font-medium text-gray-300 mb-1">Website URL (Optional if Online)</label>
                        <input
                            type="url"
                            name="url"
                            id="url"
                            class="w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-teal-500 focus:border-teal-500 @error('url') border-red-500 @enderror"
                            value="{{ old('url') }}"
                            placeholder="https://example.com"
                        >
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="thumbnail" class="block text-sm font-medium text-gray-300 mb-1">Thumbnail Image</label>
                            <input
                                type="file"
                                name="thumbnail"
                                id="thumbnail"
                                class="block w-full text-sm text-gray-400 bg-gray-700 border-gray-600 rounded-md file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-teal-500 file:text-white hover:file:bg-teal-600 @error('thumbnail') border-red-500 @enderror"
                                accept="image/*"
                                required
                            >
                            <p class="mt-1 text-xs text-gray-400">This will be the main image shown in the portfolio grid.</p>
                        </div>

                        <div>
                            <label for="screenshots" class="block text-sm font-medium text-gray-300 mb-1">Project Screenshots (Optional)</label>
                            <input
                                type="file"
                                name="screenshots[]"
                                id="screenshots"
                                class="block w-full text-sm text-gray-400 bg-gray-700 border-gray-600 rounded-md file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-teal-500 file:text-white hover:file:bg-teal-600 @error('screenshots.*') border-red-500 @enderror"
                                accept="image/*"
                                multiple
                            >
                            <p class="mt-1 text-xs text-gray-400">You can select multiple screenshots to showcase the project.</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button
                            type="submit"
                            class="px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition"
                        >
                            Add Project
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
                
                // URL field visibility based on status for 'web' category
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
            if (statusInput) { // Ensure statusInput exists before adding listener
                 statusInput.addEventListener('change', toggleProjectFields); // Also trigger on status change for URL field logic
            }
            toggleProjectFields(); // Initial call to set visibility based on current/old values
        }
    });
</script>
@endpush
@endsection