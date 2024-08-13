<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crimelist extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','crime'];

    public function maincategory()
    {
        return $this->belongsTo(Maincrimecategory::class, 'category_id');
    }
}
