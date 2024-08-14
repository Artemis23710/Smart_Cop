<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suspect extends Model
{
    use HasFactory;

    protected $fillable = [
        'Keywords',
        'idcardno',
        'namewithintial',
        'firstname',
        'middlename',
        'lastname',
        'fullname',
        'aliases',
        'gender',
        'officerdob',
        'age',
        'nationality',
        'citizenship',
        'contactno',
        'permentaddress',
        'officercity',
        'stationid',
        'maincategoryid',
        'crimeid',
        'arresteddate',
        'status',
        'convictedstatus',
        'created_by',
        'updated_by'
        
    ];

    public function station()
    {
        return $this->belongsTo(policestations::class, 'stationid');
    }

    public function maincategory()
    {
        return $this->belongsTo(Maincrimecategory::class, 'maincategoryid');
    }

    public function crimecategory()
    {
        return $this->belongsTo(Crimelist::class, 'crimeid');
    }
}
