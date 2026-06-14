@extends('layouts.frontend')

@section('content')
    <section class="pt-32 pb-16 lg:pt-48 lg:pb-24 px-6 relative bg-brand-50 border-b border-gray-100 overflow-hidden">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-brand-900/5 to-transparent pointer-events-none" aria-hidden="true"></div>
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-brand-500/10 rounded-full blur-3xl pointer-events-none" aria-hidden="true"></div>
        
        <div class="max-w-5xl mx-auto text-center relative z-10">
            <div class="inline-flex items-center bg-green-50 text-green-700 text-xs font-bold px-5 py-2 rounded-full uppercase tracking-widest mb-8 border border-green-200 shadow-sm animate-[slideInDown_0.5s_ease-out]">
                <div class="relative flex h-3 w-3 mr-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                </div>
                AI Engine: Rute Berhasil Dibuat
            </div>
            
            <h1 class="font-serif text-4xl md:text-6xl font-black text-brand-900 tracking-tight leading-tight mb-8">
                Rekomendasi <span class="text-brand-500 italic font-serif">Rute Personal</span>
            </h1>
            
            <div class="flex flex-wrap items-center justify-center gap-3 md:gap-5 font-sans text-sm font-semibold text-brand-900">
                <div class="bg-white px-6 py-3 rounded-2xl border border-gray-100 shadow-luxury flex items-center transition hover:-translate-y-1">
                    <span class="text-2xl mr-3 opacity-80" aria-hidden="true">🗓️</span>
                    <div class="text-left">
                        <span class="block text-[10px] text-gray-400 uppercase tracking-widest">Durasi</span>
                        <span class="text-base">{{ $days ?? '-' }} Hari</span>
                    </div>
                </div>
                
                <div class="bg-white px-6 py-3 rounded-2xl border border-gray-100 shadow-luxury flex items-center transition hover:-translate-y-1">
                    <span class="text-2xl mr-3 opacity-80" aria-hidden="true">🎯</span>
                    <div class="text-left">
                        <span class="block text-[10px] text-gray-400 uppercase tracking-widest">Fokus</span>
                        <span class="text-base uppercase">{{ $interest ?? '-' }}</span>
                    </div>
                </div>
                
                <div class="bg-white px-6 py-3 rounded-2xl border border-gray-100 shadow-luxury flex items-center transition hover:-translate-y-1">
                    <span class="text-2xl mr-3 opacity-80" aria-hidden="true">🏃</span>
                    <div class="text-left">
                        <span class="block text-[10px] text-gray-400 uppercase tracking-widest">Ritme (Pace)</span>
                        <span class="text-base uppercase">{{ $pace ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-6 py-16 lg:py-24 bg-brand-50">
        <div class="space-y-20 relative">
            <div class="hidden md:block absolute left-[3.25rem] top-20 bottom-0 w-1.5 bg-gradient-to-b from-brand-500 via-gray-200 to-transparent rounded-full opacity-50" aria-hidden="true"></div>

            @foreach($generatedItinerary as $day => $items)
                <div class="relative">
                    <div class="flex items-center mb-10 relative z-10">
                        <div class="bg-brand-500 text-white font-serif font-black text-2xl w-20 h-20 rounded-[1.5rem] flex items-center justify-center shrink-0 shadow-lg shadow-brand-500/30 border-4 border-brand-50 relative group cursor-default transition hover:scale-105">
                            <span class="absolute -top-1 -right-1 w-5 h-5 bg-brand-900 border-4 border-brand-50 rounded-full"></span>
                            H{{ $day }}
                        </div>
                        <div class="ml-6 w-full border-b-2 border-gray-200/60 pb-3 flex flex-col sm:flex-row sm:items-end justify-between gap-3">
                            <h3 class="font-serif text-3xl md:text-4xl font-bold text-brand-900 leading-none">
                                Jadwal Hari Ke-{{ $day }}
                            </h3>
                            <span class="text-sm font-sans font-bold text-gray-400 uppercase tracking-widest bg-white px-3 py-1.5 rounded-lg border border-gray-100 shadow-sm self-start sm:self-auto">
                                {{ count($items) }} Aktivitas
                            </span>
                        </div>
                    </div>

                    <div class="md:pl-[6.5rem] space-y-6">
                        @forelse($items as $index => $data)
                            <div class="group flex flex-col sm:flex-row items-center gap-6 bg-white p-5 sm:pr-8 rounded-[2rem] border border-gray-100 shadow-sm hover:shadow-luxury transition-all duration-500 relative overflow-hidden">
                                
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent to-brand-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                                
                                <div class="hidden sm:flex bg-brand-900/5 text-brand-900 font-serif font-black text-xl w-14 h-14 rounded-[1rem] items-center justify-center shrink-0 border border-brand-900/10 z-10 group-hover:bg-brand-900 group-hover:text-white transition-colors duration-300">
                                    {{ $index + 1 }}
                                </div>
                                
                                <div class="w-full sm:w-40 h-48 sm:h-32 shrink-0 rounded-[1.5rem] overflow-hidden bg-gray-100 z-10 shadow-sm relative">
                                    <img 
                                        src="{{ $data['item']->thumbnail ? asset('storage/'.$data['item']->thumbnail) : 'https://placehold.co/400x300?text=No+Image' }}" 
                                        alt="{{ $data['item']->name }}" 
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                    >
                                    <div class="absolute inset-0 ring-1 ring-inset ring-black/10 rounded-[1.5rem]"></div>
                                </div>

                                <div class="flex-grow text-center sm:text-left py-2 z-10 w-full">
                                    @if($data['type'] == 'destination')
                                        <div class="mb-3">
                                            <span class="text-[10px] font-bold bg-blue-50 border border-blue-100 text-blue-700 px-3 py-1.5 rounded-full uppercase tracking-widest shadow-sm">
                                                Destinasi Pilihan
                                            </span>
                                        </div>
                                        <h4 class="font-serif text-xl md:text-2xl font-bold text-brand-900 mb-2 group-hover:text-brand-500 transition">{{ $data['item']->name }}</h4>
                                        <p class="text-sm text-gray-500 font-sans mb-4 flex items-center justify-center sm:justify-start">
                                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path></svg>
                                            Desa {{ $data['item']->village->name ?? '-' }}
                                        </p>
                                        <a href="{{ route('destination.show', $data['item']->slug) }}" class="inline-flex items-center text-sm font-bold text-brand-900 hover:text-brand-500 transition bg-gray-50 hover:bg-brand-500/10 px-4 py-2 rounded-xl border border-gray-100" aria-label="Lihat detail destinasi {{ $data['item']->name }}">
                                            Lihat Info Destinasi 
                                            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                        </a>
                                    @else
                                        <div class="mb-3">
                                            <span class="text-[10px] font-bold bg-emerald-50 border border-emerald-100 text-emerald-700 px-3 py-1.5 rounded-full uppercase tracking-widest shadow-sm">
                                                Kunjungan UMKM
                                            </span>
                                        </div>
                                        <h4 class="font-serif text-xl md:text-2xl font-bold text-brand-900 mb-2 group-hover:text-brand-500 transition">{{ $data['item']->name }}</h4>
                                        <div class="flex items-center justify-center sm:justify-start gap-2 mb-4">
                                            <span class="text-xs font-bold text-gray-500 font-sans bg-gray-50 px-3 py-1 rounded-lg border border-gray-100">{{ $data['item']->category }}</span>
                                        </div>
                                        <a href="{{ route('umkm.show', $data['item']->slug) }}" class="inline-flex items-center text-sm font-bold text-brand-900 hover:text-brand-500 transition bg-gray-50 hover:bg-brand-500/10 px-4 py-2 rounded-xl border border-gray-100" aria-label="Lihat profil produk {{ $data['item']->name }}">
                                            Lihat Profil Produk
                                            <svg class="w-4 h-4 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="bg-white rounded-[2rem] p-10 border border-gray-100 text-center shadow-sm">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100">
                                    <span class="text-2xl grayscale" aria-hidden="true">🏜️</span>
                                </div>
                                <h5 class="font-serif font-bold text-brand-900 mb-2">Jadwal Kosong</h5>
                                <p class="text-gray-500 font-sans text-sm">Tidak ada rute yang tersedia untuk hari ini sesuai dengan kriteria yang dipilih.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-24 pt-12 border-t border-gray-200 flex flex-col sm:flex-row justify-center gap-4 sm:gap-6 print:hidden">
             <a href="{{ route('planner.index') }}" class="inline-flex items-center justify-center bg-white border border-gray-200 text-brand-900 font-serif font-bold py-4 px-8 md:px-10 rounded-full hover:bg-brand-50 transition shadow-sm hover:shadow-md group">
                 <svg class="w-5 h-5 mr-2 group-hover:-rotate-90 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                 Ubah Kriteria AI
             </a>
             <button onclick="window.print()" class="inline-flex items-center justify-center bg-brand-900 text-white font-serif font-bold py-4 px-8 md:px-10 rounded-full hover:bg-brand-500 transition shadow-xl shadow-brand-900/20 group">
                 <svg class="w-5 h-5 mr-2 group-hover:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2-2v4h10z"></path></svg>
                 Simpan & Cetak (PDF)
             </button>
        </div>

        <style>
            @media print {
                body { background-color: #ffffff !important; }
                nav, footer, .print\:hidden { display: none !important; }
                .shadow-luxury, .shadow-sm, .shadow-lg, .shadow-xl { box-shadow: none !important; }
                .bg-brand-50 { background-color: #ffffff !important; }
                /* Memastikan background warna tercetak dengan baik di PDF */
                * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
                /* Mencegah card terpotong saat ganti halaman PDF */
                .group { page-break-inside: avoid; break-inside: avoid; }
            }
        </style>
    </section>
@endsection