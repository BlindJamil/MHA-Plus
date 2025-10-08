@extends('layouts.app')

@section('title', $project->title . ' - MHA Plus Portfolio')

@section('content')
<div class="container mx-auto px-4 py-12">
    <a href="{{ route('home') }}#portfolio" class="inline-flex items-center text-gray-600 hover:text-red-600 mb-8 font-medium">
        <i class="fas fa-arrow-left mr-2"></i> Back to Portfolio
    </a>
    
    <div class="bg-white rounded-lg overflow-hidden shadow-lg border border-gray-200">
        <div class="p-6 md:p-8 border-b border-gray-200">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 md:mb-0">{{ $project->title }}</h1>
                
                <div class="flex space-x-3">
                    {{-- Only show status badge for web projects --}}
                    @if($project->category === 'web')
                        @if($project->is_online)
                            <span class="bg-green-50 text-green-600 px-3 py-1 rounded-full text-sm border border-green-200 font-medium">
                                Online
                            </span>
                        @elseif($project->is_offline)
                            <span class="bg-amber-50 text-amber-600 px-3 py-1 rounded-full text-sm border border-amber-200 font-medium">
                                Offline
                            </span>
                        @else {{-- Template --}}
                            <span class="bg-purple-50 text-purple-600 px-3 py-1 rounded-full text-sm border border-purple-200 font-medium">
                                Template
                            </span>
                        @endif
                    @endif
                    {{-- End status badge --}}
                    
                    <span class="bg-red-50 text-red-600 px-3 py-1 rounded-full text-sm border border-red-200 font-medium">
                        {{ ucfirst($project->category) }}
                    </span>
                </div>
            </div>
        </div>
        
        <div class="p-6 md:p-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2">
                    <h2 class="text-xl text-gray-900 font-semibold mb-4">Project Screenshots</h2>
                    
                    @if($project->screenshots_array && count($project->screenshots_array) > 0)
                        <div class="mb-4">
                            <img 
                                src="{{ asset('uploads/' . $project->screenshots_array[0]) }}" 
                                alt="{{ $project->title }} screenshot" 
                                class="w-full rounded-lg shadow-lg"
                                id="main-screenshot"
                            >
                        </div>
                        
                        @if(count($project->screenshots_array) > 1)
                            <div class="grid grid-cols-4 md:grid-cols-6 gap-2">
                                @foreach($project->screenshots_array as $index => $screenshot)
                                    <div 
                                        class="aspect-video rounded-md overflow-hidden cursor-pointer screenshot-thumbnail {{ $index === 0 ? 'ring-2 ring-red-600' : '' }}" 
                                        data-src="{{ asset('uploads/' . $screenshot) }}"
                                        data-index="{{ $index }}"
                                    >
                                        <img 
                                            src="{{ asset('uploads/' . $screenshot) }}" 
                                            alt="{{ $project->title }} screenshot {{ $index + 1 }}" 
                                            class="w-full h-full object-cover"
                                        >
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="flex items-center justify-center h-64 bg-gray-100 rounded-lg border border-gray-200">
                            <p class="text-gray-500">No screenshots available</p>
                        </div>
                    @endif
                </div>
                
                <div class="lg:col-span-1">
                    <div class="space-y-8">
                        <div>
                            <h2 class="text-xl text-gray-900 font-semibold mb-2">Project Description</h2>
                            <p class="text-gray-600">{{ $project->description }}</p>
                        </div>
                        
                        @if($project->technologies_array && count($project->technologies_array) > 0)
                        <div>
                            <h2 class="text-xl text-gray-900 font-semibold mb-2">Technologies Used</h2>
                            <div class="flex flex-wrap gap-2">
                                @foreach($project->technologies_array as $tech)
                                    <span class="bg-red-50 text-red-600 px-3 py-1 rounded-full text-sm border border-red-200">
                                        {{ $tech }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                        {{-- Only show detailed status/link for web projects --}}
                        @if($project->category === 'web')
                            <div>
                                <h2 class="text-xl text-gray-900 font-semibold mb-2">Project Status</h2>
                                <div class="flex flex-col space-y-4">
                                    @if($project->is_online)
                                        <div class="flex items-center">
                                            <span class="w-3 h-3 bg-green-500 rounded-full mr-2 flex-shrink-0"></span>
                                            <span class="text-gray-600">This project is currently online</span>
                                        </div>
                                        
                                        @if($project->url)
                                            <a 
                                                href="{{ $project->url }}" 
                                                target="_blank" 
                                                class="bg-gradient-to-r from-red-600 to-red-900 hover:opacity-90 text-white px-4 py-2 rounded-md inline-flex items-center justify-center transition-opacity self-start shadow-lg"
                                            >
                                                <i class="fas fa-external-link-alt mr-2"></i>
                                                Visit Website
                                            </a>
                                        @endif
                                    @elseif($project->is_offline)
                                        <div class="flex items-center">
                                            <span class="w-3 h-3 bg-amber-500 rounded-full mr-2 flex-shrink-0"></span>
                                            <span class="text-gray-600">This project is no longer online</span>
                                        </div>
                                    @else {{-- Template --}}
                                        <div class="flex items-center">
                                            <span class="w-3 h-3 bg-purple-500 rounded-full mr-2 flex-shrink-0"></span>
                                            <span class="text-gray-600">This is a template/concept project</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                        {{-- End status section --}}
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
        
        if(mainScreenshot && thumbnails.length > 0) { // Check if elements exist
            thumbnails.forEach(function(thumbnail) {
                thumbnail.addEventListener('click', function() {
                    // Update main image src
                    mainScreenshot.src = this.dataset.src;
                    
                    // Remove highlight from all thumbnails
                thumbnails.forEach(function(thumb) {
                    thumb.classList.remove('ring-2', 'ring-red-600');
                });                                    // Highlight clicked thumbnail
                this.classList.add('ring-2', 'ring-red-600');
                });
            });
        }
    });
</script>
@endpush
@endsection