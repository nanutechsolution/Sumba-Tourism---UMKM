@extends('layouts.frontend')

@section('content')
    <!-- 1. MAGAZINE EDITORIAL HEADER -->
    <section class="pt-36 pb-16 lg:pt-48 lg:pb-20 px-6 relative bg-brand-50 overflow-hidden">
        <!-- Elegant Decorative Accents -->
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-brand-500/5 rounded-full blur-[140px] pointer-events-none" aria-hidden="true"></div>
        <div class="absolute -left-20 top-20 w-96 h-96 bg-brand-900/5 rounded-full blur-[120px] pointer-events-none" aria-hidden="true"></div>
        
        <!-- Luxury Framing Border -->
        <div class="absolute inset-x-8 top-24 bottom-0 border border-brand-500/10 pointer-events-none hidden lg:block" aria-hidden="true"></div>

        <div class="max-w-6xl mx-auto relative z-10 text-center">
            <span class="inline-flex items-center gap-2 bg-brand-900 text-brand-100 text-[10px] font-bold tracking-[0.3em] uppercase px-5 py-2 rounded-full mb-6 border border-brand-500/20 shadow-lg shadow-brand-950/10">
                <span class="w-1.5 h-1.5 rounded-full bg-brand-500 animate-pulse"></span>
                Support Local
            </span>
            
            <h1 class="font-serif text-5xl md:text-7xl lg:text-8xl font-medium text-brand-900 tracking-tight leading-none mb-6">
                Karya <span class="text-brand-500 italic font-light font-serif">Lokal</span>
            </h1>
            
            <div class="w-12 h-[2px] bg-brand-500 mx-auto mb-8"></div>
            
            <p class="text-gray-500 text-lg md:text-xl font-sans max-w-2xl mx-auto leading-relaxed font-light mb-10">
                Temukan kerajinan tenun asli, kopi Sumba pilihan, hingga kuliner otentik langsung dari tangan para pembuatnya di penjuru Sumba Barat Daya.
            </p>
        </div>
    </section>

    <!-- 2. UMKM MAIN DIRECTORY -->
    <section class="max-w-7xl mx-auto px-6 pb-24 relative z-10">
        
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl mb-12 font-sans font-medium shadow-sm flex items-center justify-center text-center">
                <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        <div class="border-b border-brand-500/20 pb-4 mb-8 flex items-center gap-3">
            <span class="text-xs font-bold tracking-[0.2em] text-brand-500 uppercase">DIREKTORI PRODUK & JASA</span>
            <div class="h-px bg-brand-500/20 flex-grow"></div>
        </div>

        @if($umkms->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 lg:gap-8">
                @foreach($umkms as $umkm)
                    <a href="{{ route('umkm.show', $umkm->slug) }}" class="group flex flex-col bg-white rounded-[2.25rem] border border-gray-100/80 shadow-sm hover:shadow-luxury transition-all duration-500 overflow-hidden relative">
                        <!-- NatGeo Yellow/Gold Accent Border on top of card -->
                        <div class="absolute top-0 inset-x-0 h-1 bg-transparent group-hover:bg-brand-500 transition-colors duration-500 z-30"></div>

                        <!-- Image Frame (Square Aspect for Products) -->
                        <div class="relative w-full p-2 md:p-3">
                            <div class="w-full aspect-square overflow-hidden rounded-[1.6rem] relative bg-gray-50 border border-gray-100/50">
                                <img src="{{ $umkm->thumbnail ? asset('storage/'.$umkm->thumbnail) : 'https://placehold.co/600x600/eeeeee/999999?text=Produk+Lokal' }}" 
                                     alt="{{ $umkm->name }}" 
                                     class="w-full h-full object-cover img-hover-zoom duration-1000">
                                <div class="absolute inset-0 bg-gradient-to-t from-brand-950/40 via-transparent to-transparent opacity-60"></div>
                                
                                <!-- Category Badge inside Image -->
                                <div class="absolute top-4 left-4">
                                    <span class="bg-white/95 backdrop-blur-sm text-brand-900 text-[10px] font-bold px-3 py-1.5 rounded-full shadow-sm uppercase tracking-widest">
                                        {{ $umkm->category }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card Body -->
                        <div class="px-6 pb-6 pt-2 flex flex-col flex-grow justify-between">
                            <div class="mb-4">
                                <h3 class="font-serif font-bold text-lg text-brand-900 mb-2 leading-tight group-hover:text-brand-500 transition-colors duration-300 truncate">
                                    {{ $umkm->name }}
                                </h3>
                                <p class="text-xs text-gray-500 font-sans flex items-center">
                                    <svg class="w-3.5 h-3.5 mr-1.5 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path></svg>
                                    Desa {{ $umkm->village->name ?? 'Sumba Barat Daya' }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                                <span class="inline-flex items-center text-[11px] font-bold text-brand-900 uppercase tracking-wider group-hover:text-brand-500 transition-colors">
                                    Lihat Profil
                                    <svg class="w-3 h-3 ml-1.5 transform group-hover:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($umkms->hasPages())
                <div class="mt-20 font-sans flex justify-center border-t border-gray-100 pt-12">
                    {{ $umkms->links() }}
                </div>
            @endif
        @else
            <!-- EMPTY STATE -->
            <div class="py-24 text-center bg-white rounded-[2.5rem] border border-gray-100 shadow-sm">
                <div class="w-20 h-20 bg-brand-50 rounded-full flex items-center justify-center mx-auto mb-6 border border-brand-500/10">
                    <svg class="w-10 h-10 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="font-serif font-bold text-xl text-brand-900 mb-2">Belum Ada UMKM Terdaftar</h3>
                <p class="text-gray-500 font-sans max-w-sm mx-auto text-sm leading-relaxed mb-8">Direktori produk dan kerajinan lokal saat ini masih kosong. Jadilah yang pertama mempromosikan karya Anda.</p>
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center bg-brand-900 text-white font-serif font-bold py-3.5 px-8 rounded-full hover:bg-brand-800 transition shadow-lg shadow-brand-950/10">
                    Kembali ke Beranda
                </a>
            </div>
        @endif
    </section>

    <!-- 3. CALL TO ACTION: DAFTARKAN UMKM -->
    <section class="max-w-7xl mx-auto px-6 pb-24 relative z-10">
        <div class="bg-gradient-to-br from-brand-900 to-brand-950 rounded-[2.5rem] p-10 md:p-16 text-center relative overflow-hidden shadow-luxury">
            <!-- Decorative Patterns -->
            <svg class="absolute top-0 right-0 w-80 h-80 text-white/5 -mt-24 -mr-24" fill="currentColor" viewBox="0 0 100 100" aria-hidden="true"><circle cx="50" cy="50" r="50"/></svg>
            <svg class="absolute bottom-0 left-0 w-48 h-48 text-white/5 -mb-12 -ml-12" fill="currentColor" viewBox="0 0 100 100" aria-hidden="true"><circle cx="50" cy="50" r="50"/></svg>
            
            <div class="relative z-10 max-w-2xl mx-auto">
                <span class="text-brand-500 font-bold tracking-[0.2em] uppercase text-xs mb-3 block">BAGAIMANA DENGAN ANDA?</span>
                <h2 class="font-serif font-black  text-3xl md:text-5xl mb-6 tracking-tight leading-tight">Perluas Jangkauan Pasar Anda</h2>
                <p class=" font-sans text-sm md:text-base mb-8 leading-relaxed font-light">
                    Memiliki usaha kerajinan tenun, kuliner khas, atau jasa lokal di Sumba Barat Daya? Daftarkan usaha Anda di platform kami agar lebih mudah ditemukan oleh wisatawan.
                </p>
                <!-- Tombol (Ganti route pendaftaran dengan route yang sesuai jika sudah ada) -->
                <a href="{{ route('home') }}" class="inline-flex items-center bg-brand-500 text-white font-serif font-bold py-4 px-10 rounded-full hover:bg-white hover:text-brand-900 transition duration-300 shadow-xl group">
                    <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Daftarkan Usaha Anda
                </a>
            </div>
        </div>
    </section>
@endsection