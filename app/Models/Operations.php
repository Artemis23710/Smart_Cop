<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operations extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'title',
        'operation_Type',
        'Start_date',
        'End_date',
        'operation_budget',
        'officerincharge',
        'description',
        'status',
        'Complete_status',
        'approve_status',
        'status',
        'created_by',
        'updated_by',
        'approved_by',
    ];

    public function officercharge()
    {
        return $this->belongsTo(Officers::class, 'officerincharge');
    }
}
