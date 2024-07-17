<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provinces extends Model
{
    use HasFactory;

    protected $fillable = [ 'province_name' ];

     /**
     * Get the districts for the province.
     */
    public function districts()
    {
        return $this->hasMany(Districts::class);
    }


}
