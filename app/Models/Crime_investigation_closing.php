<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crime_investigation_closing extends Model
{
    use HasFactory;

    protected $fillable = [
        'investigation_id',
        'dayofclosing',
        'reason_closing',
        'closing_summary',
        'status',
        'approved_status',
        'created_by',
        'updated_by',
        'approved_by'
    ];

    public function investigation()
    {
        return $this->belongsTo(investigation_details::class, 'investigation_id');
    }
}
