{{-- resources/views/portfolio/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Our Portfolio - MHA Plus')

@section('content')
<section id="portfolio-page" class="py-20 bg-gray-50 pt-32">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold mb-4 gradient-text inline-block">Our Portfolio</h2>
            <div class="h-1 w-24 bg-gradient-to-r from-red-600 to-red-900 mx-auto"></div>
            <p class="text-gray-600 mt-6 max-w-2xl mx-auto">Browse through our collection of projects. Use the filters to find what you're looking for.</p>
            <div class="mt-8">
                <a href="{{ route('home') }}#home" class="text-red-600 hover:text-red-700 transition-colors font-medium">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Home
                </a>
            </div>
        </div>

        <div class="flex flex-wrap justify-center gap-4 mb-10" data-aos="fade-up">
            <button class="portfolio-filter active px-6 py-2 rounded-md bg-white border-2 border-red-600 text-red-600 transition-colors shadow-sm" data-filter="all">All Projects</button>
            <button class="portfolio-filter px-6 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:border-red-600 hover:text-red-600 transition-colors shadow-sm" data-filter="web">Web Development</button>
            <button class="portfolio-filter px-6 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:border-red-600 hover:text-red-600 transition-colors shadow-sm" data-filter="branding">Branding</button>
            <button class="portfolio-filter px-6 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:border-red-600 hover:text-red-600 transition-colors shadow-sm" data-filter="design">Graphic Design</button>
            <button class="portfolio-filter px-6 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:border-red-600 hover:text-red-600 transition-colors shadow-sm" data-filter="production">Production</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="portfolio-grid">
            @forelse($projects as $project)
                <div class="portfolio-item {{ $project->category }}" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                    <div class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-shadow bg-white">
                        @if($project->thumbnail)
                            <a href="{{ asset('uploads/' . $project->thumbnail) }}" data-lightbox="portfolio-page-{{ $project->id }}" data-title="{{ $project->title }}">
                                <img src="{{ asset('uploads/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                            </a>
                            @if($project->screenshots_array && count($project->screenshots_array) > 0)
                                @foreach($project->screenshots_array as $screenshotPath)
                                    <a href="{{ asset('uploads/' . $screenshotPath) }}" data-lightbox="portfolio-page-{{ $project->id }}" data-title="{{ $project->title }} - Screenshot" class="hidden"></a>
                                @endforeach
                            @endif
                        @else
                            <div class="w-full h-64 bg-gray-100 flex items-center justify-center">
                                <i class="fas fa-image text-gray-400 text-4xl"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/70 to-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6 backdrop-blur-[2px]">
                            @if($project->category === 'web')
                                @if($project->is_online)
                                    <div class="absolute top-4 right-4 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-medium shadow-lg">Online</div>
                                @elseif($project->is_offline)
                                    <div class="absolute top-4 right-4 bg-amber-500 text-white px-3 py-1 rounded-full text-xs font-medium shadow-lg">Offline</div>
                                @else
                                    <div class="absolute top-4 right-4 bg-purple-500 text-white px-3 py-1 rounded-full text-xs font-medium shadow-lg">Template</div>
                                @endif
                            @endif
                            <h3 class="text-xl font-semibold text-white mb-1">{{ $project->title }}</h3>
                            <p class="text-gray-200 mb-3 text-sm">{{ Str::limit($project->description, 80) }}</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                @if($project->technologies_array && count($project->technologies_array) > 0)
                                    @foreach($project->technologies_array as $tech)
                                        <span class="text-xs px-3 py-1 bg-red-600/80 text-white rounded-full">{{ $tech }}</span>
                                    @endforeach
                                @endif
                            </div>
                            <div class="flex space-x-3">
                                <a href="{{ route('projects.show', $project->id) }}" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors text-sm shadow-md">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                 <p class="text-center col-span-full text-gray-600">No projects found matching your criteria.</p>
            @endforelse
        </div>

        <div class="mt-16">
            {{ $projects->links('vendor.pagination.custom-tailwind') }}
        </div>
    </div>
</section>



@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (typeof AOS !== 'undefined' && !document.body.classList.contains('aos-initialized')) {
        AOS.init({
            duration: 800,
            once: true
        });
    }

    if (typeof lightbox !== 'undefined') {
        lightbox.option({
           'resizeDuration': 200,
           'wrapAround': true
        });
    }

    const filterButtonsPortfolioPage = document.querySelectorAll('#portfolio-page .portfolio-filter');
    const portfolioItemsPortfolioPage = document.querySelectorAll('#portfolio-page .portfolio-item');

    if (filterButtonsPortfolioPage.length > 0 && portfolioItemsPortfolioPage.length > 0) {
        filterButtonsPortfolioPage.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active state from all buttons
                filterButtonsPortfolioPage.forEach(btn => {
                    btn.classList.remove('active', 'border-red-600', 'text-red-600', 'text-white', 'bg-red-600', 'border-2');
                    btn.classList.add('border', 'border-gray-300', 'text-gray-700', 'bg-white');
                });

                // Add active state to clicked button
                button.classList.add('active', 'border-red-600', 'text-red-600', 'bg-white', 'border-2');
                button.classList.remove('border', 'border-gray-300', 'text-gray-700');

                const filter = button.getAttribute('data-filter');

                portfolioItemsPortfolioPage.forEach(item => {
                    if (filter === 'all' || item.classList.contains(filter)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
                 if (typeof AOS !== 'undefined') {
                    AOS.refresh();
                }
            });
        });
    }
});
</script>
@endpush

@endsection