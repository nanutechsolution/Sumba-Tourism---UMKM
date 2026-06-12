@extends('layouts.frontend')

@section('content')
    <!-- Header -->
    <section class="relative w-full h-[50vh] bg-gray-900">
        <img src="{{ $itinerary->thumbnail ? asset('storage/'.$itinerary->thumbnail) : 'https://placehold.co/1200x600/eeeeee/999999?text=Sampul' }}" 
             alt="{{ $itinerary->name }}" 
             class="w-full h-full object-cover opacity-60">
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-full pb-12 text-center">
            <div class="max-w-4xl mx-auto px-4">
                <span class="inline-block bg-amber-500 text-gray-900 text-sm font-black px-4 py-1.5 rounded-full uppercase tracking-wider mb-4 shadow-lg">
                    Rekomendasi Trip {{ $itinerary->duration_days }} Hari
                </span>
                <h1 class="text-4xl md:text-6xl font-black text-white tracking-tight leading-tight drop-shadow-lg mb-4">
                    {{ $itinerary->name }}
                </h1>
                @if($itinerary->estimated_budget)
                    <p class="text-xl text-gray-300 font-bold">Estimasi Biaya: <span class="text-amber-400">Rp {{ number_format($itinerary->estimated_budget, 0, ',', '.') }}</span> / Orang</p>
                @endif
            </div>
        </div>
    </section>

    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Deskripsi Paket -->
        @if($itinerary->description)
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 md:p-12 mb-16 text-center">
                <div class="prose prose-lg text-gray-700 max-w-none mx-auto">
                    {!! $itinerary->description !!}
                </div>
            </div>
        @endif

        <!-- Timeline Rute Perjalanan -->
        <h2 class="text-3xl font-black text-gray-900 text-center mb-12 uppercase tracking-tight">Rute Perjalanan Anda</h2>

        <div class="space-y-16">
            @forelse($groupedDestinations as $day => $destinations)
                <div class="relative">
                    <!-- Garis Vertikal Timeline (Hanya tampil di Desktop) -->
                    <div class="hidden md:block absolute left-8 top-16 bottom-0 w-1 bg-gray-200 rounded-full"></div>

                    <!-- Label Hari -->
                    <div class="flex items-center mb-8 relative z-10">
                        <div class="bg-gray-900 text-white font-black text-xl w-16 h-16 rounded-2xl flex items-center justify-center shrink-0 shadow-lg border-4 border-white">
                            H{{ $day }}
                        </div>
                        <h3 class="text-2xl font-black text-gray-900 ml-6 uppercase border-b-4 border-amber-500 pb-1">Hari Ke-{{ $day }}</h3>
                    </div>

                    <!-- List Destinasi pada Hari Tersebut -->
                    <div class="md:pl-20 space-y-6">
                        @foreach($destinations as $index => $dest)
                            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 flex flex-col sm:flex-row items-center gap-6 hover:shadow-md transition group">
                                <!-- Nomor Urut -->
                                <div class="bg-amber-100 text-amber-600 font-black text-lg w-10 h-10 rounded-full flex items-center justify-center shrink-0">
                                    {{ $index + 1 }}
                                </div>
                                
                                <!-- Foto Thumbnail Kecil -->
                                <div class="w-full sm:w-32 h-32 shrink-0 rounded-2xl overflow-hidden bg-gray-100">
                                    <img src="{{ $dest->thumbnail ? asset('storage/'.$dest->thumbnail) : 'https://placehold.co/200/eeeeee/999999' }}" alt="Destinasi" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                </div>

                                <!-- Info Detail -->
                                <div class="flex-grow text-center sm:text-left">
                                    <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $dest->name }}</h4>
                                    <p class="text-sm text-gray-500 mb-4 flex items-center justify-center sm:justify-start font-medium">
                                        <svg class="w-4 h-4 mr-1 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path></svg>
                                        Desa {{ $dest->village->name ?? 'SBD' }}
                                    </p>
                                    <a href="{{ route('destination.show', $dest->slug) }}" class="inline-block bg-gray-100 text-gray-900 font-bold px-6 py-2 rounded-xl hover:bg-amber-500 transition text-sm">
                                        Lihat Detail Tempat
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center py-20 bg-gray-50 rounded-3xl border border-gray-200">
                    <p class="text-gray-500 font-medium">Rute perjalanan belum ditambahkan.</p>
                </div>
            @endforelse
        </div>
        
        <div class="mt-16 text-center">
             <a href="{{ route('itinerary.index') }}" class="inline-block bg-gray-900 text-white font-bold py-3.5 px-8 rounded-xl hover:bg-amber-500 hover:text-gray-900 transition shadow-md">
                 Lihat Paket Lainnya
             </a>
        </div>
    </section>
@endsection