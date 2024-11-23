<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class complains extends Model
{
    use HasFactory;

    protected $fillable = [
        'station',
        'complain_type',
        'dateofcomplain',
        'description',
        'missingperson_id',
        'missingperson_fname',
        'missingperson_mname',
        'missingperson_lname',
        'missingperson_fullname',
        'missingperson_gender',
        'missingperson_dob',
        'missingperson_age',
        'missingperson_nationality',
        'missingperson_lastseen',
        'missingperson_image',
        'poctperson_name',
        'poctperson_relation',
        'poctperson_idnumber',
        'poctperson_contactno',
        'poctperson_address',
        'status',
        'created_by',
        'updated_by',
    ];

    public function station()
    {
        return $this->belongsTo(policestations::class, 'station');
    }

}
