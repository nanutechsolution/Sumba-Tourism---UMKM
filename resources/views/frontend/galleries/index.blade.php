@extends('layouts.frontend')

@section('content')
    <section class="bg-gray-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tight mb-4">Galeri Pesona Sumba</h1>
            <p class="text-lg text-gray-400 font-medium max-w-2xl mx-auto">Bingkai keindahan alam, kekayaan budaya, dan momen tak terlupakan di Sumba Barat Daya melalui lensa kamera.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        
        <!-- CSS Masonry Grid -->
        <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-6 space-y-6">
            @forelse($galleries as $gallery)
                <div class="break-inside-avoid relative rounded-2xl overflow-hidden group shadow-sm hover:shadow-xl transition duration-500">
                    <img src="{{ asset('storage/'.$gallery->image_path) }}" 
                         alt="{{ $gallery->title }}" 
                         class="w-full h-auto object-cover transform group-hover:scale-105 transition duration-700">
                    
                    <!-- Overlay Muncul Saat Hover -->
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end p-5">
                        <span class="text-amber-500 text-xs font-black uppercase tracking-wider mb-1">{{ $gallery->category }}</span>
                        <h3 class="text-white font-bold text-lg leading-tight drop-shadow-md">{{ $gallery->title }}</h3>
                    </div>
                </div>
            @empty
                <div class="col-span-full w-full text-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-300 inline-block">
                    <p class="text-gray-500 font-medium text-lg">Belum ada foto di dalam galeri publik.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-16">
            {{ $galleries->links() }}
        </div>
    </section>
@endsection