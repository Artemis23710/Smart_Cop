<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourtVerdicts extends Model
{
    use HasFactory;

    protected $fillable = [
        'suspect_id',
        'crimedetails_id',
        'investigation_id',
        'dateofjudgement',
        'verdict',
        'penelty',
        'judgment_summary',
        'status',
        'created_by',
        'updated_by'
    ];

    public function suspect()
    {
        return $this->belongsTo(Suspect::class, 'suspect_id');
    }

    public function crimedetail()
    {
        return $this->belongsTo(CrimeDetails::class, 'crimedetails_id');
    }
}
