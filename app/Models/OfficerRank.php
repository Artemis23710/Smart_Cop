<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficerRank extends Model
{
    use HasFactory;

    protected $fillable = ['Rank_name'];

    public function officers()
    {
        return $this->hasMany(Officers::class, 'rankid');
    }
}
