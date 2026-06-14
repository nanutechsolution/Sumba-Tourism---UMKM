@extends('layouts.frontend')

@section('content')
<!-- 1. PREMIUM HERO SECTION -->
<section class="relative w-full h-[60vh] lg:h-[70vh] bg-brand-50 overflow-hidden mt-16 md:mt-20">
    <img src="{{ $destination->thumbnail ? asset('storage/'.$destination->thumbnail) : 'https://placehold.co/1920x1080/eeeeee/999999' }}"
        alt="{{ $destination->name }}"
        class="w-full h-full object-cover">
    <div class="absolute inset-0 bg-gradient-to-t from-brand-950 via-brand-950/50 to-transparent"></div>

    <div class="absolute bottom-0 w-full">
        <div class="max-w-[90rem] mx-auto px-6 pb-12 md:pb-16">
            <span class="inline-block bg-brand-500 text-white text-xs font-bold px-4 py-2 rounded-full uppercase tracking-wider mb-4 shadow-lg shadow-brand-500/20">
                Desa {{ $destination->village->name ?? 'SBD' }}
            </span>
            <h1 class="font-serif text-4xl md:text-6xl lg:text-7xl font-bold text-white tracking-tight leading-tight mb-4 drop-shadow-md">
                {{ $destination->name }}
            </h1>
            <div class="flex items-center gap-4 text-white/90 font-sans">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-brand-500 mr-1" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                    </svg>
                    <span class="font-bold">{{ number_format($destination->reviews->avg('rating') ?? 5.0, 1) }}</span>
                    <span class="ml-1 text-gray-300">({{ $destination->reviews->count() }} Ulasan)</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Notifikasi Sukses -->
@if(session('success'))
<div class="max-w-[90rem] mx-auto px-6 mt-8">
    <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl font-sans font-medium shadow-sm flex items-center">
        <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        {{ session('success') }}
    </div>
</div>
@endif

<!-- 2. MAIN CONTENT LAYOUT -->
<section class="max-w-[90rem] mx-auto px-6 py-12 md:py-16">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16">

        <!-- LEFT COLUMN: Cerita & Informasi -->
        <div class="lg:col-span-2 space-y-16">

            <!-- Deskripsi Umum -->
            <div>
                <h2 class="font-serif text-2xl md:text-3xl font-bold text-brand-900 mb-6">Mengenai Tempat Ini</h2>
                <div class="prose prose-lg text-gray-600 font-sans max-w-none leading-relaxed prose-a:text-brand-500">
                    {!! $destination->description !!}
                </div>
            </div>

            <!-- STORY OF SUMBA (Bento Grid Style) -->
            @if($destination->history || $destination->culture || $destination->myth || $destination->tradition)
            <div class="pt-10 border-t border-gray-200/60">
                <h2 class="font-serif text-2xl md:text-3xl font-bold text-brand-900 mb-2">Story of Sumba</h2>
                <p class="text-gray-500 font-sans mb-8">Kekayaan tak benda di balik pesona alam.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if($destination->history)
                    <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-luxury">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="font-serif text-xl font-bold text-brand-900 mb-3">Sejarah Singkat</h4>
                        <div class="prose prose-sm text-gray-600 font-sans">{!! $destination->history !!}</div>
                    </div>
                    @endif

                    @if($destination->culture)
                    <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-luxury">
                        <div class="w-12 h-12 bg-brand-50 text-brand-500 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h4 class="font-serif text-xl font-bold text-brand-900 mb-3">Nilai Budaya</h4>
                        <div class="prose prose-sm text-gray-600 font-sans">{!! $destination->culture !!}</div>
                    </div>
                    @endif

                    @if($destination->myth)
                    <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-luxury">
                        <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        <h4 class="font-serif text-xl font-bold text-brand-900 mb-3">Mitos & Legenda</h4>
                        <div class="prose prose-sm text-gray-600 font-sans">{!! $destination->myth !!}</div>
                    </div>
                    @endif

                    @if($destination->tradition)
                    <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-luxury">
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <h4 class="font-serif text-xl font-bold text-brand-900 mb-3">Tradisi & Ritual</h4>
                        <div class="prose prose-sm text-gray-600 font-sans">{!! $destination->tradition !!}</div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

            <!-- Galeri Masonry -->
            @if($destination->gallery && is_array($destination->gallery) && count($destination->gallery) > 0)
            <div class="pt-10 border-t border-gray-200/60">
                <h2 class="font-serif text-2xl md:text-3xl font-bold text-brand-900 mb-8">Galeri Visual</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($destination->gallery as $image)
                    <div class="relative aspect-square rounded-2xl overflow-hidden shadow-sm group cursor-pointer">
                        <img src="{{ asset('storage/'.$image) }}" alt="Gallery" class="w-full h-full object-cover img-hover-zoom">
                        <div class="absolute inset-0 bg-brand-950/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- 360 Virtual Tour -->
            @if($destination->panorama_image)
            <div class="pt-10 border-t border-gray-200/60">
                <h2 class="font-serif text-2xl md:text-3xl font-bold text-brand-900 mb-6">360° Virtual Tour</h2>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css" />
                <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>

                <div class="relative w-full aspect-video md:aspect-[21/9] rounded-[2rem] overflow-hidden shadow-luxury border border-gray-100">
                    <div id="panorama" class="w-full h-full"></div>
                </div>
                <p class="text-xs text-gray-500 font-sans mt-4 text-center">Tahan dan geser gambar untuk melihat sekeliling. Gunakan scroll untuk Zoom.</p>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        pannellum.viewer('panorama', {
                            "type": "equirectangular",
                            "panorama": "{{ asset('storage/'.$destination->panorama_image) }}",
                            "autoLoad": true,
                            "compass": true
                        });
                    });
                </script>
            </div>
            @endif

            <!-- Golden Hour Guide -->
            @if(isset($goldenHour) && $goldenHour)
            <div class="pt-10 border-t border-gray-200/60">
                <h2 class="font-serif text-2xl md:text-3xl font-bold text-brand-900 mb-2">Panduan Fotografi</h2>
                <p class="text-gray-500 font-sans mb-8">Jadwal golden hour akurat untuk menangkap momen terbaik.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
                    <div class="bg-gradient-to-br from-brand-50 to-brand-100/50 p-6 rounded-[2rem] border border-brand-100 flex flex-col justify-center">
                        <span class="text-xs font-bold text-brand-600 uppercase tracking-widest mb-1">Sunrise Golden Hour</span>
                        <span class="font-serif text-3xl font-black text-brand-900">{{ $goldenHour['morning_start'] }} - {{ $goldenHour['morning_end'] }}</span>
                    </div>
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100/50 p-6 rounded-[2rem] border border-gray-200 flex flex-col justify-center">
                        <span class="text-xs font-bold text-brand-800 uppercase tracking-widest mb-1">Sunset Golden Hour</span>
                        <span class="font-serif text-3xl font-black text-brand-900">{{ $goldenHour['evening_start'] }} - {{ $goldenHour['evening_end'] }}</span>
                    </div>
                </div>

                @if($destination->photo_spots && count($destination->photo_spots) > 0)
                <h4 class="font-serif font-bold text-lg text-brand-900 mb-4">Spot Pengambilan Gambar:</h4>
                <div class="space-y-4">
                    @foreach($destination->photo_spots as $spot)
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm">
                        <h5 class="font-serif font-bold text-brand-900 text-lg mb-1">{{ $spot['spot_name'] }}</h5>
                        <p class="text-xs font-bold text-brand-500 uppercase mb-3">{{ $spot['best_moment'] }}</p>
                        <p class="text-sm text-gray-600 font-sans leading-relaxed">{{ $spot['angle_tip'] }}</p>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            @endif

            <!-- Ulasan Pengunjung -->
            <div class="pt-10 border-t border-gray-200/60">
                <h2 class="font-serif text-2xl md:text-3xl font-bold text-brand-900 mb-8">Ulasan Pengunjung ({{ $destination->reviews->count() }})</h2>

                <div class="space-y-6 mb-12">
                    @forelse($destination->reviews as $review)
                    <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm">
                        <div class="flex justify-between items-start mb-3">
                            <h4 class="font-serif font-bold text-brand-900">{{ $review->reviewer_name }}</h4>
                            <span class="text-xs text-gray-400 font-sans">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex text-brand-500 mb-4">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4" fill="{{ $i < $review->rating ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                @endfor
                        </div>
                        <p class="text-gray-600 font-sans text-sm leading-relaxed">{{ $review->comment }}</p>
                    </div>
                    @empty
                    <p class="text-gray-500 font-sans italic">Belum ada ulasan untuk destinasi ini.</p>
                    @endforelse
                </div>

                <!-- Form Ulasan Premium -->
                <div class="bg-brand-900 rounded-[2rem] p-8 md:p-10 shadow-luxury">
                    <h3 class="font-serif text-xl font-bold text-white mb-6">Bagikan Pengalaman Anda</h3>
                    <form action="{{ route('review.store', $destination->id) }}" method="POST">
                        @csrf
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-brand-100 mb-2 font-sans">Nama Anda</label>
                            <input type="text" name="reviewer_name" required class="w-full rounded-xl border-none focus:ring-2 focus:ring-brand-500 bg-white/10 text-white placeholder-white/40 px-5 py-3.5 font-sans" placeholder="Nama lengkap">
                        </div>
                        <div class="mb-5">
                            <label class="block text-sm font-medium text-brand-100 mb-2 font-sans">Penilaian</label>
                            <select name="rating" required class="w-full rounded-xl border-none focus:ring-2 focus:ring-brand-500 bg-white/10 text-white px-5 py-3.5 font-sans [&>option]:text-brand-900">
                                <option value="5">5 Bintang - Luar Biasa</option>
                                <option value="4">4 Bintang - Sangat Bagus</option>
                                <option value="3">3 Bintang - Cukup</option>
                                <option value="2">2 Bintang - Kurang</option>
                                <option value="1">1 Bintang - Sangat Kurang</option>
                            </select>
                        </div>
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-brand-100 mb-2 font-sans">Komentar</label>
                            <textarea name="comment" rows="3" required class="w-full rounded-xl border-none focus:ring-2 focus:ring-brand-500 bg-white/10 text-white placeholder-white/40 px-5 py-3.5 font-sans" placeholder="Ceritakan momen terbaik Anda..."></textarea>
                        </div>
                        <button type="submit" class="bg-brand-500 text-white font-sans font-medium py-3.5 px-8 rounded-full hover:bg-brand-600 transition duration-300 shadow-lg shadow-brand-500/30 w-full sm:w-auto">
                            Kirim Ulasan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: Sticky Sidebar (Map, Weather, UMKM) -->
        <div class="lg:col-span-1 space-y-8">

            <!-- Widget Cuaca Real-Time -->
            @if(isset($weather) && $weather)
            <div class="bg-white rounded-[2rem] shadow-luxury border border-gray-100 p-8">
                <h3 class="font-serif text-lg font-bold text-brand-900 mb-6 flex items-center">
                    Cuaca Saat Ini
                </h3>
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <div class="font-serif text-5xl font-black text-brand-900 leading-none">
                            {{ round($weather['main']['temp']) }}°
                        </div>
                        <div class="text-sm font-bold text-brand-500 uppercase tracking-wider mt-2">
                            {{ $weather['weather'][0]['description'] }}
                        </div>
                    </div>
                    <div class="w-20 h-20 flex items-center justify-center">
                        <img src="https://openweathermap.org/img/wn/{{ $weather['weather'][0]['icon'] }}@2x.png" class="w-full h-full scale-125 opacity-80" alt="Weather">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 pt-6 border-t border-gray-100">
                    <div>
                        <span class="block text-[10px] font-bold text-gray-400 uppercase">Kelembapan</span>
                        <span class="font-sans font-bold text-brand-900 text-lg">{{ $weather['main']['humidity'] }}%</span>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-gray-400 uppercase">Angin</span>
                        <span class="font-sans font-bold text-brand-900 text-lg">{{ round($weather['wind']['speed'], 1) }} m/s</span>
                    </div>
                </div>
            </div>
            @endif

            <!-- Informasi Lokasi & Peta Mini -->
            <div class="bg-white rounded-[2rem] shadow-luxury border border-gray-100 p-8 sticky top-28">
                <h3 class="font-serif text-lg font-bold text-brand-900 mb-6">Lokasi</h3>

                <ul class="space-y-4 text-sm font-sans text-gray-600 mb-6">
                    <li class="flex flex-col">
                        <span class="font-bold text-gray-400 uppercase text-[10px] tracking-widest mb-1">Kecamatan</span>
                        <span class="font-medium text-brand-900">{{ $destination->village->district->name ?? '-' }}</span>
                    </li>
                    <li class="flex flex-col">
                        <span class="font-bold text-gray-400 uppercase text-[10px] tracking-widest mb-1">Desa</span>
                        <span class="font-medium text-brand-900">{{ $destination->village->name ?? '-' }}</span>
                    </li>
                </ul>

                @if($destination->latitude && $destination->longitude)
                <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-sm aspect-video mb-6 relative z-10">
                    <div id="mini-map" class="w-full h-full"></div>
                </div>

                <a href="https://www.google.com/maps/dir/?api=1&destination={{ $destination->latitude }},{{ $destination->longitude }}"
                    target="_blank"
                    class="w-full flex items-center justify-center bg-brand-500 text-white font-sans font-medium py-3.5 rounded-full hover:bg-brand-600 transition shadow-md shadow-brand-500/20 mb-2">
                    Arahkan via Maps
                </a>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Diperbaiki format spasinya agar Javascript tidak error
                        const destLat = {{ (float) $destination->latitude }};
                        const destLng = {{ (float) $destination->longitude }};

                        var miniMap = L.map('mini-map', {
                            zoomControl: false
                        }).setView([destLat, destLng], 14);
                        
                        L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png').addTo(miniMap);

                        var destIcon = L.divIcon({
                            className: 'bg-transparent border-none',
                            html: `<div class="w-6 h-6 bg-brand-500 text-white rounded-full shadow-lg border-2 border-white"></div>`,
                            iconSize: [24, 24]
                        });

                        L.marker([destLat, destLng], {
                            icon: destIcon
                        }).addTo(miniMap);
                    });
                </script>
                @endif
            </div>

            <!-- LBS: UMKM Terdekat -->
            @if(isset($nearbyUmkms) && $nearbyUmkms->count() > 0)
            <div class="bg-brand-900 text-white rounded-[2rem] shadow-luxury p-8 relative overflow-hidden">
                <!-- Elemen Dekoratif agar tidak terlalu polos -->
                <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-brand-500/20 blur-2xl"></div>
                
                <h3 class="font-serif text-lg font-bold mb-6 relative z-10 text-white">UMKM Terdekat</h3>
                <div class="space-y-4 relative z-10">
                    @foreach($nearbyUmkms as $umkm)
                    <a href="{{ route('umkm.show', $umkm->slug) }}" class="flex items-center gap-4 bg-white/5 border border-white/10 hover:bg-white/10 p-3 rounded-2xl transition group">
                        <img src="{{ $umkm->thumbnail ? asset('storage/'.$umkm->thumbnail) : 'https://placehold.co/100' }}" class="w-14 h-14 rounded-xl object-cover">
                        <div>
                            <h4 class="font-sans font-medium text-sm leading-tight line-clamp-1 group-hover:text-brand-500 transition-colors">{{ $umkm->name }}</h4>
                            <p class="text-xs font-sans text-gray-400 mt-1">{{ $umkm->distance_km }} KM</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</section>
@endsection