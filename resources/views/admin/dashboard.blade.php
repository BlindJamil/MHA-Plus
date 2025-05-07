@extends('layouts.admin')

@section('title', 'Admin Dashboard') {{-- Or however your layouts.admin.blade.php handles the title --}}

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-300"> {{-- Changed text-gray-900 dark:text-gray-100 to text-gray-300 to match admin theme --}}
                <h3 class="text-xl font-bold mb-4 text-white">Welcome to MHA Plus Admin</h3>
                
                <p class="mb-6 text-gray-400">From here you can manage all aspects of your website.</p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-gray-700 p-6 rounded-lg shadow"> {{-- Adjusted background for dark theme --}}
                        <h4 class="text-lg font-semibold mb-2 text-white">Project Management</h4>
                        <p class="text-gray-300 mb-4">Manage your portfolio projects</p>
                        <a href="{{ route('admin.projects.index') }}" class="inline-flex items-center px-4 py-2 bg-teal-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 active:bg-teal-700 focus:outline-none focus:ring ring-teal-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Manage Projects
                        </a>
                    </div>
                    
                    <div class="bg-gray-700 p-6 rounded-lg shadow"> {{-- Adjusted background for dark theme --}}
                        <h4 class="text-lg font-semibold mb-2 text-white">View Website</h4>
                        <p class="text-gray-300 mb-4">See your live website</p>
                        <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-700 focus:outline-none focus:ring ring-green-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Visit Website
                        </a>
                    </div>

                    {{-- You might want a card for Profile Management too --}}
                    {{-- <div class="bg-gray-700 p-6 rounded-lg shadow">
                        <h4 class="text-lg font-semibold mb-2 text-white">User Profile</h4>
                        <p class="text-gray-300 mb-4">Manage your admin profile</p>
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-700 focus:outline-none focus:ring ring-purple-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Edit Profile
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection