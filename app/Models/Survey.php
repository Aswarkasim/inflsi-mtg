<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;

    protected $guarded = [];

    function pasar()
    {
        return $this->belongsTo(Pasar::class);
    }

    function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    function komoditi()
    {
        return $this->belongsTo(Komoditi::class);
    }
}
