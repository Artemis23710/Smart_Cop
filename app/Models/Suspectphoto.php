<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suspectphoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'suspect_id',
        'frontside',
        'leftside',
        'rightside',
        'status',
        
    ];

    public function suspects()
    {
        return $this->belongsTo(Suspect::class, 'suspect_id');
    }
}
