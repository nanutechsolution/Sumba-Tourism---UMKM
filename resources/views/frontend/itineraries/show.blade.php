@extends('layouts.frontend')

@section('content')
    <!-- 1. PREMIUM HERO SECTION -->
    <section class="relative w-full h-[50vh] lg:h-[60vh] bg-gray-100 overflow-hidden mt-20 md:mt-24">
        <img src="{{ $itinerary->thumbnail ? asset('storage/'.$itinerary->thumbnail) : 'https://placehold.co/1920x1080/eeeeee/999999' }}" 
             alt="{{ $itinerary->name }}" 
             class="w-full h-full object-cover">
        
        <div class="absolute inset-0 bg-gradient-to-t from-ocean/90 via-ocean/30 to-transparent"></div>
        
        <div class="absolute bottom-0 w-full">
            <div class="max-w-5xl mx-auto px-6 pb-12 md:pb-16 text-center">
                <span class="inline-block bg-white/20 backdrop-blur-md border border-white/30 text-white text-xs font-bold px-4 py-2 rounded-full uppercase tracking-wider mb-4">
                    Durasi: {{ $itinerary->total_days }} Hari
                </span>
                <h1 class="font-heading text-4xl md:text-5xl lg:text-6xl font-bold text-white tracking-tight leading-tight mb-6 drop-shadow-md">
                    {{ $itinerary->name }}
                </h1>
            </div>
        </div>
    </section>

    <!-- 2. MAIN CONTENT (Editorial & Timeline) -->
    <section class="max-w-4xl mx-auto px-6 py-16 md:py-20">
        <!-- Deskripsi Paket -->
        <div class="bg-white rounded-[2.5rem] p-8 md:p-12 shadow-premium border border-gray-100 mb-16 -mt-32 relative z-10">
            <div class="prose prose-lg text-gray-600 font-body max-w-none leading-relaxed text-center">
                {!! $itinerary->description !!}
            </div>
        </div>

        <div class="mb-12">
            <h2 class="font-heading text-3xl font-bold text-ocean text-center">Jadwal Perjalanan</h2>
            <p class="text-gray-500 font-body text-center mt-2">Rencana rute harian yang direkomendasikan.</p>
        </div>

        <!-- TIMELINE LAYOUT -->
        <div class="space-y-16 relative">
            <!-- Garis Vertikal Timeline (Desktop) -->
            <div class="hidden md:block absolute left-8 top-16 bottom-0 w-1 bg-gray-100 rounded-full"></div>

            @forelse($groupedDestinations as $day => $destinations)
                <div class="relative">
                    <!-- Day Header -->
                    <div class="flex items-center mb-8 relative z-10">
                        <div class="bg-savanna text-white font-heading font-black text-xl w-16 h-16 rounded-[1.25rem] flex items-center justify-center shrink-0 shadow-lg border-4 border-white">
                            H{{ $day }}
                        </div>
                        <h3 class="font-heading text-2xl font-bold text-ocean ml-6 border-b border-gray-200 pb-2 w-full">
                            Hari Ke-{{ $day }}
                        </h3>
                    </div>

                    <!-- Destination Cards List -->
                    <div class="md:pl-20 space-y-6">
                        @foreach($destinations as $index => $dest)
                            <a href="{{ route('destination.show', $dest->slug) }}" class="group flex flex-col sm:flex-row items-center gap-6 bg-white p-4 pr-6 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-premium transition duration-300">
                                
                                <!-- Urutan Angka -->
                                <div class="hidden sm:flex bg-gray-50 text-gray-400 font-heading font-bold text-lg w-12 h-12 rounded-full items-center justify-center shrink-0 ml-2">
                                    {{ $index + 1 }}
                                </div>
                                
                                <!-- Gambar Destinasi -->
                                <div class="w-full sm:w-32 h-40 sm:h-32 shrink-0 rounded-[1.5rem] overflow-hidden bg-gray-100">
                                    <img src="{{ $dest->thumbnail ? asset('storage/'.$dest->thumbnail) : 'https://placehold.co/200' }}" class="w-full h-full object-cover img-hover-zoom">
                                </div>

                                <!-- Konten Teks -->
                                <div class="flex-grow text-center sm:text-left py-2">
                                    <span class="text-[10px] font-bold text-savanna uppercase tracking-widest mb-1 block">Destinasi Terjadwal</span>
                                    <h4 class="font-heading text-xl font-bold text-ocean mb-2 group-hover:text-savanna transition">{{ $dest->name }}</h4>
                                    <p class="text-sm text-gray-500 font-body line-clamp-2 leading-relaxed">Desa {{ $dest->village->name ?? '-' }}, {{ $dest->village->district->name ?? '-' }}</p>
                                </div>

                                <!-- Panah Kanan -->
                                <div class="hidden sm:block text-gray-300 group-hover:text-savanna transition transform group-hover:translate-x-1">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-[2rem] p-10 border border-gray-100 shadow-sm text-center">
                    <p class="text-gray-500 font-body">Belum ada destinasi yang ditambahkan ke paket ini.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-20 text-center">
             <a href="{{ route('itinerary.index') }}" class="inline-block bg-white border border-gray-200 text-ocean font-heading font-bold py-3.5 px-8 rounded-full hover:bg-gray-50 transition shadow-sm">
                 &larr; Jelajahi Paket Lainnya
             </a>
        </div>
    </section>
@endsection