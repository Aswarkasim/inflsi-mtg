<?php

namespace App\Http\Controllers;

use App\Models\Saran;
use Illuminate\Http\Request;
use App\Models\Configuration;
use RealRashid\SweetAlert\Facades\Alert;

class HomeContactController extends Controller
{
    //
    function  index()
    {
        $data = [
            'contact'       => Configuration::first(),
            'content'       => 'home/contact/index'
        ];
        return view('home/layouts/wrapper', $data);
    }

    //functioon form send saran
    public function sendSaran(Request $request)
    {
        //
        $data = $request->validate([
            'name' => 'required',
            'nohp' => 'required',
            'subjek' => 'required',
            'desc' => 'required'
        ]);
        Saran::create($data);
        Alert::success('Sukses', 'Saran anda telah terkirim');
        return redirect()->back()->with('success', 'Saran anda telah terkirim');
    }
}
