<!-- resources/views/dashboard.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-bold mb-4">Welcome to MHA Plus Admin</h3>
                    
                    <p class="mb-6">From here you can manage all aspects of your website.</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Project Management Card -->
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow">
                            <h4 class="text-lg font-semibold mb-2">Project Management</h4>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">Manage your portfolio projects</p>
                            <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Manage Projects
                            </a>
                        </div>
                        
                        <!-- View Website Card -->
                        <div class="bg-gray-100 dark:bg-gray-700 p-6 rounded-lg shadow">
                            <h4 class="text-lg font-semibold mb-2">View Website</h4>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">See your live website</p>
                            <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-700 focus:outline-none focus:ring transition ease-in-out duration-150">
                                Visit Website
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>