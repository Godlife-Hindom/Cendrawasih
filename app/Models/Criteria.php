<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'weight',
        'code',
        'type'
    ];
    protected $table = 'criteria'; 

    public function subcriterias()
{
    return $this->hasMany(Subcriteria::class);
}

// app/Models/Criteria.php
public function subcriteria()
{
    return $this->hasMany(Subcriteria::class);
}
}
