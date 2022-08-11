<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    function Komoditi()
    {
        return $this->belongsTo(Komoditi::class);
    }

    function pasar()
    {
        return $this->belongsTo(Pasar::class);
    }
}
