<?php

namespace App\Http\Controllers;

use App\Models\HistoryRekap;
use App\Models\Kecamatan;
use App\Models\Komoditi;
use App\Models\RekapSurvey;
use App\Models\SurveyDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

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

        try {
            //code...

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

                    $rekap = RekapSurvey::whereKecamatanId($kc->id)->whereKomoditiId($km->id)->latest()->first();
                    // dd($rekap);

                    $rekap == null ? $harga_lama = 0 : $harga_lama = $rekap->harga;
                    $selisih = $harga - $harga_lama;
                    // dd($selisih);

                    // if ($rekap) {
                    //     if ($harga < $rekap->harga) {
                    //         $status = 'TURUN';
                    //     } else if ($harga > $rekap->harga) {
                    //         $status = 'NAIK';
                    //     } else {
                    //         $status = 'STABIL';
                    //     }
                    // }
                    if ($selisih < 100 && $selisih > -100) {
                        $status = 'STABIL';
                    } else if ($selisih > 100) {
                        $status = 'NAIK';
                    } else if ($selisih < -100) {
                        $status = 'TURUN';
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

            HistoryRekap::create([
                'user_id'   => auth()->user()->id,
                'tanggal'   => $current_date
            ]);
            return redirect('/admin/rekap');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Data belum lengkap');
            return redirect()->back();
        }
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
        return currency_multiple_5($rerata);
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
