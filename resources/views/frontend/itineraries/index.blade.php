@extends('layouts.frontend')

@section('content')
    <section class="bg-gray-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tight mb-4">Rekomendasi Rute Perjalanan</h1>
            <p class="text-lg text-gray-400 font-medium max-w-2xl mx-auto">Temukan paket perjalanan terbaik yang dirancang khusus untuk memastikan Anda tidak melewatkan satupun keajaiban Sumba Barat Daya.</p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($itineraries as $item)
                <div class="bg-white rounded-3xl shadow-sm hover:shadow-2xl transition duration-300 overflow-hidden border border-gray-100 flex flex-col group">
                    <div class="relative h-60 overflow-hidden">
                        <img src="{{ $item->thumbnail ? asset('storage/'.$item->thumbnail) : 'https://placehold.co/600x400/eeeeee/999999?text=Gambar+Paket' }}" 
                             alt="{{ $item->name }}" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end">
                            <div>
                                <span class="bg-amber-500 text-gray-900 text-xs font-bold px-3 py-1 rounded-full uppercase mb-2 inline-block">
                                    {{ $item->duration_days }} Hari Trip
                                </span>
                                <h3 class="text-xl font-black text-white leading-tight">{{ $item->name }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <p class="text-gray-600 text-sm mb-6 flex-grow leading-relaxed">
                            {{ Str::limit(strip_tags($item->description), 100, '...') }}
                        </p>
                        @if($item->estimated_budget)
                            <div class="mb-6 flex items-center text-gray-700 font-bold bg-gray-50 p-3 rounded-xl border border-gray-100">
                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Est. Biaya: Rp {{ number_format($item->estimated_budget, 0, ',', '.') }}
                            </div>
                        @endif
                        <a href="{{ route('itinerary.show', $item->slug) }}" class="block text-center w-full bg-gray-900 text-white font-bold py-3.5 rounded-xl hover:bg-amber-500 hover:text-gray-900 transition shadow-md">
                            Lihat Rute Lengkap
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-300">
                    <p class="text-gray-500 font-medium text-lg">Belum ada paket perjalanan yang direkomendasikan.</p>
                </div>
            @endforelse
        </div>
        <div class="mt-12">
            {{ $itineraries->links() }}
        </div>
    </section>
@endsection