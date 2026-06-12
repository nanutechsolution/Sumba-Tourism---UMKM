<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\District;
use App\Models\Village;
use App\Models\Destination;
use App\Models\Umkm;
use App\Models\Event;
use App\Models\News;
use App\Models\Itinerary;
use App\Models\Gallery;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 0. Disable foreign key checks sementara untuk reset data
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Membersihkan tabel agar tidak terjadi penumpukan data saat testing
        Destination::truncate();
        Umkm::truncate();
        Event::truncate();
        News::truncate();
        Itinerary::truncate();
        Gallery::truncate();
        Review::truncate();
        DB::table('destination_itinerary')->truncate();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Pastikan ada minimal 1 user untuk relasi Penulis Berita
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Super Admin',
                'email' => 'admin@exploresbd.com',
                'password' => bcrypt('password'),
            ]);
        }

        // 2. Seeder Kecamatan (District)
        $kodiUtara = District::firstOrCreate(['slug' => 'kodi-utara'], ['name' => 'Kodi Utara']);
        $kodiBangedo = District::firstOrCreate(['slug' => 'kodi-bangedo'], ['name' => 'Kodi Bangedo']);
        $tambolaka = District::firstOrCreate(['slug' => 'kota-tambolaka'], ['name' => 'Kota Tambolaka']);

        // 3. Seeder Desa / Kelurahan (Village)
        $kalenaWanno = Village::firstOrCreate(
            ['slug' => 'kalena-wanno'],
            ['district_id' => $kodiUtara->id, 'name' => 'Kalena Wanno', 'zip_code' => '87254']
        );

        $umbuNgedo = Village::firstOrCreate(
            ['slug' => 'umbu-ngedo'],
            ['district_id' => $kodiBangedo->id, 'name' => 'Umbu Ngedo', 'zip_code' => '87255']
        );

        $lengkeka = Village::firstOrCreate(
            ['slug' => 'lengkeka'],
            ['district_id' => $tambolaka->id, 'name' => 'Lengkeka', 'zip_code' => '87251']
        );


        // ==========================================
        // 4. DATA GEOSPASIAL DESTINASI
        // ==========================================
        
        $weekuri = Destination::create([
            'village_id' => $kalenaWanno->id,
            'name' => 'Danau Weekuri',
            'slug' => 'danau-weekuri',
            'description' => '<p>Danau air asin yang sangat jernih dengan warna tosca yang memukau. Terletak tersembunyi di balik tebing karang yang memisahkannya langsung dari Samudra Hindia. Cocok untuk berenang dan bersantai.</p>',
            'address' => 'Desa Kalena Wanno, Kecamatan Kodi Utara, Kabupaten Sumba Barat Daya, Nusa Tenggara Timur',
            'latitude' => '-9.5786022', // Koordinat riil Weekuri
            'longitude' => '118.9221199',
            'is_active' => true,
        ]);

        $ratenggaro = Destination::create([
            'village_id' => $umbuNgedo->id,
            'name' => 'Kampung Adat Ratenggaro',
            'slug' => 'kampung-adat-ratenggaro',
            'description' => '<p>Kampung tradisional Sumba dengan ciri khas rumah menara (Uma Kelada) yang menjulang tinggi hingga 15 meter. Lokasinya sangat magis karena berada tepat di muara sungai dan pinggir pantai yang indah berpasir putih.</p>',
            'address' => 'Desa Umbu Ngedo, Kecamatan Kodi Bangedo, Kabupaten Sumba Barat Daya, Nusa Tenggara Timur',
            'latitude' => '-9.6644211', // Koordinat riil Ratenggaro
            'longitude' => '118.9482937',
            'is_active' => true,
        ]);


        // ==========================================
        // 5. DATA GEOSPASIAL UMKM (UNTUK LBS TESTING)
        // ==========================================

        // UMKM 1: Dibuat sengaja SANGAT DEKAT dengan Danau Weekuri (Jarak < 5 KM) agar algoritma Rekomendasi jalan
        Umkm::create([
            'village_id' => $kalenaWanno->id,
            'name' => 'Pusat Tenun Ikat Mandorak',
            'slug' => 'tenun-ikat-mandorak',
            'category' => 'Fashion',
            'phone_number' => '081234567890',
            'description' => '<p>Pusat kerajinan kain tenun ikat khas Kodi Utara yang dibuat dengan pewarna alami dari akar pohon dan dedaunan. Menampilkan motif-motif magis Sumba.</p>',
            'address' => 'Jalan Menuju Pantai Mandorak, Desa Kalena Wanno',
            'latitude' => '-9.5851234', // Berbeda sedikit desimal dari Weekuri
            'longitude' => '118.9255678',
            'is_active' => true,
        ]);

        // UMKM 2: Dibuat sengaja SANGAT DEKAT dengan Kampung Ratenggaro
        Umkm::create([
            'village_id' => $umbuNgedo->id,
            'name' => 'Warung Seafood Pinggir Pantai Ratenggaro',
            'slug' => 'seafood-pantai-ratenggaro',
            'category' => 'Kuliner',
            'phone_number' => '089876543210',
            'description' => '<p>Menyajikan olahan hasil tangkapan laut segar warga lokal. Nikmati ikan bakar khas Sumba sambil memandangi rumah menara adat dari kejauhan.</p>',
            'address' => 'Kawasan Pantai Ratenggaro, Umbu Ngedo',
            'latitude' => '-9.6630000', // Berbeda sedikit dari Ratenggaro
            'longitude' => '118.9490000',
            'is_active' => true,
        ]);

        // UMKM 3: Dibuat di Pusat Kota Tambolaka (Sangat Jauh > 30 KM dari Weekuri & Ratenggaro)
        Umkm::create([
            'village_id' => $lengkeka->id,
            'name' => 'Kedai Kopi Robusta Tambolaka',
            'slug' => 'kopi-robusta-tambolaka',
            'category' => 'Kuliner',
            'phone_number' => '087766554433',
            'description' => '<p>Produksi kopi robusta asli Sumba hasil panen petani lokal pegunungan Wewewa dengan metode roasting tradisional.</p>',
            'address' => 'Jalan Bandara Lede Kalumbang, Tambolaka',
            'latitude' => '-9.412435', // Koordinat riil Kota Tambolaka
            'longitude' => '119.243512',
            'is_active' => true,
        ]);


        // ==========================================
        // 6. SEEDER EVENT, NEWS & REVIEW
        // ==========================================
        
        Event::create([
            'village_id' => $umbuNgedo->id,
            'name' => 'Festival Pasola Ratenggaro',
            'slug' => 'festival-pasola-ratenggaro',
            'description' => '<p>Tradisi perang adat menunggang kuda saling lempar lembing kayu yang sangat sakral.</p>',
            'start_date' => now()->addMonths(2)->format('Y-m-d'),
            'location_name' => 'Lapangan Pasola Ratenggaro',
            'is_active' => true,
        ]);

        News::create([
            'user_id' => $user->id,
            'title' => 'Peta Digital EXPLORE SBD Resmi Diluncurkan',
            'slug' => 'peta-digital-explore-sbd-resmi-diluncurkan',
            'content' => '<p>Pemerintah daerah SBD secara resmi merilis fitur pemetaan geospasial yang memungkinkan wisatawan mencari destinasi wisata dan UMKM yang paling dekat dengan lokasi mereka menggunakan teknologi <strong>Location Based System</strong>.</p>',
            'status' => 'published',
            'published_at' => now(),
        ]);

        // Tambahkan dummy review agar fitur bintang terlihat
        Review::create([
            'destination_id' => $weekuri->id,
            'reviewer_name' => 'Budi Santoso',
            'rating' => 5,
            'comment' => 'Tempatnya sangat menakjubkan, airnya tenang dan jernih sekali! Wajib datang pagi hari.',
            'is_approved' => true,
        ]);

        Review::create([
            'destination_id' => $weekuri->id,
            'reviewer_name' => 'Jessica Wong',
            'rating' => 4,
            'comment' => 'Pemandangan luar biasa, namun akses jalan menuju ke danau masih perlu sedikit perbaikan dari pemerintah.',
            'is_approved' => true,
        ]);
    }
}