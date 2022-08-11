<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AdminDesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cari = request('cari');

        if ($cari) {
            $desa = Desa::where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $desa = Desa::latest()->paginate(10);
        }
        $data = [
            'title'   => 'Manajemen Desa',
            'desa' => $desa,
            'content' => 'admin/desa/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'title'   => 'Manajemen Desa',
            'kecamatan' => Kecamatan::all(),
            'content' => 'admin/desa/add'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // print_r($request);
        // die;
        // dd($request);
        $data = $request->validate([
            'name'              => 'required|min:3',
            'kecamatan_id'              => 'required',
        ]);
        Desa::create($data);
        Alert::success('Sukses', 'Desa telah ditambahkan');
        return redirect('/admin/master/desa');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $desa = Desa::find($id);
        $data = [
            'title'   => 'Edit Desa',
            'desa' => $desa,
            'content' => 'admin/desa/add'
        ];
        return view('admin/layouts/wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $desa = Desa::find($id);
        $data = $request->validate([
            'name'              => 'required|min:3',
            'kecamatan_id'              => 'required',
        ]);
        $desa->update($data);
        Alert::success('Sukses', 'Desa telah diubah');
        return redirect('/admin/master/desa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::table('desas')->delete($id);
        Alert::success('success', 'Kateogri telah dihapus');
        return redirect('/admin/master/desa');
    }
}
