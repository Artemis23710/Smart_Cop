<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class operation_progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'operation_id',
        'report_date',
        'report_title',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];
}
