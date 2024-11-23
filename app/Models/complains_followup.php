<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class complains_followup extends Model
{
    use HasFactory;

    protected $fillable = [
        'complain_id',
        'dateofcomplainfloowup',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];

    public function complains()
    {
        return $this->belongsTo(complains::class, 'complain_id');
    }


}
