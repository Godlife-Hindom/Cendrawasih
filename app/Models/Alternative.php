<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    use HasFactory;

    // ✅ BENAR
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'vegetation',
        'water',
        'topography',
        'climate',
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
