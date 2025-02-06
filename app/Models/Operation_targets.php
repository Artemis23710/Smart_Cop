<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation_targets extends Model
{
    use HasFactory;

    protected $fillable = [
        'target_name',
        'target_description',
        'status',
        'created_by',
        'updated_by',
    ];

}
