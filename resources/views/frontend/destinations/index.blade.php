@extends('layouts.frontend')

@section('content')
    <section class="pt-32 pb-12 lg:pt-48 lg:pb-16 px-6 relative bg-brand-50/30">
        <div class="absolute top-0 right-0 w-64 h-64 bg-brand-500/5 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-10 w-40 h-40 bg-brand-900/5 rounded-full blur-2xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto text-center relative z-10">
            <span class="inline-block bg-brand-500/10 text-brand-600 text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-wider mb-4 border border-brand-500/20">
                Eksplorasi SBD
            </span>
            <h1 class="font-serif text-4xl md:text-6xl lg:text-7xl font-bold text-brand-900 tracking-tight leading-tight mb-6">
                Direktori <span class="text-brand-500 italic">Destinasi</span>
            </h1>
            <p class="text-gray-500 text-lg md:text-xl font-sans max-w-2xl mx-auto leading-relaxed">
                Temukan surga tersembunyi, pantai eksotis, dan kampung adat yang tersebar di seluruh penjuru Sumba Barat Daya.
            </p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-10 mb-20 relative z-20">
        
        <div class="flex flex-col sm:flex-row justify-between items-center mb-10 pb-6 border-b border-gray-100">
            <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4 sm:mb-0 font-sans">
                Menampilkan {{ $destinations->firstItem() ?? 0 }}-{{ $destinations->lastItem() ?? 0 }} dari {{ $destinations->total() }} Lokasi
            </p>
            
            <div class="flex items-center gap-2">
                <a href="{{ route('planner.index') }}" class="inline-flex items-center text-sm font-bold text-brand-900 hover:text-brand-500 transition bg-white px-4 py-2 rounded-full border border-gray-200 shadow-sm font-sans">
                    <svg class="w-4 h-4 mr-2 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Gunakan AI Planner
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 lg:gap-10 gap-6">
            @forelse($destinations as $dest)
                <a href="{{ route('destination.show', $dest->slug) }}" class="group block cursor-pointer">
                    <div class="relative w-full aspect-[4/5] rounded-[2.5rem] overflow-hidden mb-5 bg-gray-100 shadow-sm border border-gray-100">
                        <img src="{{ $dest->thumbnail ? asset('storage/'.$dest->thumbnail) : 'https://placehold.co/800x1000/eeeeee/999999' }}" alt="{{ $dest->name }}" class="w-full h-full object-cover img-hover-zoom">
                        <div class="absolute inset-0 bg-gradient-to-t from-brand-950/80 via-brand-950/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <div class="absolute top-5 left-5 bg-white/90 backdrop-blur-sm text-brand-900 text-[10px] font-bold px-3 py-1.5 rounded-full uppercase tracking-widest shadow-sm font-sans">
                            Desa {{ $dest->village->name ?? 'SBD' }}
                        </div>

                        <div class="absolute bottom-5 left-5 right-5 flex justify-between items-end transform translate-y-2 group-hover:translate-y-0 transition duration-300">
                            <div>
                                <h3 class="font-serif font-bold text-xl text-white mb-1 drop-shadow-md">{{ $dest->name }}</h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-start px-2">
                        <div class="pr-4">
                            <p class="text-sm text-gray-500 font-sans line-clamp-2 leading-relaxed">{{ Str::limit(strip_tags($dest->description), 80) }}</p>
                        </div>
                        <div class="flex items-center gap-1 text-sm font-bold text-brand-900 bg-gray-50 px-2.5 py-1.5 rounded-xl border border-gray-100 shrink-0 font-sans">
                            <svg class="w-4 h-4 text-brand-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                            {{ number_format($dest->reviews->avg('rating') ?? 5.0, 1) }}
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full py-24 text-center bg-white rounded-[2.5rem] border border-gray-100 shadow-sm w-full">
                    <div class="w-20 h-20 bg-brand-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <p class="text-gray-500 font-sans text-lg mb-2">Destinasi belum tersedia.</p>
                </div>
            @endforelse
        </div>
        
        @if($destinations->hasPages())
        <div class="mt-16 font-sans flex justify-center border-t border-gray-100 pt-10">
            {{ $destinations->links() }}
        </div>
        @endif
    </section>
@endsection