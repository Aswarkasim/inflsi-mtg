<?php

namespace App\Http\Controllers;

use App\Models\SurveyDetail;
use Illuminate\Http\Request;

class AdminSurveyDetailController extends Controller
{
    //
    function update()
    {
        $id = request('id');
        $komoditi = SurveyDetail::find($id);
        $komoditi->harga = request('harga');
        $komoditi->save();

        return response()->json([
            'Success'   => 'Berhasil'
        ]);
    }

    function create(Request $request)
    {
        $survey = SurveyDetail::whereKomoditiId($request->komoditi_id)->latest()->first();
        $data = $request->validate([
            'komoditi_id'   => 'required',
            'harga'         => 'required|numeric'
        ]);

        $harga_lama  = 0;
        isset($survey) ? $harga_lama = $survey->harga : 0;

        $data['range'] = $harga_lama - $request->harga;
        $status = 'KOSONG';


        if ($harga_lama > $request->harga) {
            $status = 'TURUN';
        } else if ($harga_lama < $request->harga) {
            $status = 'NAIK';
        } else if ($harga_lama == $request->harga) {
            $status = 'STABIL';
        }
        $data['status']  = $status;
        $data['survey_id'] = $request->survey_id;
        SurveyDetail::create($data);
        return redirect('/admin/survey/' . $request->survey_id);
    }
}
