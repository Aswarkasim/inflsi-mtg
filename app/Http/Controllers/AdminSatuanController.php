<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AdminSatuanController extends Controller
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
            $satuan = Satuan::where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $satuan = Satuan::latest()->paginate(10);
        }
        $data = [
            'title'   => 'Manajemen Satuan',
            'satuan' => $satuan,
            'content' => 'admin/satuan/index'
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
            'title'   => 'Manajemen Satuan Satuan',
            'content' => 'admin/satuan/add'
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
            'name'              => 'required',
            'desc'              => 'required',
        ]);
        Satuan::create($data);
        Alert::success('Sukses', 'Satuan telah ditambahkan');
        return redirect('/admin/komoditi/satuan');
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
        $satuan = Satuan::find($id);
        $data = [
            'title'   => 'Edit Satuan',
            'satuan' => $satuan,
            'content' => 'admin/satuan/add'
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
        $satuan = Satuan::find($id);
        $data = $request->validate([
            'name'              => 'required',
            'desc'              => 'required',
        ]);
        $satuan->update($data);
        Alert::success('Sukses', 'Satuan telah diubah');
        return redirect('/admin/komoditi/satuan');
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
        DB::table('satuans')->delete($id);
        Alert::success('success', 'Kateogri telah dihapus');
        return redirect('/admin/komoditi/satuan');
    }
}
