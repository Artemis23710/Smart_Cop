<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    use HasFactory;

    protected $fillable = ['province_id','distric_name'];

     /**
     * Get the province that owns the district.
     */
    
     public function province()
     {
         return $this->belongsTo(provinces::class, 'province_id');
     }


}
