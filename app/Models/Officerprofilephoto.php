<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officerprofilephoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'officer_id',
        'photourl',
        'status',
        
    ];

    public function officers()
    {
        return $this->belongsTo(Officers::class, 'officer_id');
    }
}
