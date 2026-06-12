<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Umkm extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'village_id',
        'name',
        'slug',
        'category',
        'phone_number',
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
}