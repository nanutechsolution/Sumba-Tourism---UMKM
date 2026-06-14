@extends('layouts.frontend')

@section('content')
    <!-- 1. EDITORIAL HEADER SECTION (MUSEUM/MAGAZINE STYLE) -->
    <section class="pt-36 pb-16 lg:pt-48 lg:pb-20 px-6 relative bg-brand-50 overflow-hidden">
        <!-- Elegant Decorative Accents -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-brand-500/5 rounded-full blur-[120px] pointer-events-none animate-pulse" aria-hidden="true"></div>
        <div class="absolute -left-20 top-40 w-80 h-80 bg-brand-900/5 rounded-full blur-[100px] pointer-events-none" aria-hidden="true"></div>
        
        <!-- Framing Border (Luxury Detail) -->
        <div class="absolute inset-x-8 top-24 bottom-0 border border-brand-500/10 pointer-events-none hidden lg:block" aria-hidden="true"></div>

        <div class="max-w-6xl mx-auto relative z-10">
            <div class="flex flex-col items-center text-center">
                <!-- Curator Badge -->
                <div class="inline-flex items-center gap-2 bg-brand-900 text-brand-100 text-[10px] font-bold tracking-[0.3em] uppercase px-5 py-2 rounded-full mb-6 border border-brand-500/20 shadow-lg shadow-brand-950/10">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-500 animate-ping"></span>
                    Curated Visual Journal
                </div>
                
                <!-- Main Magazine Heading -->
                <h1 class="font-serif text-5xl md:text-7xl lg:text-8xl font-medium text-brand-900 tracking-tight leading-none mb-6">
                    Bingkai <span class="text-brand-500 italic font-light font-serif">Sumba</span>
                </h1>
                
                <!-- Curatorial Intro -->
                <div class="w-12 h-[2px] bg-brand-500 mb-8"></div>
                <p class="text-gray-500 text-lg md:text-xl font-sans max-w-3xl mx-auto leading-relaxed font-light">
                    Merekam lanskap magis sabana liar, ombak murni Samudra Hindia, tradisi megalitikum Marapu, dan pancaran senyum otentik yang melintasi waktu di Sumba Barat Daya.
                </p>
            </div>
        </div>
    </section>

    <!-- 2. EDITORIAL CATEGORY FILTER -->
    <div class="max-w-7xl mx-auto px-6 mb-12 relative z-20">
        <div class="flex flex-wrap items-center justify-center gap-3 border-b border-gray-200/60 pb-8">
            <button class="px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest bg-brand-900 text-white shadow-md transition-all duration-300">
                Semua Koleksi
            </button>
            <button class="px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest text-gray-500 bg-white border border-gray-200/80 hover:border-brand-500 hover:text-brand-900 transition-all duration-300">
                Bentang Alam
            </button>
            <button class="px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest text-gray-500 bg-white border border-gray-200/80 hover:border-brand-500 hover:text-brand-900 transition-all duration-300">
                Budaya & Ritual
            </button>
            <button class="px-6 py-2.5 rounded-full text-xs font-bold uppercase tracking-widest text-gray-500 bg-white border border-gray-200/80 hover:border-brand-500 hover:text-brand-900 transition-all duration-300">
                Wajah Sumba
            </button>
        </div>
    </div>

    <!-- 3. PREMIUM MASONRY GALLERY SECTION -->
    <section class="max-w-7xl mx-auto px-6 pb-24 relative z-10">
        <!-- True CSS Columns Masonry with Elegant Spacing -->
        <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-6 space-y-6">
            @forelse($galleries as $gallery)
                <div onclick="openLightbox('{{ $gallery->image_path ? asset('storage/'.$gallery->image_path) : 'https://placehold.co/800x1200?text=Sumba+Explore' }}', '{{ e($gallery->title) }}', '{{ e($gallery->description ?? 'Pesona keindahan alam liar Sumba Barat Daya.') }}', 'Desa {{ $gallery->destination->village->name ?? 'SBD' }}')" 
                     class="break-inside-avoid relative group rounded-[1.5rem] md:rounded-[2rem] overflow-hidden shadow-sm hover:shadow-luxury transition-all duration-700 bg-white border border-gray-100/60 cursor-pointer">
                    
                    <!-- Image with Micro-border frame -->
                    <div class="p-2 md:p-3 bg-white h-full w-full rounded-[1.5rem] md:rounded-[2rem]">
                        <div class="overflow-hidden rounded-[1rem] md:rounded-[1.5rem] relative aspect-auto">
                            <img src="{{ $gallery->image_path ? asset('storage/'.$gallery->image_path) : 'https://placehold.co/800x1200?text=Sumba+Explore' }}" 
                                 alt="{{ $gallery->title }}" 
                                 class="w-full h-auto object-cover img-hover-zoom duration-1000"
                                 loading="lazy">
                        </div>
                    </div>
                    
                    <!-- National Geographic Inspired Editorial Overlay Card -->
                    <div class="absolute inset-0 bg-gradient-to-t from-brand-950 via-brand-950/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-6 md:p-8 rounded-[1.5rem] md:rounded-[2rem] z-20">
                        <div class="translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            <!-- EXIF Metadata Mock / Location (Aesthetic NatGeo Vibe) -->
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-[9px] font-bold text-brand-500 uppercase tracking-widest border border-brand-500/30 px-2 py-0.5 rounded">
                                    {{ $gallery->destination->village->name ?? 'Sumba Barat Daya' }}
                                </span>
                                <span class="text-[8px] font-mono text-gray-400">
                                    50mm • f/2.8 • ISO 100
                                </span>
                            </div>
                            
                            <h3 class="font-serif font-medium text-xl text-white mb-2 leading-tight tracking-wide">{{ $gallery->title }}</h3>
                            <p class="text-xs text-gray-300 font-sans line-clamp-2 leading-relaxed opacity-90 mb-4">
                                {{ $gallery->description ?? 'Menangkap momen magis, kebudayaan luhur, dan lanskap eksotis Sumba Barat Daya.' }}
                            </p>
                            
                            <!-- Premium CTA inside overlay -->
                            <span class="inline-flex items-center text-[10px] font-bold text-brand-500 uppercase tracking-widest group-hover:underline">
                                Perbesar Jurnal Visual
                                <svg class="w-3.5 h-3.5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="break-inside-avoid col-span-full py-24 text-center bg-white rounded-[2.5rem] border border-gray-100 shadow-sm w-full">
                    <div class="w-16 h-16 bg-brand-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-brand-500/10">
                        <svg class="w-8 h-8 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <p class="text-gray-500 font-sans text-lg">Koleksi dokumentasi visual belum tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($galleries->hasPages())
            <div class="mt-20 font-sans flex justify-center border-t border-gray-100 pt-12">
                {{ $galleries->links() }}
            </div>
        @endif
    </section>

    <!-- 4. NATIONAL GEOGRAPHIC STYLE LIGHTBOX MODAL -->
    <div id="lightbox-modal" class="fixed inset-0 z-[100] bg-brand-950/98 backdrop-blur-xl hidden flex-col items-center justify-center p-4 transition-opacity duration-500 opacity-0" onclick="closeLightbox()">
        <!-- Close Button -->
        <button class="absolute top-6 right-6 text-white/70 hover:text-white transition-colors duration-300 p-3 rounded-full hover:bg-white/10" onclick="closeLightbox()">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Lightbox Content Container -->
        <div class="max-w-5xl w-full flex flex-col md:flex-row items-center gap-8 md:gap-12" onclick="event.stopPropagation()">
            <!-- Image Area -->
            <div class="w-full md:w-3/5 flex justify-center max-h-[70vh] rounded-2xl overflow-hidden shadow-2xl bg-black border border-white/5">
                <img id="lightbox-img" src="" alt="Zoomed Photo" class="max-w-full max-h-[70vh] object-contain">
            </div>

            <!-- Meta/Editorial Info Area -->
            <div class="w-full md:w-2/5 text-left text-white flex flex-col">
                <div class="flex items-center gap-3 mb-4">
                    <span id="lightbox-badge" class="bg-brand-500 text-brand-950 text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded">
                        SUMBA BARAT DAYA
                    </span>
                    <span class="text-[10px] font-mono text-gray-400">
                        NATGEO INSPIRED CAPTURE
                    </span>
                </div>
                
                <h2 id="lightbox-title" class="font-serif font-medium text-3xl lg:text-4xl text-white tracking-wide mb-4 leading-tight"></h2>
                
                <div class="w-10 h-[1px] bg-brand-500 mb-6"></div>
                
                <p id="lightbox-desc" class="text-sm text-gray-300 font-sans leading-relaxed font-light mb-8 opacity-90"></p>
                
                <div class="flex items-center gap-6 border-t border-white/10 pt-6">
                    <div>
                        <span class="block text-[8px] font-bold text-gray-500 uppercase tracking-widest mb-1">EQUIPMENT</span>
                        <span class="text-xs font-mono text-gray-300">SLR Camera - 50mm Lens</span>
                    </div>
                    <div>
                        <span class="block text-[8px] font-bold text-gray-500 uppercase tracking-widest mb-1">EXIF DATA</span>
                        <span class="text-xs font-mono text-gray-300">f/4.0 • 1/250s • ISO 100</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- LIGHTBOX MODAL SCRIPT -->
    <script>
        function openLightbox(imgSrc, title, desc, badge) {
            const modal = document.getElementById('lightbox-modal');
            const img = document.getElementById('lightbox-img');
            const titleEl = document.getElementById('lightbox-title');
            const descEl = document.getElementById('lightbox-desc');
            const badgeEl = document.getElementById('lightbox-badge');

            img.src = imgSrc;
            titleEl.innerText = title;
            descEl.innerText = desc;
            if (badge) {
                badgeEl.innerText = badge.toUpperCase();
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modal.classList.add('opacity-100');
            }, 50);
            
            // Prevent scrolling behind lightbox
            document.body.style.overflow = 'hidden';
        }

        function closeLightbox() {
            const modal = document.getElementById('lightbox-modal');
            modal.classList.remove('opacity-100');
            modal.classList.add('opacity-0');
            setTimeout(() => {
                modal.classList.remove('flex');
                modal.classList.add('hidden');
            }, 500);

            document.body.style.overflow = '';
        }

        // Close on ESC key press
        document.addEventListener('keydown', function(event) {
            if (event.key === "Escape") {
                closeLightbox();
            }
        });
    </script>
@endsection