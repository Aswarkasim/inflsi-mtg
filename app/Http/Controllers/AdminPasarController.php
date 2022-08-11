<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Pasar;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AdminPasarController extends Controller
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
            $pasar = Pasar::where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $pasar = Pasar::latest()->paginate(10);
        }
        $data = [
            'title'   => 'Manajemen Pasar',
            'pasar' => $pasar,
            'content' => 'admin/pasar/index'
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
            'title'   => 'Manajemen Pasar',
            'kecamatan' => Kecamatan::all(),
            'desa' => Desa::all(),
            'content' => 'admin/pasar/add'
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
            'desa_id'              => 'required',
        ]);
        Pasar::create($data);
        Alert::success('Sukses', 'Pasar telah ditambahkan');
        return redirect('/admin/master/pasar');
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
        $pasar = Pasar::find($id);
        $data = [
            'title'   => 'Edit Pasar',
            'pasar' => $pasar,
            'kecamatan' => Kecamatan::all(),
            'desa' => Desa::all(),
            'content' => 'admin/pasar/add'
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
        $pasar = Pasar::find($id);
        $data = $request->validate([
            'name'              => 'required|min:3',
            'kecamatan_id'              => 'required',
            'desa_id'              => 'required',
        ]);
        $pasar->update($data);
        Alert::success('Sukses', 'Pasar telah diubah');
        return redirect('/admin/master/pasar');
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
        DB::table('pasars')->delete($id);
        Alert::success('success', 'Pasar telah dihapus');
        return redirect('/admin/master/pasar');
    }
}
