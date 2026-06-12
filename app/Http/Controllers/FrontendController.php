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
use Illuminate\Http\Request;
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

    public function showDestination($slug)
    {
        $destination = Destination::with(['village', 'reviews' => function ($query) {
            $query->where('is_approved', true)->latest();
        }])->where('slug', $slug)->where('is_active', true)->firstOrFail();

        // LBS ALGORITHM (Location Based System) - Mencari UMKM Terdekat
        $nearbyUmkms = collect();
        if ($destination->latitude && $destination->longitude) {
            $lat = (float) $destination->latitude;
            $lon = (float) $destination->longitude;

            // Mengambil semua UMKM aktif yang memiliki koordinat
            $allUmkms = Umkm::with('village')->where('is_active', true)->whereNotNull('latitude')->whereNotNull('longitude')->get();

            // Filter menggunakan rumus Haversine (menghitung jarak dalam Kilometer)
            $nearbyUmkms = $allUmkms->filter(function ($umkm) use ($lat, $lon) {
                $uLat = (float) $umkm->latitude;
                $uLon = (float) $umkm->longitude;

                $earthRadius = 6371; // Jari-jari bumi dalam KM

                $dLat = deg2rad($uLat - $lat);
                $dLon = deg2rad($uLon - $lon);

                $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat)) * cos(deg2rad($uLat)) * sin($dLon / 2) * sin($dLon / 2);
                $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

                $distance = $earthRadius * $c;

                // Simpan jarak ke dalam object model agar bisa ditampilkan di View
                $umkm->distance_km = round($distance, 1);

                // Hanya ambil UMKM dalam radius maksimal 15 KM
                return $distance <= 15;
            })->sortBy('distance_km')->take(4); // Urutkan dari yang terdekat, ambil maksimal 4
        }

        // SEO Injection
        $page_title = $destination->name . ' - Destinasi Wisata';
        $page_description = Str::limit(strip_tags($destination->description), 160);
        $page_image = asset('storage/' . $destination->thumbnail);

        return view('frontend.destinations.show', compact('destination', 'nearbyUmkms', 'page_title', 'page_description', 'page_image'));
    }

    // ... (method storeReview, umkmIndex, umkmShow, itineraryIndex, itineraryShow, galleryIndex tetap sama) ...
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
}
