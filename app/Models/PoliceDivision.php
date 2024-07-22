<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliceDivision extends Model
{
    use HasFactory;

    protected $fillable = ['district_id','division_name','status','created_by','updated_by'];


     public function district()
    {
        return $this->belongsTo(Districts::class, 'district_id');
    }
}
