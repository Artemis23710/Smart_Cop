<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation_officers extends Model
{
    use HasFactory;

    protected $fillable = [
        'Officer_id',
        'officer_badge',
        'officer_role',
        'status',
        'created_by',
        'updated_by',
    ];

    public function officers()
    {
        return $this->belongsTo(Officers::class, 'Officer_id');
    }
}
