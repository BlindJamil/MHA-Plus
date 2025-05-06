@extends('layouts.app')

@section('title', $project->title . ' - MHA Plus Portfolio')

@section('content')
<div class="container mx-auto px-4 py-12">
    <!-- Back Button -->
    <a href="{{ route('home') }}" class="inline-flex items-center text-gray-400 hover:text-teal-500 mb-8">
        <i class="fas fa-arrow-left mr-2"></i> Back to Portfolio
    </a>
    
    <div class="bg-gray-800 rounded-lg overflow-hidden shadow-lg">
        <!-- Project Header -->
        <div class="p-6 md:p-8 border-b border-gray-700">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 md:mb-0">{{ $project->title }}</h1>
                
                <div class="flex space-x-3">
                    @if($project->is_online)
                        <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-sm">
                            Online
                        </span>
                    @elseif($project->is_offline)
                        <span class="bg-amber-500/20 text-amber-400 px-3 py-1 rounded-full text-sm">
                            Offline
                        </span>
                    @else
                        <span class="bg-purple-500/20 text-purple-400 px-3 py-1 rounded-full text-sm">
                            Template
                        </span>
                    @endif
                    
                    <span class="bg-teal-500/20 text-teal-400 px-3 py-1 rounded-full text-sm">
                        {{ ucfirst($project->category) }}
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="p-6 md:p-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Left Column - Screenshots -->
                <div class="lg:col-span-2">
                    <h2 class="text-xl text-white font-semibold mb-4">Project Screenshots</h2>
                    
                    @if(count($project->screenshots_array) > 0)
                        <!-- Primary Image -->
                        <div class="mb-4">
                            <img 
                                src="{{ asset('storage/' . $project->screenshots_array[0]) }}" 
                                alt="{{ $project->title }} screenshot" 
                                class="w-full rounded-lg shadow-lg"
                                id="main-screenshot"
                            >
                        </div>
                        
                        <!-- Thumbnails -->
                        @if(count($project->screenshots_array) > 1)
                            <div class="grid grid-cols-4 md:grid-cols-6 gap-2">
                                @foreach($project->screenshots_array as $index => $screenshot)
                                    <div 
                                        class="aspect-video rounded-md overflow-hidden cursor-pointer screenshot-thumbnail {{ $index === 0 ? 'ring-2 ring-teal-500' : '' }}" 
                                        data-src="{{ asset('storage/' . $screenshot) }}"
                                        data-index="{{ $index }}"
                                    >
                                        <img 
                                            src="{{ asset('storage/' . $screenshot) }}" 
                                            alt="{{ $project->title }} screenshot {{ $index + 1 }}" 
                                            class="w-full h-full object-cover"
                                        >
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="flex items-center justify-center h-64 bg-gray-900 rounded-lg">
                            <p class="text-gray-500">No screenshots available</p>
                        </div>
                    @endif
                </div>
                
                <!-- Right Column - Details -->
                <div class="lg:col-span-1">
                    <div class="space-y-8">
                        <!-- Description -->
                        <div>
                            <h2 class="text-xl text-white font-semibold mb-2">Project Description</h2>
                            <p class="text-gray-400">{{ $project->description }}</p>
                        </div>
                        
                        <!-- Technologies -->
                        <div>
                            <h2 class="text-xl text-white font-semibold mb-2">Technologies Used</h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach($project->technologies_array as $tech)
                                    <span class="bg-teal-500/10 text-teal-400 px-3 py-1 rounded-full text-sm">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Status & Links -->
                        <div>
                            <h2 class="text-xl text-white font-semibold mb-2">Project Status</h2>
                            <div class="flex flex-col space-y-4">
                                @if($project->is_online)
                                    <div class="flex items-center">
                                        <span class="w-3 h-3 bg-green-500 rounded-full mr-2"></span>
                                        <span class="text-gray-400">This project is currently online</span>
                                    </div>
                                    
                                    @if($project->url)
                                        <a 
                                            href="{{ $project->url }}" 
                                            target="_blank" 
                                            class="bg-teal-500 hover:bg-teal-600 text-white px-4 py-2 rounded-md inline-flex items-center justify-center transition-colors"
                                        >
                                            <i class="fas fa-external-link-alt mr-2"></i>
                                            Visit Website
                                        </a>
                                    @endif
                                @elseif($project->is_offline)
                                    <div class="flex items-center">
                                        <span class="w-3 h-3 bg-amber-500 rounded-full mr-2"></span>
                                        <span class="text-gray-400">This project is no longer online</span>
                                    </div>
                                @else
                                    <div class="flex items-center">
                                        <span class="w-3 h-3 bg-purple-500 rounded-full mr-2"></span>
                                        <span class="text-gray-400">This is a template/concept project</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainScreenshot = document.getElementById('main-screenshot');
        const thumbnails = document.querySelectorAll('.screenshot-thumbnail');
        
        thumbnails.forEach(function(thumbnail) {
            thumbnail.addEventListener('click', function() {
                // Update main image
                mainScreenshot.src = this.dataset.src;
                
                // Remove highlight from all thumbnails
                thumbnails.forEach(function(thumb) {
                    thumb.classList.remove('ring-2', 'ring-teal-500');
                });
                
                // Highlight clicked thumbnail
                this.classList.add('ring-2', 'ring-teal-500');
            });
        });
    });
</script>
@endpush
@endsection