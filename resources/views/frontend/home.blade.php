@extends('layouts.frontend')

@section('content')
<!-- 1. HERO SECTION (Cinematic & Official) -->
<header class="relative h-screen min-h-[800px] md:min-h-[900px] flex items-center justify-center overflow-hidden">
    <!-- Background Image Effect -->
    <div class="absolute inset-0 z-0 bg-brand-950">
        <img src="https://images.unsplash.com/photo-1576408226079-5683286bbcc2?q=80&w=2000&auto=format&fit=crop" alt="Sumba Cinematic Landscape" class="w-full h-full object-cover scale-110 animate-[pulse_20s_ease-in-out_infinite] opacity-70">
    </div>

    <!-- Premium Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-brand-950/80 via-brand-950/40 to-brand-50 z-10"></div>

    <!-- Hero Content -->
    <div class="relative z-20 text-center px-6 max-w-5xl mx-auto pt-20">

        <!-- Main Heading -->
        <h1 class="font-serif text-5xl md:text-7xl lg:text-[6rem] text-white tracking-tight leading-[1.05] mb-6 drop-shadow-2xl">
            {{ __('Explore The Untouched') }} <br>
            <span class="text-brand-500 italic font-light">{{ __('Beauty of Sumba.') }}</span>
        </h1>

        <!-- Sub-Paragraph -->
        <p class="text-gray-200 text-lg md:text-xl font-light max-w-2xl mx-auto leading-relaxed drop-shadow-md mb-12">
            {{ __('Discover a land where ancient Marapu traditions live in perfect harmony with pristine beaches and endless savannas. The true spirit of Eastern Indonesia awaits.') }}
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-5">
            <a href="#destinations" class="w-full sm:w-auto bg-brand-500 text-white font-medium text-lg px-10 py-4 rounded-full hover:bg-brand-600 transition-all duration-300 shadow-xl shadow-brand-500/20">
                {{ __('Discover Sumba') }}
            </a>
            <a href="{{ route('planner.index') }}" class="w-full sm:w-auto flex items-center justify-center gap-3 text-white font-medium px-8 py-4 rounded-full border border-white/30 hover:bg-white/10 transition-all duration-300 backdrop-blur-sm">
                <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                {{ __('AI Smart Planner') }}
            </a>
        </div>
    </div>
</header>
<!-- 2. ABOUT SUMBA (Editorial Split) -->
<section id="about" class="py-24 lg:py-32 bg-brand-50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-center">
            <!-- Text Content -->
            <div class="relative z-10 order-2 lg:order-1">
                <span class="text-brand-500 font-semibold text-xs uppercase tracking-widest block mb-4 border-l-2 border-brand-500 pl-3">
                    {{ __('About Sumba Island') }}
                </span>

                <h2 class="font-serif text-4xl md:text-5xl lg:text-6xl text-brand-900 mb-8 leading-tight">
                    {{ __('An Island Forged by') }} <br>
                    <span class="italic text-brand-500 font-light">{{ __('Nature & Ancestors') }}</span>
                </h2>

                <div class="prose prose-lg text-gray-600 font-light leading-relaxed mb-10">
                    <p class="first-letter:text-7xl first-letter:font-serif first-letter:text-brand-900 first-letter:mr-3 first-letter:float-left">
                        {{ __('Sumba is not just a destination; it is a profound journey into the past. Twice the size of Bali, yet profoundly untouched, this island is the final frontier of the ancient Marapu religion.') }}
                    </p>
                    <p class="mt-6">
                        {{ __('From the dramatic coastal cliffs of the southwest to the sweeping golden savannas of the east, Sumba offers an unparalleled adventure. Here, megalithic tombs stand proudly in the center of traditional villages, and majestic wild horses roam free across the hills.') }}
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-8 pt-8 border-t border-gray-200">
                    <div>
                        <h4 class="font-serif text-brand-900 text-2xl mb-2">{{ __('Pristine Nature') }}</h4>
                        <p class="text-sm text-gray-500 font-light leading-relaxed">
                            {{ __('Untouched beaches, crystal clear lagoons, and dramatic waterfalls waiting to be explored.') }}
                        </p>
                    </div>
                    <div>
                        <h4 class="font-serif text-brand-900 text-2xl mb-2">{{ __('Living Culture') }}</h4>
                        <p class="text-sm text-gray-500 font-light leading-relaxed">
                            {{ __('Experience the authentic Marapu heritage that has been preserved for thousands of years.') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Image Collage -->
            <div class="relative z-10 order-1 lg:order-2 h-[500px] sm:h-[700px] w-full">
                <div class="absolute top-0 right-0 w-[80%] h-[75%] rounded-[2rem] overflow-hidden shadow-luxury border-[12px] border-brand-50 z-20 transition-transform duration-700 hover:scale-[1.02]">
                    <img src="https://images.unsplash.com/photo-1604928141064-207cea6f571f?q=80&w=1000" alt="Traditional Sumba Village" class="w-full h-full object-cover">
                </div>
                <div class="absolute bottom-0 left-0 w-[65%] h-[55%] rounded-[2rem] overflow-hidden shadow-luxury border-[12px] border-brand-50 z-30 transition-transform duration-700 hover:scale-[1.02]">
                    <img src="https://images.unsplash.com/photo-1544644181-1484b3fdfc62?q=80&w=800" alt="Wild Horses of Sumba" class="w-full h-full object-cover">
                </div>
                <!-- Decorative Element -->
                <div class="absolute -top-10 -right-10 w-64 h-64 bg-brand-500/10 rounded-full blur-3xl z-0"></div>
            </div>
        </div>
    </div>
</section>

<!-- 3. FEATURED DESTINATIONS (Dynamic from DB) -->
<!-- 3. FEATURED DESTINATIONS -->
<section id="destinations" class="py-24 bg-white border-y border-gray-100">
    <div class="max-w-[90rem] mx-auto px-6 sm:px-12">

        <!-- HEADER -->
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
            <div class="max-w-3xl">
                <span class="text-brand-500 font-semibold text-xs uppercase tracking-[0.2em] block mb-4">
                    {{ __('Official Selections') }}
                </span>

                <h2 class="font-serif text-4xl md:text-5xl lg:text-6xl text-brand-900 leading-tight">
                    {{ __('Iconic Landmarks') }} <br>
                    {{ __('of Sumba') }}
                </h2>
            </div>

            <a href="{{ route('destination.index') }}"
               class="inline-flex items-center justify-center bg-transparent text-brand-900 font-medium py-3 px-8 rounded-full border border-brand-900 hover:bg-brand-900 hover:text-white transition duration-300">
                {{ __('Explore All Destinations') }}
            </a>
        </div>

        <!-- GRID -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

            @if($destinations->count() > 0)

                @php $mainDest = $destinations->first(); @endphp

                <!-- MAIN CARD -->
                <a href="{{ route('destination.show', $mainDest->slug) }}"
                   class="md:col-span-7 group relative rounded-[2rem] overflow-hidden shadow-luxury h-[420px] md:h-[520px] block">

                    <img src="{{ $mainDest->thumbnail ? asset('storage/'.$mainDest->thumbnail) : 'https://placehold.co/1200' }}"
                         alt="{{ $mainDest->name }}"
                         class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">

                    <div class="absolute inset-0 bg-gradient-to-t from-brand-950/90 via-brand-950/20 to-transparent"></div>

                    <div class="absolute bottom-10 left-10 right-10 text-white">
                        <span class="inline-block bg-brand-500 text-white text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-widest mb-4">
                            {{ __('Must Visit') }}
                        </span>

                        <h3 class="font-serif text-4xl mb-3">
                            {{ $mainDest->name }}
                        </h3>

                        <p class="text-base text-gray-200 font-light max-w-md opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-500 line-clamp-3">
                            {{ Str::limit(strip_tags($mainDest->description), 120) }}
                        </p>
                    </div>
                </a>

                <!-- SIDE CARDS -->
                <div class="md:col-span-5 grid gap-6">

                    @foreach($destinations->skip(1)->take(3) as $dest)

                        <a href="{{ route('destination.show', $dest->slug) }}"
                           class="group relative rounded-[2rem] overflow-hidden shadow-luxury h-56 md:h-48 lg:h-56 block">

                            <img src="{{ $dest->thumbnail ? asset('storage/'.$dest->thumbnail) : 'https://placehold.co/800' }}"
                                 alt="{{ $dest->name }}"
                                 class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">

                            <div class="absolute inset-0 bg-gradient-to-t from-brand-950/90 via-brand-950/20 to-transparent"></div>

                            <div class="absolute bottom-6 left-6 right-6 text-white flex justify-between items-end">

                                <div>
                                    <h3 class="font-serif text-2xl mb-1">
                                        {{ $dest->name }}
                                    </h3>

                                    <p class="text-sm text-gray-300 font-light">
                                        {{ __('Village') }} {{ $dest->village->name ?? 'SBD' }}
                                    </p>
                                </div>

                                <div class="w-10 h-10 rounded-full border border-white/50 flex items-center justify-center group-hover:bg-brand-500 group-hover:border-brand-500 transition duration-300">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </div>

                            </div>
                        </a>

                    @endforeach

                </div>

            @else

                <!-- EMPTY STATE -->
                <div class="col-span-full py-20 text-center bg-brand-50 rounded-[2rem] border border-brand-100">
                    <p class="text-brand-900 font-serif text-xl">
                        {{ __('No destinations published yet.') }}
                    </p>
                </div>

            @endif

        </div>
    </div>
</section>
<!-- 4. CULTURAL HERITAGE (Deep Immersion) -->
<section class="py-32 bg-brand-950 text-white relative overflow-hidden">
    <!-- Subtle Background Texture -->
    <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="text-center mb-20">
            <span class="text-brand-500 font-semibold text-xs uppercase tracking-[0.2em] block mb-4">{{ __('Preserving The Past') }}</span>
            <h2 class="font-serif text-4xl md:text-5xl lg:text-6xl font-normal mb-6">{{ __('Living Cultural Heritage') }}</h2>
            <p class="text-gray-400 font-light max-w-2xl mx-auto text-lg">{{ __('The Department of Tourism proudly safeguards the ancestral heritage of Sumba. Immerse yourself in rituals that have withstood the test of time.') }}</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Pasola Festival -->
            <div class="group cursor-pointer">
                <div class="w-full aspect-[3/4] rounded-[2rem] overflow-hidden mb-6 relative shadow-luxury">
                    <img src="https://images.unsplash.com/photo-1532012197267-da84d127e765?q=80&w=600" alt="Pasola Festival" class="w-full h-full object-cover img-hover-zoom grayscale-[30%] group-hover:grayscale-0 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-brand-950 via-transparent to-transparent opacity-90"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <h3 class="font-serif text-2xl mb-2 text-white">{{ __('Pasola Festival') }}</h3>
                        <p class="text-sm text-gray-400 font-light">{{ __('An ancient horseback spear-fighting ritual to welcome the harvest season.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Traditional Villages -->
            <div class="group cursor-pointer lg:translate-y-8">
                <div class="w-full aspect-[3/4] rounded-[2rem] overflow-hidden mb-6 relative shadow-luxury">
                    <img src="https://images.unsplash.com/photo-1604928141064-207cea6f571f?q=80&w=600" alt="Traditional Villages" class="w-full h-full object-cover img-hover-zoom grayscale-[30%] group-hover:grayscale-0 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-brand-950 via-transparent to-transparent opacity-90"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <h3 class="font-serif text-2xl mb-2 text-white">{{ __('Traditional Villages') }}</h3>
                        <p class="text-sm text-gray-400 font-light">{{ __('Towering Uma Kelada roofs and megalithic tombs reflecting social status.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Sumba Weaving -->
            <div class="group cursor-pointer">
                <div class="w-full aspect-[3/4] rounded-[2rem] overflow-hidden mb-6 relative shadow-luxury">
                    <img src="https://images.unsplash.com/photo-1582296431766-c956bf102f90?q=80&w=600" alt="Sumba Tenun Ikat" class="w-full h-full object-cover img-hover-zoom grayscale-[30%] group-hover:grayscale-0 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-brand-950 via-transparent to-transparent opacity-90"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <h3 class="font-serif text-2xl mb-2 text-white">{{ __('Tenun Ikat Weaving') }}</h3>
                        <p class="text-sm text-gray-400 font-light">{{ __('Masterpieces of textile art woven with natural dyes over months.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Local Traditions -->
            <div class="group cursor-pointer lg:translate-y-8">
                <div class="w-full aspect-[3/4] rounded-[2rem] overflow-hidden mb-6 relative shadow-luxury">
                    <img src="https://images.unsplash.com/photo-1544644181-1484b3fdfc62?q=80&w=600" alt="Marapu Traditions" class="w-full h-full object-cover img-hover-zoom grayscale-[30%] group-hover:grayscale-0 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-brand-950 via-transparent to-transparent opacity-90"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <h3 class="font-serif text-2xl mb-2 text-white">{{ __('Marapu Traditions') }}</h3>
                        <p class="text-sm text-gray-400 font-light">{{ __('The indigenous belief system connecting the living, nature, and ancestors.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- 5. TOURISM STATISTICS (Dynamic if available) -->
<section class="py-24 bg-brand-500 relative overflow-hidden">
    <div class="absolute inset-0 opacity-20 pointer-events-none mix-blend-multiply bg-[url('https://images.unsplash.com/photo-1576408226079-5683286bbcc2?q=80&w=2000')] bg-cover bg-fixed"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center divide-y md:divide-y-0 md:divide-x divide-white/30">
            <div class="pt-8 md:pt-0">
                <h3 class="font-serif text-6xl md:text-7xl text-white mb-2 font-light">{{ \App\Models\Destination::count() ?? 125 }}<span class="text-brand-900 text-5xl font-bold">+</span></h3>
                <p class="font-medium tracking-[0.2em] uppercase text-xs text-brand-900">{{ __('Official Destinations') }}</p>
            </div>
            <div class="pt-8 md:pt-0">
                <h3 class="font-serif text-6xl md:text-7xl text-white mb-2 font-light">50<span class="text-brand-900 text-5xl font-bold">k</span></h3>
                <p class="font-medium tracking-[0.2em] uppercase text-xs text-brand-900">{{ __('Annual Tourist Arrivals') }}</p>
            </div>
            <div class="pt-8 md:pt-0">
                <h3 class="font-serif text-6xl md:text-7xl text-white mb-2 font-light">{{ \App\Models\Umkm::count() ?? 85 }}<span class="text-brand-900 text-5xl font-bold">+</span></h3>
                <p class="font-medium tracking-[0.2em] uppercase text-xs text-brand-900">{{ __('Registered Local UMKM') }}</p>
            </div>
        </div>
    </div>
</section>
<!-- 6 & 7. EVENTS CALENDAR & UMKM SHOWCASE (Split Layout) -->
<section class="py-32 bg-brand-50">
    <div class="max-w-[90rem] mx-auto px-6 sm:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24">

            <!-- Events Calendar (Dynamic) -->
            <div class="lg:col-span-5">
                <div class="mb-12">
                    <span class="text-brand-500 font-semibold text-xs uppercase tracking-[0.2em] block mb-4">{{ __('Official Calendar') }}</span>
                    <h2 class="font-serif text-4xl text-brand-900">{{ __('Tourism Events & Festivals') }}</h2>
                </div>

                <div class="space-y-6">
                    @forelse($events as $event)
                    <div class="group flex gap-6 items-start border-b border-gray-200 pb-6 last:border-0 cursor-pointer">
                        <div class="w-20 text-center shrink-0">
                            <span class="block font-serif text-4xl text-brand-500 group-hover:text-brand-900 transition-colors">{{ \Carbon\Carbon::parse($event->start_date)->format('d') }}</span>
                            <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ \Carbon\Carbon::parse($event->start_date)->format('M Y') }}</span>
                        </div>
                        <div>
                            <h3 class="font-serif text-xl font-medium text-brand-900 mb-2 group-hover:text-brand-500 transition-colors">{{ $event->name }}</h3>
                            <p class="text-sm text-gray-500 font-light flex items-center mb-3">
                                <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path>
                                </svg>
                                {{ $event->location_name ?? 'Sumba Barat Daya' }}
                            </p>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 font-light italic">{{ __('No upcoming events scheduled yet.') }}</p>
                    @endforelse
                </div>
            </div>

            <!-- Local UMKM Showcase -->
            <div class="lg:col-span-7">
                <div class="bg-brand-900 rounded-[2.5rem] p-10 md:p-16 h-full relative overflow-hidden shadow-luxury">
                    <!-- Decorative bg -->
                    <div class="absolute -top-24 -right-24 w-96 h-96 bg-brand-500/20 rounded-full blur-3xl pointer-events-none"></div>

                    <div class="relative z-10">
                        <span class="inline-block border border-brand-500 text-brand-500 text-[10px] font-bold px-4 py-1.5 rounded-full uppercase tracking-widest mb-6">{{ __('Empowering Communities') }}</span>
                        <h2 class="font-serif text-4xl text-white leading-tight mb-6">{{ __('Support Local MSMEs (UMKM)') }}</h2>
                        <p class="text-gray-300 font-light leading-relaxed mb-10 text-lg">
                            {{ __('Take home a piece of Sumba. By purchasing authentic crafts, coffee, and textiles directly from the artisans, you are directly supporting the local economy and helping preserve ancient skills.') }}
                        </p>

                        <div class="grid grid-cols-3 gap-4 mb-10">
                            <div class="bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-4 text-center hover:bg-white/10 transition">
                                <span class="block text-2xl mb-2">☕</span>
                                <span class="text-xs text-white uppercase tracking-widest">{{ __('Coffee') }}</span>
                            </div>
                            <div class="bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-4 text-center hover:bg-white/10 transition">
                                <span class="block text-2xl mb-2">🧶</span>
                                <span class="text-xs text-white uppercase tracking-widest">{{ __('Tenun') }}</span>
                            </div>
                            <div class="bg-white/5 backdrop-blur border border-white/10 rounded-2xl p-4 text-center hover:bg-white/10 transition">
                                <span class="block text-2xl mb-2">🏺</span>
                                <span class="text-xs text-white uppercase tracking-widest">{{ __('Crafts') }}</span>
                            </div>
                        </div>

                        <a href="{{ route('umkm.index') }}" class="inline-flex items-center text-sm font-semibold text-white hover:text-brand-500 transition border-b border-white hover:border-brand-500 pb-1">
                            {{ __('Browse UMKM Directory') }} <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 8. NEWS / KABAR PARIWISATA (Dynamic) -->
<section class="py-24 bg-white border-t border-gray-100">
    <div class="max-w-[90rem] mx-auto px-6 sm:px-12">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
            <div>
                <span class="text-brand-500 font-semibold text-xs uppercase tracking-[0.2em] block mb-4">{{ __('Official Journal') }}</span>
                <h2 class="font-serif text-4xl md:text-5xl text-brand-900">{{ __('Tourism News') }}</h2>
            </div>
            <a href="{{ route('news.index') }}" class="inline-flex items-center text-sm font-semibold text-brand-900 hover:text-brand-500 transition border-b border-brand-900 hover:border-brand-500 pb-1">
                {{ __('Read All News') }} <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @forelse($news as $article)
            <a href="{{ route('news.show', $article->slug) }}" class="group block cursor-pointer">
                <div class="w-full aspect-[4/3] rounded-[2rem] overflow-hidden mb-6 bg-gray-100 shadow-luxury relative">
                    <img src="{{ $article->thumbnail ? asset('storage/'.$article->thumbnail) : 'https://placehold.co/600x400' }}" class="w-full h-full object-cover img-hover-zoom">
                    <div class="absolute inset-0 bg-gradient-to-t from-brand-950/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                </div>
                <div>
                    <span class="text-[10px] font-bold text-brand-500 uppercase tracking-widest mb-3 block">{{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}</span>
                    <h3 class="font-serif text-2xl text-brand-900 leading-tight mb-3 group-hover:text-brand-500 transition line-clamp-2">
                        {{ $article->title }}
                    </h3>
                    <p class="text-sm text-gray-500 font-light line-clamp-2">
                        {{ Str::limit(strip_tags($article->content), 100) }}
                    </p>
                </div>
            </a>
            @empty
            <p class="text-gray-500 font-light italic col-span-full">{{ __('No recent tourism news.') }}</p>
            @endforelse
        </div>
    </div>
</section>

<!-- 9. INTERACTIVE TOURISM MAP (Dynamic) -->
<section class="py-24 bg-brand-50 border-t border-gray-200">
    <div class="max-w-[90rem] mx-auto px-6 sm:px-12">
        <div class="text-center mb-16">
            <span class="text-brand-500 font-semibold text-xs uppercase tracking-[0.2em] block mb-4">{{ __('Geographic Information System') }}</span>
            <h2 class="font-serif text-4xl md:text-5xl text-brand-900 mb-4">{{ __('Interactive Tourism Map') }}</h2>
            <p class="text-gray-500 font-light max-w-2xl mx-auto text-lg">{{ __('Navigate the island securely with our official integrated mapping system.') }}</p>
        </div>

        <div class="w-full h-[500px] md:h-[650px] bg-white rounded-[2.5rem] overflow-hidden shadow-luxury relative border border-gray-200">
            <!-- Map Container -->
            <div id="tourism-map" class="w-full h-full z-10"></div>

            <!-- Floating Map Panel -->
            <div class="absolute bottom-8 left-8 z-20 bg-white/95 backdrop-blur-md p-6 rounded-2xl shadow-luxury border border-white max-w-sm hidden md:block">
                <div class="flex items-center gap-3 mb-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/Garuda_Pancasila_-_National_Emblem_of_Indonesia.svg/120px-Garuda_Pancasila_-_National_Emblem_of_Indonesia.svg.png" alt="Garuda" class="w-8 h-8 object-contain">
                    <div>
                        <h4 class="font-serif font-bold text-brand-900">{{ __('Sumba GIS') }}</h4>
                        <p class="text-[10px] text-gray-500 uppercase tracking-widest">{{ __('Official Tourism Data') }}</p>
                    </div>
                </div>
                <p class="text-sm text-gray-600 font-light mb-6">{{ __('Integrated map detailing') }} {{ \App\Models\Destination::whereNotNull('latitude')->count() }} {{ __('official destinations and verified local businesses.') }}</p>
                <a href="{{ route('planner.index') }}" class="block text-center w-full bg-brand-900 text-white font-medium text-sm py-3 rounded-lg hover:bg-brand-800 transition">
                    {{ __('Open Smart Planner') }}
                </a>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof L !== 'undefined') {
                    var map = L.map('tourism-map', {
                        zoomControl: false
                    }).setView([-9.4124, 119.2435], 10);
                    L.control.zoom({
                        position: 'topright'
                    }).addTo(map);

                    L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                        attribution: '&copy; Pariwisata SBD | OpenStreetMap'
                    }).addTo(map);

                    var destIcon = L.divIcon({
                        className: 'bg-transparent border-none',
                        html: `<div class="w-10 h-10 bg-brand-900 text-white rounded-full flex items-center justify-center shadow-lg border-2 border-white transition transform hover:scale-110"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/></svg></div>`,
                        iconSize: [40, 40],
                        iconAnchor: [20, 40]
                    });

                    var destinations = @json($mapDestinations ?? []);
                    destinations.forEach(function(dest) {
                        var marker = L.marker([dest.latitude, dest.longitude], {
                            icon: destIcon
                        }).addTo(map);
                        marker.bindPopup(`<b class="font-serif text-lg text-brand-900">${dest.name}</b><br><a href="/destinasi/${dest.slug}" class="text-xs text-brand-500 hover:underline">Lihat Detail</a>`);
                    });
                } else {
                    document.getElementById('tourism-map').innerHTML = '<div class="w-full h-full flex items-center justify-center bg-brand-50 text-brand-900 font-serif text-xl">Loading Map...</div>';
                }
            });
        </script>
    </div>
</section>

<!-- 10. DYNAMIC PHOTO GALLERY (Masonry Grid from DB) -->
<section id="gallery" class="py-32 bg-brand-950 text-white">
    <div class="max-w-[90rem] mx-auto px-6 sm:px-12">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
            <div>
                <span class="text-brand-500 font-semibold text-xs uppercase tracking-[0.2em] block mb-4">{{ __('Visual Journey') }}</span>
                <h2 class="font-serif text-4xl md:text-5xl lg:text-6xl text-white">{{ __('Sumba in Frames') }}</h2>
            </div>
            <a href="{{ route('gallery.index') }}" class="inline-flex items-center text-sm font-semibold text-white hover:text-brand-500 transition border-b border-white hover:border-brand-500 pb-1">
                {{ __('View Full Gallery') }} <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>

        <div class="columns-1 sm:columns-2 lg:columns-3 xl:columns-4 gap-6 space-y-6">
            @php
            // Fetch latest galleries dynamically if available, otherwise use empty fallback
            $latestGalleries = \App\Models\Gallery::where('is_active', true)->latest()->take(7)->get();
            @endphp

            @forelse($latestGalleries as $gallery)
            <div class="break-inside-avoid rounded-2xl overflow-hidden cursor-pointer group relative shadow-luxury">
                <img src="{{ asset('storage/'.$gallery->image_path) }}" class="w-full h-auto img-hover-zoom" alt="{{ $gallery->title }}">
                <div class="absolute inset-0 bg-brand-950/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                    <span class="text-white font-serif text-lg text-center px-4">{{ $gallery->title }}</span>
                </div>
            </div>
            @empty
            <!-- Fallback if database is empty -->
            <div class="break-inside-avoid rounded-2xl overflow-hidden cursor-pointer group relative shadow-luxury">
                <img src="https://images.unsplash.com/photo-1544644181-1484b3fdfc62?q=80&w=600" class="w-full h-auto img-hover-zoom" alt="Sumba">
            </div>
            <div class="break-inside-avoid rounded-2xl overflow-hidden cursor-pointer group relative shadow-luxury">
                <img src="https://images.unsplash.com/photo-1534080564583-6be75777b70a?q=80&w=600" class="w-full h-auto img-hover-zoom" alt="Sumba">
            </div>
            <div class="break-inside-avoid rounded-2xl overflow-hidden cursor-pointer group relative shadow-luxury">
                <img src="https://images.unsplash.com/photo-1433086966358-54859d0ed716?q=80&w=600" class="w-full h-auto img-hover-zoom" alt="Sumba">
            </div>
            @endforelse

            <div class="break-inside-avoid rounded-2xl bg-brand-900 border border-white/10 p-10 flex items-center justify-center text-center shadow-luxury">
                <div>
                    <h4 class="font-serif text-3xl text-brand-500 mb-2">{{ __('Share Yours') }}</h4>
                    <p class="text-sm font-light text-gray-400 mb-4">{{ __('Tag #ExploreSBD to be featured') }}</p>
                    <a href="{{ route('story.create') }}" class="text-xs uppercase tracking-widest text-white border-b border-white pb-1 hover:text-brand-500 hover:border-brand-500 transition">{{ __('Submit Your Story') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 11. CONTACT & TOURISM INFORMATION CENTER -->
<section class="py-24 bg-white border-t border-gray-100">
    <div class="max-w-[90rem] mx-auto px-6 sm:px-12">
        <div class="bg-brand-50 rounded-[3rem] p-10 md:p-16 flex flex-col lg:flex-row gap-16 lg:gap-24">

            <div class="lg:w-1/2">
                <div class="inline-flex items-center gap-3 mb-6">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/Garuda_Pancasila_-_National_Emblem_of_Indonesia.svg/120px-Garuda_Pancasila_-_National_Emblem_of_Indonesia.svg.png" alt="Garuda" class="w-6 h-6 object-contain">
                    <span class="text-brand-900 font-bold uppercase tracking-widest text-xs">{{ __('Tourism Information Center') }}</span>
                </div>

                <h2 class="font-serif text-4xl lg:text-5xl text-brand-900 mb-6">{{ __('Southwest Sumba Tourism') }}</h2>
                <p class="text-gray-600 font-light leading-relaxed mb-10 text-lg">
                    {{ __('We are dedicated to assisting travelers, investors, and partners in exploring the limitless potential of Sumba. Contact our official center for any inquiries.') }}
                </p>

                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shrink-0 border border-gray-200 shadow-sm">
                            <svg class="w-5 h-5 text-brand-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path>
                            </svg>
                        </div>
                        <div class="pt-1">
                            <h4 class="font-bold text-brand-900 text-sm">{{ __('Official Office') }}</h4>
                            <p class="text-sm text-gray-500 font-light">{!! nl2br(e(__('Jl. Pusat Pemerintahan, Tambolaka,\nSouthwest Sumba, NTT, Indonesia'))) !!}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shrink-0 border border-gray-200 shadow-sm">
                            <svg class="w-5 h-5 text-brand-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="pt-1">
                            <h4 class="font-bold text-brand-900 text-sm">{{ __('Email Support') }}</h4>
                            <p class="text-sm text-gray-500 font-light">tourism@sbdkab.go.id</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-white flex items-center justify-center shrink-0 border border-gray-200 shadow-sm">
                            <svg class="w-5 h-5 text-brand-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <div class="pt-1">
                            <h4 class="font-bold text-brand-900 text-sm">{{ __('Tourist Hotline') }}</h4>
                            <p class="text-sm text-gray-500 font-light">+62 811-XXXX-XXXX ({{ __('Available 24/7') }})</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-1/2 w-full">
                <form class="bg-white p-10 rounded-[2rem] shadow-luxury">
                    <h3 class="font-serif text-2xl text-brand-900 mb-8">{{ __('Send an Inquiry') }}</h3>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">{{ __('Full Name') }}</label>
                            <input type="text" class="w-full bg-brand-50 border border-brand-100 rounded-xl px-5 py-4 text-sm focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition font-light">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">{{ __('Email Address') }}</label>
                            <input type="email" class="w-full bg-brand-50 border border-brand-100 rounded-xl px-5 py-4 text-sm focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition font-light">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">{{ __('Subject / Interest') }}</label>
                            <select class="w-full bg-brand-50 border border-brand-100 rounded-xl px-5 py-4 text-sm focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition font-light text-gray-600">
                                <option>{{ __('General Tourism Info') }}</option>
                                <option>{{ __('Investment Opportunities') }}</option>
                                <option>{{ __('Media & Partnership') }}</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">{{ __('Message') }}</label>
                            <textarea rows="4" class="w-full bg-brand-50 border border-brand-100 rounded-xl px-5 py-4 text-sm focus:outline-none focus:border-brand-500 focus:ring-1 focus:ring-brand-500 transition font-light"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-brand-900 text-white font-medium text-lg py-4 rounded-xl hover:bg-brand-800 transition duration-300">
                            {{ __('Submit Message') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- 4. UMKM & CULTURE SPOTLIGHT -->
<section class="py-24 bg-brand-900 relative overflow-hidden">
    <!-- Abstract Pattern -->
    <svg class="absolute top-0 right-0 w-full h-full text-brand-950/30 pointer-events-none" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
        <polygon points="100,0 100,100 0,100" />
    </svg>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="bg-brand-950/40 backdrop-blur-md rounded-[3rem] border border-brand-500/10 p-10 lg:p-16 flex flex-col lg:flex-row items-center gap-12 lg:gap-20">

            <div class="w-full lg:w-1/2">
                <div class="relative w-full aspect-square rounded-[2.5rem] overflow-hidden shadow-2xl border-4 border-brand-900/50">
                    <img src="https://images.unsplash.com/photo-1582200259850-2fb33a759ba0?q=80&w=800&auto=format&fit=crop" alt="Tenun Ikat Sumba" class="w-full h-full object-cover">
                    <!-- Overlay Badge -->
                    <div class="absolute top-6 left-6 bg-white/95 backdrop-blur-sm text-brand-900 text-[10px] font-bold px-4 py-2 rounded-full uppercase tracking-widest">
                        Support Local
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 text-white">
                <span class="text-brand-500 font-bold text-[10px] uppercase tracking-[0.2em] block mb-4">
                    {{ __('Directori UMKM') }}
                </span>
                <h2 class="font-serif text-4xl lg:text-5xl font-medium mb-6 leading-tight">
                    Karya <span class="text-brand-500 italic font-light">Lokal</span> <br>
                    Sumba Barat Daya
                </h2>
                <p class="text-brand-100/80 font-light text-lg mb-10 leading-relaxed max-w-lg">
                    {{ __('Temukan kerajinan tenun asli, kopi Sumba pilihan, hingga kuliner otentik langsung dari tangan para pembuatnya. Mari bersama memajukan ekonomi lokal melalui karya nyata.') }}
                </p>

                <a href="{{ route('umkm.index') }}" class="inline-flex items-center justify-center bg-brand-500 text-white font-serif font-bold py-4 px-10 rounded-full hover:bg-white hover:text-brand-900 transition-colors duration-300 shadow-xl group">
                    <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    {{ __('Lihat Direktori Produk') }}
                </a>
            </div>

        </div>
    </div>
</section>
@endsection