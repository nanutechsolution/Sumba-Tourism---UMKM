@extends('layouts.frontend')

@section('content')
    <section class="bg-amber-500 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-black text-gray-900 uppercase tracking-tight mb-4">Direktori UMKM Lokal</h1>
            <p class="text-lg text-gray-900 font-medium max-w-2xl mx-auto">Dukung roda perekonomian Sumba Barat Daya dengan membeli produk asli buatan tangan dan layanan warga lokal.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($umkms as $item)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden border border-gray-100 flex flex-col">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $item->thumbnail ? asset('storage/'.$item->thumbnail) : 'https://placehold.co/400x300/eeeeee/999999?text=Logo+UMKM' }}" 
                             alt="{{ $item->name }}" 
                             class="w-full h-full object-cover">
                        <div class="absolute top-3 right-3 bg-gray-900 text-amber-500 text-xs font-bold px-3 py-1 rounded-full uppercase">
                            {{ $item->category }}
                        </div>
                    </div>
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $item->name }}</h3>
                        <p class="text-sm text-gray-500 mb-4 flex items-center font-medium">
                            <svg class="w-4 h-4 mr-1 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path></svg>
                            Desa {{ $item->village->name ?? '-' }}
                        </p>
                        <div class="mt-auto">
                            <a href="{{ route('umkm.show', $item->slug) }}" class="block text-center w-full bg-amber-500 text-gray-900 font-bold py-2.5 rounded-xl hover:bg-gray-900 hover:text-white transition shadow-sm">
                                Lihat Profil
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-300">
                    <p class="text-gray-500 font-medium text-lg">Belum ada data UMKM yang dipublikasikan.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $umkms->links() }}
        </div>
    </section>
@endsection