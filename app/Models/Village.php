<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Village extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'district_id',
        'name',
        'slug',
        'zip_code',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }

    public function umkms()
    {
        return $this->hasMany(Umkm::class);
    }
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
