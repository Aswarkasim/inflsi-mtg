<?php

namespace App\Http\Controllers;

use App\Models\Saran;
use Illuminate\Http\Request;

class AdminSaranController extends Controller
{
    //
    function index()
    {
        $data = [
            'saran'     => Saran::latest()->paginate(10),
            'content' => 'admin/saran/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }
    function detail($id)
    {
        $saran = Saran::find($id);

        if ($saran->is_read == 0) {
            $saran->is_read = 1;
            $saran->save();
        }

        $data = [
            'saran'     => $saran,
            'content' => 'admin/saran/show'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    function delete($id)
    {
        $saran = Saran::find($id);
        $saran->delete();
        return redirect('/admin/saran');
    }
}
