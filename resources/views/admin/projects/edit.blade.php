<!-- resources/views/admin/projects/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Project') }}: {{ $project->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.projects.update', $project->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- Title -->
                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $project->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        
                        <!-- Description -->
                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>{{ old('description', $project->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        
                        <!-- Category -->
                        <div class="mb-4">
                            <x-input-label for="category" :value="__('Category')" />
                            <select id="category" name="category" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="">Select Category</option>
                                <option value="web" {{ old('category', $project->category) == 'web' ? 'selected' : '' }}>Web Development</option>
                                <option value="branding" {{ old('category', $project->category) == 'branding' ? 'selected' : '' }}>Branding</option>
                                <option value="design" {{ old('category', $project->category) == 'design' ? 'selected' : '' }}>Graphic Design</option>
                                <option value="production" {{ old('category', $project->category) == 'production' ? 'selected' : '' }}>Production</option>
                            </select>
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>
                        
                        <!-- Technologies -->
                        <div class="mb-4">
                            <x-input-label for="technologies" :value="__('Technologies (comma-separated)')" />
                            <x-text-input id="technologies" class="block mt-1 w-full" type="text" name="technologies" :value="old('technologies', implode(', ', $project->technologies_array))" placeholder="Laravel, Tailwind CSS, Vue.js, MySQL" required />
                            <x-input-error :messages="$errors->get('technologies')" class="mt-2" />
                        </div>
                        
                        <!-- Status -->
                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                <option value="">Select Status</option>
                                <option value="online" {{ old('status', $project->status) == 'online' ? 'selected' : '' }}>Online</option>
                                <option value="offline" {{ old('status', $project->status) == 'offline' ? 'selected' : '' }}>Offline</option>
                                <option value="template" {{ old('status', $project->status) == 'template' ? 'selected' : '' }}>Template</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                        
                        <!-- URL (for online projects) -->
                        <div class="mb-4" id="url-field">
                            <x-input-label for="url" :value="__('URL (for online projects)')" />
                            <x-text-input id="url" class="block mt-1 w-full" type="url" name="url" :value="old('url', $project->url)" placeholder="https://example.com" />
                            <x-input-error :messages="$errors->get('url')" class="mt-2" />
                        </div>
                        
                        <!-- Current Thumbnail -->
                        @if($project->thumbnail)
                            <div class="mb-4">
                                <x-input-label :value="__('Current Thumbnail')" />
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="h-32 w-auto border dark:border-gray-700 rounded-md">
                                </div>
                            </div>
                        @endif
                        
                        <!-- Thumbnail -->
                        <div class="mb-4">
                            <x-input-label for="thumbnail" :value="__('New Thumbnail Image (optional)')" />
                            <input id="thumbnail" type="file" name="thumbnail" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" accept="image/*" />
                            <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                        </div>
                        
                        <!-- Current Screenshots -->
                        @if(count($project->screenshots_array) > 0)
                            <div class="mb-4">
                                <x-input-label :value="__('Current Screenshots')" />
                                <div class="mt-2 grid grid-cols-2 md:grid-cols-4 gap-4">
                                    @foreach($project->screenshots_array as $index => $screenshot)
                                        <div class="relative">
                                            <img src="{{ asset('storage/' . $screenshot) }}" alt="Screenshot {{ $index + 1 }}" class="h-24 w-auto border dark:border-gray-700 rounded-md">
                                            <div class="mt-1">
                                                <label class="inline-flex items-center">
                                                    <input type="checkbox" name="delete_screenshots[]" value="{{ $index }}" class="rounded border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Remove</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        <!-- New Screenshots -->
                        <div class="mb-4">
                            <x-input-label for="screenshots" :value="__('Add Project Screenshots (optional)')" />
                            <input id="screenshots" type="file" name="screenshots[]" multiple class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" accept="image/*" />
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">You can select multiple screenshots to add to the project.</p>
                            <x-input-error :messages="$errors->get('screenshots')" class="mt-2" />
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.projects.index') }}" class="mr-3 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Cancel
                            </a>
                            <x-primary-button>
                                {{ __('Update Project') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Show/hide URL field based on status
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('status');
            const urlField = document.getElementById('url-field');
            
            function toggleUrlField() {
                if (statusSelect.value === 'online') {
                    urlField.style.display = 'block';
                } else {
                    urlField.style.display = 'none';
                }
            }
            
            // Run on initial load
            toggleUrlField();
            
            // Add event listener for changes
            statusSelect.addEventListener('change', toggleUrlField);
        });
    </script>
</x-app-layout>