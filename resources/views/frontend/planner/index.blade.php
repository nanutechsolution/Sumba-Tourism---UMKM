@extends('layouts.frontend')

@section('content')
<div id="ai-loader" class="fixed inset-0 z-[100] bg-brand-950/95 backdrop-blur-xl hidden flex-col items-center justify-center transition-all duration-500">
    <div class="relative w-40 h-40 mb-10">
        <div class="absolute inset-0 border-4 border-brand-500/20 rounded-full animate-[ping_2s_cubic-bezier(0,0,0.2,1)_infinite]"></div>
        <div class="absolute inset-4 border-4 border-brand-500/40 rounded-full animate-pulse"></div>
        <div class="absolute inset-8 border-4 border-brand-500/60 rounded-full animate-[spin_3s_linear_infinite] border-t-transparent border-l-transparent"></div>
        <div class="absolute inset-12 bg-brand-500 rounded-full flex items-center justify-center shadow-lg shadow-brand-500/50">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
            </svg>
        </div>
    </div>

    <h2 class="font-serif text-3xl md:text-4xl font-black text-white mb-3 tracking-widest uppercase flex items-center">
        AI Engine <span class="text-brand-500 ml-3 animate-pulse">Active</span>
    </h2>

    <div class="bg-black/30 px-6 py-3 rounded-lg border border-white/10 font-mono text-sm md:text-base">
        <span class="text-green-400 mr-2">➜</span>
        <span id="ai-loading-text" class="text-brand-200 tracking-wider">Menganalisis parameter Anda...</span><span class="animate-pulse text-brand-500">_</span>
    </div>
</div>

<section class="pt-32 pb-24 lg:pt-48 lg:pb-32 px-6 relative bg-brand-950 overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-20">
        <img src="https://images.unsplash.com/photo-1544644181-1484b3fdfc62?q=80&w=2000&auto=format&fit=crop" class="w-full h-full object-cover" alt="Sumba Landscape">
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-brand-50/10 via-brand-950/80 to-brand-950/40 z-10"></div>

    <div class="max-w-4xl mx-auto text-center relative z-20">
        <span class="inline-flex items-center bg-white/10 backdrop-blur-md text-white text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-widest mb-6 shadow-sm border border-white/20">
            <span class="w-2 h-2 rounded-full bg-brand-500 mr-2 animate-pulse"></span>
            AI Planner Engine v2.0
        </span>
        <h1 class="font-serif text-4xl md:text-5xl lg:text-6xl font-bold text-white tracking-tight leading-tight mb-6">
            Rancang Rute <span class="text-brand-500 italic">Sempurna Anda</span>
        </h1>
        <p class="text-brand-100 text-lg font-sans max-w-2xl mx-auto leading-relaxed">
            Tidak perlu pusing mengatur jadwal. Beritahu algoritma kami apa yang Anda suka, dan dapatkan rute perjalanan personal dalam hitungan detik.
        </p>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 pb-24 relative z-30 -mt-16 md:-mt-20">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

        <div class="lg:col-span-8 bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 md:p-12">
            <form action="{{ route('planner.generate') }}" method="POST" onsubmit="startAIEngine(event, this)">
                @csrf

                <div class="mb-12 border-b border-gray-100 pb-12">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-10 h-10 rounded-2xl bg-brand-900 text-white flex items-center justify-center font-serif font-bold text-lg shadow-md">1</div>
                        <div>
                            <label class="block font-serif text-xl font-bold text-brand-900">Durasi Eksplorasi</label>
                            <p class="text-sm text-gray-500 font-sans">Berapa lama Anda akan menjelajah Sumba?</p>
                        </div>
                    </div>

                    <div class="px-2 md:px-6">
                        <input type="range" name="days" min="1" max="7" value="3" class="w-full h-3 bg-gray-100 rounded-lg appearance-none cursor-pointer accent-brand-500" oninput="document.getElementById('days-output').innerText = this.value + ' Hari Eksplorasi'">
                        <div class="flex justify-between text-xs font-bold text-gray-400 mt-3 px-1 uppercase tracking-widest font-sans">
                            <span>1 Hari</span>
                            <span>7 Hari</span>
                        </div>
                        <div class="text-center mt-6">
                            <span id="days-output" class="font-serif text-3xl font-black text-brand-600 bg-brand-500/10 px-8 py-3 rounded-full border border-brand-500/20 inline-block shadow-sm">3 Hari Eksplorasi</span>
                        </div>
                    </div>
                </div>

                <div class="mb-12 border-b border-gray-100 pb-12">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-10 h-10 rounded-2xl bg-brand-900 text-white flex items-center justify-center font-serif font-bold text-lg shadow-md">2</div>
                        <div>
                            <label class="block font-serif text-xl font-bold text-brand-900">Fokus Destinasi</label>
                            <p class="text-sm text-gray-500 font-sans">Apa yang paling ingin Anda lihat & rasakan?</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 md:gap-6">
                        <div class="relative">
                            <input type="radio" id="interest-campur" name="interest" value="campur" class="peer hidden" checked>
                            <label for="interest-campur" class="cursor-pointer flex flex-col items-center justify-center h-40 p-4 rounded-[2rem] border-2 border-transparent peer-checked:border-brand-500 peer-checked:ring-4 peer-checked:ring-brand-500/20 transition duration-300 relative overflow-hidden group">
                                <div class="absolute inset-0 bg-gradient-to-br from-brand-900 to-brand-950 opacity-90 group-hover:opacity-100 transition"></div>
                                <div class="relative z-10 flex flex-col items-center">
                                    <span class="block text-4xl mb-3">🧭</span>
                                    <span class="font-serif font-bold text-white text-lg">Semuanya</span>
                                    <span class="text-xs text-brand-200 font-sans mt-1">Kombinasi Terbaik</span>
                                </div>
                                <div class="absolute top-4 right-4 bg-brand-500 text-white rounded-full p-1 opacity-0 peer-checked:opacity-100 transition shadow-md scale-50 peer-checked:scale-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </label>
                        </div>
                        <div class="relative">
                            <input type="radio" id="interest-alam" name="interest" value="alam" class="peer hidden">
                            <label for="interest-alam" class="cursor-pointer flex flex-col items-center justify-center h-40 p-4 rounded-[2rem] border-2 border-transparent peer-checked:border-brand-500 peer-checked:ring-4 peer-checked:ring-brand-500/20 transition duration-300 relative overflow-hidden group">
                                <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=800')] bg-cover bg-center transition duration-500 group-hover:scale-110"></div>
                                <div class="absolute inset-0 bg-brand-950/70 peer-checked:bg-brand-950/80 transition"></div>
                                <div class="relative z-10 flex flex-col items-center">
                                    <span class="block text-4xl mb-3">🌊</span>
                                    <span class="font-serif font-bold text-white text-lg">Alam & Pantai</span>
                                </div>
                                <div class="absolute top-4 right-4 bg-brand-500 text-white rounded-full p-1 opacity-0 peer-checked:opacity-100 transition shadow-md scale-50 peer-checked:scale-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </label>
                        </div>
                        <div class="relative">
                            <input type="radio" id="interest-budaya" name="interest" value="budaya" class="peer hidden">
                            <label for="interest-budaya" class="cursor-pointer flex flex-col items-center justify-center h-40 p-4 rounded-[2rem] border-2 border-transparent peer-checked:border-brand-500 peer-checked:ring-4 peer-checked:ring-brand-500/20 transition duration-300 relative overflow-hidden group">
                                <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1604928141064-207cea6f571f?q=80&w=800')] bg-cover bg-center transition duration-500 group-hover:scale-110"></div>
                                <div class="absolute inset-0 bg-brand-950/70 peer-checked:bg-brand-950/80 transition"></div>
                                <div class="relative z-10 flex flex-col items-center">
                                    <span class="block text-4xl mb-3">🛖</span>
                                    <span class="font-serif font-bold text-white text-lg">Adat Budaya</span>
                                </div>
                                <div class="absolute top-4 right-4 bg-brand-500 text-white rounded-full p-1 opacity-0 peer-checked:opacity-100 transition shadow-md scale-50 peer-checked:scale-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </label>
                        </div>
                        <div class="relative">
                            <input type="radio" id="interest-kuliner" name="interest" value="kuliner" class="peer hidden">
                            <label for="interest-kuliner" class="cursor-pointer flex flex-col items-center justify-center h-40 p-4 rounded-[2rem] border-2 border-transparent peer-checked:border-brand-500 peer-checked:ring-4 peer-checked:ring-brand-500/20 transition duration-300 relative overflow-hidden group">
                                <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1534080564583-6be75777b70a?q=80&w=800')] bg-cover bg-center transition duration-500 group-hover:scale-110"></div>
                                <div class="absolute inset-0 bg-brand-950/70 peer-checked:bg-brand-950/80 transition"></div>
                                <div class="relative z-10 flex flex-col items-center">
                                    <span class="block text-4xl mb-3">🍲</span>
                                    <span class="font-serif font-bold text-white text-lg">Kuliner & Kriya</span>
                                </div>
                                <div class="absolute top-4 right-4 bg-brand-500 text-white rounded-full p-1 opacity-0 peer-checked:opacity-100 transition shadow-md scale-50 peer-checked:scale-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-12">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-10 h-10 rounded-2xl bg-brand-900 text-white flex items-center justify-center font-serif font-bold text-lg shadow-md">3</div>
                        <div>
                            <label class="block font-serif text-xl font-bold text-brand-900">Ritme Perjalanan (Pace)</label>
                            <p class="text-sm text-gray-500 font-sans">Bagaimana Anda ingin menikmati waktu?</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="relative">
                            <input type="radio" id="pace-santai" name="pace" value="santai" class="peer hidden" checked>
                            <label for="pace-santai" class="cursor-pointer block p-6 rounded-[1.5rem] border-2 border-transparent bg-gray-50/50 peer-checked:border-brand-500 peer-checked:bg-brand-500/10 peer-checked:ring-4 peer-checked:ring-brand-500/20 peer-checked:shadow-md transition-all duration-300 h-full relative overflow-hidden group">
                                <div class="absolute top-4 right-4 bg-brand-500 text-white rounded-full p-1 opacity-0 peer-checked:opacity-100 transition shadow-md scale-50 peer-checked:scale-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div class="flex items-center justify-between mb-3 relative z-10 pr-6">
                                    <h4 class="font-serif text-xl font-bold text-gray-400 peer-checked:text-brand-900 transition">Santai (Slow)</h4>
                                    <span class="text-3xl grayscale peer-checked:grayscale-0 transition group-hover:scale-110">🌴</span>
                                </div>
                                <p class="text-sm text-gray-500 font-sans leading-relaxed relative z-10">Lebih banyak waktu menikmati tiap lokasi. Santai di pantai, berbincang lama dengan warga. (Maks 2-3 tempat/hari).</p>
                            </label>
                        </div>
                        <div class="relative">
                            <input type="radio" id="pace-padat" name="pace" value="padat" class="peer hidden">
                            <label for="pace-padat" class="cursor-pointer block p-6 rounded-[1.5rem] border-2 border-transparent bg-gray-50/50 peer-checked:border-brand-500 peer-checked:bg-brand-500/10 peer-checked:ring-4 peer-checked:ring-brand-500/20 peer-checked:shadow-md transition-all duration-300 h-full relative overflow-hidden group">
                                <div class="absolute top-4 right-4 bg-brand-500 text-white rounded-full p-1 opacity-0 peer-checked:opacity-100 transition shadow-md scale-50 peer-checked:scale-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div class="flex items-center justify-between mb-3 relative z-10 pr-6">
                                    <h4 class="font-serif text-xl font-bold text-gray-400 peer-checked:text-brand-900 transition">Padat (Fast)</h4>
                                    <span class="text-3xl grayscale peer-checked:grayscale-0 transition group-hover:scale-110">🔥</span>
                                </div>
                                <p class="text-sm text-gray-500 font-sans leading-relaxed relative z-10">Mengeksplorasi sebanyak mungkin tempat. Cocok untuk jiwa petualang yang memiliki waktu terbatas. (Hingga 5 tempat/hari).</p>
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-brand-900 text-white font-serif font-black text-xl py-5 rounded-full hover:bg-brand-500 transition duration-300 shadow-xl shadow-brand-900/20 flex justify-center items-center group overflow-hidden relative">
                    <div class="absolute inset-0 bg-white/20 w-full transform -translate-x-full group-hover:translate-x-full transition duration-700"></div>
                    <svg class="w-6 h-6 mr-3 text-brand-500 group-hover:text-white transition group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                    <span class="relative z-10">Mulai Generate Rute</span>
                </button>
            </form>
        </div>

        <div class="lg:col-span-4 space-y-6">
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100">
                <div class="w-12 h-12 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="font-serif font-bold text-brand-900 text-xl mb-3">Bagaimana AI Bekerja?</h3>
                <p class="text-sm text-gray-500 font-sans leading-relaxed mb-4">
                    Sistem kami menggunakan <span class="font-bold text-gray-700">Heuristic Algorithm</span> yang memindai puluhan destinasi dan ratusan produk UMKM di database kami, lalu mencocokkannya dengan kriteria yang Anda pilih.
                </p>
                <ul class="space-y-3 text-sm font-sans text-gray-600">
                    <li class="flex items-center"><svg class="w-4 h-4 text-brand-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg> Filtrasi berdasarkan kategori</li>
                    <li class="flex items-center"><svg class="w-4 h-4 text-brand-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg> Kalkulasi bobot ritme (Pace)</li>
                    <li class="flex items-center"><svg class="w-4 h-4 text-brand-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg> Pengacakan rute anti-bosan</li>
                </ul>
            </div>

            <div class="bg-brand-900 text-white rounded-[2rem] p-8 shadow-sm relative overflow-hidden">
                <svg class="absolute top-0 right-0 w-32 h-32 text-brand-950/30 -mt-10 -mr-10" viewBox="0 0 100 100" fill="currentColor">
                    <circle cx="50" cy="50" r="50" />
                </svg>
                <div class="relative z-10">
                    <h3 class="font-serif font-bold text-brand-200 mb-6 uppercase tracking-widest text-xs">Statistik Sistem</h3>

                    <div class="mb-6">
                        <span class="block font-serif text-4xl font-black text-white">4,208</span>
                        <span class="text-sm font-sans text-brand-200">Rute berhasil di-generate</span>
                    </div>

                    <div class="grid grid-cols-2 gap-4 border-t border-white/20 pt-6">
                        <div>
                            <span class="block font-serif text-2xl font-bold text-brand-500">30+</span>
                            <span class="text-xs font-sans text-brand-200">Pilihan Destinasi</span>
                        </div>
                        <div>
                            <span class="block font-serif text-2xl font-bold text-brand-500">120+</span>
                            <span class="text-xs font-sans text-brand-200">Mitra UMKM Lokal</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-brand-50/20 rounded-[2rem] p-8 border border-brand-500/30">
                <div class="flex text-brand-500 mb-3">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                    </svg>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                    </svg>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                    </svg>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                    </svg>
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                    </svg>
                </div>
                <p class="text-sm text-gray-600 font-sans leading-relaxed italic mb-4">"Fitur ini menyelamatkan liburan saya! Saya tidak tahu harus mulai dari mana di Sumba, dan AI ini meracik rute 5 hari yang sangat seimbang antara pantai dan desa adat."</p>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-gray-200"></div>
                    <span class="font-serif font-bold text-brand-900 text-xs">Ardiansyah, Traveler</span>
                </div>
            </div>

        </div>

    </div>
</section>

<script>
    function startAIEngine(event, form) {
        // Hentikan submit langsung
        event.preventDefault();

        // Tampilkan Overlay Loading
        const loader = document.getElementById('ai-loader');
        loader.classList.remove('hidden');
        loader.classList.add('flex');

        // Animasi pergantian teks Terminal
        const texts = [
            "Menganalisis parameter Anda...",
            "Memindai cuaca & jarak lokasi...",
            "Mencocokkan destinasi Sumba...",
            "Menyelaraskan UMKM terdekat...",
            "Mengkompilasi rute sempurna..."
        ];

        let i = 0;
        const textElement = document.getElementById('ai-loading-text');

        const textInterval = setInterval(() => {
            i++;
            if (i < texts.length) {
                textElement.innerText = texts[i];
            }
        }, 600);

        // Submit form sesungguhnya setelah 3 detik animasi
        setTimeout(() => {
            clearInterval(textInterval);
            form.submit();
        }, 3000);
    }
</script>
@endsection