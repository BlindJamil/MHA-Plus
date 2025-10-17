@php
    // This is needed for checking validation errors specifically for the newsletter form
    use Illuminate\Support\ViewErrorBag;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
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
        /* Prevent horizontal overflow and stabilize vertical scrollbar gutter */
        html {
            scroll-behavior: smooth;
            overflow-x: hidden;
            /* Reserve space for vertical scrollbar to avoid layout shift/flicker on load */
            scrollbar-gutter: stable both-edges;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            width: 100%;
            position: relative;
        }
        /* Lock vertical scroll during initial paint to avoid transient scrollbars */
        body.preload {
            overflow-y: hidden;
        }
        
        /* Ensure all containers don't overflow */
        * {
            max-width: 100%;
        }
        
        .gradient-text {
            background: linear-gradient(90deg, #E02020, #8B0000);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text; /* Standard property */
            color: transparent; /* Fallback */
        }
        .btn-gradient {
            background: linear-gradient(90deg, #E02020, #8B0000);
        }
        .border-gradient {
            border-image: linear-gradient(to right, #E02020, #8B0000) 1;
        }
        .hero-gradient {
            background: linear-gradient(135deg, rgba(224, 32, 32, 0.05), rgba(250, 250, 250, 0.95)), 
                        linear-gradient(to bottom right, #ffffff, #fafafa);
            background-size: cover;
            background-position: center;
        }
        .portfolio-item {
            transition: all 0.3s ease;
        }
        .portfolio-item:hover {
            transform: translateY(-10px);
        }
        
        /* Fix back-to-top button on mobile */
        #back-to-top {
            -webkit-tap-highlight-color: transparent;
        }
        
        /* Ensure viewport doesn't zoom out on mobile */
        @media (max-width: 768px) {
            #back-to-top {
                bottom: 1rem !important;
                right: 1rem !important;
                width: 3rem;
                height: 3rem;
            }
            
            /* Prevent elements from going outside viewport */
            .container {
                max-width: 100vw;
                overflow-x: hidden;
            }
            
            /* Fix any padding/margin issues on mobile */
            section {
                overflow-x: hidden;
            }
            
            /* Ensure images don't overflow */
            img {
                max-width: 100%;
                height: auto;
            }
            
            /* Fix grid layouts on mobile */
            .grid {
                overflow-x: hidden;
            }
            
            /* Ensure hero text fits properly */
            h1 {
                word-wrap: break-word;
                overflow-wrap: break-word;
            }
        }
        
        /* Additional safety for all screen sizes */
        section, header, footer {
            max-width: 100vw;
            overflow-x: hidden;
        }

        /* --- Logo Slider Styles --- */
        .logo-slider {
            overflow: hidden;
            padding: 40px 0;
            background: #FAFAFA;
            white-space: nowrap;
            position: relative;
            width: 100%;
            max-width: 100vw;
        }

        .logo-slider::before,
        .logo-slider::after {
            position: absolute;
            top: 0;
            width: 150px;
            height: 100%;
            content: "";
            z-index: 2;
            pointer-events: none;
        }

        .logo-slider::before {
            left: 0;
            background: linear-gradient(to left, rgba(250, 250, 250, 0), #FAFAFA);
        }

        .logo-slider::after {
            right: 0;
            background: linear-gradient(to right, rgba(250, 250, 250, 0), #FAFAFA);
        }

        .logo-slider-track {
            display: inline-block;
            animation: scrollLogos 28s linear infinite; /* Slightly faster (was 40s) */
        }
        /* Will be toggled via JS when interacting with a specific logo */
        .logo-slider-track.paused {
            animation-play-state: paused;
        }

        .logo-slide {
            display: inline-block; /* Changed from inline-flex */
            vertical-align: middle;
            height: 80px; /* Adjust height as needed */
            margin: 0 40px; /* Space between logos */
            /* Always colorful */
            filter: none;
            opacity: 1;
            /* Smooth scale on interaction */
            transform-origin: center;
            transition: transform 200ms ease, filter 200ms ease, opacity 200ms ease;
        }
        .logo-slide img {
             max-height: 100%; /* Ensure image fits within the height */
             max-width: 150px; /* Max width for logos */
             width: auto; /* Maintain aspect ratio */
             vertical-align: middle; /* Align images vertically */
        }
        /* Enlarge the specific logo being interacted with */
        .logo-slide:hover,
        .logo-slide:focus {
            transform: scale(1.12);
        }

        @keyframes scrollLogos {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); } /* Scroll by half the total width (since logos are duplicated) */
        }
        
        /* Mobile adjustments for logo slider */
        @media (max-width: 768px) {
            .logo-slider::before,
            .logo-slider::after {
                width: 50px;
            }
            
            .logo-slide {
                height: 60px;
                margin: 0 20px;
            }
            
            .logo-slide img {
                max-width: 100px;
            }
        }
        /* --- End Logo Slider Styles --- */


        .fab.fa-twitter:before {
    content: "𝕏";
    font-family: 'Poppins', sans-serif; /* Use the same font as your site */
    font-weight: 600; /* Semi-bold to match other icons */
  }

    </style>
</head>
<body class="bg-white text-gray-900 preload">
    <script>
        // Remove preload lock ASAP after first paint and again on load as fallback
        (function() {
            var removePreload = function() {
                document.body && document.body.classList.remove('preload');
            };
            // Next tick after DOM starts parsing body
            setTimeout(removePreload, 0);
            // Ensure removal after window load
            window.addEventListener('load', removePreload);
        })();
    </script>
    <header class="fixed w-full z-50 bg-white/95 backdrop-blur-md shadow-sm">
        <nav class="container mx-auto px-6 py-4 flex items-center justify-between">
            <a href="#home" class="flex items-center">
                <img src="/images/logo-transparent.png" alt="MHA Plus Logo" class="h-12">
                <span class="ml-3 text-xl font-semibold text-gray-900 hidden sm:inline-block">MHA <span class="gradient-text">Plus</span></span>
            </a>
    
            <div class="hidden md:flex items-center space-x-8">
                <a href="#home" class="text-gray-700 hover:text-red-600 transition-colors font-medium">Home</a>
                <a href="#about" class="text-gray-700 hover:text-red-600 transition-colors font-medium">About</a>
                <a href="#services" class="text-gray-700 hover:text-red-600 transition-colors font-medium">Services</a>
                <a href="#portfolio" class="text-gray-700 hover:text-red-600 transition-colors font-medium">Portfolio</a>
                <a href="#contact" class="text-gray-700 hover:text-red-600 transition-colors font-medium">Contact</a>
            </div>
    
            <div class="md:hidden">
                <button id="menu-toggle" class="text-gray-900 hover:text-red-600 focus:outline-none" aria-label="Toggle mobile menu">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </nav>
        <div class="hidden bg-white md:hidden py-4 px-6 shadow-lg" id="mobile-menu">
            <a href="#home" class="block py-2 text-gray-700 hover:text-red-600 transition-colors font-medium">Home</a>
            <a href="#about" class="block py-2 text-gray-700 hover:text-red-600 transition-colors font-medium">About</a>
            <a href="#services" class="block py-2 text-gray-700 hover:text-red-600 transition-colors font-medium">Services</a>
            <a href="#portfolio" class="block py-2 text-gray-700 hover:text-red-600 transition-colors font-medium">Portfolio</a>
            <a href="#contact" class="block py-2 text-gray-700 hover:text-red-600 transition-colors font-medium">Contact</a>
        </div>
    </header>

    <section id="home" class="hero-gradient min-h-screen flex items-center pt-20">
        <div class="container mx-auto px-6 py-24">
            <div class="max-w-4xl" data-aos="fade-up" data-aos-delay="100">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 text-gray-900">Your Complete Marketing Solution in <span class="gradient-text">Erbil, Iraq</span></h1>
                <p class="text-xl md:text-2xl mb-8 text-gray-700">We offer comprehensive services from printing and branding to social media management and website development.</p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#services" class="px-8 py-3 btn-gradient text-white font-medium rounded-md hover:opacity-90 transition-opacity inline-block text-center shadow-lg">Our Services</a>
                    <a href="#portfolio" class="px-8 py-3 bg-white border-2 border-red-600 text-red-600 font-medium rounded-md hover:bg-red-50 hover:border-red-700 hover:shadow-xl transition-all inline-block text-center shadow-md">View Portfolio</a>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-4xl font-bold mb-4 gradient-text inline-block">About Us</h2>
                <div class="h-1 w-24 bg-gradient-to-r from-red-600 to-red-900 mx-auto"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-10">
                <div class="bg-gray-50 p-8 rounded-lg shadow-md hover:shadow-xl transition-shadow" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-16 h-16 btn-gradient rounded-full flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-handshake text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-gray-900">Professional Excellence</h3>
                    <p class="text-gray-600">We deliver high-quality marketing solutions tailored to your needs.</p>
                </div>

                <div class="bg-gray-50 p-8 rounded-lg shadow-md hover:shadow-xl transition-shadow" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-16 h-16 btn-gradient rounded-full flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-lightbulb text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-gray-900">Creative Approach</h3>
                    <p class="text-gray-600">Our team combines innovation with strategic thinking.</p>
                </div>

                <div class="bg-gray-50 p-8 rounded-lg shadow-md hover:shadow-xl transition-shadow" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-16 h-16 btn-gradient rounded-full flex items-center justify-center mb-6 shadow-lg">
                        <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-gray-900">Local Expertise</h3>
                    <p class="text-gray-600">Based in Erbil, we understand the regional market dynamics.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="services" class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-4xl font-bold mb-4 gradient-text inline-block">Our Services</h2>
                <div class="h-1 w-24 bg-gradient-to-r from-red-600 to-red-900 mx-auto"></div>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white rounded-lg p-6 hover:shadow-xl transition-shadow border border-gray-200" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-14 h-14 btn-gradient rounded-lg flex items-center justify-center mb-6 shadow-md">
                        <i class="fas fa-print text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">Printing & Branding</h3>
                    <p class="text-gray-600">Event branding, banners, flags, signs, brochures, flyers, and more.</p>
                </div>

                <div class="bg-white rounded-lg p-6 hover:shadow-xl transition-shadow border border-gray-200" data-aos="fade-up" data-aos-delay="150">
                    <div class="w-14 h-14 btn-gradient rounded-lg flex items-center justify-center mb-6 shadow-md">
                        <i class="fas fa-palette text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">Graphic Design</h3>
                    <p class="text-gray-600">Logo creation, visual identity, and promotional materials for print and digital.</p>
                </div>

                <div class="bg-white rounded-lg p-6 hover:shadow-xl transition-shadow border border-gray-200" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-14 h-14 btn-gradient rounded-lg flex items-center justify-center mb-6 shadow-md">
                        <i class="fas fa-video text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">Production & Creative</h3>
                    <p class="text-gray-600">Video production, live streaming, photography, and audio production services.</p>
                </div>

                <div class="bg-white rounded-lg p-6 hover:shadow-xl transition-shadow border border-gray-200" data-aos="fade-up" data-aos-delay="250">
                    <div class="w-14 h-14 btn-gradient rounded-lg flex items-center justify-center mb-6 shadow-md">
                        <i class="fas fa-share-alt text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">Social Media</h3>
                    <p class="text-gray-600">Content creation, performance tracking, audience engagement, and scheduling.</p>
                </div>

                <div class="bg-white rounded-lg p-6 hover:shadow-xl transition-shadow border border-gray-200" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-14 h-14 btn-gradient rounded-lg flex items-center justify-center mb-6 shadow-md">
                        <i class="fas fa-chart-line text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">Business Promotion</h3>
                    <p class="text-gray-600">Market research, brand positioning, and comprehensive marketing campaigns.</p>
                </div>

                <div class="bg-white rounded-lg p-6 hover:shadow-xl transition-shadow border border-gray-200" data-aos="fade-up" data-aos-delay="350">
                    <div class="w-14 h-14 btn-gradient rounded-lg flex items-center justify-center mb-6 shadow-md">
                        <i class="fas fa-laptop-code text-white text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">Website Development</h3>
                    <p class="text-gray-600">Design, development, hosting, and maintenance of responsive websites.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="clients" class="py-16 bg-white border-t border-gray-200">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl font-semibold mb-4 text-gray-900">Trusted By</h2>
                <div class="h-1 w-20 bg-gradient-to-r from-red-600 to-red-900 mx-auto"></div>
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
                    <img src="/images/MHATravel.png" alt="Client Logo 6">
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
                    <img src="/images/MHATravel.png" alt="Client Logo 6">
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
    {{-- resources/views/welcome.blade.php --}}
{{-- ... other sections ... --}}

<section id="portfolio" class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl font-bold mb-4 gradient-text inline-block">Our Portfolio</h2>
            <div class="h-1 w-24 bg-gradient-to-r from-red-600 to-red-900 mx-auto"></div>
            <p class="text-gray-600 mt-6 max-w-2xl mx-auto">Explore our recent projects across various industries and service categories.</p>
        </div>

        <div class="flex flex-wrap justify-center gap-4 mb-10" data-aos="fade-up">
            <button class="portfolio-filter active px-6 py-2 rounded-md bg-white border-2 border-red-600 text-red-600 transition-colors shadow-sm" data-filter="all">All Projects</button>
            <button class="portfolio-filter px-6 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:border-red-600 hover:text-red-600 transition-colors shadow-sm" data-filter="web">Web Development</button>
            <button class="portfolio-filter px-6 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:border-red-600 hover:text-red-600 transition-colors shadow-sm" data-filter="branding">Branding</button>
            <button class="portfolio-filter px-6 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:border-red-600 hover:text-red-600 transition-colors shadow-sm" data-filter="design">Graphic Design</button>
            <button class="portfolio-filter px-6 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:border-red-600 hover:text-red-600 transition-colors shadow-sm" data-filter="production">Production</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="portfolio-grid">
            @if(isset($projects) && $projects->count() > 0)
                @foreach($projects as $project) {{-- $projects now contains max 6 items --}}
                    <div class="portfolio-item {{ $project->category }}" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                        <div class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-shadow bg-white">
                            @if($project->thumbnail)
                                <a href="{{ asset('uploads/' . $project->thumbnail) }}" data-lightbox="portfolio-home-{{ $project->id }}" data-title="{{ $project->title }}">
                                    <img src="{{ asset('uploads/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                                </a>
                                @if($project->screenshots_array && count($project->screenshots_array) > 0)
                                    @foreach($project->screenshots_array as $screenshotPath)
                                        <a href="{{ asset('uploads/' . $screenshotPath) }}" data-lightbox="portfolio-home-{{ $project->id }}" data-title="{{ $project->title }} - Screenshot" class="hidden"></a>
                                    @endforeach
                                @endif
                            @else
                                <div class="w-full h-64 bg-gray-100 flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400 text-4xl"></i>
                                </div>
                            @endif
                            <!-- Darkening layer (only darkens image) - refined to requested rgba(0,0,0,0.45) -->
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none" style="background: rgba(0,0,0,0.45);"></div>
                            <!-- Original overlay with gradient & content -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
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
                                    <a href="{{ route('projects.show', $project->id) }}" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors text-sm shadow-md">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
             @else
                 <p class="text-center col-span-full text-gray-600">No projects to display at the moment. Check back soon!</p>
             @endif
        </div>

        {{-- "See More Projects" Button --}}
        @if(isset($totalProjects) && $totalProjects > 6)
        <div class="text-center mt-12" data-aos="fade-up">
            <a href="{{ route('portfolio.index') }}" class="px-8 py-3 btn-gradient text-white font-medium rounded-md hover:opacity-90 transition-opacity inline-block shadow-lg">
                See More Projects <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
        @endif
    </div>
</section>

{{-- ... other sections ... --}}

    <section id="contact" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold mb-4 gradient-text inline-block">Get In Touch</h2>
                <div class="h-1 w-24 bg-gradient-to-r from-red-600 to-red-900 mx-auto"></div>
                <p class="text-gray-600 mt-6 max-w-2xl mx-auto">Ready to elevate your marketing strategy? Contact us to discuss how we can help your business grow.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-12">
                <div class="space-y-8" data-aos="fade-up" data-aos-delay="100">
                     <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 btn-gradient rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                            <i class="fas fa-map-marker-alt text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Our Location</h3>
                            <p class="text-gray-600">Erbil, Kurdistan Region, Iraq</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 btn-gradient rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                            <i class="fas fa-envelope text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Email Us</h3>
                            <p class="text-gray-600"><a href="mailto:info@mhaplus.com" class="hover:text-red-600 transition-colors">info@mhaplus.com</a></p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 btn-gradient rounded-lg flex items-center justify-center flex-shrink-0 shadow-md">
                            <i class="fas fa-phone-alt text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Call Us</h3>
                            <p class="text-gray-600"><a href="tel:+964XXXXXXXXXX" class="hover:text-red-600 transition-colors">+964 750 651 1045</a></p>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Follow Us</h3>
                        <div class="flex space-x-4">
                          <a href="#" aria-label="Facebook" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-700 hover:bg-red-600 hover:text-white transition-colors shadow-sm">
                            <i class="fab fa-facebook-f"></i>
                          </a>
                          <a href="#" aria-label="X (Twitter)" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-700 hover:bg-red-600 hover:text-white transition-colors shadow-sm">
                            <span class="font-semibold" style="font-family: Arial, sans-serif;">X</span>
                          </a>
                          <a href="#" aria-label="Instagram" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-700 hover:bg-red-600 hover:text-white transition-colors shadow-sm">
                            <i class="fab fa-instagram"></i>
                          </a>
                          <a href="#" aria-label="LinkedIn" class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-gray-700 hover:bg-red-600 hover:text-white transition-colors shadow-sm">
                            <i class="fab fa-linkedin-in"></i>
                          </a>
                        </div>
                      </div>
                </div>

                <div data-aos="fade-up" data-aos-delay="200">
                    {{-- Display Success Message --}}
                    @if(session('contact_success'))
                        <div class="mb-4 p-3 rounded-md bg-green-50 border border-green-200 text-green-700 text-sm">
                            {{ session('contact_success') }}
                        </div>
                    @endif

                    {{-- Display General Error Message --}}
                     @if(session('contact_error'))
                        <div class="mb-4 p-3 rounded-md bg-red-50 border border-red-200 text-red-700 text-sm">
                            {{ session('contact_error') }}
                        </div>
                    @endif

                    {{-- Display Validation Errors --}}
                    @if(isset($errors) && $errors->contact->any()) {{-- Check 'contact' error bag --}}
                        <div class="mb-4 p-3 rounded-md bg-red-50 border border-red-200 text-red-700 text-sm">
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
                            <label for="name" class="block text-sm font-medium text-gray-900 mb-2">Your Name</label>
                            <input type="text" id="name" name="name" required value="{{ old('name') }}" class="w-full bg-white border @error('name', 'contact') border-red-500 @else border-gray-300 @enderror rounded-md py-3 px-4 text-gray-900 focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20 transition-colors" placeholder="Enter your name">
                        </div>

                        <div>
                            <label for="email_contact" class="block text-sm font-medium text-gray-900 mb-2">Your Email</label>
                            <input type="email" id="email_contact" name="email" required value="{{ old('email') }}" class="w-full bg-white border @error('email', 'contact') border-red-500 @else border-gray-300 @enderror rounded-md py-3 px-4 text-gray-900 focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20 transition-colors" placeholder="Enter your email">
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-900 mb-2">Subject</label>
                            <input type="text" id="subject" name="subject" required value="{{ old('subject') }}" class="w-full bg-white border @error('subject', 'contact') border-red-500 @else border-gray-300 @enderror rounded-md py-3 px-4 text-gray-900 focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20 transition-colors" placeholder="Enter subject">
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-900 mb-2">Your Message</label>
                            <textarea id="message" name="message" rows="5" required class="w-full bg-white border @error('message', 'contact') border-red-500 @else border-gray-300 @enderror rounded-md py-3 px-4 text-gray-900 focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20 transition-colors" placeholder="Enter your message">{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="px-8 py-3 btn-gradient text-white font-medium rounded-md hover:opacity-90 transition-opacity shadow-lg">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER SECTION -->
<footer id="newsletter-section" class="bg-gray-50 py-16 border-t border-gray-200">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-8 mb-12">
            {{-- Column 1: Logo/About --}}
            <div class="col-span-1 md:col-span-1">
                <div class="flex items-center mb-4">
                    <img src="/images/logo-transparent.png" alt="MHA Plus Logo" class="h-12">
                </div>
                <p class="text-gray-600 mb-6 leading-relaxed">Your complete marketing solution in Erbil, Iraq. We deliver high-quality services tailored to your business needs.</p>
                <div class="flex space-x-4">
                    <a href="#" aria-label="Facebook" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:border-red-600 hover:text-red-600 hover:shadow-md transition-all">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" aria-label="Twitter" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:border-red-600 hover:text-red-600 hover:shadow-md transition-all">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" aria-label="Instagram" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:border-red-600 hover:text-red-600 hover:shadow-md transition-all">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" aria-label="LinkedIn" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:border-red-600 hover:text-red-600 hover:shadow-md transition-all">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>

            {{-- Column 2: Quick Links --}}
            <div>
                <h3 class="text-gray-900 text-lg font-semibold mb-4 flex items-center">
                    <span class="w-1 h-6 bg-gradient-to-b from-red-600 to-red-900 mr-2 rounded-full"></span>
                    Quick Links
                </h3>
                <ul class="space-y-3">
                    <li><a href="#about" class="text-gray-600 hover:text-red-600 transition-colors flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-gray-400 group-hover:text-red-600 transition-colors"></i>
                        About Us
                    </a></li>
                    <li><a href="#services" class="text-gray-600 hover:text-red-600 transition-colors flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-gray-400 group-hover:text-red-600 transition-colors"></i>
                        Services
                    </a></li>
                    <li><a href="#portfolio" class="text-gray-600 hover:text-red-600 transition-colors flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-gray-400 group-hover:text-red-600 transition-colors"></i>
                        Portfolio
                    </a></li>
                    <li><a href="#contact" class="text-gray-600 hover:text-red-600 transition-colors flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-gray-400 group-hover:text-red-600 transition-colors"></i>
                        Contact
                    </a></li>
                </ul>
            </div>

            {{-- Column 3: Our Services --}}
            <div>
                <h3 class="text-gray-900 text-lg font-semibold mb-4 flex items-center">
                    <span class="w-1 h-6 bg-gradient-to-b from-red-600 to-red-900 mr-2 rounded-full"></span>
                    Our Services
                </h3>
                <ul class="space-y-3">
                    <li><a href="#services" class="text-gray-600 hover:text-red-600 transition-colors flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-gray-400 group-hover:text-red-600 transition-colors"></i>
                        Printing & Branding
                    </a></li>
                    <li><a href="#services" class="text-gray-600 hover:text-red-600 transition-colors flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-gray-400 group-hover:text-red-600 transition-colors"></i>
                        Graphic Design
                    </a></li>
                    <li><a href="#services" class="text-gray-600 hover:text-red-600 transition-colors flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-gray-400 group-hover:text-red-600 transition-colors"></i>
                        Production & Creative
                    </a></li>
                    <li><a href="#services" class="text-gray-600 hover:text-red-600 transition-colors flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-gray-400 group-hover:text-red-600 transition-colors"></i>
                        Social Media
                    </a></li>
                    <li><a href="#services" class="text-gray-600 hover:text-red-600 transition-colors flex items-center group">
                        <i class="fas fa-chevron-right text-xs mr-2 text-gray-400 group-hover:text-red-600 transition-colors"></i>
                        Web Development
                    </a></li>
                </ul>
            </div>

            {{-- Column 4: Newsletter --}}
            <div>
                <h3 class="text-gray-900 text-lg font-semibold mb-4 flex items-center">
                    <span class="w-1 h-6 bg-gradient-to-b from-red-600 to-red-900 mr-2 rounded-full"></span>
                    Newsletter
                </h3>
                <p class="text-gray-600 mb-4 leading-relaxed">Subscribe to our newsletter for the latest updates and offers.</p>

                {{-- Display Success Message --}}
                @if(session('newsletter_success'))
                    <div class="mb-4 p-3 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('newsletter_success') }}
                    </div>
                @endif

                {{-- Display General Error Message --}}
                 @if(session('newsletter_error'))
                    <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
                        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('newsletter_error') }}
                    </div>
                @endif

                {{-- Display Validation Errors --}}
                @if(isset($errors) && $errors instanceof ViewErrorBag && $errors->newsletter->any())
                    <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
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
                        class="flex-1 bg-white border border-gray-300 rounded-l-lg py-3 px-4 text-gray-900 placeholder-gray-400 focus:outline-none focus:border-red-600 focus:ring-2 focus:ring-red-600/20 transition-all @error('email', 'newsletter') border-red-500 @enderror"
                    >
                    <button type="submit" aria-label="Subscribe to newsletter" class="bg-gradient-to-r from-red-600 to-red-900 text-white px-6 rounded-r-lg hover:shadow-lg transition-all">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="border-t border-gray-200 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-600 text-sm">&copy; {{ date('Y') }} MHA Plus. All rights reserved.</p>
                <div class="flex items-center space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-600 hover:text-red-600 text-sm transition-colors">Privacy Policy</a>
                    <a href="#" class="text-gray-600 hover:text-red-600 text-sm transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>
</footer>
            </div>
        </div>

                    </div>
        </div>

        <div class="border-t border-gray-200 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-600 text-sm">&copy; {{ date('Y') }} MHA Plus. All rights reserved.</p>
                <div class="flex items-center space-x-6 mt-4 md:mt-0">
                    <a href="#" class="text-gray-600 hover:text-red-600 text-sm transition-colors">Privacy Policy</a>
                    <a href="#" class="text-gray-600 hover:text-red-600 text-sm transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </div>
</footer>

    <button id="back-to-top" class="fixed bottom-4 right-4 sm:bottom-8 sm:right-8 w-12 h-12 btn-gradient rounded-full flex items-center justify-center text-white opacity-0 invisible transition-all duration-300 shadow-lg hover:scale-110 z-40">
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
                        btn.classList.remove('active', 'border-red-600', 'text-red-600', 'text-white', 'bg-red-600', 'border-2');
                        btn.classList.add('border', 'border-gray-300', 'text-gray-700', 'bg-white');
                    });

                    // Add active class to clicked button
                    button.classList.add('active', 'border-red-600', 'text-red-600', 'bg-white', 'border-2');
                    button.classList.remove('border', 'border-gray-300', 'text-gray-700');

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

        // Logo slider: pause only when interacting with a specific logo and scale it smoothly
        (function () {
            const track = document.querySelector('.logo-slider-track');
            const slides = document.querySelectorAll('.logo-slide');
            if (!track || slides.length === 0) return;

            // Allow keyboard focus on slides for accessibility
            slides.forEach(slide => slide.setAttribute('tabindex', '0'));

            const pause = () => track.classList.add('paused');
            const resume = () => track.classList.remove('paused');

            slides.forEach(slide => {
                // Mouse interactions
                slide.addEventListener('mouseenter', pause);
                slide.addEventListener('mouseleave', resume);
                slide.addEventListener('mousedown', pause);
                slide.addEventListener('mouseup', resume);

                // Touch interactions
                slide.addEventListener('touchstart', () => {
                    pause();
                }, { passive: true });
                slide.addEventListener('touchend', () => {
                    resume();
                });

                // Keyboard focus interactions
                slide.addEventListener('focus', pause);
                slide.addEventListener('blur', resume);

                // Space/Enter key can briefly pause for inspection
                slide.addEventListener('keydown', (e) => {
                    if (e.key === ' ' || e.key === 'Enter') {
                        pause();
                    }
                });
                slide.addEventListener('keyup', (e) => {
                    if (e.key === ' ' || e.key === 'Enter') {
                        resume();
                    }
                });
            });
        })();
    </script>
</body>
</html>