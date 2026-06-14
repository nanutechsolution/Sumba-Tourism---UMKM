<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\District;
use App\Models\Village;
use App\Models\Destination;
use App\Models\Umkm;
use App\Models\Story;
use App\Models\News;
use App\Models\Event;
use App\Models\Review;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun Admin (Gunakan UUID eksplisit)
        $admin = User::create([
            'id' => Str::uuid()->toString(),
            'name' => 'Administrator SBD',
            'email' => 'admin@exploresbd.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // 2. Buat Data Relasi Sederhana (Kecamatan & Desa)
        // Kecamatan (Districts)
        $districtKodi = District::create([
            'id' => Str::uuid()->toString(), 
            'name' => 'Kodi Bangedo', 
            'slug' => 'kodi-bangedo'
        ]);
        $districtTambolaka = District::create([
            'id' => Str::uuid()->toString(), 
            'name' => 'Kota Tambolaka', 
            'slug' => 'kota-tambolaka'
        ]);
        $districtWewewa = District::create([
            'id' => Str::uuid()->toString(), 
            'name' => 'Wewewa Barat', 
            'slug' => 'wewewa-barat'
        ]);

        // Desa (Villages)
        $villageRatenggaro = Village::create([
            'id' => Str::uuid()->toString(),
            'district_id' => $districtKodi->id,
            'name' => 'Desa Ratenggaro',
            'slug' => 'desa-ratenggaro'
        ]);
        
        $villageKalenaRongo = Village::create([
            'id' => Str::uuid()->toString(),
            'district_id' => $districtKodi->id,
            'name' => 'Desa Kalena Rongo',
            'slug' => 'desa-kalena-rongo'
        ]);
        
        $villageWaitabula = Village::create([
            'id' => Str::uuid()->toString(),
            'district_id' => $districtTambolaka->id,
            'name' => 'Kelurahan Waitabula',
            'slug' => 'kelurahan-waitabula'
        ]);
        
        $villageWaimakaha = Village::create([
            'id' => Str::uuid()->toString(),
            'district_id' => $districtWewewa->id,
            'name' => 'Desa Waimakaha',
            'slug' => 'desa-waimakaha'
        ]);

        // 3. SEEDER 10 DESTINASI WISATA
        $destinations = [
            [
                'name' => 'Danau Weekuri',
                'description' => 'Danau Weekuri adalah laguna tersembunyi berair asin yang sangat jernih di Sumba Barat Daya. Warna airnya yang biru kehijauan dan dikelilingi tebing karang membuatnya menjadi tempat berenang yang magis.',
                'history' => 'Danau ini terbentuk dari air laut yang menembus celah batu karang besar yang mengelilinginya. Nama "Weekuri" berasal dari bahasa Sumba yang berarti "air yang memercik".',
                'culture' => 'Bagi masyarakat setempat, danau ini dijaga ketat kebersihannya karena dianggap sebagai anugerah alam yang menyatukan laut dan daratan Sumba.',
                'myth' => 'Masyarakat kuno percaya bahwa warna air yang bisa berubah-ubah dari biru ke hijau adalah pantulan dari suasana hati para leluhur yang menjaga kawasan tersebut.',
                'tradition' => 'Setiap tahun baru adat, beberapa tetua desa melakukan ritual syukur di sekitar tebing karang Weekuri.',
                'latitude' => '-9.4005', 'longitude' => '118.9221', 'village_id' => $villageKalenaRongo->id
            ],
            [
                'name' => 'Kampung Adat Ratenggaro',
                'description' => 'Sebuah kampung adat yang terletak di pinggir pantai dengan ciri khas rumah menara (Uma Kelada) yang atapnya menjulang tinggi hingga 15 meter, menjadikannya salah satu ikon budaya terkuat di Sumba.',
                'history' => 'Ratenggaro berarti "Kuburan orang Garo". Pada zaman dahulu, terjadi perang suku di mana suku Garo berhasil dikalahkan dan dikuburkan di wilayah ini.',
                'culture' => 'Batu-batu megalitik (kubur batu) berjejer di area kampung, menandakan sistem kepercayaan Marapu yang masih dipegang teguh. Ukiran pada kubur melambangkan status sosial.',
                'myth' => 'Diyakini bahwa roh nenek moyang (Marapu) turun dari langit melalui atap menara rumah yang menjulang tinggi untuk memberkati penghuni rumah.',
                'tradition' => 'Ritual penyembelihan hewan (kerbau/babi) saat membangun rumah baru atau saat upacara pemakaman adat yang sangat sakral.',
                'latitude' => '-9.5894', 'longitude' => '118.9602', 'village_id' => $villageRatenggaro->id
            ],
            [
                'name' => 'Pantai Mandorak',
                'description' => 'Pantai mungil yang tersembunyi di balik dua tebing karang raksasa. Pasir putihnya yang bersih dan deburan ombak Samudra Hindia yang masuk melalui celah karang menciptakan pemandangan yang dramatis.',
                'history' => 'Dulu sering digunakan sebagai tempat bersandar perahu-perahu nelayan tradisional Sumba sebelum melaut ke samudra lepas.',
                'culture' => 'Masyarakat pesisir Mandorak memiliki ikatan yang kuat dengan laut, tercermin dalam motif tenun mereka yang terkadang mengambil corak biota laut.',
                'myth' => 'Terdapat mitos tentang penguasa laut selatan yang sering singgah di celah karang Mandorak saat bulan purnama.',
                'tradition' => 'Tradisi menangkap ikan musiman menggunakan peralatan tradisional warisan leluhur.',
                'latitude' => '-9.4124', 'longitude' => '118.9135', 'village_id' => $villageKalenaRongo->id
            ],
            [
                'name' => 'Pantai Mbawana',
                'description' => 'Terkenal dengan tebing karang bolong raksasanya (meskipun sempat runtuh akibat gempa). Pantai ini menawarkan pemandangan matahari terbenam paling epik di Sumba Barat Daya dengan garis pantai pasir putih yang panjang.',
                'history' => 'Garis pantai ini terbentuk dari abrasi laut selama ribuan tahun yang mengukir tebing-tebing karang di pesisir barat Sumba.',
                'culture' => 'Tempat berkumpulnya anak muda Sumba saat sore hari untuk berlatih pacuan kuda tanpa pelana khas Sumba.',
                'myth' => 'Karang bolong Mbawana dulunya dipercaya sebagai pintu gerbang menuju dunia gaib bawah laut pelindung pulau.',
                'tradition' => 'Ritual Pasola (perang berkuda) seringkali latihannya dilakukan di hamparan pasir pantai yang luas ini.',
                'latitude' => '-9.5601', 'longitude' => '118.9405', 'village_id' => $villageRatenggaro->id
            ],
            [
                'name' => 'Tanjung Mareha',
                'description' => 'Sebuah tanjung perbukitan sabana yang menjorok ke laut. Dari atas bukit ini, wisatawan dapat melihat langsung keindahan Pantai Mbawana di satu sisi dan Pantai Watu Maladong di sisi lainnya.',
                'history' => 'Bukit ini dahulunya adalah titik pantau pengintai untuk mengawasi datangnya kapal musuh dari arah laut.',
                'culture' => 'Mencerminkan lanskap khas Sumba: perpaduan antara padang sabana tempat penggembalaan ternak dan pesisir laut.',
                'myth' => 'Angin kencang di tanjung ini dipercaya sebagai nafas dari kuda-kuda sembrani tunggangan para leluhur.',
                'tradition' => 'Sering digunakan sebagai titik istirahat (lopo) bagi para penggembala sapi dan kuda liar.',
                'latitude' => '-9.5681', 'longitude' => '118.9450', 'village_id' => $villageRatenggaro->id
            ],
            [
                'name' => 'Pantai Pero',
                'description' => 'Berbeda dengan pantai lain yang berpasir halus, Pantai Pero didominasi oleh batuan karang yang eksotis dan ombak yang sangat besar, menjadikannya surganya para peselancar profesional.',
                'history' => 'Desa Pero adalah salah satu pelabuhan nelayan tertua di Sumba Barat Daya.',
                'culture' => 'Kehidupan nelayan yang tangguh bergelut dengan ombak besar Samudra Hindia membentuk karakter masyarakat Pero yang kuat.',
                'myth' => 'Batu karang besar di tengah pantai dipercaya sebagai kapal laut kuno yang dikutuk menjadi batu oleh leluhur.',
                'tradition' => 'Pasar ikan tradisional yang ramai setiap pagi dengan hasil tangkapan laut segar.',
                'latitude' => '-9.5441', 'longitude' => '118.9220', 'village_id' => $villageWaimakaha->id
            ],
            [
                'name' => 'Air Terjun Pringgasela',
                'description' => 'Oase tersembunyi di tengah keringnya sabana Sumba. Air terjun bertingkat dengan kolam alami berwarna toska yang menyegarkan.',
                'history' => 'Ditemukan secara tidak sengaja oleh pemburu babi hutan beberapa dekade lalu.',
                'culture' => 'Sumber air utama bagi beberapa desa di sekitarnya pada musim kemarau.',
                'myth' => 'Dipercaya terdapat roh pelindung air (ular raksasa) yang berdiam di gua balik air terjun.',
                'tradition' => 'Dilarang membuang kotoran atau mencaci maki saat berada di kawasan mata air adat.',
                'latitude' => '-9.6200', 'longitude' => '119.0500', 'village_id' => $villageWaitabula->id
            ],
            [
                'name' => 'Kampung Adat Wainyapu',
                'description' => 'Kampung kembar dari Ratenggaro. Menawarkan jumlah rumah menara yang lebih banyak dan suasana yang lebih autentik serta padat merayap.',
                'history' => 'Merupakan kampung induk dari beberapa klan besar di wilayah Kodi.',
                'culture' => 'Pusat pembuatan kain tenun ikat Kodi yang terkenal dengan pewarna alam lumpur dan nila.',
                'myth' => 'Setiap tiang agung di dalam rumah adat memiliki roh penjaga yang harus diberi sesajen sirih pinang.',
                'tradition' => 'Tuan rumah festival Pasola tahunan pada bulan Februari/Maret.',
                'latitude' => '-9.5950', 'longitude' => '118.9650', 'village_id' => $villageRatenggaro->id
            ],
            [
                'name' => 'Pantai Watu Maladong',
                'description' => 'Pantai dengan formasi batu karang raksasa yang menyerupai rumah adat Sumba yang berdiri kokoh di tengah laut. Sangat menakjubkan saat air surut.',
                'history' => 'Formasi geologi ini terbentuk dari pergeseran lempeng bumi jutaan tahun lalu.',
                'culture' => 'Inspirasi bentuk atap rumah adat Sumba dipercaya sebagian berasal dari bentuk tebing karang ini.',
                'myth' => 'Karang raksasa tersebut adalah tempat pertapaan tokoh sakti Sumba di masa lampau.',
                'tradition' => 'Mencari biota laut (gurita, landak laut) di sela karang saat air laut surut jauh (Meti).',
                'latitude' => '-9.5750', 'longitude' => '118.9500', 'village_id' => $villageRatenggaro->id
            ],
            [
                'name' => 'Waikelo Sawah',
                'description' => 'Bukan pantai, melainkan bendungan yang dibangun di atas goa sumber mata air yang sangat deras. Menyuplai air untuk hamparan sawah di sekitarnya.',
                'history' => 'Dibangun pada tahun 1976 untuk mendukung irigasi pertanian di Sumba Barat Daya yang cenderung kering.',
                'culture' => 'Simbol gotong royong dan kemakmuran agraris masyarakat SBD.',
                'myth' => 'Sumber mata air dari dalam goa dikabarkan tidak berujung dan terhubung langsung ke laut selatan.',
                'tradition' => 'Ritual syukur panen yang dilakukan warga di sekitar aliran irigasi.',
                'latitude' => '-9.4500', 'longitude' => '119.2000', 'village_id' => $villageWaitabula->id
            ],
        ];

        foreach ($destinations as $dest) {
            $createdDest = Destination::create([
                'id' => Str::uuid()->toString(),
                'name' => $dest['name'],
                'slug' => Str::slug($dest['name']),
                'village_id' => $dest['village_id'],
                'description' => $dest['description'],
                'history' => $dest['history'],
                'culture' => $dest['culture'],
                'myth' => $dest['myth'],
                'tradition' => $dest['tradition'],
                'latitude' => $dest['latitude'],
                'longitude' => $dest['longitude'],
                'is_active' => true,
            ]);

            // Buat Ulasan Dummy
            Review::create([
                'id' => Str::uuid()->toString(),
                'destination_id' => $createdDest->id,
                'reviewer_name' => 'Turis Petualang',
                'rating' => rand(4, 5),
                'comment' => 'Tempat yang sangat menakjubkan. Vibes-nya luar biasa dan masyarakatnya ramah. Sangat direkomendasikan!',
                'is_approved' => true
            ]);
            Review::create([
                'id' => Str::uuid()->toString(),
                'destination_id' => $createdDest->id,
                'reviewer_name' => 'Anak Senja Jakarta',
                'rating' => rand(4, 5),
                'comment' => 'Golden hour di sini tidak ada duanya. Pastikan bawa kamera yang bagus dan baterai cadangan.',
                'is_approved' => true
            ]);
        }

        // 4. SEEDER 10 UMKM LOKAL
        $umkms = [
            ['name' => 'Sanggar Tenun Kodi', 'category' => 'Kriya & Tenun', 'desc' => 'Memproduksi kain tenun ikat khas Kodi menggunakan pewarna alam.', 'lat' => '-9.5800', 'lon' => '118.9600'],
            ['name' => 'Kopi Roaster Tambolaka', 'category' => 'Kuliner', 'desc' => 'Kopi Sumba robusta dan arabica yang disangrai dengan kayu bakar.', 'lat' => '-9.4100', 'lon' => '119.2400'],
            ['name' => 'Kerajinan Tanduk Kerbau', 'category' => 'Kriya & Tenun', 'desc' => 'Pahatan miniatur rumah adat dan ornamen kalung limbah tanduk.', 'lat' => '-9.4200', 'lon' => '119.2300'],
            ['name' => 'Warung Ayam Bumbu Sumba', 'category' => 'Kuliner', 'desc' => 'Menyajikan ayam kampung bakar bumbu rempah kuning khas Sumba.', 'lat' => '-9.4150', 'lon' => '119.2450'],
            ['name' => 'Madu Hutan Liar Wewewa', 'category' => 'Kuliner', 'desc' => 'Madu murni yang dipanen langsung dari hutan Wewewa.', 'lat' => '-9.5000', 'lon' => '119.3000'],
            ['name' => 'Pusat Suvenir Pahikung', 'category' => 'Kriya & Tenun', 'desc' => 'Menjual tas, syal dari potongan kain tenun Sumba.', 'lat' => '-9.4120', 'lon' => '119.2410'],
            ['name' => 'Kacang Mete SBD', 'category' => 'Kuliner', 'desc' => 'Kacang mete yang disangrai dengan rasa original dan bawang.', 'lat' => '-9.4300', 'lon' => '119.2500'],
            ['name' => 'Parang Sumba (Kabeala)', 'category' => 'Kriya & Tenun', 'desc' => 'Pembuatan parang tradisional Sumba gagang kayu ukir.', 'lat' => '-9.5500', 'lon' => '118.9500'],
            ['name' => 'Kafe Sabana Waimakaha', 'category' => 'Kuliner', 'desc' => 'Kafe modern menyajikan kopi Sumba dan view sabana.', 'lat' => '-9.4800', 'lon' => '119.2000'],
            ['name' => 'Anyaman Pandan', 'category' => 'Kriya & Tenun', 'desc' => 'Tikar dan topi ramah lingkungan anyaman daun pandan laut.', 'lat' => '-9.4000', 'lon' => '119.2350'],
        ];

        foreach ($umkms as $index => $u) {
            Umkm::create([
                'id' => Str::uuid()->toString(),
                'name' => $u['name'],
                'slug' => Str::slug($u['name']),
                'village_id' => $villageWaitabula->id,
                'category' => $u['category'],
                'description' => $u['desc'],
                'address' => 'Jalan Utama SBD No. ' . ($index + 1),
                'phone_number' => '0812345678' . $index,
                'latitude' => $u['lat'],
                'longitude' => $u['lon'],
                'is_active' => true,
            ]);
        }

        // 5. SEEDER 5 CERITA SUMBA
        // Tabel Stories menggunakan ID BigInt otomatis sesuai skema, jadi tidak butuh Str::uuid()
        $stories = [
            [
                'title' => 'Tersihir Magisnya Pasola di Kodi',
                'author' => 'Bima Petualang',
                'content' => 'Kemarin saya berkesempatan melihat langsung festival Pasola. Suara ringkikan kuda, teriakan para ksatria Sumba, dan debu yang beterbangan membuat bulu kuduk saya merinding. Ini bukan sekadar festival, ini adalah pertaruhan nyawa dan dedikasi kepada leluhur (Marapu). Sangat epic!'
            ],
            [
                'title' => 'Berenang di Air Sebening Kaca Danau Weekuri',
                'author' => 'Sarah Jalan-Jalan',
                'content' => 'Saya pernah melihat foto Weekuri di Instagram, tapi melihat aslinya jauh lebih indah. Airnya sangat jernih sampai dasar pasirnya terlihat jelas. Yang paling saya suka adalah suasananya yang tenang. Tips: Datanglah jam 9 pagi saat sinar matahari tepat menyorot danau, warnanya akan menjadi toska sempurna.'
            ],
            [
                'title' => 'Menyusuri Keheningan Kampung Ratenggaro',
                'author' => 'Dimas Fotografi',
                'content' => 'Berjalan di antara kubur batu raksasa dan rumah beratap menjulang di Ratenggaro membuat saya merasa kembali ke zaman megalitikum. Penduduknya sangat ramah. Saya sempat diajak minum kopi Sumba di beranda salah satu Uma Kelada. Sebuah pengalaman humanis yang tak ternilai.'
            ],
            [
                'title' => 'Mengejar Sunset Terindah di Mbawana',
                'author' => 'Anya Senja',
                'content' => 'Perjalanan ke Pantai Mbawana cukup menantang karena jalannya yang berbatu, tapi semuanya terbayar lunas saat matahari mulai terbenam. Siluet tebing karang dipadukan dengan langit Sumba yang berwarna jingga keunguan adalah pemandangan terbaik yang pernah saya saksikan di Indonesia timur.'
            ],
            [
                'title' => 'Menemukan Motif Tenun Kuda di Wainyapu',
                'author' => 'Dinda Culture Seeker',
                'content' => 'Saya penggemar kain wastra Nusantara. Di Wainyapu, saya bertemu dengan Ina (Ibu) pembuat tenun yang menjelaskan bahwa motif kuda melambangkan kejantanan dan kebangsawanan di Sumba. Proses pembuatannya yang memakan waktu berbulan-bulan membuat saya sadar betapa berharganya selembar kain ini.'
            ]
        ];

        foreach ($stories as $story) {
            Story::create([
                'title' => $story['title'],
                'slug' => Str::slug($story['title']) . '-' . rand(100, 999),
                'author_name' => $story['author'],
                'content' => $story['content'],
                'is_approved' => 1,
                'created_at' => now()->subDays(rand(1, 30))
            ]);
        }

        // 6. SEEDER BERITA & EVENT
        News::create([
            'id' => Str::uuid()->toString(),
            'title' => 'Pemerintah Targetkan 1 Juta Kunjungan ke SBD Tahun Ini',
            'slug' => 'target-1-juta-kunjungan',
            'content' => 'Pemerintah daerah optimis dengan infrastruktur yang terus membaik, pariwisata SBD akan meledak.',
            'status' => 'published',
            'published_at' => now()->subDays(2),
            'user_id' => $admin->id
        ]);
        News::create([
            'id' => Str::uuid()->toString(),
            'title' => 'Desa Ratenggaro Masuk Nominasi Desa Wisata Terbaik',
            'slug' => 'ratenggaro-desa-wisata',
            'content' => 'Berkat pelestarian budaya yang konsisten, Ratenggaro diakui di kancah nasional.',
            'status' => 'published',
            'published_at' => now()->subDays(5),
            'user_id' => $admin->id
        ]);

        Event::create([
            'id' => Str::uuid()->toString(),
            'name' => 'Festival Pasola Raya SBD',
            'slug' => Str::slug('Festival Pasola Raya SBD'),
            'description' => 'Puncak acara perang berkuda adat Sumba.',
            'start_date' => now()->addDays(15),
            'end_date' => now()->addDays(16),
            'location_name' => 'Lapan Pasola Kodi',
            'village_id' => $villageRatenggaro->id,
            'is_active' => true
        ]);
        Event::create([
            'id' => Str::uuid()->toString(),
            'name' => 'Sumba Tenun Exhibition',
            'slug' => Str::slug('Sumba Tenun Exhibition'),
            'description' => 'Pameran kain tenun ikat pewarna alam terbesar.',
            'start_date' => now()->addDays(20),
            'end_date' => now()->addDays(22),
            'location_name' => 'Alun-Alun Tambolaka',
            'village_id' => $villageWaitabula->id,
            'is_active' => true
        ]);
    }
}