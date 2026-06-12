<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Destination extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'village_id',
        'name',
        'slug',
        'description',
        'thumbnail',
        'gallery',
        'address',
        'latitude',
        'longitude',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'gallery' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function itineraries()
    {
        return $this->belongsToMany(Itinerary::class)
            ->withPivot(['day', 'order_index'])
            ->withTimestamps();
    }

}
