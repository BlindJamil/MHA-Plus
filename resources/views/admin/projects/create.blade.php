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
                        Back to Projects
                    </a>
                </div>

                <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Project Title</label>
                            <input 
                                type="text" 
                                name="title" 
                                id="title" 
                                class="w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-teal-500 focus:border-teal-500" 
                                value="{{ old('title') }}" 
                                required
                            >
                            @error('title')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Category -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-300 mb-1">Category</label>
                            <select 
                                name="category" 
                                id="category" 
                                class="w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-teal-500 focus:border-teal-500"
                                required
                            >
                                <option value="">Select Category</option>
                                <option value="web" {{ old('category') == 'web' ? 'selected' : '' }}>Web Development</option>
                                <option value="branding" {{ old('category') == 'branding' ? 'selected' : '' }}>Branding</option>
                                <option value="design" {{ old('category') == 'design' ? 'selected' : '' }}>Graphic Design</option>
                                <option value="production" {{ old('category') == 'production' ? 'selected' : '' }}>Production</option>
                            </select>
                            @error('category')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                        <textarea 
                            name="description" 
                            id="description" 
                            rows="4" 
                            class="w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-teal-500 focus:border-teal-500"
                            required
                        >{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Technologies -->
                        <div>
                            <label for="technologies" class="block text-sm font-medium text-gray-300 mb-1">Technologies (comma-separated)</label>
                            <input 
                                type="text" 
                                name="technologies" 
                                id="technologies" 
                                class="w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-teal-500 focus:border-teal-500" 
                                value="{{ old('technologies') }}" 
                                placeholder="Laravel, Tailwind CSS, Alpine.js, MySQL"
                                required
                            >
                            @error('technologies')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-300 mb-1">Status</label>
                            <select 
                                name="status" 
                                id="status" 
                                class="w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-teal-500 focus:border-teal-500"
                                required
                            >
                                <option value="">Select Status</option>
                                <option value="online" {{ old('status') == 'online' ? 'selected' : '' }}>Online</option>
                                <option value="offline" {{ old('status') == 'offline' ? 'selected' : '' }}>Offline</option>
                                <option value="template" {{ old('status') == 'template' ? 'selected' : '' }}>Template</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- URL (conditional) -->
                    <div class="mb-6 url-field" style="display: none;">
                        <label for="url" class="block text-sm font-medium text-gray-300 mb-1">Website URL</label>
                        <input 
                            type="url" 
                            name="url" 
                            id="url" 
                            class="w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-teal-500 focus:border-teal-500" 
                            value="{{ old('url') }}" 
                            placeholder="https://example.com"
                        >
                        @error('url')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Thumbnail -->
                        <div>
                            <label for="thumbnail" class="block text-sm font-medium text-gray-300 mb-1">Thumbnail Image</label>
                            <input 
                                type="file" 
                                name="thumbnail" 
                                id="thumbnail" 
                                class="w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-teal-500 focus:border-teal-500 p-2"
                                accept="image/*"
                                required
                            >
                            <p class="mt-1 text-sm text-gray-400">This will be the main image shown in the portfolio grid.</p>
                            @error('thumbnail')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Screenshots -->
                        <div>
                            <label for="screenshots" class="block text-sm font-medium text-gray-300 mb-1">Project Screenshots</label>
                            <input 
                                type="file" 
                                name="screenshots[]" 
                                id="screenshots" 
                                class="w-full bg-gray-700 border-gray-600 rounded-md shadow-sm text-white focus:ring-teal-500 focus:border-teal-500 p-2"
                                accept="image/*"
                                multiple
                            >
                            <p class="mt-1 text-sm text-gray-400">You can select multiple screenshots to showcase the project.</p>
                            @error('screenshots.*')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
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
        const statusSelect = document.getElementById('status');
        const urlField = document.querySelector('.url-field');
        
        // Check initial value
        toggleUrlField();
        
        // Add change event listener
        statusSelect.addEventListener('change', toggleUrlField);
        
        function toggleUrlField() {
            if (statusSelect.value === 'online') {
                urlField.style.display = 'block';
                document.getElementById('url').setAttribute('required', 'required');
            } else {
                urlField.style.display = 'none';
                document.getElementById('url').removeAttribute('required');
            }
        }
    });
</script>
@endpush
@endsection