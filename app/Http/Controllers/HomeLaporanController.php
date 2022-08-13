<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;

class HomeLaporanController extends Controller
{
    //
    function index()
    {
        $data = [
            'kecamatan'     => Kecamatan::all(),
            'content'       => 'home/laporan/index'
        ];
        return view('home/layouts/wrapper', $data);
    }
}
