<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>@yield('title', 'MHA Plus - Marketing Solutions in Erbil, Iraq')</title>
    <meta name="description" content="MHA Plus offers comprehensive marketing services from printing and branding to social media management and website development in Erbil, Iraq.">

    @vite('resources/css/app.css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">

    <style>
        :root { --header-offset: 80px; }
        html { scroll-padding-top: var(--header-offset); }
        section[id] { scroll-margin-top: var(--header-offset); }
        /* Prevent horizontal overflow and stabilize vertical scrollbar gutter */
        html {
            scroll-behavior: smooth;
            overflow-x: hidden;
            scrollbar-gutter: stable both-edges;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
            width: 100%;
            position: relative;
        }
        body.preload { overflow-y: hidden; }
        
        /* Ensure all containers don't overflow */
        * {
            max-width: 100%;
        }
        
        .gradient-text {
            background: linear-gradient(90deg, #E02020, #8B0000);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
        }
        .btn-gradient {
            background: linear-gradient(90deg, #E02020, #8B0000);
        }
         .fab.fa-twitter:before {
            content: "𝕏";
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }
        
        /* Fix back-to-top button on mobile */
        #back-to-top {
            -webkit-tap-highlight-color: transparent;
        }
        
        /* Mobile responsiveness */
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
        }
        
        /* Additional safety for all screen sizes */
        section, header, footer, main {
            max-width: 100vw;
            overflow-x: hidden;
        }
    /* (Removed advanced overlay styles per request – returning to original card behavior) */
    </style>
    @stack('styles')
</head>
<body class="bg-white text-gray-900 antialiased preload">
    <script>
        (function() {
            var removePreload = function() {
                document.body && document.body.classList.remove('preload');
            };
            setTimeout(removePreload, 0);
            window.addEventListener('load', removePreload);
        })();
    </script>

    <header class="fixed w-full z-50 bg-white/95 backdrop-blur-md shadow-sm">
        <nav class="container mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}#home" class="flex items-center">
                <img src="/images/logo-transparent.png" alt="MHA Plus Logo" class="h-12">
                <span class="ml-3 text-xl font-semibold text-gray-900 hidden sm:inline-block">MHA <span class="gradient-text">Plus</span></span>
            </a>
    
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}#home" class="text-gray-700 hover:text-red-600 transition-colors font-medium">Home</a>
                <a href="{{ route('home') }}#about" class="text-gray-700 hover:text-red-600 transition-colors font-medium">About</a>
                <a href="{{ route('home') }}#services" class="text-gray-700 hover:text-red-600 transition-colors font-medium">Services</a>
                <a href="{{ route('portfolio.index') }}" class="text-gray-700 hover:text-red-600 transition-colors font-medium {{ request()->routeIs('portfolio.index') ? 'text-red-600 font-semibold' : '' }}">Portfolio</a>
                <a href="{{ route('home') }}#contact" class="text-gray-700 hover:text-red-600 transition-colors font-medium">Contact</a>
            </div>
    
            <div class="md:hidden">
                <button id="menu-toggle-layout" class="text-gray-900 hover:text-red-600 focus:outline-none" aria-label="Toggle mobile menu">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </nav>
        <div class="hidden bg-white md:hidden py-4 px-6 shadow-lg" id="mobile-menu-layout">
            <a href="{{ route('home') }}#home" class="block py-2 text-gray-700 hover:text-red-600 transition-colors font-medium mobile-nav-link">Home</a>
            <a href="{{ route('home') }}#about" class="block py-2 text-gray-700 hover:text-red-600 transition-colors font-medium mobile-nav-link">About</a>
            <a href="{{ route('home') }}#services" class="block py-2 text-gray-700 hover:text-red-600 transition-colors font-medium mobile-nav-link">Services</a>
            <a href="{{ route('portfolio.index') }}" class="block py-2 text-gray-700 hover:text-red-600 transition-colors font-medium mobile-nav-link {{ request()->routeIs('portfolio.index') ? 'text-red-600' : '' }}">Portfolio</a>
            <a href="{{ route('home') }}#contact" class="block py-2 text-gray-700 hover:text-red-600 transition-colors font-medium mobile-nav-link">Contact</a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    {{-- Consider moving the full footer here if it's on all pages --}}
    {{-- For now, assuming footer might be unique to welcome page or handled by sections --}}
     <footer id="newsletter-section-minimal" class="bg-gray-50 py-12 border-t border-gray-200">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-8 mb-8">
                {{-- Logo & Description --}}
                <div>
                    <div class="flex items-center mb-4">
                        <img src="/images/logo-transparent.png" alt="MHA Plus Logo" class="h-10">
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">Your complete marketing solution in Erbil, Iraq.</p>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h3 class="text-gray-900 text-sm font-semibold mb-4 flex items-center">
                        <span class="w-1 h-5 bg-gradient-to-b from-red-600 to-red-900 mr-2 rounded-full"></span>
                        Quick Links
                    </h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}#about" class="text-gray-600 hover:text-red-600 text-sm transition-colors flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-gray-400 group-hover:text-red-600 transition-colors"></i>
                            About Us
                        </a></li>
                        <li><a href="{{ route('home') }}#services" class="text-gray-600 hover:text-red-600 text-sm transition-colors flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-gray-400 group-hover:text-red-600 transition-colors"></i>
                            Services
                        </a></li>
                        <li><a href="{{ route('portfolio.index') }}" class="text-gray-600 hover:text-red-600 text-sm transition-colors flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-gray-400 group-hover:text-red-600 transition-colors"></i>
                            Portfolio
                        </a></li>
                        <li><a href="{{ route('home') }}#contact" class="text-gray-600 hover:text-red-600 text-sm transition-colors flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 text-gray-400 group-hover:text-red-600 transition-colors"></i>
                            Contact
                        </a></li>
                    </ul>
                </div>

                {{-- Social Media --}}
                <div>
                    <h3 class="text-gray-900 text-sm font-semibold mb-4 flex items-center">
                        <span class="w-1 h-5 bg-gradient-to-b from-red-600 to-red-900 mr-2 rounded-full"></span>
                        Follow Us
                    </h3>
                    <div class="flex space-x-3">
                        <a href="#" aria-label="Facebook" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:border-red-600 hover:text-red-600 hover:shadow-md transition-all">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" aria-label="X (Twitter)" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:border-red-600 hover:text-red-600 hover:shadow-md transition-all">
                            <span class="font-semibold text-sm">X</span>
                        </a>
                        <a href="#" aria-label="Instagram" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:border-red-600 hover:text-red-600 hover:shadow-md transition-all">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" aria-label="LinkedIn" class="w-10 h-10 rounded-full bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:border-red-600 hover:text-red-600 hover:shadow-md transition-all">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-200 pt-6">
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

    <button id="back-to-top" class="fixed bottom-4 right-4 sm:bottom-8 sm:right-8 w-12 h-12 btn-gradient rounded-full flex items-center justify-center text-white opacity-0 invisible transition-all duration-300 z-50 shadow-lg hover:scale-110">
        <i class="fas fa-arrow-up"></i>
    </button>

    @vite('resources/js/app.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const headerEl = document.querySelector('header');
        function updateHeaderOffsetVar() {
            const headerOffset = headerEl ? Math.ceil(headerEl.getBoundingClientRect().height) : 80;
            document.documentElement.style.setProperty('--header-offset', headerOffset + 'px');
            return headerOffset;
        }
        let CURRENT_HEADER_OFFSET = updateHeaderOffsetVar();
        window.addEventListener('resize', () => { CURRENT_HEADER_OFFSET = updateHeaderOffsetVar(); });
        if (typeof AOS !== 'undefined') {
            AOS.init({ duration: 800, once: true });
            document.body.classList.add('aos-initialized'); // Mark as initialized
        }
        if (typeof lightbox !== 'undefined') {
            lightbox.option({ 'resizeDuration': 200, 'wrapAround': true });
        }

        const menuToggleLayout = document.getElementById('menu-toggle-layout');
        const mobileMenuLayout = document.getElementById('mobile-menu-layout');
        if (menuToggleLayout && mobileMenuLayout) {
            menuToggleLayout.addEventListener('click', () => {
                mobileMenuLayout.classList.toggle('hidden');
            });
        }

        document.querySelectorAll('a.mobile-nav-link, .md\\:flex a[href*="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                const targetUrl = new URL(href, window.location.origin);
                const currentUrl = new URL(window.location.href);

                // Check if navigating to a hash on the same page or to home page with hash
                if ((targetUrl.pathname === currentUrl.pathname || targetUrl.pathname === '/') && targetUrl.hash) {
                    if (targetUrl.pathname !== currentUrl.pathname && targetUrl.pathname === '/') {
                        // Navigating to home page with hash, let it redirect and then scroll will be handled by welcome page script
                        if (mobileMenuLayout && !mobileMenuLayout.classList.contains('hidden')) {
                             mobileMenuLayout.classList.add('hidden');
                        }
                        return; // Allow default navigation
                    }
                    
                    e.preventDefault();
                    const targetElement = document.querySelector(targetUrl.hash);
                    if (targetElement) {
                        const headerOffset = CURRENT_HEADER_OFFSET;
                        const elementPosition = targetElement.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                        window.scrollTo({ top: offsetPosition, behavior: 'smooth' });
                    }
                }
                if (mobileMenuLayout && !mobileMenuLayout.classList.contains('hidden') && this.closest('#mobile-menu-layout')) {
                    mobileMenuLayout.classList.add('hidden');
                }
            });
        });
        
        const backToTopBtn = document.getElementById('back-to-top');
        if (backToTopBtn) {
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 300) {
                    backToTopBtn.classList.remove('opacity-0', 'invisible');
                } else {
                    backToTopBtn.classList.add('opacity-0', 'invisible');
                }
            });
            backToTopBtn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
        }

        // Correct initial hash offset after load (e.g., when linking directly into a section)
        window.addEventListener('load', () => {
            CURRENT_HEADER_OFFSET = updateHeaderOffsetVar();
            if (location.hash && location.hash.length > 1) {
                const t = document.querySelector(location.hash);
                if (t) {
                    setTimeout(() => {
                        const y = t.getBoundingClientRect().top + window.pageYOffset - CURRENT_HEADER_OFFSET;
                        window.scrollTo({ top: Math.max(0, y), behavior: 'instant' in window ? 'instant' : 'auto' });
                    }, 50);
                }
            }
        });
    });
    </script>
    @stack('scripts')
</body>
</html>