@extends('layouts.frontend')

@section('content')
    <section class="pt-32 pb-20 lg:pt-40 lg:pb-24 px-6 relative bg-[#FDFBF7] min-h-screen">
        <div class="max-w-3xl mx-auto">
            
            <div class="text-center mb-10">
                <a href="{{ route('story.index') }}" class="inline-flex items-center text-sm font-heading font-semibold text-gray-400 hover:text-savanna transition mb-6">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar
                </a>
                <h1 class="font-heading text-4xl font-bold text-ocean tracking-tight mb-4">Bagikan <span class="text-savanna italic font-serif">Kisah Anda</span></h1>
                <p class="text-gray-500 font-body leading-relaxed max-w-lg mx-auto">Ceritakan momen magis atau pengalaman tak terlupakan Anda selama di Sumba Barat Daya. Cerita Anda akan menginspirasi wisatawan lain!</p>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-premium border border-gray-100 p-8 md:p-12 relative overflow-hidden">
                <!-- Subtle Decoration -->
                <svg class="absolute top-0 right-0 w-64 h-64 text-gray-50 -mt-10 -mr-10 rotate-12 pointer-events-none" fill="currentColor" viewBox="0 0 100 100"><circle cx="50" cy="50" r="50"/></svg>

                <form action="{{ route('story.store') }}" method="POST" enctype="multipart/form-data" class="relative z-10">
                    @csrf
                    
                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Judul Cerita <span class="text-red-500">*</span></label>
                        <input type="text" name="title" required class="w-full rounded-2xl border border-gray-200 focus:border-savanna focus:ring-1 focus:ring-savanna px-5 py-4 font-body text-ocean bg-gray-50/50 outline-none transition" placeholder="Contoh: Senja Tak Terlupakan di Ratenggaro">
                    </div>
                    
                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Nama Penulis <span class="text-red-500">*</span></label>
                        <input type="text" name="author_name" required class="w-full rounded-2xl border border-gray-200 focus:border-savanna focus:ring-1 focus:ring-savanna px-5 py-4 font-body text-ocean bg-gray-50/50 outline-none transition" placeholder="Nama lengkap atau nama pena">
                    </div>

                    <div class="mb-6">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Foto Utama (Opsional)</label>
                        <div class="relative w-full rounded-2xl border border-dashed border-gray-300 bg-gray-50/50 p-6 flex flex-col items-center justify-center hover:border-savanna transition cursor-pointer group">
                            <svg class="w-8 h-8 text-gray-400 group-hover:text-savanna mb-2 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-sm font-body text-gray-500 group-hover:text-savanna font-medium">Klik untuk memilih foto</span>
                            <span class="text-[10px] text-gray-400 mt-1 uppercase tracking-wider">Format JPG, PNG (Max 2MB)</span>
                            <input type="file" name="photo" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        </div>
                    </div>

                    <div class="mb-10">
                        <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Isi Cerita <span class="text-red-500">*</span></label>
                        <textarea name="content" required rows="8" class="w-full rounded-2xl border border-gray-200 focus:border-savanna focus:ring-1 focus:ring-savanna px-5 py-4 font-body text-ocean bg-gray-50/50 outline-none transition" placeholder="Tuliskan petualangan, tips, atau momen berharga Anda di sini..."></textarea>
                    </div>

                    <button type="submit" class="w-full bg-ocean text-white font-heading font-bold text-lg py-4 rounded-full hover:bg-savanna transition duration-300 shadow-lg shadow-ocean/20 flex justify-center items-center">
                        Kirim Cerita untuk Moderasi
                    </button>
                    
                    <div class="mt-6 flex items-center justify-center text-xs text-gray-400 font-body">
                        <svg class="w-4 h-4 mr-1.5 text-savanna" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        Cerita akan ditinjau oleh Admin sebelum dipublikasikan.
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection