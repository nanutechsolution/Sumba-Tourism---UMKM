@extends('layouts.frontend')

@section('content')
<!-- Banner Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10 mb-16">
    <div class="bg-amber-50 border-4 border-amber-500 p-10 md:p-16 rounded-2xl shadow-xl text-center">
        <h1 class="text-4xl md:text-6xl font-black text-gray-900 tracking-tight uppercase leading-tight mb-6">
            {{ __('Jelajahi Pesona') }} <br><span class="text-amber-600">Sumba Barat Daya</span>
        </h1>
        <p class="text-lg md:text-2xl text-gray-700 font-medium mb-10 max-w-3xl mx-auto">
            Platform Pintar untuk menemukan keindahan destinasi wisata, budaya autentik, dan karya UMKM lokal terbaik dari Tambolaka hingga penjuru Sumba.
        </p>
        <a href="#destinasi" class="inline-block bg-gray-900 text-white font-extrabold uppercase tracking-wide py-4 px-10 rounded-full border-4 border-gray-900 hover:bg-amber-500 hover:border-amber-500 hover:text-gray-900 transition-all duration-300 shadow-lg">
           {{ __('Mulai Eksplorasi') }}
        </a>
    </div>
</section>

<!-- Destinasi Grid Section -->
<section id="destinasi" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
    <div class="flex items-center justify-between mb-10">
        <h2 class="text-3xl font-black text-gray-900 border-l-8 border-amber-500 pl-4 uppercase">{{ __('Destinasi Populer') }}</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($destinations as $dest)
        <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden border border-gray-100 flex flex-col group">
            <div class="relative h-56 overflow-hidden">
                <img src="{{ $dest->thumbnail ? asset('storage/'.$dest->thumbnail) : 'https://placehold.co/600x400/eeeeee/999999?text=Gambar+Wisata' }}"
                    alt="{{ $dest->name }}"
                    class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                <div class="absolute top-4 left-4 bg-amber-500 text-gray-900 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider shadow-sm">
                    Desa {{ $dest->village->name ?? 'SBD' }}
                </div>
            </div>
            <div class="p-6 flex flex-col flex-grow">
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $dest->name }}</h3>
                <p class="text-gray-600 text-sm mb-6 flex-grow leading-relaxed">
                    {{ Str::limit(strip_tags($dest->description), 110, '...') }}
                </p>
                <a href="{{ route('destination.show', $dest->slug) }}" class="block text-center w-full bg-gray-100 text-gray-900 font-bold py-3 rounded-xl hover:bg-amber-100 transition">
                    {{ __('Lihat Detail') }}
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-20 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-300">
            <p class="text-gray-500 font-medium text-lg">Belum ada data destinasi yang dipublikasikan.</p>
        </div>
        @endforelse
    </div>
</section>

<!-- NEW FITUR: Peta Interaktif Utama -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
    <div class="bg-white rounded-3xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="p-8 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h2 class="text-2xl font-black text-gray-900 uppercase">Jelajahi Lewat Peta</h2>
                <p class="text-gray-500 font-medium">Temukan destinasi wisata (Biru) dan UMKM lokal (Kuning) di seluruh penjuru SBD.</p>
            </div>
        </div>

        <!-- Kontainer Peta -->
        <div id="main-map" class="w-full h-[500px] z-10"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Koordinat tengah Sumba Barat Daya (Tambolaka)
            var map = L.map('main-map').setView([-9.4124, 119.2435], 11);

            // Load layer peta dari OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Custom Icon Destinasi (Biru)
            var destIcon = L.divIcon({
                className: 'leaflet-custom-icon',
                html: `<svg class="w-8 h-8 text-blue-600 drop-shadow-md" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>`,
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });

            // Custom Icon UMKM (Kuning/Amber)
            var umkmIcon = L.divIcon({
                className: 'leaflet-custom-icon',
                html: `<svg class="w-8 h-8 text-amber-500 drop-shadow-md" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>`,
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            });

            // Data Destinasi dari Laravel Backend
            var destinations = @json($mapDestinations);
            destinations.forEach(function(dest) {
                var marker = L.marker([dest.latitude, dest.longitude], {
                    icon: destIcon
                }).addTo(map);
                marker.bindPopup(`<b>${dest.name}</b><br><a href="/destinasi/${dest.slug}" class="text-blue-600 font-bold hover:underline">Lihat Detail</a>`);
            });

            // Data UMKM dari Laravel Backend
            var umkms = @json($mapUmkms);
            umkms.forEach(function(umkm) {
                var marker = L.marker([umkm.latitude, umkm.longitude], {
                    icon: umkmIcon
                }).addTo(map);
                marker.bindPopup(`<b>${umkm.name}</b><br><span class="text-xs text-gray-500">${umkm.category}</span><br><a href="/umkm/${umkm.slug}" class="text-amber-600 font-bold hover:underline">Lihat Profil</a>`);
            });
        });
    </script>
</section>

<!-- Agenda & Berita Section (Sama seperti sebelumnya) -->
<section class="bg-gray-900 py-20 mt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
            <!-- Kolom Kiri: Agenda Event -->
            <div class="lg:col-span-1">
                <h2 class="text-2xl font-black text-white border-l-8 border-amber-500 pl-4 uppercase mb-8">Agenda Terdekat</h2>

                <div class="space-y-6">
                    @forelse($events as $event)
                    <div class="bg-gray-800 rounded-xl p-5 border border-gray-700 hover:border-amber-500 transition group flex items-start">
                        <div class="bg-gray-900 text-center rounded-lg min-w-[70px] py-2 px-3 border border-gray-700 mr-4 group-hover:bg-amber-500 group-hover:border-amber-500 transition">
                            <span class="block text-2xl font-black text-white group-hover:text-gray-900">{{ \Carbon\Carbon::parse($event->start_date)->format('d') }}</span>
                            <span class="block text-xs font-bold text-gray-400 uppercase group-hover:text-gray-900">{{ \Carbon\Carbon::parse($event->start_date)->format('M Y') }}</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-white mb-1 leading-tight group-hover:text-amber-400 transition">{{ $event->name }}</h3>
                            <p class="text-sm text-gray-400 flex items-center">
                                <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                {{ $event->location_name ?? 'Desa ' . ($event->village->name ?? 'SBD') }}
                            </p>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-400 font-medium">Belum ada agenda pariwisata terdekat.</p>
                    @endforelse
                </div>
            </div>

            <!-- Kolom Kanan: Artikel & Berita -->
            <div class="lg:col-span-2">
                <h2 class="text-2xl font-black text-white border-l-8 border-amber-500 pl-4 uppercase mb-8">Kabar Pariwisata</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($news as $article)
                    <div class="bg-gray-800 rounded-xl overflow-hidden border border-gray-700 group cursor-pointer hover:border-amber-500 transition">
                        <div class="h-40 overflow-hidden relative">
                            <img src="{{ $article->thumbnail ? asset('storage/'.$article->thumbnail) : 'https://placehold.co/600x400/222222/999999?text=Berita' }}"
                                alt="{{ $article->title }}"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500 opacity-80 group-hover:opacity-100">
                            <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-gray-900 to-transparent">
                                <span class="text-xs font-bold text-amber-500 uppercase tracking-wider">
                                    {{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-white mb-3 line-clamp-2 leading-tight group-hover:text-amber-400 transition">{{ $article->title }}</h3>
                            <p class="text-sm text-gray-400 line-clamp-3">
                                {{ Str::limit(strip_tags($article->content), 120, '...') }}
                            </p>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-10 bg-gray-800 rounded-xl border border-gray-700 text-center">
                        <p class="text-gray-400 font-medium">Belum ada publikasi berita terbaru.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection