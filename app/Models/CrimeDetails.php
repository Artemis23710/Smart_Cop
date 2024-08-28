<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrimeDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'Keywords',
        'arrested_crime_category',
        'arrested_crime',
        'arrested_station',
        'suspect_id',
        'investigation_id',
        'arrested_date',
        'incident_location',
        'incident_city',
        'dateofincident',
        'incident_note',
        'incident_followup',
        'incident_evidance',
        'status',
        'approve_status',
        'created_by',
        'updated_by',
        'approved_by'
    ];
    public function suspect()
    {
        return $this->belongsTo(Suspect::class, 'suspect_id');
    }

    public function crimemain()
    {
        return $this->belongsTo(Maincrimecategory::class, 'arrested_crime_category');
    }

    public function crime()
    {
        return $this->belongsTo(Crimelist::class, 'arrested_crime');
    }
    
    public function station()
    {
        return $this->belongsTo(policestations::class, 'arrested_station');
    }
}
