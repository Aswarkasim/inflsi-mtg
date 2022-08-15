<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasar extends Model
{
    use HasFactory;

    protected $guarded = [];

    function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
