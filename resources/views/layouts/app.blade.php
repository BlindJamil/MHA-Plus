<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        body {
            font-family: 'Poppins', sans-serif;
        }
        html {
             scroll-behavior: smooth;
        }
        .gradient-text {
            background: linear-gradient(90deg, #2b8a98, #0f5e8d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            color: transparent;
        }
        .btn-gradient {
            background: linear-gradient(90deg, #2b8a98, #0f5e8d);
        }
         .fab.fa-twitter:before { /* From welcome.blade.php styles */
            content: "𝕏";
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-900 text-gray-300 antialiased">

    <header class="fixed w-full z-50 bg-gray-900/80 backdrop-blur-md">
        <nav class="container mx-auto px-6 py-4 flex items-center justify-between">
            <a href="{{ route('home') }}#home" class="flex items-center">
                <img src="/images/logo.png" alt="MHA Plus Logo" class="h-10">
                <span class="ml-3 text-xl font-semibold text-white hidden sm:inline-block">MHA <span class="gradient-text">Plus</span></span>
            </a>
    
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}#home" class="text-gray-300 hover:text-white transition-colors">Home</a>
                <a href="{{ route('home') }}#about" class="text-gray-300 hover:text-white transition-colors">About</a>
                <a href="{{ route('home') }}#services" class="text-gray-300 hover:text-white transition-colors">Services</a>
                <a href="{{ route('portfolio.index') }}" class="text-gray-300 hover:text-white transition-colors {{ request()->routeIs('portfolio.index') ? 'text-teal-400 font-semibold' : '' }}">Portfolio</a>
                <a href="{{ route('home') }}#contact" class="text-gray-300 hover:text-white transition-colors">Contact</a>
            </div>
    
            <div class="md:hidden">
                <button id="menu-toggle-layout" class="text-gray-300 hover:text-white focus:outline-none" aria-label="Toggle mobile menu">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
        </nav>
        <div class="hidden bg-gray-800 md:hidden py-4 px-6" id="mobile-menu-layout">
            <a href="{{ route('home') }}#home" class="block py-2 text-gray-300 hover:text-white transition-colors mobile-nav-link">Home</a>
            <a href="{{ route('home') }}#about" class="block py-2 text-gray-300 hover:text-white transition-colors mobile-nav-link">About</a>
            <a href="{{ route('home') }}#services" class="block py-2 text-gray-300 hover:text-white transition-colors mobile-nav-link">Services</a>
            <a href="{{ route('portfolio.index') }}" class="block py-2 text-gray-300 hover:text-white transition-colors mobile-nav-link {{ request()->routeIs('portfolio.index') ? 'text-teal-400' : '' }}">Portfolio</a>
            <a href="{{ route('home') }}#contact" class="block py-2 text-gray-300 hover:text-white transition-colors mobile-nav-link">Contact</a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    {{-- Consider moving the full footer here if it's on all pages --}}
    {{-- For now, assuming footer might be unique to welcome page or handled by sections --}}
     <footer id="newsletter-section-minimal" class="bg-gray-800 py-8 border-t border-gray-700">
        <div class="container mx-auto px-6">
            <div class="text-center text-gray-500">
                <p>&copy; {{ date('Y') }} MHA Plus. All rights reserved.</p>
                 <div class="flex justify-center space-x-6 mt-4 md:mt-4">
                    <a href="#" aria-label="Facebook" class="text-gray-500 hover:text-white transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" aria-label="X (Twitter)" class="text-gray-500 hover:text-white transition-colors">
                         <span class="font-semibold">X</span>
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

    <button id="back-to-top" class="fixed bottom-8 right-8 w-12 h-12 btn-gradient rounded-full flex items-center justify-center text-white opacity-0 invisible transition-all duration-300 z-50">
        <i class="fas fa-arrow-up"></i>
    </button>

    @vite('resources/js/app.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
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
                        const headerOffset = 80;
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
    });
    </script>
    @stack('scripts')
</body>
</html>