<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    // Mengizinkan field ini untuk diisi massal
    protected $fillable = ['url', 'ip_address'];
}