@extends('layouts.frontend')

@section('content')
<!-- Header Image Section -->
<section class="relative w-full h-[50vh] md:h-[60vh] bg-gray-900">
    <img src="{{ $destination->thumbnail ? asset('storage/'.$destination->thumbnail) : 'https://placehold.co/1200x600/eeeeee/999999?text=Gambar+Wisata' }}"
        alt="{{ $destination->name }}"
        class="w-full h-full object-cover opacity-80">
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>

    <div class="absolute bottom-0 left-0 w-full pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="inline-block bg-amber-500 text-gray-900 text-sm font-black px-4 py-1.5 rounded-full uppercase tracking-wider mb-4 shadow-lg">
                Desa {{ $destination->village->name ?? 'Sumba Barat Daya' }}
            </div>
            <h1 class="text-4xl md:text-6xl font-black text-white tracking-tight leading-tight drop-shadow-lg">
                {{ $destination->name }}
            </h1>

            <!-- Tampilan Rata-rata Rating (Opsional) -->
            @if($destination->reviews->count() > 0)
            <div class="mt-4 flex items-center">
                <div class="flex text-amber-400">
                    @for($i = 0; $i < 5; $i++)
                        <svg class="w-6 h-6" fill="{{ $i < round($destination->reviews->avg('rating')) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                        @endfor
                </div>
                <span class="ml-2 text-white font-medium">{{ number_format($destination->reviews->avg('rating'), 1) }} / 5.0 ({{ $destination->reviews->count() }} Ulasan)</span>
            </div>
            @endif
        </div>
    </div>
</section>
<!-- ... (Bagian Header Image Section sama persis) ... -->

    <!-- Notifikasi Sukses -->
    @if(session('success'))
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
            <span class="block sm:inline font-bold">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <!-- Content Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <!-- Main Content (Deskripsi, Ulasan, Rekomendasi UMKM) -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-12 mb-10">
                    <h2 class="text-2xl font-black text-gray-900 border-b-4 border-amber-500 pb-4 inline-block mb-8">Tentang Destinasi</h2>
                    
                    <div class="prose prose-lg text-gray-700 max-w-none">
                        {!! $destination->description !!}
                    </div>

                    @if($destination->gallery && is_array($destination->gallery) && count($destination->gallery) > 0)
                        <div class="mt-12">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Galeri Foto</h3>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($destination->gallery as $image)
                                    <div class="relative h-32 md:h-48 rounded-xl overflow-hidden shadow-sm">
                                        <img src="{{ asset('storage/'.$image) }}" alt="Gallery image" class="w-full h-full object-cover hover:scale-110 transition duration-500">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- NEW FITUR: Rekomendasi UMKM Terdekat (LBS) -->
                @if(isset($nearbyUmkms) && $nearbyUmkms->count() > 0)
                <div class="bg-amber-50 rounded-3xl shadow-sm border border-amber-100 p-8 md:p-12 mb-10 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-8 text-amber-200 opacity-30">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    </div>
                    <div class="relative z-10">
                        <h2 class="text-2xl font-black text-gray-900 mb-2">Belanja & Kuliner Terdekat</h2>
                        <p class="text-gray-700 mb-8 font-medium">Berdasarkan lokasi destinasi ini, berikut rekomendasi UMKM yang bisa Anda kunjungi di sekitar sini.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($nearbyUmkms as $umkm)
                                <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-start gap-4 hover:shadow-md transition">
                                    <div class="w-20 h-20 shrink-0 rounded-xl overflow-hidden bg-gray-100">
                                        <img src="{{ $umkm->thumbnail ? asset('storage/'.$umkm->thumbnail) : 'https://placehold.co/100/eeeeee/999999' }}" alt="{{ $umkm->name }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="font-bold text-gray-900 text-sm mb-1 line-clamp-1">{{ $umkm->name }}</h4>
                                        <p class="text-xs font-bold text-amber-600 mb-2">{{ $umkm->category }}</p>
                                        <div class="flex items-center justify-between mt-auto">
                                            <span class="text-xs font-bold bg-gray-100 text-gray-600 px-2 py-1 rounded-md">
                                                ~ {{ $umkm->distance_km }} KM
                                            </span>
                                            <a href="{{ route('umkm.show', $umkm->slug) }}" class="text-xs font-bold text-white bg-gray-900 px-3 py-1.5 rounded-lg hover:bg-amber-500 transition">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <!-- Bagian Ulasan (Sama persis seperti sebelumnya) -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-12">
                    <h2 class="text-2xl font-black text-gray-900 mb-8">Ulasan Pengunjung ({{ $destination->reviews->count() }})</h2>
                    
                    <div class="space-y-6 mb-12">
                        @forelse($destination->reviews as $review)
                            <!-- ... (Blok looping review sama) ... -->
                            <div class="border-b border-gray-100 pb-6 last:border-0 last:pb-0">
                                <div class="flex justify-between items-start mb-2">
                                    <h4 class="font-bold text-gray-900">{{ $review->reviewer_name }}</h4>
                                    <span class="text-xs text-gray-500 font-medium">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="flex text-amber-500 mb-3">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="w-4 h-4" fill="{{ $i < $review->rating ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                    @endfor
                                </div>
                                <p class="text-gray-700">{{ $review->comment }}</p>
                            </div>
                        @empty
                            <p class="text-gray-500 italic">Belum ada ulasan untuk destinasi ini. Jadilah yang pertama!</p>
                        @endforelse
                    </div>

                    <!-- Form Tambah Ulasan -->
                    <div class="bg-gray-50 rounded-2xl p-6 md:p-8 border border-gray-200">
                        <h3 class="text-lg font-bold text-gray-900 mb-6">Bagikan Pengalaman Anda</h3>
                        <form action="{{ route('review.store', $destination->id) }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="reviewer_name" class="block text-sm font-bold text-gray-700 mb-2">Nama Anda</label>
                                <input type="text" name="reviewer_name" id="reviewer_name" required class="w-full rounded-xl border-gray-300 focus:border-amber-500 focus:ring-amber-500 shadow-sm px-4 py-3" placeholder="Masukkan nama lengkap">
                            </div>
                            <div class="mb-4">
                                <label for="rating" class="block text-sm font-bold text-gray-700 mb-2">Penilaian (Bintang)</label>
                                <select name="rating" id="rating" required class="w-full rounded-xl border-gray-300 focus:border-amber-500 focus:ring-amber-500 shadow-sm px-4 py-3 font-medium">
                                    <option value="5">5 - Sangat Bagus Sekali</option>
                                    <option value="4">4 - Bagus</option>
                                    <option value="3">3 - Cukup</option>
                                    <option value="2">2 - Kurang</option>
                                    <option value="1">1 - Sangat Kurang</option>
                                </select>
                            </div>
                            <div class="mb-6">
                                <label for="comment" class="block text-sm font-bold text-gray-700 mb-2">Komentar Singkat</label>
                                <textarea name="comment" id="comment" rows="4" required class="w-full rounded-xl border-gray-300 focus:border-amber-500 focus:ring-amber-500 shadow-sm px-4 py-3" placeholder="Ceritakan pengalaman menyenangkan Anda..."></textarea>
                            </div>
                            <button type="submit" class="bg-gray-900 text-white font-bold py-3 px-8 rounded-xl hover:bg-amber-500 hover:text-gray-900 transition duration-300 w-full md:w-auto shadow-md">
                                Kirim Ulasan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar Informasi (Lokasi & Peta Spesifik) -->
            <div class="lg:col-span-1">
                <div class="bg-gray-50 rounded-3xl shadow-sm border border-gray-200 p-8 sticky top-28">
                    <h3 class="text-xl font-black text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        Informasi Lokasi
                    </h3>
                    
                    <ul class="space-y-4 text-gray-700 mb-8">
                        <li class="flex flex-col">
                            <span class="text-sm font-bold text-gray-500 uppercase tracking-wider">Kecamatan</span>
                            <span class="font-medium text-lg">{{ $destination->village->district->name ?? '-' }}</span>
                        </li>
                        <li class="flex flex-col">
                            <span class="text-sm font-bold text-gray-500 uppercase tracking-wider">Desa / Kelurahan</span>
                            <span class="font-medium text-lg">{{ $destination->village->name ?? '-' }}</span>
                        </li>
                        @if($destination->address)
                        <li class="flex flex-col pt-4 border-t border-gray-200">
                            <span class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Alamat Lengkap</span>
                            <span class="font-medium">{{ $destination->address }}</span>
                        </li>
                        @endif
                    </ul>

                    <!-- NEW FITUR: Peta Mini Destinasi -->
                    @if($destination->latitude && $destination->longitude)
                        <div class="rounded-xl overflow-hidden border border-gray-200 shadow-inner h-48 mb-6">
                            <div id="mini-map" class="w-full h-full z-10"></div>
                        </div>
                        
                        <a href="https://www.google.com/maps/dir/?api=1&destination={{ $destination->latitude }},{{ $destination->longitude }}" 
                           target="_blank"
                           class="w-full flex items-center justify-center bg-blue-600 text-white font-bold py-3.5 rounded-xl hover:bg-blue-700 transition shadow-md mb-4">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                            Rute Google Maps
                        </a>

                        <script>
                            document.addEventListener('DOMContentLoaded', function () {
                                var miniMap = L.map('mini-map', { zoomControl: false }).setView([{{ $destination->latitude }}, {{ $destination->longitude }}], 14);
                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(miniMap);
                                
                                var destIcon = L.divIcon({
                                    className: 'leaflet-custom-icon',
                                    html: `<svg class="w-8 h-8 text-amber-500 drop-shadow-md" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>`,
                                    iconSize: [32, 32], iconAnchor: [16, 32]
                                });
                                L.marker([{{ $destination->latitude }}, {{ $destination->longitude }}], {icon: destIcon}).addTo(miniMap);
                            });
                        </script>
                    @endif

                    <a href="/" class="block w-full text-center bg-gray-200 text-gray-900 font-bold py-3.5 rounded-xl hover:bg-gray-300 transition">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection