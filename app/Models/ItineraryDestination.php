<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItineraryDestination extends Model
{
    // Arahkan secara spesifik ke tabel pivot kita
    protected $table = 'destination_itinerary';

    protected $fillable = [
        'itinerary_id',
        'destination_id',
        'day',
        'order_index',
    ];

    // Relasi ke Destinasi (Ini yang dicari oleh Filament)
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class);
    }
}