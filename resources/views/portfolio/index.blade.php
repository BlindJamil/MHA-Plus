{{-- resources/views/portfolio/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Our Portfolio - MHA Plus')

@section('content')
<section id="portfolio-page" class="py-20 bg-gray-900 pt-32">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold mb-4 gradient-text inline-block">Our Portfolio</h2>
            <div class="h-1 w-24 bg-gradient-to-r from-teal-500 to-blue-600 mx-auto"></div>
            <p class="text-gray-400 mt-6 max-w-2xl mx-auto">Browse through our collection of projects. Use the filters to find what you're looking for.</p>
            <div class="mt-8">
                <a href="{{ route('home') }}#home" class="text-teal-400 hover:text-teal-300 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Home
                </a>
            </div>
        </div>

        <div class="flex flex-wrap justify-center gap-4 mb-10" data-aos="fade-up">
            <button class="portfolio-filter active px-6 py-2 rounded-md bg-gray-800 border border-teal-500 text-white hover:bg-teal-500/10 transition-colors" data-filter="all">All Projects</button>
            <button class="portfolio-filter px-6 py-2 rounded-md bg-gray-800 border border-gray-700 text-gray-300 hover:border-teal-500 hover:text-white transition-colors" data-filter="web">Web Development</button>
            <button class="portfolio-filter px-6 py-2 rounded-md bg-gray-800 border border-gray-700 text-gray-300 hover:border-teal-500 hover:text-white transition-colors" data-filter="branding">Branding</button>
            <button class="portfolio-filter px-6 py-2 rounded-md bg-gray-800 border border-gray-700 text-gray-300 hover:border-teal-500 hover:text-white transition-colors" data-filter="design">Graphic Design</button>
            <button class="portfolio-filter px-6 py-2 rounded-md bg-gray-800 border border-gray-700 text-gray-300 hover:border-teal-500 hover:text-white transition-colors" data-filter="production">Production</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="portfolio-grid">
            @forelse($projects as $project)
                <div class="portfolio-item {{ $project->category }}" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                    <div class="group relative overflow-hidden rounded-lg shadow-lg bg-gray-800">
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
                            <div class="w-full h-64 bg-gray-700 flex items-center justify-center">
                                <i class="fas fa-image text-gray-500 text-4xl"></i>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-800 via-gray-800/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                            @if($project->category === 'web')
                                @if($project->is_online)
                                    <div class="absolute top-4 right-4 bg-green-500/90 text-white px-2 py-1 rounded text-xs">Online</div>
                                @elseif($project->is_offline)
                                    <div class="absolute top-4 right-4 bg-amber-500/90 text-white px-2 py-1 rounded text-xs">Offline</div>
                                @else
                                    <div class="absolute top-4 right-4 bg-purple-500/90 text-white px-2 py-1 rounded text-xs">Template</div>
                                @endif
                            @endif
                            <h3 class="text-xl font-semibold text-white mb-1">{{ $project->title }}</h3>
                            <p class="text-gray-300 mb-3 text-sm">{{ Str::limit($project->description, 80) }}</p>
                            <div class="flex flex-wrap gap-2 mb-4">
                                @if($project->technologies_array && count($project->technologies_array) > 0)
                                    @foreach($project->technologies_array as $tech)
                                        <span class="text-xs px-3 py-1 bg-teal-500/20 text-teal-400 rounded-full">{{ $tech }}</span>
                                    @endforeach
                                @endif
                            </div>
                            <div class="flex space-x-3">
                                <a href="{{ route('projects.show', $project->id) }}" class="px-4 py-2 bg-teal-500/20 text-teal-400 rounded-md hover:bg-teal-500/30 transition-colors text-sm">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                 <p class="text-center col-span-full text-gray-400">No projects found matching your criteria.</p>
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
                filterButtonsPortfolioPage.forEach(btn => {
                    btn.classList.remove('active', 'border-teal-500', 'text-white', 'bg-teal-500/10');
                    btn.classList.add('border-gray-700', 'text-gray-300', 'bg-gray-800');
                });

                button.classList.add('active', 'border-teal-500', 'text-white', 'bg-teal-500/10');
                button.classList.remove('border-gray-700', 'text-gray-300', 'bg-gray-800');

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