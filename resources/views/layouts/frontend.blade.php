<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($page_title) ? $page_title . ' | ' . config('app.name', 'Portal Pariwisata SBD') : config('app.name', 'Portal Resmi Pariwisata Sumba Barat Daya') }}</title>
    <meta name="description" content="{{ $page_description ?? 'Situs Pariwisata Sumba Barat Daya. Jelajahi lanskap sabana yang magis, budaya leluhur Marapu, dan destinasi eksotis Sumba.' }}">
    <meta name="robots" content="index, follow">

    <!-- Premium Fonts: Playfair Display (Luxury Serif) & Inter (Clean Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <style>
        body {
            background-color: #FDFBF7;
            color: #141D26;
        }

        .img-hover-zoom {
            transition: transform 0.8s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .group:hover .img-hover-zoom {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="font-sans antialiased selection:bg-brand-500 selection:text-white flex flex-col min-h-screen">

    @php
    $isHome = request()->is('/');
    $navClasses = $isHome ? 'bg-transparent py-4' : 'bg-brand-50/95 backdrop-blur-md border-b border-gray-200/50 py-2 shadow-sm';
    $textClasses = $isHome ? 'text-white' : 'text-brand-900';
    @endphp

    <!-- OFFICIAL NAVIGATION BAR -->
    <nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-300 {{ $navClasses }}">
        <div class="max-w-[90rem] mx-auto px-6 h-16 md:h-20 flex items-center justify-between">
            <!-- Brand Logo with Added IDs for Safe JS Dom Access -->
            <div class="flex items-center">
                <a href="/" class="flex items-center gap-3">

                    <!-- ICON (Added id="nav-logo-img" and conditionally inverted brightness on Homepage load) -->
                    <svg id="nav-logo-img" class="w-9 h-9 transition-all duration-300 {{ $isHome ? 'brightness-0 invert' : '' }}" viewBox="0 0 64 64" fill="none">
                        <circle cx="32" cy="18" r="8" fill="#D8A25E" />
                        <path d="M10 38 C18 30, 46 30, 54 38 L54 44 C46 40, 18 40, 10 44 Z" fill="#2A3642" />
                        <path d="M10 46 C18 50, 26 42, 34 46 C42 50, 50 42, 54 46" stroke="#D8A25E" stroke-width="2" fill="none" stroke-linecap="round" />
                    </svg>

                    <!-- TEXT -->
                    <div class="flex flex-col leading-none">
                        <span id="nav-brand-text" class="font-serif font-bold text-xl transition-colors duration-300 {{ $isHome ? 'text-white' : 'text-brand-900' }}">
                            Sumba<span class="text-brand-500 italic font-light">Explore</span>
                        </span>
                        <span id="nav-sub-text" class="text-[10px] uppercase tracking-widest transition-colors duration-300 {{ $isHome ? 'text-gray-300' : 'text-gray-500' }}">
                            Tourism Platform
                        </span>
                    </div>

                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex space-x-8 items-center font-medium text-sm">
                <a href="/" class="nav-link transition {{ request()->is('/') ? 'text-brand-500 font-semibold' : ($isHome ? 'text-white hover:text-brand-500' : 'text-brand-900 hover:text-brand-500') }}">{{ __('Beranda') }}</a>
                <a href="{{ route('destination.index') }}" class="nav-link transition {{ request()->routeIs('destination.*') ? 'text-brand-500 font-semibold' : ($isHome ? 'text-white hover:text-brand-500' : 'text-brand-900 hover:text-brand-500') }}">{{ __('Destinasi') }}</a>
                <a href="{{ route('itinerary.index') }}" class="nav-link transition {{ request()->routeIs('itinerary.*') ? 'text-brand-500 font-semibold' : ($isHome ? 'text-white hover:text-brand-500' : 'text-brand-900 hover:text-brand-500') }}">{{ __('Paket Tour') }}</a>
                <a href="{{ route('umkm.index') }}" class="nav-link transition {{ request()->routeIs('umkm.*') ? 'text-brand-500 font-semibold' : ($isHome ? 'text-white hover:text-brand-500' : 'text-brand-900 hover:text-brand-500') }}">{{ __('UMKM') }}</a>
                <a href="{{ route('story.index') }}" class="nav-link transition {{ request()->routeIs('story.*') ? 'text-brand-500 font-semibold' : ($isHome ? 'text-white hover:text-brand-500' : 'text-brand-900 hover:text-brand-500') }}">{{ __('Budaya') }}</a>
                <a href="{{ route('gallery.index') }}" class="nav-link transition {{ request()->routeIs('gallery.*') ? 'text-brand-500 font-semibold' : ($isHome ? 'text-white hover:text-brand-500' : 'text-brand-900 hover:text-brand-500') }}">{{ __('Galeri') }}</a>
                <a href="{{ route('news.index') }}" class="nav-link transition {{ request()->routeIs('news.*') ? 'text-brand-500 font-semibold' : ($isHome ? 'text-white hover:text-brand-500' : 'text-brand-900 hover:text-brand-500') }}">{{ __('Kabar') }}</a>

                <!-- Language Switcher -->
                <div class="flex items-center space-x-2 border {{ $isHome ? 'border-white/20' : 'border-gray-200' }} px-3 py-1.5 rounded-full" id="nav-lang">
                    <a href="{{ route('switch.lang', 'id') }}" class="text-xs font-bold {{ App::getLocale() == 'id' ? 'text-brand-500' : 'nav-link ' . ($isHome ? 'text-gray-300' : 'text-gray-500') }} hover:text-brand-500 transition">ID</a>
                    <span class="text-xs nav-link {{ $isHome ? 'text-gray-500' : 'text-gray-300' }}">|</span>
                    <a href="{{ route('switch.lang', 'en') }}" class="text-xs font-bold {{ App::getLocale() == 'en' ? 'text-brand-500' : 'nav-link ' . ($isHome ? 'text-gray-300' : 'text-gray-500') }} hover:text-brand-500 transition">EN</a>
                </div>

                <!-- Primary CTA -->
                <a href="{{ route('planner.index') }}" class="bg-brand-500 text-white font-medium text-sm px-6 py-2.5 rounded-full hover:bg-brand-600 transition shadow-lg shadow-brand-500/20 flex items-center ml-2 {{ request()->routeIs('planner.*') ? 'ring-2 ring-offset-2 ring-brand-500 ring-offset-brand-50' : '' }}">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Smart Planner
                </a>
            </div>

            <!-- Mobile menu button -->
            <div class="flex items-center lg:hidden gap-4">
                <a href="{{ route('planner.index') }}" class="bg-brand-500 text-white p-2.5 rounded-full shadow-md">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </a>
                <button type="button" id="mobile-menu-btn" class="p-2 rounded-md transition-colors nav-link {{ $isHome ? 'text-white' : 'text-brand-900' }} focus:outline-none">
                    <svg class="block h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Panel (Cleanly hidden with CSS config) -->
        <div class="lg:hidden hidden bg-brand-50 border-t border-gray-200 absolute w-full shadow-luxury" id="mobile-menu">
            <div class="px-6 py-6 space-y-4">
                <a href="/" class="block text-lg font-serif font-medium transition {{ request()->is('/') ? 'text-brand-500' : 'text-brand-900 hover:text-brand-500' }}">{{ __('Beranda') }}</a>
                <a href="{{ route('destination.index') }}" class="block text-lg font-serif font-medium transition {{ request()->routeIs('destination.*') ? 'text-brand-500' : 'text-brand-900 hover:text-brand-500' }}">{{ __('Destinasi Wisata') }}</a>
                <a href="{{ route('itinerary.index') }}" class="block text-lg font-serif font-medium transition {{ request()->routeIs('itinerary.*') ? 'text-brand-500' : 'text-brand-900 hover:text-brand-500' }}">{{ __('Paket Perjalanan') }}</a>
                <a href="{{ route('umkm.index') }}" class="block text-lg font-serif font-medium transition {{ request()->routeIs('umkm.*') ? 'text-brand-500' : 'text-brand-900 hover:text-brand-500' }}">{{ __('Direktori UMKM') }}</a>
                <a href="{{ route('story.index') }}" class="block text-lg font-serif font-medium transition {{ request()->routeIs('story.*') ? 'text-brand-500' : 'text-brand-900 hover:text-brand-500' }}">{{ __('Budaya & Cerita') }}</a>
                <a href="{{ route('gallery.index') }}" class="block text-lg font-serif font-medium transition {{ request()->routeIs('gallery.*') ? 'text-brand-500' : 'text-brand-900 hover:text-brand-500' }}">{{ __('Galeri Visual') }}</a>
                <a href="{{ route('news.index') }}" class="block text-lg font-serif font-medium transition {{ request()->routeIs('news.*') ? 'text-brand-500' : 'text-brand-900 hover:text-brand-500' }}">{{ __('Kabar Pariwisata') }}</a>

                <div class="pt-4 border-t border-gray-200 flex gap-2">
                    <a href="{{ route('switch.lang', 'id') }}" class="flex-1 text-center py-3 rounded-xl font-medium text-sm {{ App::getLocale() == 'id' ? 'bg-brand-500 text-white' : 'bg-white border border-gray-200 text-gray-500' }}">Bahasa Indonesia</a>
                    <a href="{{ route('switch.lang', 'en') }}" class="flex-1 text-center py-3 rounded-xl font-medium text-sm {{ App::getLocale() == 'en' ? 'bg-brand-500 text-white' : 'bg-white border border-gray-200 text-gray-500' }}">English</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="flex-grow w-full">
        @yield('content')
    </main>

    <!-- OFFICIAL GOVERNMENT FOOTER -->
    <footer class="bg-brand-950 text-white pt-24 pb-10 mt-auto border-t-[12px] border-brand-500">
        <div class="max-w-[90rem] mx-auto px-6 sm:px-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16 border-b border-white/10 pb-16">

                <!-- Brand & Mission -->
                <div class="md:col-span-1">
                    <a href="#" class="flex items-center gap-3 mb-6">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/Garuda_Pancasila_-_National_Emblem_of_Indonesia.svg/120px-Garuda_Pancasila_-_National_Emblem_of_Indonesia.svg.png" alt="Garuda" class="w-10 h-10 object-contain brightness-0 invert">
                        <div class="flex flex-col">
                            <span class="font-serif font-bold text-xl tracking-tight text-white leading-none">Sumba<span class="text-brand-500 italic font-light">Explore</span></span>
                            <span class="text-[8px] uppercase tracking-[0.2em] font-medium text-gray-400 mt-1">Portal Resmi Pariwisata</span>
                        </div>
                    </a>
                    <p class="text-gray-400 font-light text-sm leading-relaxed mb-6">
                        Pintu gerbang resmi Anda menuju pesona Sumba Barat Daya. Jelajahi padang sabana yang megah, pantai perawan, dan warisan budaya kuno Marapu secara bertanggung jawab.
                    </p>
                </div>

                <!-- Links 1 -->
                <div>
                    <h4 class="font-medium text-white mb-6 uppercase tracking-widest text-xs">Eksplorasi Sumba</h4>
                    <ul class="space-y-4 text-sm text-gray-400 font-light">
                        <li><a href="{{ route('destination.index') }}" class="hover:text-brand-500 transition-colors">Semua Destinasi</a></li>
                        <li><a href="{{ route('itinerary.index') }}" class="hover:text-brand-500 transition-colors">Paket Tour Resmi</a></li>
                        <li><a href="{{ route('gallery.index') }}" class="hover:text-brand-500 transition-colors">Galeri Visual</a></li>
                        <li><a href="{{ route('story.index') }}" class="hover:text-brand-500 transition-colors">Jejak Budaya & Cerita</a></li>
                    </ul>
                </div>

                <!-- Links 2 -->
                <div>
                    <h4 class="font-medium text-white mb-6 uppercase tracking-widest text-xs">Layanan Publik</h4>
                    <ul class="space-y-4 text-sm text-gray-400 font-light">
                        <li><a href="{{ route('umkm.index') }}" class="hover:text-brand-500 transition-colors">Direktori Mitra UMKM</a></li>
                        <li><a href="{{ route('news.index') }}" class="hover:text-brand-500 transition-colors">Kabar & Publikasi</a></li>
                        <li><a href="{{ route('planner.index') }}" class="hover:text-brand-500 transition-colors flex items-center"><svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM9 9V5h2v4h4v2h-4v4H9v-4H5V9h4z" />
                                </svg> AI Smart Planner</a></li>
                        <li><a href="/admin" class="hover:text-brand-500 transition-colors">Login Admin Portal</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="font-medium text-white mb-6 uppercase tracking-widest text-xs">Pusat Informasi</h4>
                    <ul class="space-y-4 text-sm text-gray-400 font-light">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-brand-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Pariwisata Kab. Sumba Barat Daya<br>Tambolaka, NTT, Indonesia</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-brand-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <a href="mailto:tourism@sbdkab.go.id" class="hover:text-white transition-colors">tourism@sbdkab.go.id</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-brand-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span>+62 811-XXXX-XXXX (Hotline)</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center text-xs text-gray-500 font-light gap-4">
                <p>&copy; {{ date('Y') }} Pemerintah Kabupaten Sumba Barat Daya. All rights reserved.</p>
                <div class="flex space-x-6">
                    <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-white transition-colors">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Script Interactive Navigation Menu -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Menu Toggle - Now fully functional and isolated from syntax crashes
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            if (btn && menu) {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    menu.classList.toggle('hidden');
                });
            }

            // Close mobile menu if clicked outside
            document.addEventListener('click', function(e) {
                if (menu && !menu.classList.contains('hidden') && !menu.contains(e.target) && e.target !== btn) {
                    menu.classList.add('hidden');
                }
            });

            // Sticky Navbar Scroll Effect (Correct inline Blade parsing)
            const isHomePage = {{ request()->is('/') ? 'true' : 'false' }};
            if (isHomePage) {
                const navbar = document.getElementById('navbar');
                const navTexts = document.querySelectorAll('.nav-link');
                const navBrand = document.getElementById('nav-brand-text');
                const navSub = document.getElementById('nav-sub-text');
                const navLogo = document.getElementById('nav-logo-img');
                const navLang = document.getElementById('nav-lang');

                window.addEventListener('scroll', () => {
                    if (window.scrollY > 50) {
                        // On Scroll (Solid/White Background)
                        if (navbar) {
                            navbar.classList.add('bg-brand-50/95', 'backdrop-blur-md', 'border-b', 'border-gray-200/50', 'shadow-sm');
                            navbar.classList.remove('bg-transparent', 'py-4');
                            navbar.classList.add('py-2');
                        }

                        if (navBrand) {
                            navBrand.classList.remove('text-white');
                            navBrand.classList.add('text-brand-900');
                        }

                        if (navSub) {
                            navSub.classList.remove('text-gray-300');
                            navSub.classList.add('text-gray-500');
                        }

                        if (navLogo) {
                            navLogo.classList.remove('brightness-0', 'invert');
                        }

                        if (navLang) {
                            navLang.classList.remove('border-white/20');
                            navLang.classList.add('border-gray-200');
                        }

                        navTexts.forEach(el => {
                            if (!el.classList.contains('text-brand-500')) {
                                el.classList.remove('text-white', 'text-gray-300');
                                el.classList.add('text-brand-900');
                            }
                        });
                    } else {
                        // At Top (Transparent/Dark Background)
                        if (navbar) {
                            navbar.classList.remove('bg-brand-50/95', 'backdrop-blur-md', 'border-b', 'border-gray-200/50', 'shadow-sm');
                            navbar.classList.add('bg-transparent', 'py-4');
                            navbar.classList.remove('py-2');
                        }

                        if (navBrand) {
                            navBrand.classList.add('text-white');
                            navBrand.classList.remove('text-brand-900');
                        }

                        if (navSub) {
                            navSub.classList.add('text-gray-300');
                            navSub.classList.remove('text-gray-500');
                        }

                        if (navLogo) {
                            navLogo.classList.add('brightness-0', 'invert');
                        }

                        if (navLang) {
                            navLang.classList.add('border-white/20');
                            navLang.classList.remove('border-gray-200');
                        }

                        navTexts.forEach(el => {
                            if (!el.classList.contains('text-brand-500')) {
                                el.classList.add('text-white');
                                el.classList.remove('text-brand-900');
                            }
                        });
                    }
                });
            }
        });
    </script>
</body>

</html>