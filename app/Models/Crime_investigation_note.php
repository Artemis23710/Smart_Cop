<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crime_investigation_note extends Model
{
    use HasFactory;

    protected $fillable = [
        'investigation_id',
        'investigation_title',
        'day_investigation_note',
        'related_location',
        'description',
        'status',
        'created_by',
        'updated_by'
    ];
}
