<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class operation_close extends Model
{
    use HasFactory;

    protected $fillable = [
        'operation_id',
        'closing_date',
        'closing_type',
        'closing_reason',
        'closing_description',
        'status',
        'created_by',
        'updated_by',
    ];
}
