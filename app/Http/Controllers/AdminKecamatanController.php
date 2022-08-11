<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AdminKecamatanController extends Controller
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
            $kecamatan = Kecamatan::where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $kecamatan = Kecamatan::latest()->paginate(10);
        }
        $data = [
            'title'   => 'Manajemen Kecamatan',
            'kecamatan' => $kecamatan,
            'content' => 'admin/kecamatan/index'
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
            'title'   => 'Manajemen Kecamatan Kecamatan',
            'content' => 'admin/kecamatan/add'
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
        ]);
        Kecamatan::create($data);
        Alert::success('Sukses', 'Kecamatan telah ditambahkan');
        return redirect('/admin/master/kecamatan');
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
        $kecamatan = Kecamatan::find($id);
        $data = [
            'title'   => 'Edit Kecamatan',
            'kecamatan' => $kecamatan,
            'content' => 'admin/kecamatan/add'
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
        $kecamatan = Kecamatan::find($id);
        $data = $request->validate([
            'name'              => 'required|min:3',
        ]);
        $kecamatan->update($data);
        Alert::success('Sukses', 'Kecamatan telah diubah');
        return redirect('/admin/master/kecamatan');
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
        DB::table('kecamatans')->delete($id);
        Alert::success('success', 'Kateogri telah dihapus');
        return redirect('/admin/master/kecamatan');
    }
}
