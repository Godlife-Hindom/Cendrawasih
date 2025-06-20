<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcriteria extends Model
{
    use HasFactory;
    protected $table = 'subcriterias';
    protected $fillable = ['criteria_id', 'name', 'range', 'score'];

    public function criteria() {
        return $this->belongsTo(Criteria::class);
    }

    public function criterion()
    {
        return $this->belongsTo(Criteria::class, 'criterion_id');
    }
}
