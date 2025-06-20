<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = ['user_id', 'name', 'score', 'peringkat'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

