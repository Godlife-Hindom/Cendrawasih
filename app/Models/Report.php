<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'status',
        'evaluation',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alternatives()
{
    return $this->belongsToMany(Alternative::class);
}
public function criteria()
{
    return $this->belongsToMany(Criteria::class);
}
public function subcriteria()
{
    return $this->belongsToMany(Subcriteria::class);
}
}
