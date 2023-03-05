<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Banner;
use App\Models\HistoryRekap;
use App\Models\Komoditi;
use App\Models\Kecamatan;
use App\Models\RekapSurvey;
use App\Models\Survey;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        //

        $komoditi_id = request('komoditi_id');
        $kecamatan_id = request('kecamatan_id');

        if (!$komoditi_id) {
            $komoditi_id = 6;
        }

        if (!$kecamatan_id) {
            $kecamatan_id = 1;
        }

        $historyRekap = HistoryRekap::latest()->first();

        $rekap = RekapSurvey::with(['kecamatan', 'komoditi'])->whereKomoditiId($komoditi_id)->whereTanggal($historyRekap->tanggal)->latest('tanggal')->get();
        $rekapByKecamatan  = RekapSurvey::with(['kecamatan', 'komoditi'])->whereKecamatanId($kecamatan_id)->latest('tanggal')->limit(6)->get();
        // dd($rekap);
        $data = [
            'banner'    => Banner::get(),
            'post'     => Post::with('category')->paginate(8),
            'kecamatan' => Kecamatan::all(),
            'komoditi'  => Komoditi::all(),
            'historyRekap' => $historyRekap,
            'rekap'     => $rekap,
            'rekapByKecamatan'     => $rekapByKecamatan,
            'content'  => 'home/home/index'
        ];
        return view('home/layouts/wrapper', $data);
    }
}
