@extends('layouts.frontend')

@section('content')
    <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="w-full h-64 md:h-96 relative bg-gray-100">
                <img src="{{ $umkm->thumbnail ? asset('storage/'.$umkm->thumbnail) : 'https://placehold.co/1200x600/eeeeee/999999?text=Logo+UMKM' }}" 
                     alt="{{ $umkm->name }}" 
                     class="w-full h-full object-cover">
            </div>

            <div class="p-8 md:p-12">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-6 border-b border-gray-100 pb-8">
                    <div>
                        <div class="inline-block bg-amber-100 text-amber-800 text-sm font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-3">
                            Kategori: {{ $umkm->category }}
                        </div>
                        <h1 class="text-3xl md:text-5xl font-black text-gray-900 mb-2">{{ $umkm->name }}</h1>
                        <p class="text-gray-500 font-medium text-lg flex items-center">
                            <svg class="w-5 h-5 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path></svg>
                            {{ $umkm->address ?? 'Desa ' . ($umkm->village->name ?? 'SBD') }}
                        </p>
                    </div>

                    @if($umkm->phone_number)
                        <div class="shrink-0">
                            @php
                                $waNumber = preg_replace('/^0/', '62', $umkm->phone_number);
                                $waNumber = preg_replace('/[^0-9]/', '', $waNumber);
                            @endphp
                            <a href="https://wa.me/{{ $waNumber }}?text=Halo,%20saya%20melihat%20usaha%20Anda%20di%20platform%20EXPLORE%20SBD." 
                               target="_blank"
                               class="inline-flex items-center justify-center bg-green-500 text-white font-extrabold px-8 py-4 rounded-full hover:bg-green-600 transition shadow-lg text-lg">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.573-.187-.981-.342-1.714-.649-2.822-2.4-2.909-2.515-.086-.115-.694-.925-.694-1.764s.434-1.258.587-1.42c.152-.163.333-.204.444-.204.11 0 .222.001.318.005.103.005.239-.039.373.284.144.346.491 1.201.535 1.289.043.088.072.191.014.306-.058.115-.087.182-.173.283l-.261.268c-.087.086-.179.18-.079.353.099.172.443.733.953 1.189.658.588 1.21.772 1.396.858.186.086.295.072.404-.044.11-.115.474-.551.604-.74.129-.189.258-.158.416-.099.158.058 1.002.473 1.175.56.173.086.289.143.332.222.043.079.043.46-.101.865z"/></svg>
                                Hubungi via WhatsApp
                            </a>
                        </div>
                    @endif
                </div>

                <div class="prose prose-lg text-gray-700 max-w-none">
                    {!! $umkm->description !!}
                </div>

                @if($umkm->gallery && is_array($umkm->gallery) && count($umkm->gallery) > 0)
                    <div class="mt-12 pt-8 border-t border-gray-100">
                        <h3 class="text-2xl font-black text-gray-900 mb-6">Galeri Produk / Tempat</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($umkm->gallery as $image)
                                <div class="relative h-40 rounded-xl overflow-hidden shadow-sm">
                                    <img src="{{ asset('storage/'.$image) }}" alt="Galeri UMKM" class="w-full h-full object-cover hover:scale-110 transition duration-500">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection