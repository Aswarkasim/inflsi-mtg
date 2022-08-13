<?php

namespace App\Http\Controllers;

use App\Models\Komoditi;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AdminKomoditiController extends Controller
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

        // $komoditi = [];
        if ($cari) {
            $komoditi = Komoditi::with('satuan')->where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $komoditi = Komoditi::with('satuan')->latest()->paginate(10);
        }
        // dd($komoditi->satuan);
        $data = [
            'title'   => 'Manajemen Komoditi',
            'komoditi' => $komoditi,
            'content' => 'admin/komoditi/index'
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
            'title'   => 'Manajemen Komoditi',
            'satuan'  => Satuan::all(),
            'content' => 'admin/komoditi/add'
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
            'satuan_id'              => 'required',
            'gambar'              => 'required',
        ]);

        $data['desc']   = $request->desc;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $file_name = time() . "_" . $gambar->getClientOriginalName();

            $storage = 'uploads/images/';
            $gambar->move($storage, $file_name);
            $data['gambar'] = $storage . $file_name;
        } else {
            $data['gambar'] = NULL;
        }

        Komoditi::create($data);
        Alert::success('Sukses', 'Komoditi telah ditambahkan');
        //return redirect back();
        return redirect('/admin/komoditi/komoditi');
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
        $komoditi = Komoditi::find($id);
        $data = [
            'title'   => 'Edit Komoditi',
            'komoditi' => $komoditi,
            'satuan'  => Satuan::all(),
            'content' => 'admin/komoditi/add'
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
        $komoditi = Komoditi::find($id);
        $data = $request->validate([
            'name'              => 'required|min:3',
            'satuan_id'              => 'required',
            'gambar'              => '|mimes:jpeg,jpg,png,JPG,JPEG,PNG',
        ]);

        $data['desc']   = $request->desc;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $file_name = time() . "_" . $gambar->getClientOriginalName();

            $storage = 'uploads/images/';
            $gambar->move($storage, $file_name);
            $data['gambar'] = $storage . $file_name;
        } else {
            $data['gambar'] = $komoditi->gambar;
        }

        $komoditi->update($data);
        Alert::success('Sukses', 'Komoditi telah ditambahkan');
        //return redirect back();
        return redirect('/admin/komoditi/komoditi');
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
        DB::table('komoditis')->delete($id);
        Alert::success('success', 'Kateogri telah dihapus');
        return redirect('/admin/komoditi/komoditi');
    }
}
