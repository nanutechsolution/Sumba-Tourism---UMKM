<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ isset($page_title) ? $page_title . ' | ' . config('app.name', 'Explore SBD') : config('app.name', 'Explore SBD') . ' - Smart Tourism Platform' }}</title>

    <meta name="description" content="{{ $page_description ?? 'Platform Pintar untuk menemukan keindahan destinasi wisata, budaya autentik, dan karya UMKM lokal terbaik dari Tambolaka hingga penjuru Sumba Barat Daya.' }}">
    <meta name="author" content="Pemerintah Kabupaten Sumba Barat Daya">
    <meta name="robots" content="index, follow">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $page_title ?? config('app.name', 'Explore SBD') }}">
    <meta property="og:description" content="{{ $page_description ?? 'Platform pariwisata dan UMKM terintegrasi Kabupaten Sumba Barat Daya.' }}">
    <meta property="og:image" content="{{ $page_image ?? asset('images/default-share.jpg') }}">

    <!-- CSS Peta Leaflet (Baru) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Script Leaflet (Baru) ditaruh di head agar siap dipakai -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Inline Style untuk custom icon peta agar tidak conflict -->
    <style>
        .leaflet-custom-icon {
            background: none;
            border: none;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 font-sans antialiased flex flex-col min-h-screen">

    <!-- Navbar (Sama persis seperti sebelumnya) -->
    <nav class="bg-white shadow-sm w-full sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex">
                    <a href="/" class="flex-shrink-0 flex items-center font-black text-3xl tracking-tighter text-amber-600">
                        EXPLORE <span class="text-gray-900 ml-2">SBD</span>
                    </a>
                </div>

                <div class="hidden md:ml-6 md:flex md:space-x-6 items-center">
                    <a href="/" class="text-gray-900 px-2 py-2 rounded-md text-sm font-bold hover:text-amber-600 transition">{{ __('Beranda') }}</a>
                    <a href="{{ route('itinerary.index') }}" class="text-gray-900 px-2 py-2 rounded-md text-sm font-bold hover:text-amber-600 transition">{{ __('Paket Perjalanan') }}</a>
                    <a href="{{ route('umkm.index') }}" class="text-gray-900 px-2 py-2 rounded-md text-sm font-bold hover:text-amber-600 transition">{{ __('Direktori UMKM') }}</a>
                    <a href="{{ route('gallery.index') }}" class="text-gray-900 px-2 py-2 rounded-md text-sm font-bold hover:text-amber-600 transition">{{ __('Galeri') }}</a>

                    <!-- FITUR BARU: Language Switcher -->
                    <div class="flex border border-gray-300 rounded-lg overflow-hidden ml-2">
                        <a href="{{ route('switch.lang', 'id') }}" class="px-2 py-1 text-xs font-bold {{ App::getLocale() == 'id' ? 'bg-amber-500 text-gray-900' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">ID</a>
                        <a href="{{ route('switch.lang', 'en') }}" class="px-2 py-1 text-xs font-bold {{ App::getLocale() == 'en' ? 'bg-amber-500 text-gray-900' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">EN</a>
                    </div>

                    <a href="/admin" class="bg-gray-900 text-white px-4 py-2 rounded-full text-xs font-bold hover:bg-amber-600 transition shadow-md ml-2">{{ __('Dashboard Admin') }}</a>
                </div>

                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden gap-4">
                    <!-- Mobile Language Switcher -->
                    <div class="flex border border-gray-300 rounded-lg overflow-hidden">
                        <a href="{{ route('switch.lang', 'id') }}" class="px-2 py-1 text-xs font-bold {{ App::getLocale() == 'id' ? 'bg-amber-500 text-gray-900' : 'bg-gray-100 text-gray-500' }}">ID</a>
                        <a href="{{ route('switch.lang', 'en') }}" class="px-2 py-1 text-xs font-bold {{ App::getLocale() == 'en' ? 'bg-amber-500 text-gray-900' : 'bg-gray-100 text-gray-500' }}">EN</a>
                    </div>

                    <button type="button" id="mobile-menu-btn" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-amber-500">
                        <span class="sr-only">Buka menu</span>
                        <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="md:hidden hidden bg-white border-t border-gray-100" id="mobile-menu">
            <div class="pt-2 pb-4 space-y-1 px-4">
                <a href="/" class="block px-3 py-3 rounded-md text-base font-bold text-gray-900 hover:text-amber-600 hover:bg-gray-50">{{ __('Beranda') }}</a>
                <a href="{{ route('itinerary.index') }}" class="block px-3 py-3 rounded-md text-base font-bold text-gray-900 hover:text-amber-600 hover:bg-gray-50">{{ __('Paket Perjalanan') }}</a>
                <a href="{{ route('umkm.index') }}" class="block px-3 py-3 rounded-md text-base font-bold text-gray-900 hover:text-amber-600 hover:bg-gray-50">{{ __('Direktori UMKM') }}</a>
                <a href="{{ route('gallery.index') }}" class="block px-3 py-3 rounded-md text-base font-bold text-gray-900 hover:text-amber-600 hover:bg-gray-50">{{ __('Galeri') }}</a>
            </div>
        </div>
    </nav>

    <main class="flex-grow w-full">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white mt-auto py-10">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="font-semibold text-gray-400">&copy; {{ date('Y') }} Platform Pariwisata & UMKM Sumba Barat Daya.</p>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            if (btn && menu) {
                btn.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>

</html>