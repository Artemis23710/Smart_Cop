<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class policestations extends Model
{
    use HasFactory;

    protected $fillable = ['division_id','station_name','station_address','station_contact','status','created_by','updated_by'];


     public function policedivision()
    {
        return $this->belongsTo(policedivision::class, 'division_id');
    }
}
