@extends('layouts.frontend')

@section('content')
    <!-- 1. HEADER SECTION -->
    <section class="pt-32 pb-16 lg:pt-48 lg:pb-24 px-6 relative overflow-hidden bg-[#FDFBF7]">
        <div class="max-w-7xl mx-auto relative z-10 text-center">
            <span class="inline-block bg-savanna/10 text-savanna text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-wider mb-4 border border-savanna/20">
                Curated Routes
            </span>
            <h1 class="font-heading text-4xl md:text-6xl font-bold text-ocean tracking-tight leading-tight mb-6">
                Paket <span class="text-savanna italic font-serif">Perjalanan</span>
            </h1>
            <p class="text-gray-500 text-lg md:text-xl font-body max-w-2xl mx-auto leading-relaxed">
                Rute wisata yang dirancang khusus untuk memberikan pengalaman liburan tak terlupakan di Sumba Barat Daya, mulai dari pantai hingga kampung adat.
            </p>
        </div>
    </section>

    <!-- 2. CARDS SECTION -->
    <section class="max-w-7xl mx-auto px-6 py-10 mb-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($itineraries as $itinerary)
                <a href="{{ route('itinerary.show', $itinerary->slug) }}" class="group flex flex-col bg-white rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-premium transition-all duration-500 overflow-hidden">
                    <div class="relative w-full aspect-[4/3] overflow-hidden bg-gray-50">
                        <img src="{{ $itinerary->thumbnail ? asset('storage/'.$itinerary->thumbnail) : 'https://placehold.co/600x400' }}" 
                             alt="{{ $itinerary->name }}" 
                             class="w-full h-full object-cover img-hover-zoom">
                        <div class="absolute inset-0 bg-gradient-to-t from-ocean/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-ocean font-heading font-bold px-4 py-2 rounded-full shadow-md text-sm flex items-center">
                            <svg class="w-4 h-4 mr-1 text-savanna" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $itinerary->total_days }} Hari
                        </div>
                    </div>
                    <div class="p-8 flex flex-col flex-grow">
                        <h3 class="font-heading font-bold text-2xl text-ocean mb-3 leading-tight group-hover:text-savanna transition">{{ $itinerary->name }}</h3>
                        <p class="text-sm text-gray-500 font-body mb-6 line-clamp-3 leading-relaxed flex-grow">
                            {{ Str::limit(strip_tags($itinerary->description), 120) }}
                        </p>
                        <div class="flex items-center text-sm font-bold text-ocean uppercase tracking-wider group-hover:text-savanna transition">
                            Lihat Detail Rute 
                            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-24 text-center bg-white rounded-[2.5rem] border border-gray-100 shadow-sm">
                    <p class="text-gray-500 font-body text-lg">Belum ada paket perjalanan yang tersedia.</p>
                </div>
            @endforelse
        </div>
        
        <div class="mt-16 font-body">
            {{ $itineraries->links() }}
        </div>
    </section>
@endsection