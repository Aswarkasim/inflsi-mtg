<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Komoditi;
use App\Models\RekapSurvey;
use Illuminate\Http\Request;

class HomeKomoditiController extends Controller
{
    //

    function index()
    {
        $kecamatan_id = request('kecamatan_id');
        $komoditi_id = request('komoditi_id');

        if (!$kecamatan_id) {
            $kecamatan_id = 1;
        }

        if (!$komoditi_id) {
            $komoditi_id = 2;
        }

        $rekap  = RekapSurvey::with(['kecamatan', 'komoditi'])->whereKecamatanId($kecamatan_id)->latest('tanggal')->paginate(12);
        $data = [
            'rekap' => $rekap,
            'komoditi'  => Komoditi::all(),
            'kecamatan' => Kecamatan::all(),
            'content'   => 'home/komoditi/index'
        ];
        return view('home/layouts/wrapper', $data);
    }
}
