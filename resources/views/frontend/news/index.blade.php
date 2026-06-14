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
                Informasi & Jurnal
            </span>
            
            <h1 class="font-serif text-5xl md:text-7xl lg:text-8xl font-medium text-brand-900 tracking-tight leading-none mb-6">
                Kabar <span class="text-brand-500 italic font-light font-serif">Pariwisata</span>
            </h1>
            
            <div class="w-12 h-[2px] bg-brand-500 mx-auto mb-8"></div>
            
            <p class="text-gray-500 text-lg md:text-xl font-sans max-w-2xl mx-auto leading-relaxed font-light mb-10">
                Dapatkan informasi terkini mengenai perkembangan wisata, event budaya, dan pesona alam dari penjuru Sumba Barat Daya.
            </p>
        </div>
    </section>

    <!-- 2. NEWS MAIN SECTION -->
    <section class="max-w-7xl mx-auto px-6 pb-24 relative z-10">
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-2xl mb-12 font-sans font-medium shadow-sm flex items-center justify-center text-center">
                <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        @if($news->isNotEmpty())
            <!-- Split News: 1 Featured (on Page 1 only), Others in Grid -->
            @php
                $currentPage = request()->get('page', 1);
                $featuredNews = $news->first();
                $gridNews = $currentPage == 1 ? $news->slice(1) : $news;
            @endphp

            @if($currentPage == 1 && $featuredNews)
                <!-- FEATURED NEWS SPOTLIGHT (NatGeo Cover Style) -->
                <div class="mb-20">
                    <div class="border-b border-brand-500/20 pb-4 mb-8 flex items-center gap-3">
                        <span class="text-xs font-bold tracking-[0.2em] text-brand-500 uppercase">BERITA UTAMA</span>
                        <div class="h-px bg-brand-500/20 flex-grow"></div>
                    </div>
                    
                    <a href="{{ route('news.show', $featuredNews->slug) }}" class="group grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 bg-white rounded-[2.5rem] border border-gray-100/80 shadow-sm hover:shadow-luxury transition-all duration-700 overflow-hidden">
                        <!-- Image Container with Yellow Frame Signature -->
                        <div class="lg:col-span-7 relative aspect-[16/10] lg:aspect-auto lg:h-[500px] overflow-hidden bg-gray-50 p-3 lg:p-4">
                            <div class="w-full h-full overflow-hidden rounded-[1.8rem] relative">
                                <img src="{{ $featuredNews->thumbnail ? asset('storage/'.$featuredNews->thumbnail) : 'https://placehold.co/1200x800/eeeeee/999999?text=Kabar+Pariwisata' }}" alt="{{ $featuredNews->title }}" class="w-full h-full object-cover img-hover-zoom duration-1000">
                                <div class="absolute inset-0 bg-gradient-to-t from-brand-950/40 via-transparent to-transparent"></div>
                                <span class="absolute bottom-6 left-6 bg-white/90 backdrop-blur-sm text-brand-900 text-xs font-bold px-4 py-2 rounded-full shadow-sm uppercase tracking-widest">
                                    {{ \Carbon\Carbon::parse($featuredNews->published_at)->format('d M Y') }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Content Column -->
                        <div class="lg:col-span-5 flex flex-col justify-between p-8 lg:py-12 lg:pr-12 lg:pl-0">
                            <div>
                                <!-- Author Bio / Tag info -->
                                <div class="flex items-center gap-3 mb-6">
                                    <div class="w-8 h-8 rounded-full bg-brand-900 flex items-center justify-center text-white text-xs font-serif font-bold">
                                        {{ substr($featuredNews->user->name ?? 'A', 0, 1) }}
                                    </div>
                                    <span class="text-xs font-bold text-brand-500 uppercase tracking-widest">
                                        Oleh: {{ $featuredNews->user->name ?? 'Admin' }}
                                    </span>
                                </div>
                                
                                <h2 class="font-serif text-3xl md:text-4xl font-bold text-brand-900 group-hover:text-brand-500 transition-colors duration-300 leading-tight mb-4">
                                    {{ $featuredNews->title }}
                                </h2>
                                
                                <p class="text-gray-500 text-sm md:text-base font-sans leading-relaxed line-clamp-4 font-light mb-6">
                                    {{ strip_tags($featuredNews->content) }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between border-t border-gray-100 pt-6">
                                <span class="inline-flex items-center text-xs font-bold text-brand-900 uppercase tracking-widest group-hover:text-brand-500 transition-colors">
                                    Baca Berita Lengkap
                                    <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </span>
                                <span class="text-xs font-mono text-gray-400">
                                    @php
                                        $featuredWordCount = str_word_count(strip_tags($featuredNews->content));
                                        $featuredReadingTime = max(1, ceil($featuredWordCount / 200));
                                    @endphp
                                    {{ $featuredReadingTime }} mnt baca
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <!-- 3. MAIN NEWS GRID -->
            <div>
                <div class="border-b border-brand-500/20 pb-4 mb-8 flex items-center gap-3">
                    <span class="text-xs font-bold tracking-[0.2em] text-brand-500 uppercase">INDEKS BERITA</span>
                    <div class="h-px bg-brand-500/20 flex-grow"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10">
                    @foreach($gridNews as $article)
                        <a href="{{ route('news.show', $article->slug) }}" class="group flex flex-col bg-white rounded-[2.25rem] border border-gray-100/80 shadow-sm hover:shadow-luxury transition-all duration-500 overflow-hidden relative">
                            <!-- NatGeo Yellow/Gold Accent Border on top of card -->
                            <div class="absolute top-0 inset-x-0 h-1 bg-transparent group-hover:bg-brand-500 transition-colors duration-500 z-30"></div>

                            <!-- Image Frame -->
                            <div class="relative w-full aspect-[4/3] overflow-hidden bg-gray-50 p-2 md:p-3">
                                <div class="w-full h-full overflow-hidden rounded-[1.6rem] relative">
                                    <img src="{{ $article->thumbnail ? asset('storage/'.$article->thumbnail) : 'https://placehold.co/600x400/eeeeee/999999?text=Berita+Sumba' }}" alt="{{ $article->title }}" class="w-full h-full object-cover img-hover-zoom duration-1000">
                                    <div class="absolute inset-0 bg-gradient-to-t from-brand-950/40 to-transparent"></div>
                                    <div class="absolute bottom-4 left-4">
                                        <span class="bg-white/95 backdrop-blur-sm text-brand-900 text-[10px] font-bold px-3 py-1.5 rounded-full shadow-sm uppercase tracking-widest">
                                            {{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Card Body -->
                            <div class="p-6 md:p-8 flex flex-col flex-grow justify-between">
                                <div class="mb-6">
                                    <!-- Author Signature -->
                                    <div class="flex items-center gap-2.5 mb-4">
                                        <div class="w-6 h-6 rounded-full bg-brand-900 flex items-center justify-center text-white text-[9px] font-serif font-bold">
                                            {{ substr($article->user->name ?? 'A', 0, 1) }}
                                        </div>
                                        <span class="text-[11px] font-bold text-brand-500 uppercase tracking-widest">
                                            {{ $article->user->name ?? 'Admin' }}
                                        </span>
                                    </div>
                                    
                                    <h3 class="font-serif font-bold text-xl text-brand-900 mb-3 leading-tight group-hover:text-brand-500 transition-colors duration-300 line-clamp-2">
                                        {{ $article->title }}
                                    </h3>
                                    
                                    <p class="text-sm text-gray-500 font-sans leading-relaxed line-clamp-3 font-light">
                                        {{ strip_tags($article->content) }}
                                    </p>
                                </div>

                                <div class="flex items-center justify-between border-t border-gray-100 pt-5">
                                    <span class="inline-flex items-center text-xs font-bold text-brand-900 uppercase tracking-wider group-hover:text-brand-500 transition-colors">
                                        Baca Berita
                                        <svg class="w-3.5 h-3.5 ml-2 transform group-hover:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                    </span>
                                    <span class="text-[10px] font-mono text-gray-400">
                                        @php
                                            $wordCount = str_word_count(strip_tags($article->content));
                                            $readingTime = max(1, ceil($wordCount / 200));
                                        @endphp
                                        {{ $readingTime }} mnt baca
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @else
            <!-- EMPTY STATE -->
            <div class="py-24 text-center bg-white rounded-[2.5rem] border border-gray-100 shadow-sm">
                <div class="w-20 h-20 bg-brand-50 rounded-full flex items-center justify-center mx-auto mb-6 border border-brand-500/10">
                    <svg class="w-10 h-10 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-.586-1.414l-4.5-4.5A2 2 0 0012.586 3H12"></path></svg>
                </div>
                <h3 class="font-serif font-bold text-xl text-brand-900 mb-2">Belum Ada Kabar Terbaru</h3>
                <p class="text-gray-500 font-sans max-w-sm mx-auto text-sm leading-relaxed mb-8">Informasi dan berita seputar pariwisata Sumba Barat Daya sedang dalam penyusunan. Silakan kembali lagi nanti.</p>
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center bg-brand-900 text-white font-serif font-bold py-3.5 px-8 rounded-full hover:bg-brand-800 transition shadow-lg shadow-brand-950/10">
                    Kembali ke Beranda
                </a>
            </div>
        @endif
        
        <!-- Pagination -->
        @if($news->hasPages())
            <div class="mt-20 font-sans flex justify-center border-t border-gray-100 pt-12">
                {{ $news->links() }}
            </div>
        @endif
    </section>
@endsection