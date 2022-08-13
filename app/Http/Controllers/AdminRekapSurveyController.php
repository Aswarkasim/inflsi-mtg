<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Komoditi;
use App\Models\RekapSurvey;
use App\Models\SurveyDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminRekapSurveyController extends Controller
{
    //
    function index()
    {
        $data = [
            'title'   => 'Rekap Survey',
            'rekap' => RekapSurvey::with('komoditi')->groupBy('tanggal')->paginate(10),
            'content' => 'admin/rekap/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }
    function create()
    {
        $current_date = date('Y-m-d');
        // echo $current_date;
        $komoditi = Komoditi::all();
        $kecamatan = Kecamatan::all();

        $harga = 0;
        $selisih = 0;
        $status = 'KOSONG';
        foreach ($kecamatan as $kc) {
            foreach ($komoditi as $km) {
                $survey_detail = SurveyDetail::whereKomoditiId($km->id)->get();
                $harga = $this->rerata($survey_detail);

                $rekap = RekapSurvey::latest()->first();

                $rekap == null ? $selisih = 0 : $selisih = $rekap->selisih;
                $selisih = abs($selisih - $harga);

                if ($rekap) {
                    if ($harga < $rekap->harga) {
                        $status = 'TURUN';
                    } else if ($harga > $rekap->harga) {
                        $status = 'NAIK';
                    } else {
                        $status = 'STABIL';
                    }
                }
                $data = [
                    'kecamatan_id'      => $kc->id,
                    'komoditi_id'       => $km->id,
                    'tanggal'           => $current_date,
                    'harga'             => $harga,
                    'selisih'           => $selisih,
                    'status'            => $status
                ];
                RekapSurvey::create($data);
            }
        }
        return redirect('/admin/rekap');
    }

    private function rerata($rekap)
    {
        // dd($rekap);
        $sum = 0;
        foreach ($rekap as $r) {
            $sum = $sum + $r->harga;
        }
        $n = count($rekap);
        if ($n == null) {
            $n = 0;
        }
        $rerata = $sum / $n;
        return $rerata;
    }

    function delete($rekap_id)
    {
        // $rekap = RekapSurvey::find($rekap_id);
        // $rekap->delete();
        // die;
        $rekap = RekapSurvey::find($rekap_id);
        $rekaps = RekapSurvey::whereTanggal($rekap->tanggal)->get();
        foreach ($rekaps as $r) {
            DB::table('rekap_surveys')->delete($r->id);
        }
        return redirect('/admin/rekap');
    }

    function detail($id)
    {
        $rekap  = RekapSurvey::find($id);
        // echo $rekap->tanggal;
        $data = [
            'title'   => 'Rekap Survey',
            // 'rekap_kecamatan' => RekapSurvey::with(['komoditi', 'kecamatan'])->groupBy('kecamatan_id')->whereTanggal($rekap->tanggal)->get(),
            'kecamatan'    => Kecamatan::all(),
            'rekap_detail' => RekapSurvey::with(['komoditi', 'kecamatan'])->groupBy('komoditi_id')->whereTanggal($rekap->tanggal)->get(),
            'rekap_tanggal' => $rekap->tanggal,
            'content' => 'admin/rekap/detail'
        ];
        return view('admin/layouts/wrapper', $data);
    }
}
