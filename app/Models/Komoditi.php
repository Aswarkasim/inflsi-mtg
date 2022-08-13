<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komoditi extends Model
{
    use HasFactory;

    protected $guarded = [];

    function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }
}
