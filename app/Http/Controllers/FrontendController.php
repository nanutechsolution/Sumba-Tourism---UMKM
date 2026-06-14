<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Umkm;
use App\Models\Event;
use App\Models\News;
use App\Models\Review;
use App\Models\Itinerary;
use App\Models\Gallery;
use App\Models\PageView;
use App\Models\Story;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        PageView::create([
            'url' => $request->fullUrl(),
            'ip_address' => $request->ip()
        ]);
        $destinations = Destination::with('village')->where('is_active', true)->latest()->take(6)->get();
        $events = Event::with('village')->where('is_active', true)->where('start_date', '>=', now()->format('Y-m-d'))->orderBy('start_date', 'asc')->take(4)->get();
        $news = News::with('user')->where('status', 'published')->latest('published_at')->take(3)->get();
        $itineraries = Itinerary::where('is_active', true)->latest()->take(3)->get();

        // Ambil semua data Destinasi & UMKM yang memiliki koordinat untuk ditampilkan di Peta Utama
        $mapDestinations = Destination::whereNotNull('latitude')->whereNotNull('longitude')->where('is_active', true)->get();
        $mapUmkms = Umkm::whereNotNull('latitude')->whereNotNull('longitude')->where('is_active', true)->get();

        return view('frontend.home', compact('destinations', 'events', 'news', 'itineraries', 'mapDestinations', 'mapUmkms'));
    }

    public function destinationIndex()
    {
        // Mengambil semua destinasi yang aktif beserta relasi desanya, dengan pagination
        $destinations = \App\Models\Destination::with(['village', 'reviews'])
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        $page_title = 'Jelajahi Semua Destinasi';
        return view('frontend.destinations.index', compact('destinations', 'page_title'));
    }
    public function showDestination($slug)
    {
        $destination = Destination::with(['village', 'reviews' => function ($query) {
            $query->where('is_approved', true)->latest();
        }])->where('slug', $slug)->where('is_active', true)->firstOrFail();

        // 1. LBS ALGORITHM - Mencari UMKM Terdekat
        $nearbyUmkms = collect();
        if ($destination->latitude && $destination->longitude) {
            $lat = (float) $destination->latitude;
            $lon = (float) $destination->longitude;
            $allUmkms = Umkm::with('village')->where('is_active', true)->whereNotNull('latitude')->whereNotNull('longitude')->get();
            $nearbyUmkms = $allUmkms->filter(function ($umkm) use ($lat, $lon) {
                $uLat = (float) $umkm->latitude;
                $uLon = (float) $umkm->longitude;
                $earthRadius = 6371;
                $dLat = deg2rad($uLat - $lat);
                $dLon = deg2rad($uLon - $lon);
                $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat)) * cos(deg2rad($uLat)) * sin($dLon / 2) * sin($dLon / 2);
                $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
                $distance = $earthRadius * $c;
                $umkm->distance_km = round($distance, 1);
                return $distance <= 15;
            })->sortBy('distance_km')->take(4);
        }

        // 2. API Cuaca dengan Smart Caching
        $weather = null;
        if ($destination->latitude && $destination->longitude) {
            $cacheKey = 'weather_dest_' . $destination->id;
            $weather = Cache::remember($cacheKey, 3600, function () use ($destination) {
                $apiKey = env('OPENWEATHER_API_KEY');
                if (!$apiKey) return null;
                try {
                    $response = Http::timeout(5)->get("https://api.openweathermap.org/data/2.5/weather", [
                        'lat' => $destination->latitude,
                        'lon' => $destination->longitude,
                        'appid' => $apiKey,
                        'units' => 'metric',
                        'lang' => 'id'
                    ]);
                    if ($response->successful()) return $response->json();
                } catch (\Exception $e) {
                    return null;
                }
                return null;
            });
        }

        // 3. NEW FITUR: Perhitungan Matematika Golden Hour Secara Akurat (WITA / UTC + 8)
        $goldenHour = null;
        if ($destination->latitude && $destination->longitude) {
            $lat = (float) $destination->latitude;
            $lon = (float) $destination->longitude;

            // Mengambil info posisi matahari berdasarkan waktu sekarang dan koordinat lokal
            $sunInfo = date_sun_info(time(), $lat, $lon);

            if ($sunInfo) {
                // Konversi timestamp UTC bawaan PHP ke format jam operasional WITA (UTC + 8)
                // Ditambah toleransi durasi golden hour sekitar 45-60 menit
                $sunriseTime = \Carbon\Carbon::parse($sunInfo['sunrise'])->timezone('Asia/Makassar');
                $sunsetTime = \Carbon\Carbon::parse($sunInfo['sunset'])->timezone('Asia/Makassar');

                $goldenHour = [
                    'morning_start' => $sunriseTime->format('H:i'),
                    'morning_end' => $sunriseTime->addMinutes(45)->format('H:i'),
                    'evening_start' => $sunsetTime->subMinutes(45)->format('H:i'),
                    'evening_end' => $sunsetTime->addMinutes(45)->format('H:i'),
                ];
            }
        }

        // 4. SEO Injection
        $page_title = $destination->name . ' - Destinasi Wisata';
        $page_description = Str::limit(strip_tags($destination->description), 160);
        $page_image = asset('storage/' . $destination->thumbnail);

        // Lempar variabel $goldenHour ke view
        return view('frontend.destinations.show', compact('destination', 'nearbyUmkms', 'weather', 'goldenHour', 'page_title', 'page_description', 'page_image'));
    }
    public function storeReview(Request $request, $destinationId)
    {
        $validatedData = $request->validate(['reviewer_name' => 'required|string|max:255', 'rating' => 'required|integer|min:1|max:5', 'comment' => 'required|string',]);
        $destination = Destination::findOrFail($destinationId);
        Review::create(['destination_id' => $destination->id, 'reviewer_name' => $validatedData['reviewer_name'], 'rating' => $validatedData['rating'], 'comment' => $validatedData['comment'], 'is_approved' => true,]);
        return redirect()->back()->with('success', 'Terima kasih! Ulasan Anda berhasil dikirim.');
    }

    public function umkmIndex()
    {
        $umkms = Umkm::with('village')->where('is_active', true)->latest()->paginate(12);
        $page_title = 'Direktori UMKM Lokal Sumba Barat Daya';
        return view('frontend.umkms.index', compact('umkms', 'page_title'));
    }

    public function umkmShow($slug)
    {
        $umkm = Umkm::with('village')->where('slug', $slug)->where('is_active', true)->firstOrFail();
        $page_title = $umkm->name . ' - Produk UMKM SBD';
        $page_description = Str::limit(strip_tags($umkm->description), 160);
        $page_image = asset('storage/' . $umkm->thumbnail);
        return view('frontend.umkms.show', compact('umkm', 'page_title', 'page_description', 'page_image'));
    }

    public function itineraryIndex()
    {
        $itineraries = Itinerary::where('is_active', true)->latest()->paginate(9);
        $page_title = 'Paket & Rute Perjalanan Wisata';
        return view('frontend.itineraries.index', compact('itineraries', 'page_title'));
    }

    public function itineraryShow($slug)
    {
        $itinerary = Itinerary::with('destinations')->where('slug', $slug)->where('is_active', true)->firstOrFail();
        $groupedDestinations = $itinerary->destinations->groupBy('pivot.day');
        $page_title = 'Paket ' . $itinerary->name;
        $page_description = Str::limit(strip_tags($itinerary->description), 160);
        $page_image = asset('storage/' . $itinerary->thumbnail);
        return view('frontend.itineraries.show', compact('itinerary', 'groupedDestinations', 'page_title', 'page_description', 'page_image'));
    }

    public function galleryIndex()
    {
        $galleries = Gallery::where('is_active', true)->latest()->paginate(24);
        $page_title = 'Galeri Pesona Sumba Barat Daya';
        return view('frontend.galleries.index', compact('galleries', 'page_title'));
    }
    public function storyIndex()
    {
        $stories = Story::where('is_approved', true)->latest()->paginate(9);
        $page_title = 'Cerita Sumba - Pengalaman Wisatawan';
        return view('frontend.stories.index', compact('stories', 'page_title'));
    }

    public function storyCreate()
    {
        $page_title = 'Bagikan Cerita Sumba Anda';
        return view('frontend.stories.create', compact('page_title'));
    }

    public function storyStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'content' => 'required|string',
            'photo' => 'nullable|image|max:2048'
        ]);

        $path = null;
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('stories', 'public');
        }

        Story::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . uniqid(),
            'author_name' => $request->author_name,
            'content' => $request->content,
            'photo_path' => $path,
            'is_approved' => false // Secara default menunggu persetujuan Admin
        ]);

        return redirect()->route('story.index')->with('success', 'Cerita Anda berhasil dikirim dan sedang menunggu moderasi dari tim kami. Terima kasih telah berbagi pengalaman!');
    }

    public function storyShow($slug)
    {
        $story = Story::where('slug', $slug)->where('is_approved', true)->firstOrFail();
        $page_title = $story->title;
        return view('frontend.stories.show', compact('story', 'page_title'));
    }


    public function smartPlanner()
    {
        $page_title = 'Smart Planner - Buat Rute Otomatis';
        return view('frontend.planner.index', compact('page_title'));
    }

    public function generateSmartPlanner(Request $request)
    {
        $request->validate([
            'days' => 'required|integer|min:1|max:7',
            'interest' => 'required|in:alam,budaya,kuliner,campur',
            'pace' => 'required|in:santai,padat'
        ]);

        $days = (int) $request->days;
        $interest = $request->interest;
        $pace = $request->pace;

        // Aturan Heuristik (Kecepatan / Pace)
        $destinationsPerDay = ($pace == 'santai') ? 2 : 3;
        $umkmPerDay = ($pace == 'santai') ? 1 : 2;

        // Ambil Data Destinasi
        $destQuery = Destination::with('village')->where('is_active', true);
        if ($interest == 'alam') {
            $destQuery->where(function ($q) {
                $q->where('description', 'like', '%pantai%')->orWhere('description', 'like', '%danau%')->orWhere('description', 'like', '%alam%');
            });
        } elseif ($interest == 'budaya') {
            $destQuery->where(function ($q) {
                $q->where('description', 'like', '%adat%')->orWhere('description', 'like', '%budaya%')->orWhere('description', 'like', '%kampung%');
            });
        }
        $availableDestinations = $destQuery->inRandomOrder()->get();

        // Fallback jika data kurang
        if ($availableDestinations->count() < ($days * $destinationsPerDay)) {
            $availableDestinations = Destination::with('village')->where('is_active', true)->inRandomOrder()->get();
        }

        // Ambil Data UMKM
        $umkmQuery = Umkm::with('village')->where('is_active', true);
        if ($interest == 'kuliner') {
            $umkmQuery->where('category', 'Kuliner');
        } elseif ($interest == 'budaya') {
            $umkmQuery->whereIn('category', ['Kriya', 'Fashion']);
        }
        $availableUmkms = $umkmQuery->inRandomOrder()->get();

        // Fallback
        if ($availableUmkms->count() < ($days * $umkmPerDay)) {
            $availableUmkms = Umkm::with('village')->where('is_active', true)->inRandomOrder()->get();
        }

        // Generate Rute Array Multidimensi
        $generatedItinerary = [];
        $destIndex = 0;
        $umkmIndex = 0;

        for ($i = 1; $i <= $days; $i++) {
            $dayPlan = [];

            for ($j = 0; $j < $destinationsPerDay; $j++) {
                if (isset($availableDestinations[$destIndex])) {
                    $dayPlan[] = ['type' => 'destination', 'item' => $availableDestinations[$destIndex]];
                    $destIndex++;
                }
            }

            for ($k = 0; $k < $umkmPerDay; $k++) {
                if (isset($availableUmkms[$umkmIndex])) {
                    $dayPlan[] = ['type' => 'umkm', 'item' => $availableUmkms[$umkmIndex]];
                    $umkmIndex++;
                }
            }
            // Acak urutan dalam satu hari biar natural (tidak selalu destinasi duluan)
            shuffle($dayPlan);
            $generatedItinerary[$i] = $dayPlan;
        }

        $page_title = 'Rekomendasi Rute Anda';
        return view('frontend.planner.result', compact('generatedItinerary', 'days', 'interest', 'pace', 'page_title'));
    }

    public function newsIndex()
    {
        // Mengambil berita yang sudah di-publish, diurutkan dari yang terbaru
        $news = News::with('user')->where('status', 'published')->latest('published_at')->paginate(12);

        $page_title = 'Kabar Pariwisata Sumba';
        return view('frontend.news.index', compact('news', 'page_title'));
    }
    public function newsShow($slug)
    {
        $article = News::with('user')->where('slug', $slug)->where('status', 'published')->firstOrFail();

        // Ambil berita terkait/terbaru lainnya
        $relatedNews = News::where('status', 'published')
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        $page_title = $article->title;
        return view('frontend.news.show', compact('article', 'relatedNews', 'page_title'));
    }
}
