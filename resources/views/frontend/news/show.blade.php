@extends('layouts.frontend')

@section('content')
    <!-- ASYMMETRIC EDITORIAL LAYOUT -->
    <section class="min-h-screen bg-brand-50 pt-24 md:pt-32 pb-20">
        <div class="max-w-[90rem] mx-auto px-6 sm:px-8 lg:px-12">
            
            <!-- Tombol Kembali Minimalis -->
            <div class="mb-10 lg:mb-16">
                <a href="{{ route('news.index') }}" class="inline-flex items-center text-xs font-heading font-bold text-gray-400 hover:text-ocean transition tracking-widest uppercase">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Daftar Kabar
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-24 relative">
                
                <!-- KOLOM KIRI: STICKY HEADER & META (5 Kolom) -->
                <div class="lg:col-span-5 relative">
                    <div class="lg:sticky lg:top-32 flex flex-col justify-between h-auto lg:min-h-[calc(100vh-12rem)] pb-10">
                        
                        <div>
                            <span class="inline-block bg-blue-50/50 border border-blue-100/50 text-blue-600 text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-widest mb-6">
                                Liputan Khusus
                            </span>
                            
                            <h1 class="font-heading text-4xl sm:text-5xl lg:text-[4rem] font-black text-ocean leading-[1.05] tracking-tight mb-8">
                                {{ $article->title }}
                            </h1>
                            
                            <!-- Meta Info Box -->
                            <div class="flex items-center gap-5 pt-8 border-t border-gray-200/50 mt-8">
                                <div class="w-14 h-14 rounded-full bg-ocean flex items-center justify-center text-white font-heading font-bold text-xl shrink-0">
                                    {{ substr($article->user->name ?? 'A', 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-heading font-bold text-ocean uppercase tracking-wider text-sm">{{ $article->user->name ?? 'Administrator' }}</p>
                                    <div class="flex items-center text-xs font-body text-gray-500 mt-1 gap-3">
                                        <span>{{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}</span>
                                        <span class="text-gray-300">•</span>
                                        <span class="flex items-center text-savanna font-semibold">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            @php
                                                $wordCount = str_word_count(strip_tags($article->content));
                                                $readingTime = max(1, ceil($wordCount / 200));
                                            @endphp
                                            {{ $readingTime }} mnt baca
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Social Share (Bottom of Sticky) -->
                        <div class="mt-12 lg:mt-0 pt-8 border-t border-gray-200/50">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4">Bagikan Liputan Ini</p>
                            <div class="flex gap-3">
                                <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:border-ocean hover:text-ocean transition" title="Salin Tautan">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                </button>
                                <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-[#1DA1F2] hover:border-[#1DA1F2] hover:text-white transition" title="Bagikan ke Twitter">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                                </button>
                                <button class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-[#25D366] hover:border-[#25D366] hover:text-white transition" title="Bagikan ke WhatsApp">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.1.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.029 18.88c-1.161 0-2.305-.292-3.318-.844l-3.677.964.984-3.595c-.607-1.052-.927-2.246-.926-3.468.001-5.824 4.74-10.563 10.564-10.563 5.826 0 10.564 4.738 10.564 10.561s-4.738 10.563-10.564 10.563z"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN: KONTEN EDITORIAL (7 Kolom) -->
                <div class="lg:col-span-7">
                    
                    <!-- Editorial Hero Image -->
                    <div class="w-full aspect-[4/3] md:aspect-video lg:aspect-[4/5] bg-gray-100 rounded-none sm:rounded-[2rem] overflow-hidden mb-12 shadow-premium relative">
                        <img src="{{ $article->thumbnail ? asset('storage/'.$article->thumbnail) : 'https://placehold.co/1200x1500/eeeeee/999999' }}" 
                             alt="{{ $article->title }}" 
                             class="w-full h-full object-cover">
                        <!-- Abstract Overlay Halus -->
                        <div class="absolute inset-0 bg-gradient-to-t from-ocean/20 to-transparent mix-blend-multiply"></div>
                    </div>

                    <!-- Editorial Content Area (Dengan Custom Drop Cap) -->
                    <div class="prose prose-lg md:prose-xl prose-p:text-gray-600 prose-headings:text-ocean prose-headings:font-heading prose-a:text-savanna font-body max-w-none leading-relaxed 
                        prose-first-letter:text-[5rem] prose-first-letter:font-heading prose-first-letter:font-black prose-first-letter:text-savanna prose-first-letter:mr-3 prose-first-letter:-mt-2 prose-first-letter:float-left prose-first-letter:leading-none
                        prose-blockquote:border-l-4 prose-blockquote:border-savanna prose-blockquote:pl-6 prose-blockquote:italic prose-blockquote:text-ocean prose-blockquote:font-heading prose-blockquote:font-medium">
                        
                        {!! nl2br(e($article->content)) !!}
                        
                    </div>

                    <!-- Tags / Sub Topics -->
                    <div class="mt-16 pt-8 border-t border-gray-200/50 flex flex-wrap gap-2">
                        <span class="bg-white border border-gray-200 text-gray-500 hover:text-ocean transition cursor-pointer px-5 py-2 rounded-full text-xs font-bold uppercase tracking-widest shadow-sm">Pariwisata</span>
                        <span class="bg-white border border-gray-200 text-gray-500 hover:text-ocean transition cursor-pointer px-5 py-2 rounded-full text-xs font-bold uppercase tracking-widest shadow-sm">Sumba Barat Daya</span>
                        <span class="bg-white border border-gray-200 text-gray-500 hover:text-ocean transition cursor-pointer px-5 py-2 rounded-full text-xs font-bold uppercase tracking-widest shadow-sm">Pemerintah</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 3. RELATED NEWS (FULL WIDTH SECTION) -->
    @if($relatedNews && $relatedNews->count() > 0)
    <section class="bg-white py-24 border-t border-gray-100">
        <div class="max-w-[90rem] mx-auto px-6 sm:px-8 lg:px-12">
            <div class="flex items-end justify-between mb-12">
                <div>
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest block mb-2">Lanjutkan Membaca</span>
                    <h2 class="font-heading text-3xl md:text-4xl font-black text-ocean">Kabar Lainnya</h2>
                </div>
                <a href="{{ route('news.index') }}" class="hidden md:inline-flex items-center text-sm font-bold text-ocean hover:text-savanna transition uppercase tracking-widest border-b border-ocean hover:border-savanna pb-1">
                    Indeks Berita
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">
                @foreach($relatedNews as $related)
                    <a href="{{ route('news.show', $related->slug) }}" class="group block cursor-pointer">
                        <div class="w-full aspect-[4/3] bg-gray-100 rounded-[1.5rem] overflow-hidden mb-6 relative">
                            <img src="{{ $related->thumbnail ? asset('storage/'.$related->thumbnail) : 'https://placehold.co/800x600/eeeeee/999999' }}" class="w-full h-full object-cover img-hover-zoom">
                            <div class="absolute inset-0 bg-ocean/0 group-hover:bg-ocean/10 transition duration-500"></div>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-savanna uppercase tracking-widest mb-3">{{ \Carbon\Carbon::parse($related->published_at)->format('d F Y') }}</p>
                            <h3 class="font-heading text-xl font-bold text-ocean leading-tight mb-3 group-hover:text-savanna transition line-clamp-2">
                                {{ $related->title }}
                            </h3>
                            <p class="text-sm text-gray-500 font-body line-clamp-2">
                                {{ Str::limit(strip_tags($related->content), 90) }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection