<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Pasar;
use Illuminate\Http\Request;

class AdminRegionController extends Controller
{
    //
    function getDesa($kecamatan_id)
    {
        if (!$kecamatan_id) return response()->json('NOT OK');

        $desa = Desa::where('kecamatan_id', $kecamatan_id)->get();

        if ($desa == false) return response()->json('NOT OK');

        $dataDesa = "";

        foreach ($desa as $key) {
            $dataDesa .= "<option value='" . $key->id . "'>$key->name</option>";
        }

        return response()->json($dataDesa);
    }

    function getPasar($desa_id)
    {
        if (!$desa_id) return response()->json('NOT OK');

        $desa = Pasar::where('desa_id', $desa_id)->get();

        if ($desa == false) return response()->json('NOT OK');

        $dataPasar = "";

        foreach ($desa as $key) {
            $dataPasar .= "<option value='" . $key->id . "'>$key->name</option>";
        }

        return response()->json($dataPasar);
    }

    function getPasarByKecamatan($kecamatan_id)
    {
        if (!$kecamatan_id) return response()->json('NOT OK');

        $kecamatan = Pasar::where('kecamatan_id', $kecamatan_id)->get();

        if ($kecamatan == false) return response()->json('NOT OK');

        $dataPasar = "";

        foreach ($kecamatan as $key) {
            $dataPasar .= "<option value='" . $key->id . "'>$key->name</option>";
        }

        return response()->json($dataPasar);
    }
}
