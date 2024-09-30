<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class investigation_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'Keywords',
        'case_no',
        'report_date',
        'arrested_crime_category',
        'arrested_crime',
        'title_incident',
        'incident_date',
        'incident_location',
        'incident_area',
        'arrested_station',
        'investigating_officer',
        'assigndate',
        'incident_description',
        'status',
        'approve_status',
        'investigation_status',
        'created_by',
        'updated_by',
        'approved_by'
    ];

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

    public function officer(){
        return $this->belongsTo(Officers::class, 'investigating_officer');
    }
}
