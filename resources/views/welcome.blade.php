@php
    // This is needed for checking validation errors specifically for the newsletter form
    use Illuminate\Support\ViewErrorBag;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MHA Plus - Marketing Solutions in Erbil, Iraq</title>
    <meta name="description" content="MHA Plus offers comprehensive marketing services from printing and branding to social media management and website development in Erbil, Iraq.">

    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .gradient-text {
            background: linear-gradient(90deg, #2b8a98, #0f5e8d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text; /* Standard property */
            color: transparent; /* Fallback */
        }
        .btn-gradient {
            background: linear-gradient(90deg, #2b8a98, #0f5e8d);
        }
        .border-gradient {
            border-image: linear-gradient(to right, #2b8a98, #0f5e8d) 1;
        }
        .hero-gradient {
            background: linear-gradient(to right, rgba(10, 15, 23, 0.9), rgba(17, 24, 39, 0.7)), url('/images/hero-bg.jpg');
            background-size: cover;
            background-position: center;
        }
        .portfolio-item {
            transition: all 0.3s ease;
        }
        .portfolio-item:hover {
            transform: translateY(-10px);
        }
        /* Add smooth scroll behavior */
        html {
             scroll-behavior: smooth;
        }

        /* --- Logo Slider Styles --- */
        .logo-slider {
            overflow: hidden;
            padding: 40px 0; /* Increased padding */
            background: #1f2937; /* bg-gray-800 */
            white-space: nowrap;
            position: relative;
        }

        .logo-slider::before,
        .logo-slider::after {
            /* Fade effect at edges */
            position: absolute;
            top: 0;
            width: 150px; /* Width of the fade */
            height: 100%;
            content: "";
            z-index: 2;
        }

        .logo-slider::before {
            left: 0;
            background: linear-gradient(to left, rgba(31, 41, 55, 0), #1f2937); /* Fade from transparent to bg-gray-800 */
        }

        .logo-slider::after {
            right: 0;
            background: linear-gradient(to right, rgba(31, 41, 55, 0), #1f2937); /* Fade from transparent to bg-gray-800 */
        }

        .logo-slider-track {
            display: inline-block;
            animation: scrollLogos 40s linear infinite; /* Adjust duration for speed (longer = slower) */
        }

        .logo-slider:hover .logo-slider-track {
            animation-play-state: paused; /* Pause animation on hover */
        }

        .logo-slide {
            display: inline-block; /* Changed from inline-flex */
            align-items: center;
            justify-content: center;
            height: 80px; /* Adjust height as needed */
            width: auto; /* Let width be determined by content or specific width below */
            margin: 0 40px; /* Space between logos */
            filter: grayscale(100%);
            opacity: 0.6;
            transition: filter 0.3s ease, opacity 0.3s ease;
        }
        .logo-slide img {
             max-height: 100%; /* Ensure image fits within the height */
             max-width: 150px; /* Max width for logos */
             width: auto; /* Maintain aspect ratio */
             vertical-align: middle; /* Align images vertically */
        }

        .logo-slider:hover .logo-slide {
            filter: grayscale(0%);
            opacity: 1;
        }

        @keyframes scrollLogos {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); } /* Scroll by half the total width (since logos are duplicated) */
        }
        /* --- End Logo Slider Styles --- */


        .fab.fa-twitter:before {
    content: "𝕏";
    font-family: 'Poppins', sans-serif; /* Use the same font as your site */
    font-weight: 600; /* Semi-bold to match other icons */
  }

    </style>
</head>
<body class="bg-gray-900 text-gray-300">
    <header class="fixed w-full z-50 bg-gray-900/80 backdrop-blur-md">
        <nav class="container mx-auto px-6 py-4 flex items-center justify-between">
            <a href="#home" class="flex items-center">
                <img src="/images/logo.png" alt="MHA Plus Logo" class="h-10">
                <span class="ml-3 text-xl font-semibold text-white hidden sm:inline-block">MHA <span class="gradient-text">Plus</span></span>
            </a>
    
            <div class="hidden md:flex items-center space-x-8">
                <a href="#home" class="text-gray-300 hover:text-white transition-colors">Home</a>
                <a href="#about" class="text-gray-300 hover:text-white transition-colors">About</a>
                <a href="#services" class="text-gray-300 hover:text-white transition-colors">Services</a>
                <a href="#portfolio" class="text-gray-300 hover:text-white transition-colors">Portfolio</a>
                <a href="#contact" class="text-gray-300 hover:text-white transition-colors">Contact</a>
            </div>
    
            <div class="md:hidden">
                <button id="menu-toggle" class="text-gray-300 hover:text-white focus:outline-none" aria-label="Toggle mobile menu">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </nav>
        <div class="hidden bg-gray-800 md:hidden py-4 px-6" id="mobile-menu">
            <a href="#home" class="block py-2 text-gray-300 hover:text-white transition-colors">Home</a>
            <a href="#about" class="block py-2 text-gray-300 hover:text-white transition-colors">About</a>
            <a href="#services" class="block py-2 text-gray-300 hover:text-white transition-colors">Services</a>
            <a href="#portfolio" class="block py-2 text-gray-300 hover:text-white transition-colors">Portfolio</a>
            <a href="#contact" class="block py-2 text-gray-300 hover:text-white transition-colors">Contact</a>
        </div>
    </header>

    <section id="home" class="hero-gradient min-h-screen flex items-center pt-20">
        <div class="container mx-auto px-6 py-24">
            <div class="max-w-4xl" data-aos="fade-up" data-aos-delay="100">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 text-white">Your Complete Marketing Solution in <span class="gradient-text">Erbil, Iraq</span></h1>
                <p class="text-xl md:text-2xl mb-8 text-gray-300">We offer comprehensive services from printing and branding to social media management and website development.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#services" class="px-8 py-3 btn-gradient text-white font-medium rounded-md hover:opacity-90 transition-opacity inline-block text-center">Our Services</a>
                    <a href="#portfolio" class="px-8 py-3 border border-gray-600 text-white font-medium rounded-md hover:border-teal-500 transition-colors inline-block text-center">View Portfolio</a>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="py-16 bg-gray-800">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-4xl font-bold mb-4 gradient-text inline-block">About Us</h2>
                <div class="h-1 w-24 bg-gradient-to-r from-teal-500 to-blue-600 mx-auto"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-10">
                <div class="bg-gray-900 p-8 rounded-lg shadow-lg" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 btn-gradient rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-handshake text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Professional Excellence</h3>
                    <p class="text-gray-400">We deliver high-quality marketing solutions tailored to your needs.</p>
                </div>

                <div class="bg-gray-900 p-8 rounded-lg shadow-lg" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 btn-gradient rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-lightbulb text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Creative Approach</h3>
                    <p class="text-gray-400">Our team combines innovation with strategic thinking.</p>
                </div>

                <div class="bg-gray-900 p-8 rounded-lg shadow-lg" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 btn-gradient rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Local Expertise</h3>
                    <p class="text-gray-400">Based in Erbil, we understand the regional market dynamics.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="py-16 bg-gray-900">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-4xl font-bold mb-4 gradient-text inline-block">Our Services</h2>
                <div class="h-1 w-24 bg-gradient-to-r from-teal-500 to-blue-600 mx-auto"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-gray-800 rounded-lg p-6 hover:bg-gray-800/80 transition-all" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-14 h-14 btn-gradient rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-print text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-white">Printing & Branding</h3>
                    <p class="text-gray-400">Event branding, banners, flags, signs, brochures, flyers, and more.</p>
                </div>

                <div class="bg-gray-800 rounded-lg p-6 hover:bg-gray-800/80 transition-all" data-aos="fade-up" data-aos-delay="150">
                    <div class="w-14 h-14 btn-gradient rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-palette text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-white">Graphic Design</h3>
                    <p class="text-gray-400">Logo creation, visual identity, and promotional materials for print and digital.</p>
                </div>

                <div class="bg-gray-800 rounded-lg p-6 hover:bg-gray-800/80 transition-all" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-14 h-14 btn-gradient rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-video text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-white">Production & Creative</h3>
                    <p class="text-gray-400">Video production, live streaming, photography, and audio production services.</p>
                </div>

                <div class="bg-gray-800 rounded-lg p-6 hover:bg-gray-800/80 transition-all" data-aos="fade-up" data-aos-delay="250">
                    <div class="w-14 h-14 btn-gradient rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-share-alt text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-white">Social Media</h3>
                    <p class="text-gray-400">Content creation, performance tracking, audience engagement, and scheduling.</p>
                </div>

                <div class="bg-gray-800 rounded-lg p-6 hover:bg-gray-800/80 transition-all" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-14 h-14 btn-gradient rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-chart-line text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-white">Business Promotion</h3>
                    <p class="text-gray-400">Market research, brand positioning, and comprehensive marketing campaigns.</p>
                </div>

                <div class="bg-gray-800 rounded-lg p-6 hover:bg-gray-800/80 transition-all" data-aos="fade-up" data-aos-delay="350">
                    <div class="w-14 h-14 btn-gradient rounded-lg flex items-center justify-center mb-6">
                        <i class="fas fa-laptop-code text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-white">Website Development</h3>
                    <p class="text-gray-400">Design, development, hosting, and maintenance of responsive websites.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="clients" class="py-16 bg-gray-800">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-semibold mb-4 text-white">Trusted By</h2>
                <div class="h-1 w-20 bg-gradient-to-r from-teal-500 to-blue-600 mx-auto"></div>
            </div>
        </div>
        {{-- The container mx-auto is removed from the slider itself to allow edge-to-edge fading --}}
        <div class="logo-slider" data-aos="fade-up" data-aos-delay="100">
            <div class="logo-slider-track">
                {{-- Add your client logos here. Duplicate the set for seamless looping --}}
                {{-- Set 1 --}}
                <div class="logo-slide">
                    <img src="/images/landrover.png" alt="Client Logo 1">
                </div>
                <div class="logo-slide">
                    <img src="/images/sahara.jpg" alt="Client Logo 2">
                </div>
                <div class="logo-slide">
                    <img src="/images/nightclub.png" alt="Client Logo 3">
                </div>
                <div class="logo-slide">
                    <img src="/images/familysport.png" alt="Client Logo 4">
                </div>
                <div class="logo-slide">
                    <img src="/images/kattan21.jpg" alt="Client Logo 5">
                </div>
                <div class="logo-slide">
                    <img src="/images/mhatravel.png" alt="Client Logo 6">
                </div>
                 <div class="logo-slide">
                    <img src="/images/aminojula.jpg" alt="Client Logo 7">
                </div>
                 <div class="logo-slide">
                    <img src="/images/girlhouse.jpg" alt="Client Logo 8">
                </div>
                <div class="logo-slide">
                    <img src="/images/pcgamenet.jpg" alt="Client Logo 9">
                </div>
                <div class="logo-slide">
                    <img src="/images/fscollection.jpg" alt="Client Logo 10">
                </div>
                <div class="logo-slide">
                    <img src="/images/krg_logo.png" alt="Client Logo 11">
                </div>
                <div class="logo-slide">
                    <img src="/images/tmtgroup.png" alt="Client Logo 12">
                </div>
                <div class="logo-slide">
                    <img src="/images/jordanfriendship.png" alt="Client Logo 13">
                </div>
                <div class="logo-slide">
                    <img src="/images/armanicafe.jpg" alt="Client Logo 14">
                </div>
                <div class="logo-slide">
                    <img src="/images/barak.png" alt="Client Logo 15">
                </div>
                <div class="logo-slide">
                    <img src="/images/media.jpg" alt="Client Logo 16">
                </div>

                {{-- Set 2 (Duplicate of Set 1 for seamless loop) --}}
                <div class="logo-slide">
                    <img src="/images/landrover.png" alt="Client Logo 1">
                </div>
                <div class="logo-slide">
                    <img src="/images/sahara.jpg" alt="Client Logo 2">
                </div>
                <div class="logo-slide">
                    <img src="/images/nightclub.png" alt="Client Logo 3">
                </div>
                <div class="logo-slide">
                    <img src="/images/familysport.png" alt="Client Logo 4">
                </div>
                <div class="logo-slide">
                    <img src="/images/kattan21.jpg" alt="Client Logo 5">
                </div>
                <div class="logo-slide">
                    <img src="/images/mhatravel.png" alt="Client Logo 6">
                </div>
                 <div class="logo-slide">
                    <img src="/images/aminojula.jpg" alt="Client Logo 7">
                </div>
                 <div class="logo-slide">
                    <img src="/images/girlhouse.jpg" alt="Client Logo 8">
                </div>
                <div class="logo-slide">
                    <img src="/images/pcgamenet.jpg" alt="Client Logo 9">
                </div>
                <div class="logo-slide">
                    <img src="/images/fscollection.jpg" alt="Client Logo 10">
                </div>
                <div class="logo-slide">
                    <img src="/images/krg_logo.png" alt="Client Logo 11">
                </div>
                <div class="logo-slide">
                    <img src="/images/tmtgroup.png" alt="Client Logo 12">
                </div>
                <div class="logo-slide">
                    <img src="/images/jordanfriendship.png" alt="Client Logo 13">
                </div>
                <div class="logo-slide">
                    <img src="/images/armanicafe.jpg" alt="Client Logo 14">
                </div>
                <div class="logo-slide">
                    <img src="/images/barak.png" alt="Client Logo 15">
                </div>
                <div class="logo-slide">
                    <img src="/images/media.jpg" alt="Client Logo 16">
                </div>
                
            </div>
        </div>
    </section>
    <section id="portfolio" class="py-20 bg-gray-900"> {{-- Changed background to contrast with slider --}}
        <div class="container mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold mb-4 gradient-text inline-block">Our Portfolio</h2>
                <div class="h-1 w-24 bg-gradient-to-r from-teal-500 to-blue-600 mx-auto"></div>
                <p class="text-gray-400 mt-6 max-w-2xl mx-auto">Explore our recent projects across various industries and service categories.</p>
            </div>

            <div class="flex flex-wrap justify-center gap-4 mb-10" data-aos="fade-up">
                <button class="portfolio-filter active px-6 py-2 rounded-md bg-gray-800 border border-teal-500 text-white hover:bg-teal-500/10 transition-colors" data-filter="all">All Projects</button>
                <button class="portfolio-filter px-6 py-2 rounded-md bg-gray-800 border border-gray-700 text-gray-300 hover:border-teal-500 hover:text-white transition-colors" data-filter="web">Web Development</button>
                <button class="portfolio-filter px-6 py-2 rounded-md bg-gray-800 border border-gray-700 text-gray-300 hover:border-teal-500 hover:text-white transition-colors" data-filter="branding">Branding</button>
                <button class="portfolio-filter px-6 py-2 rounded-md bg-gray-800 border border-gray-700 text-gray-300 hover:border-teal-500 hover:text-white transition-colors" data-filter="design">Graphic Design</button>
                <button class="portfolio-filter px-6 py-2 rounded-md bg-gray-800 border border-gray-700 text-gray-300 hover:border-teal-500 hover:text-white transition-colors" data-filter="production">Production</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="portfolio-grid">
                @if(isset($projects) && $projects->count() > 0)
                    @foreach($projects as $project)
                        <div class="portfolio-item {{ $project->category }}" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                            <div class="group relative overflow-hidden rounded-lg shadow-lg bg-gray-800"> {{-- Changed bg-gray-900 to bg-gray-800 --}}
                                @if($project->thumbnail)
                                    <a href="{{ asset('storage/' . $project->thumbnail) }}" data-lightbox="portfolio-{{ $project->id }}" data-title="{{ $project->title }}">
                                        <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                                    </a>
                                    @if($project->screenshots_array && count($project->screenshots_array) > 0)
                                        @foreach($project->screenshots_array as $screenshot)
                                            <a href="{{ asset('storage/' . $screenshot) }}" data-lightbox="portfolio-{{ $project->id }}" data-title="{{ $project->title }} - Screenshot" class="hidden"></a>
                                        @endforeach
                                    @endif
                                @else
                                    <div class="w-full h-64 bg-gray-700 flex items-center justify-center"> {{-- Changed bg-gray-800 to bg-gray-700 --}}
                                        <i class="fas fa-image text-gray-500 text-4xl"></i>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-800 via-gray-800/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6"> {{-- Changed gradient from gray-900 --}}
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
                                        {{-- @if($project->category === 'web' && $project->is_online && $project->url)
                                            <a href="{{ $project->url }}" target="_blank" class="px-4 py-2 bg-white/10 text-white rounded-md hover:bg-white/20 transition-colors text-sm">
                                                Visit Site
                                            </a>
                                        @endif --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                 @else
                     <p class="text-center col-span-full">No projects found.</p>
                 @endif
            </div>
        </div>
    </section>

    <section id="contact" class="py-20 bg-gray-900">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold mb-4 gradient-text inline-block">Get In Touch</h2>
                <div class="h-1 w-24 bg-gradient-to-r from-teal-500 to-blue-600 mx-auto"></div>
                <p class="text-gray-400 mt-6 max-w-2xl mx-auto">Ready to elevate your marketing strategy? Contact us to discuss how we can help your business grow.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-12">
                <div class="space-y-8" data-aos="fade-up" data-aos-delay="100">
                     <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 btn-gradient rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-2">Our Location</h3>
                            <p class="text-gray-400">Erbil, Kurdistan Region, Iraq</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 btn-gradient rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-2">Email Us</h3>
                            <p class="text-gray-400"><a href="mailto:mhagroup@gmail.com" class="hover:text-teal-400">mhagroup@gmail.com</a></p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 btn-gradient rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone-alt text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-white mb-2">Call Us</h3>
                            <p class="text-gray-400"><a href="tel:+964XXXXXXXXXX" class="hover:text-teal-400">+964 750 651 1045</a></p> {{-- Replace with actual number --}}
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-white mb-4">Follow Us</h3>
                        <div class="flex space-x-4">
                          <a href="#" aria-label="Facebook" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:text-white hover:bg-teal-500/20 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                          </a>
                          <a href="#" aria-label="X (Twitter)" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:text-white hover:bg-teal-500/20 transition-colors">
                            <!-- Using X character directly instead of icon -->
                            <span class="font-semibold" style="font-family: Arial, sans-serif;">X</span>
                          </a>
                          <a href="#" aria-label="Instagram" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:text-white hover:bg-teal-500/20 transition-colors">
                            <i class="fab fa-instagram"></i>
                          </a>
                          <a href="#" aria-label="LinkedIn" class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-400 hover:text-white hover:bg-teal-500/20 transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                          </a>
                        </div>
                      </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="200">
                    {{-- Display Success Message --}}
                    @if(session('contact_success'))
                        <div class="mb-4 p-3 rounded-md bg-green-500/20 text-green-400 text-sm">
                            {{ session('contact_success') }}
                        </div>
                    @endif

                    {{-- Display General Error Message --}}
                     @if(session('contact_error'))
                        <div class="mb-4 p-3 rounded-md bg-red-500/20 text-red-400 text-sm">
                            {{ session('contact_error') }}
                        </div>
                    @endif

                    {{-- Display Validation Errors --}}
                    @if(isset($errors) && $errors->contact->any()) {{-- Check 'contact' error bag --}}
                        <div class="mb-4 p-3 rounded-md bg-red-500/20 text-red-400 text-sm">
                            <strong class="font-bold">Oops! Please fix the following:</strong>
                            <ul class="list-disc pl-5 mt-2">
                                @foreach ($errors->contact->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="space-y-6" action="{{ route('contact.store') }}" method="POST">
                         @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-white mb-2">Your Name</label>
                            <input type="text" id="name" name="name" required value="{{ old('name') }}" class="w-full bg-gray-800 border @error('name', 'contact') border-red-500 @else border-gray-700 @enderror rounded-md py-3 px-4 text-white focus:outline-none focus:border-teal-500 transition-colors" placeholder="Enter your name">
                        </div>

                        <div>
                            <label for="email_contact" class="block text-sm font-medium text-white mb-2">Your Email</label>
                            <input type="email" id="email_contact" name="email" required value="{{ old('email') }}" class="w-full bg-gray-800 border @error('email', 'contact') border-red-500 @else border-gray-700 @enderror rounded-md py-3 px-4 text-white focus:outline-none focus:border-teal-500 transition-colors" placeholder="Enter your email">
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-white mb-2">Subject</label>
                            <input type="text" id="subject" name="subject" required value="{{ old('subject') }}" class="w-full bg-gray-800 border @error('subject', 'contact') border-red-500 @else border-gray-700 @enderror rounded-md py-3 px-4 text-white focus:outline-none focus:border-teal-500 transition-colors" placeholder="Enter subject">
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-white mb-2">Your Message</label>
                            <textarea id="message" name="message" rows="5" required class="w-full bg-gray-800 border @error('message', 'contact') border-red-500 @else border-gray-700 @enderror rounded-md py-3 px-4 text-white focus:outline-none focus:border-teal-500 transition-colors" placeholder="Enter your message">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="px-8 py-3 btn-gradient text-white font-medium rounded-md hover:opacity-90 transition-opacity">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER SECTION -->
<footer id="newsletter-section" class="bg-gray-800 py-12 border-t border-gray-700">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-8">
            {{-- Column 1: Logo/About --}}
            <div class="col-span-1 md:col-span-1">
                <div class="flex items-center mb-4">
                    <img src="/images/logo.png" alt="MHA Plus Logo" class="h-12">
                    <span class="ml-3 text-xl font-semibold text-white">MHA <span class="gradient-text">Plus</span></span>
                </div>
                <p class="text-gray-400 mb-6">Your complete marketing solution in Erbil, Iraq. We deliver high-quality services tailored to your business needs.</p>
            </div>

            {{-- Column 2: Quick Links --}}
            <div>
                <h3 class="text-white text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="#about" class="text-gray-400 hover:text-white transition-colors">About Us</a></li>
                    <li><a href="#services" class="text-gray-400 hover:text-white transition-colors">Services</a></li>
                    <li><a href="#portfolio" class="text-gray-400 hover:text-white transition-colors">Portfolio</a></li>
                    <li><a href="#contact" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                </ul>
            </div>

            {{-- Column 3: Our Services --}}
            <div>
                <h3 class="text-white text-lg font-semibold mb-4">Our Services</h3>
                <ul class="space-y-2">
                    <li><a href="#services" class="text-gray-400 hover:text-white transition-colors">Printing & Branding</a></li>
                    <li><a href="#services" class="text-gray-400 hover:text-white transition-colors">Graphic Design</a></li>
                    <li><a href="#services" class="text-gray-400 hover:text-white transition-colors">Production & Creative</a></li>
                    <li><a href="#services" class="text-gray-400 hover:text-white transition-colors">Social Media Management</a></li>
                    <li><a href="#services" class="text-gray-400 hover:text-white transition-colors">Website Development</a></li>
                </ul>
            </div>

            {{-- Column 4: Newsletter --}}
            <div>
                <h3 class="text-white text-lg font-semibold mb-4">Newsletter</h3>
                <p class="text-gray-400 mb-4">Subscribe to our newsletter for the latest updates and offers.</p>

                {{-- Display Success Message --}}
                @if(session('newsletter_success'))
                    <div class="mb-4 p-3 rounded-md bg-green-500/20 text-green-400 text-sm">
                        {{ session('newsletter_success') }}
                    </div>
                @endif

                {{-- Display General Error Message --}}
                 @if(session('newsletter_error'))
                    <div class="mb-4 p-3 rounded-md bg-red-500/20 text-red-400 text-sm">
                        {{ session('newsletter_error') }}
                    </div>
                @endif

                {{-- Display Validation Errors --}}
                @if(isset($errors) && $errors instanceof ViewErrorBag && $errors->newsletter->any())
                    <div class="mb-4 p-3 rounded-md bg-red-500/20 text-red-400 text-sm">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->newsletter->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Updated Newsletter Form --}}
                <form class="flex" method="POST" action="{{ route('newsletter.subscribe') }}">
                    @csrf
                    <input
                        type="email"
                        name="email"
                        placeholder="Your email"
                        required
                        value="{{ old('email') }}"
                        aria-label="Email for newsletter"
                        class="w-full bg-gray-900 border border-gray-700 rounded-l-md py-2 px-4 text-white focus:outline-none focus:border-teal-500 transition-colors @error('email', 'newsletter') border-red-500 @enderror"
                    >
                    <button type="submit" aria-label="Subscribe to newsletter" class="bg-gradient-to-r from-teal-500 to-blue-600 text-white px-4 rounded-r-md hover:opacity-90 transition-opacity">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="border-t border-gray-700 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-500">&copy; {{ date('Y') }} MHA Plus. All rights reserved.</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                {{-- Social Links --}}
                <a href="#" aria-label="Facebook" class="text-gray-500 hover:text-white transition-colors">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" aria-label="Twitter" class="text-gray-500 hover:text-white transition-colors">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" aria-label="Instagram" class="text-gray-500 hover:text-white transition-colors">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" aria-label="LinkedIn" class="text-gray-500 hover:text-white transition-colors">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>
    </div>
</footer>

    <button id="back-to-top" class="fixed bottom-8 right-8 w-12 h-12 btn-gradient rounded-full flex items-center justify-center text-white opacity-0 invisible transition-all duration-300">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

    <script>
        // Initialize AOS animation
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                once: true
            });
        }

        // Initialize Lightbox
        if (typeof lightbox !== 'undefined') {
             lightbox.option({
               'resizeDuration': 200,
               'wrapAround': true
             })
        }

        // Mobile Menu Toggle
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        if (menuToggle && mobileMenu) { // Ensure elements exist
            menuToggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Portfolio Filter
        const filterButtons = document.querySelectorAll('.portfolio-filter');
        const portfolioItems = document.querySelectorAll('.portfolio-item');

        if (filterButtons.length > 0 && portfolioItems.length > 0) { // Ensure elements exist
            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => {
                        btn.classList.remove('active', 'border-teal-500', 'text-white', 'bg-teal-500/10');
                        btn.classList.add('border-gray-700', 'text-gray-300', 'bg-gray-800'); // Changed bg-gray-900 to bg-gray-800
                    });

                    // Add active class to clicked button
                    button.classList.add('active', 'border-teal-500', 'text-white', 'bg-teal-500/10');
                    button.classList.remove('border-gray-700', 'text-gray-300', 'bg-gray-800'); // Changed bg-gray-900 to bg-gray-800

                    const filter = button.getAttribute('data-filter');

                    portfolioItems.forEach(item => {
                        if (filter === 'all' || item.classList.contains(filter)) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                    // Refresh AOS after filtering to ensure new items are animated correctly
                    if (typeof AOS !== 'undefined') {
                        AOS.refresh();
                    }
                });
            });
        }

        // Back to Top Button
        const backToTopBtn = document.getElementById('back-to-top');

        if (backToTopBtn) { // Ensure the button exists
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 300) {
                    backToTopBtn.classList.remove('opacity-0', 'invisible');
                    backToTopBtn.classList.add('opacity-100', 'visible');
                } else {
                    backToTopBtn.classList.add('opacity-0', 'invisible');
                    backToTopBtn.classList.remove('opacity-100', 'visible');
                }
            });

            backToTopBtn.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                 const href = this.getAttribute('href');
                 // Only prevent default for actual hash links, not "#" placeholder
                 if (href && href.startsWith('#') && href.length > 1) {
                    e.preventDefault();
                    const targetElement = document.querySelector(href);

                    if (targetElement) {
                        // Calculate offset based on header height (adjust 80 if your header height changes)
                        const headerOffset = 80;
                        const elementPosition = targetElement.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });

                        // Close mobile menu if open and if it's a mobile navigation link
                        if (mobileMenu && !mobileMenu.classList.contains('hidden') && this.closest('#mobile-menu')) {
                            mobileMenu.classList.add('hidden');
                        }
                    }
                 }
            });
        });
    </script>
</body>
</html>