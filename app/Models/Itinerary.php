<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Itinerary extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'slug',
        'duration_days',
        'description',
        'thumbnail',
        'estimated_budget',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'duration_days' => 'integer',
            'estimated_budget' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Relasi Asli (Many-to-Many) - Digunakan oleh Frontend
     */
    public function destinations()
    {
        return $this->belongsToMany(Destination::class)
                    ->withPivot(['day', 'order_index'])
                    ->withTimestamps()
                    ->orderBy('pivot_day', 'asc')
                    ->orderBy('pivot_order_index', 'asc');
    }

    /**
     * RELASI BARU (One-to-Many) - Digunakan KHUSUS oleh Filament Repeater
     */
    public function itineraryDestinations()
    {
        return $this->hasMany(ItineraryDestination::class)->orderBy('day', 'asc')->orderBy('order_index', 'asc');
    }
}