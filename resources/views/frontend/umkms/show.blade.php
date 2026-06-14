@extends('layouts.frontend')

@section('content')
    <!-- 1. BENTO HEADER GALLERY (Airbnb Style) -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 mt-28 lg:mt-32 mb-8 md:mb-12">
        <!-- Back Navigation -->
        <div class="mb-6">
            <a href="{{ route('umkm.index') }}" class="inline-flex items-center text-sm font-heading font-semibold text-gray-500 hover:text-savanna transition bg-white px-4 py-2 rounded-full shadow-sm border border-gray-100">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Direktori UMKM
            </a>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-6 gap-4">
            <div>
                <span class="inline-block bg-savanna/10 text-savanna text-xs font-bold uppercase tracking-widest mb-2 px-3 py-1 rounded-md border border-savanna/20">
                    Kategori: {{ $umkm->category }}
                </span>
                <h1 class="font-heading text-3xl md:text-5xl font-black text-ocean tracking-tight">{{ $umkm->name }}</h1>
                <p class="text-sm font-body text-gray-500 mt-2 flex items-center">
                    <svg class="w-4 h-4 mr-1 text-savanna" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Desa {{ $umkm->village->name ?? '-' }}, Sumba Barat Daya
                </p>
            </div>
            
            <!-- Share & Save Buttons -->
            <div class="flex items-center gap-3">
                <button class="flex items-center text-sm font-heading font-semibold text-ocean hover:bg-gray-100 px-4 py-2 rounded-lg transition border border-gray-200 bg-white shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                    Bagikan
                </button>
            </div>
        </div>

        <!-- Image Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-2 md:gap-4 h-[40vh] md:h-[60vh] rounded-[2rem] overflow-hidden">
            <!-- Main Image -->
            <div class="md:col-span-2 relative group bg-gray-100">
                <img src="{{ $umkm->thumbnail ? asset('storage/'.$umkm->thumbnail) : 'https://placehold.co/800' }}" alt="{{ $umkm->name }}" class="w-full h-full object-cover img-hover-zoom">
            </div>
            
            <!-- Side Images (Dari Galeri jika ada) -->
            <div class="hidden md:grid md:col-span-2 grid-cols-2 gap-4">
                @if($umkm->gallery && is_array($umkm->gallery) && count($umkm->gallery) >= 2)
                    <div class="relative group bg-gray-100 overflow-hidden"><img src="{{ asset('storage/'.$umkm->gallery[0]) }}" class="w-full h-full object-cover img-hover-zoom"></div>
                    <div class="relative group bg-gray-100 overflow-hidden"><img src="{{ asset('storage/'.$umkm->gallery[1]) }}" class="w-full h-full object-cover img-hover-zoom"></div>
                    <div class="relative group bg-gray-100 overflow-hidden"><img src="{{ isset($umkm->gallery[2]) ? asset('storage/'.$umkm->gallery[2]) : asset('storage/'.$umkm->thumbnail) }}" class="w-full h-full object-cover img-hover-zoom"></div>
                    <div class="relative group bg-gray-100 overflow-hidden">
                        <img src="{{ isset($umkm->gallery[3]) ? asset('storage/'.$umkm->gallery[3]) : asset('storage/'.$umkm->thumbnail) }}" class="w-full h-full object-cover img-hover-zoom">
                        <!-- Overlay See All Photos -->
                        <div class="absolute inset-0 bg-ocean/40 hover:bg-ocean/30 transition flex items-center justify-center cursor-pointer backdrop-blur-[2px]">
                            <span class="bg-white/90 text-ocean font-heading font-bold px-4 py-2 rounded-lg text-sm shadow-sm">Lihat Semua Foto</span>
                        </div>
                    </div>
                @else
                    <!-- Fallback jika galeri kosong -->
                    <div class="col-span-2 relative bg-gray-100 overflow-hidden"><img src="{{ $umkm->thumbnail ? asset('storage/'.$umkm->thumbnail) : 'https://placehold.co/800' }}" class="w-full h-full object-cover opacity-80 blur-sm"></div>
                @endif
            </div>
        </div>
    </section>

    <!-- 2. MAIN CONTENT SPLIT -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 pb-24">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-16">
            
            <!-- LEFT COLUMN: Cerita Brand & Informasi (2/3 width) -->
            <div class="lg:col-span-2 space-y-12">
                
                <!-- Highlights / Mengapa Memilih Kami -->
                <div class="flex flex-wrap gap-4 py-6 border-b border-gray-100">
                    <div class="flex items-center gap-3 w-full sm:w-auto pr-8">
                        <div class="w-10 h-10 rounded-full bg-savanna/10 text-savanna flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-heading font-bold text-ocean text-sm">100% Asli Sumba</h4>
                            <p class="text-xs text-gray-500 font-body">Karya otentik masyarakat lokal.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 w-full sm:w-auto pr-8">
                        <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-heading font-bold text-ocean text-sm">Dukung Ekonomi</h4>
                            <p class="text-xs text-gray-500 font-body">Langsung dari pengrajin/petani.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-heading font-bold text-ocean text-sm">Kualitas Terjamin</h4>
                            <p class="text-xs text-gray-500 font-body">Telah dikurasi oleh tim Explore SBD.</p>
                        </div>
                    </div>
                </div>

                <!-- Tentang Brand -->
                <div>
                    <h2 class="font-heading text-2xl font-bold text-ocean mb-6">Cerita di Balik Produk</h2>
                    <div class="prose prose-lg text-gray-600 font-body max-w-none leading-relaxed">
                        @if($umkm->description)
                            {!! $umkm->description !!}
                        @else
                            <p class="italic">UMKM ini belum menambahkan deskripsi cerita produknya.</p>
                        @endif
                    </div>
                </div>

                <!-- Peta Lokasi Interaktif -->
                @if($umkm->latitude && $umkm->longitude)
                <div class="pt-8 border-t border-gray-100">
                    <h2 class="font-heading text-2xl font-bold text-ocean mb-6">Lokasi Penjualan</h2>
                    <p class="text-gray-500 font-body text-sm mb-6">{{ $umkm->address ?? 'Lokasi tepat belum disertakan.' }}</p>
                    
                    <div class="w-full aspect-video rounded-[2rem] overflow-hidden shadow-premium border border-gray-100 relative z-10">
                        <div id="umkm-map" class="w-full h-full"></div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            var umkmMap = L.map('umkm-map', { zoomControl: true }).setView([{{ $umkm->latitude }}, {{ $umkm->longitude }}], 15);
                            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png').addTo(umkmMap);
                            
                            var umkmIcon = L.divIcon({
                                className: 'bg-transparent border-none',
                                html: `<div class="w-10 h-10 bg-savanna text-white rounded-full flex items-center justify-center shadow-lg border-4 border-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg></div>`,
                                iconSize: [40, 40], iconAnchor: [20, 40]
                            });
                            
                            L.marker([{{ $umkm->latitude }}, {{ $umkm->longitude }}], {icon: umkmIcon})
                             .addTo(umkmMap)
                             .bindPopup('<b class="font-heading">{{ $umkm->name }}</b>')
                             .openPopup();
                        });
                    </script>
                </div>
                @endif
            </div>

            <!-- RIGHT COLUMN: Sticky Reservation / Contact Card (1/3 width) -->
            <div class="lg:col-span-1 relative">
                <div class="sticky top-32 bg-white rounded-[2.5rem] p-8 shadow-floating border border-gray-100">
                    
                    <h3 class="font-heading text-2xl font-black text-ocean mb-2">Tertarik?</h3>
                    <p class="text-gray-500 font-body text-sm mb-8">Dukung UMKM lokal Sumba dengan membeli produk mereka secara langsung.</p>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-gray-400 mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <div>
                                <span class="block text-xs font-bold text-gray-800 uppercase">Alamat</span>
                                <span class="text-sm text-gray-600 font-body">{{ $umkm->address ?? 'Hubungi untuk alamat lengkap' }}<br>Desa {{ $umkm->village->name ?? '-' }}</span>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <div>
                                <span class="block text-xs font-bold text-gray-800 uppercase">Kontak</span>
                                <span class="text-sm text-gray-600 font-body">{{ $umkm->phone_number ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    @if($umkm->phone_number)
                        @php
                            $wa_number = preg_replace('/[^0-9]/', '', $umkm->phone_number);
                            if(str_starts_with($wa_number, '0')) {
                                $wa_number = '62' . substr($wa_number, 1);
                            }
                        @endphp
                        <a href="https://wa.me/{{ $wa_number }}?text=Halo,%20saya%20tertarik%20dengan%20produk%20dari%20{{ urlencode($umkm->name) }}%20yang%20saya%20lihat%20di%20Explore%20SBD." 
                           target="_blank"
                           class="w-full flex items-center justify-center bg-[#25D366] text-white font-heading font-bold px-6 py-4 rounded-full hover:bg-[#20b858] transition shadow-lg shadow-green-500/20 group">
                            <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.1.824zm-3.423-14.416c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm.029 18.88c-1.161 0-2.305-.292-3.318-.844l-3.677.964.984-3.595c-.607-1.052-.927-2.246-.926-3.468.001-5.824 4.74-10.563 10.564-10.563 5.826 0 10.564 4.738 10.564 10.561s-4.738 10.563-10.564 10.563z"/></svg>
                            Pesan via WhatsApp
                        </a>
                        <p class="text-[10px] text-gray-400 text-center mt-4 font-body">Anda akan diarahkan langsung ke WhatsApp pemilik UMKM.</p>
                    @else
                        <button disabled class="w-full bg-gray-100 text-gray-400 font-heading font-bold px-6 py-4 rounded-full cursor-not-allowed">
                            Kontak Belum Tersedia
                        </button>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection