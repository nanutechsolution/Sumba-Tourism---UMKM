@extends('layouts.frontend')

@section('content')
<!-- 1. EDITORIAL HERO SECTION -->
<section class="relative w-full h-[60vh] lg:h-[75vh] bg-brand-900 overflow-hidden mt-16 md:mt-20">
    @if($story->photo_path)
    <img src="{{ asset('storage/'.$story->photo_path) }}" class="w-full h-full object-cover opacity-90" alt="{{ $story->title }}">
    @else
    <!-- Abstract Pattern Fallback -->
    <div class="w-full h-full bg-brand-900 flex items-center justify-center opacity-20">
        <svg width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
            <path d="M0 100 C 20 0 50 0 100 100 Z" fill="currentColor" />
        </svg>
    </div>
    @endif

    <!-- Premium Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-t from-brand-50 via-brand-900/30 to-transparent"></div>
</section>

<!-- 2. ARTICLE CONTENT -->
<section class="relative max-w-4xl mx-auto px-4 sm:px-6 pb-24 -mt-40 md:-mt-56 z-10">

    <!-- Back Navigation -->
    <div class="mb-8">
        <a href="{{ route('story.index') }}" class="inline-flex items-center text-sm font-serif font-bold text-white/90 hover:text-white transition backdrop-blur-md bg-black/20 px-5 py-2.5 rounded-full border border-white/20 shadow-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Jurnal
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-luxury border border-gray-100 overflow-hidden">
        <div class="p-8 md:p-12 lg:p-16">

            <!-- HEADER / META -->
            <div class="text-center border-b border-gray-100 pb-10 mb-12">
                <span class="inline-block bg-brand-500 text-white text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-widest mb-6 shadow-sm">
                    Citizen Journalism
                </span>

                <h1 class="font-serif text-4xl md:text-5xl lg:text-6xl font-black text-brand-900 mb-8 tracking-tight leading-tight">
                    {{ $story->title }}
                </h1>

                <div class="flex items-center justify-center gap-4 text-sm font-sans">
                    <!-- Author Avatar -->
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-brand-900 to-brand-800 flex items-center justify-center text-white font-serif font-bold text-xl shadow-md border-2 border-white ring-2 ring-gray-100">
                        {{ substr($story->author_name, 0, 1) }}
                    </div>
                    <div class="text-left flex flex-col justify-center">
                        <p class="font-bold text-brand-900 uppercase tracking-wider text-sm mb-1">{{ $story->author_name }}</p>
                        <div class="text-gray-500 font-medium flex items-center text-xs flex-wrap gap-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $story->created_at->format('d M Y') }}
                            </span>
                            <span class="hidden sm:inline text-gray-300">•</span>
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                @php
                                // Menghitung estimasi waktu baca (rata-rata 200 kata per menit)
                                $wordCount = str_word_count(strip_tags($story->content));
                                $readingTime = ceil($wordCount / 200);
                                @endphp
                                {{ $readingTime }} mnt baca
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CONTENT AREA (Editorial Typography with Drop Cap) -->
            <div class="prose prose-lg md:prose-xl prose-p:text-gray-600 prose-headings:text-brand-900 prose-headings:font-serif prose-a:text-brand-500 font-sans max-w-none leading-relaxed prose-first-letter:text-6xl prose-first-letter:font-serif prose-first-letter:font-black prose-first-letter:text-brand-900 prose-first-letter:mr-2 prose-first-letter:float-left prose-first-letter:leading-none">
                {!! nl2br(e($story->content)) !!}
            </div>

            <!-- TOPICS / TAGS -->
            <div class="mt-12 flex flex-wrap gap-2">
                <span class="bg-gray-50 border border-gray-200 text-gray-500 hover:text-brand-900 hover:border-brand-900 hover:bg-white transition cursor-pointer px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest">#ExploreSBD</span>
                <span class="bg-gray-50 border border-gray-200 text-gray-500 hover:text-brand-900 hover:border-brand-900 hover:bg-white transition cursor-pointer px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest">#BudayaSumba</span>
                <span class="bg-gray-50 border border-gray-200 text-gray-500 hover:text-brand-900 hover:border-brand-900 hover:bg-white transition cursor-pointer px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest">#HiddenGems</span>
            </div>

            <!-- AUTHOR BIO BOX -->
            <div class="mt-12 bg-brand-50 border border-brand-500/20 rounded-[2rem] p-8 flex flex-col sm:flex-row items-center sm:items-start gap-6">
                <div class="w-20 h-20 shrink-0 rounded-full bg-brand-900 flex items-center justify-center text-white font-serif font-bold text-3xl shadow-md border-4 border-white">
                    {{ substr($story->author_name, 0, 1) }}
                </div>
                <div class="text-center sm:text-left flex-grow">
                    <span class="text-[10px] font-bold text-brand-500 uppercase tracking-widest mb-1 block">Tentang Penulis</span>
                    <h4 class="font-serif font-bold text-brand-900 text-2xl mb-2">{{ $story->author_name }}</h4>
                    <p class="text-sm text-gray-600 font-sans leading-relaxed mb-4">
                        Seorang pejalan kaki yang membagikan potret dan cerita otentiknya melalui platform Explore SBD. Temukan keajaiban lain dari sudut pandang warga lokal dan wisatawan.
                    </p>
                    <a href="{{ route('story.index') }}" class="inline-flex items-center text-sm font-bold text-blue-600 hover:text-blue-800 transition">
                        Lihat Cerita Lainnya &rarr;
                    </a>
                </div>
            </div>

            <!-- SHARE & ENGAGEMENT -->
            <div class="mt-12 pt-8 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-6">

                <!-- Apresiasi Kiri -->
                <div class="flex items-center gap-4">
                    <button class="flex items-center gap-2 px-5 py-2.5 rounded-full bg-gray-50 hover:bg-red-50 hover:text-red-500 text-gray-500 transition border border-gray-200 hover:border-red-200 group font-bold text-sm font-sans">
                        <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        Bermanfaat
                    </button>
                    <span class="text-sm text-gray-400 font-medium">Bantu orang lain menemukan cerita ini</span>
                </div>

                <!-- Bagikan Kanan -->
                <div class="flex items-center gap-3">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-widest mr-2">Bagikan:</span>
                    <button class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-500 hover:bg-[#25D366] hover:border-[#25D366] hover:text-white transition border border-gray-200" title="Bagikan ke WhatsApp">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.1.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.029 18.88c-1.161 0-2.305-.292-3.318-.844l-3.677.964.984-3.595c-.607-1.052-.927-2.246-.926-3.468.001-5.824 4.74-10.563 10.564-10.563 5.826 0 10.564 4.738 10.564 10.561s-4.738 10.563-10.564 10.563z" />
                        </svg>
                    </button>
                    <button class="w-10 h-10 rounded-full bg-gray-50 flex items-center justify-center text-gray-500 hover:bg-[#1DA1F2] hover:border-[#1DA1F2] hover:text-white transition border border-gray-200" title="Bagikan ke Twitter">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- CALL TO ACTION AREA -->
        <div class="bg-gradient-to-br from-brand-900 to-brand-950 p-10 md:p-14 text-center relative overflow-hidden">
            <!-- Abstract Pattern -->
            <svg class="absolute top-0 right-0 w-64 h-64 text-white/5 -mt-20 -mr-20" fill="currentColor" viewBox="0 0 100 100" aria-hidden="true">
                <circle cx="50" cy="50" r="50" />
            </svg>
            <svg class="absolute bottom-0 left-0 w-40 h-40 text-white/5 -mb-10 -ml-10" fill="currentColor" viewBox="0 0 100 100" aria-hidden="true">
                <circle cx="50" cy="50" r="50" />
            </svg>

            <div class="relative z-10">
                <span class="text-brand-500 font-bold tracking-widest uppercase text-sm mb-3 block">Tertarik Menulis?</span>
                <h4 class="font-serif font-black text-3xl md:text-4xl mb-4">Bagikan Cerita Anda</h4>
                <p class=" font-sans text-sm mb-8 max-w-md mx-auto leading-relaxed">
                    Inspirasi wisatawan lain dengan membagikan momen magis, kuliner lezat, atau pengalaman otentik Anda selama di Sumba.
                </p>
                <a href="{{ route('story.create') }}" class="inline-flex items-center bg-brand-500 text-white font-serif font-bold py-3.5 px-8 rounded-full hover:bg-white hover:text-brand-900 transition duration-300 shadow-lg group">
                    <svg class="w-5 h-5 mr-2 group-hover:-rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                    Mulai Tulis Cerita
                </a>
            </div>
        </div>

    </div>
</section>
@endsection