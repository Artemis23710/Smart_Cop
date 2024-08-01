<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officers extends Model
{
    use HasFactory;

    protected $fillable = [
        'Keywords',
        'idcardno',
        'officerid',
        'namewithintial',
        'firstname',
        'middlename',
        'lastname',
        'fullname',
        'gender',
        'officerdob',
        'contactno',
        'officeremail',
        'permentaddress',
        'officercity',
        'temporyaddress',
        'joinservicedate',
        'resignationdate',
        'stationid',
        'rankid',
        'status',
        'created_by',
        'updated_by'
        
    ];

    public function station()
    {
        return $this->belongsTo(policestations::class, 'stationid');
    }

    public function rank()
    {
        return $this->belongsTo(OfficerRank::class, 'rankid');
    }
}
