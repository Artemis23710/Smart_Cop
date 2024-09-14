<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class investigation_vicims extends Model
{
    use HasFactory;

    protected $fillable = [
        'investigation_id',
        'victim_name',
        'victim_gender',
        'victim_age',
        'status',
        
    ];

    public function investigationdetails()
    {
        return $this->belongsTo(investigation_details::class, 'investigation_id');
    }
}
