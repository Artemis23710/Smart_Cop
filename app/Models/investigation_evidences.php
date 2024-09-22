<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class investigation_evidences extends Model
{
    use HasFactory;

    protected $fillable = [
        'investigation_note_id',
        'evidence',
        'evidence_title',
        'evidence_desription',
        'status',
        
    ];

}
