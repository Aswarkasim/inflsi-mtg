<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use App\Models\Kecamatan;
use App\Models\RekapSurvey;
use App\Models\SurveyDetail;
use Illuminate\Http\Request;

class HomeLaporanController extends Controller
{
    //
    function index()
    {
        $kecamatan_id = request('kecamatan_id');
        $pasar_id = request('pasar_id');
        // $date_start = request('date_start');
        // $date_end = request('date_end');
        $tanggal = request('tanggal');

        $data_survey = RekapSurvey::with(['komoditi', 'kecamatan'])->groupBy('komoditi_id')->latest('tanggal')->get();
        // dd($data_survey);

        $data = [
            'kecamatan'     => Kecamatan::all(),
            'data_survey' => $data_survey,
            'content'       => 'home/laporan/index'
        ];
        return view('home/layouts/wrapper', $data);
    }

    function show()
    {
        // dd($request->all());
        $kecamatan_id = request('kecamatan_id');
        $pasar_id = request('pasar_id');
        // $date_start = request('date_start');
        // $date_end = request('date_end');
        $tanggal = request('tanggal');

        // $survey = Survey::whereKecamatanId($kecamatan_id)->wherePasarId($pasar_id)->whereTanggal($tanggal)->first();
        // dd($survey);


        $data = [
            'kecamatan'     => Kecamatan::all(),
            'content'       => 'home/laporan/index'
        ];
        return view('home/layouts/wrapper', $data);
    }
}
