<?php

namespace App\Http\Controllers;

use App\Exports\RekapExport;
use App\Models\Survey;
use App\Models\Kecamatan;
use App\Models\RekapSurvey;
use App\Models\SurveyDetail;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HomeLaporanController extends Controller
{
    //
    function index()
    {
        $kecamatan_id = request('kecamatan_id');
        // $pasar_id = request('pasar_id');
        // $date_start = request('date_start');
        // $date_end = request('date_end');
        $tanggal = request('tanggal');

        $data_kecamatan = [];
        if ($kecamatan_id) {
            $data_kecamatan = RekapSurvey::with(['komoditi', 'kecamatan'])->whereKecamatanId($kecamatan_id)->whereTanggal($tanggal)->get();
            // dd($data_kecamatan);
        }
        $data_survey = RekapSurvey::with(['komoditi', 'kecamatan'])->groupBy('komoditi_id')->latest('tanggal')->get();
        // dd($data_survey);

        $data = [
            'kecamatan'     => Kecamatan::all(),
            'data_kecamatan' => $data_kecamatan,
            'data_survey' => $data_survey,
            'kecamatan_detail'     => Kecamatan::find($kecamatan_id),
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

    function exportExcel()
    {

        $kecamatan_id = request('kecamatan_id');
        $tanggal = request('tanggal');
        $this->updateNameById($kecamatan_id, $tanggal);
        // die($filter);
        return Excel::download(new RekapExport($kecamatan_id, $tanggal), 'laporan tanggal' . format_indo($tanggal) . '.xlsx');
    }

    function updateNameById($kecamatan_id, $tanggal)
    {
        $rekap = RekapSurvey::with(['komoditi', 'kecamatan'])->whereKecamatanId($kecamatan_id)->whereTanggal($tanggal)->get();

        foreach ($rekap as $row) {
            if (isset($row->kecamatan_id)) {
                $row->kecamatan_name = $row->kecamatan->name;
            }

            if (isset($row->komoditi_id)) {
                $row->komoditi_name = $row->komoditi->name;
            }

            $row->save();
        }
    }
}
