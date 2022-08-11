<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Komoditi;
use App\Models\Pasar;
use App\Models\Survey;
use App\Models\SurveyDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class AdminSurveyController extends Controller
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
            $survey = Survey::with(['kecamatan', 'desa', 'pasar'])->where('name', 'like', '%' . $cari . '%')->latest()->paginate(10);
        } else {
            $survey = Survey::with(['kecamatan', 'desa', 'pasar'])->latest()->paginate(10);
        }
        $data = [
            'title'   => 'Manajemen Survey',
            'survey' => $survey,
            'content' => 'admin/survey/index'
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
            'title'   => 'Manajemen Survey',
            'kecamatan' => Kecamatan::all(),
            'desa' => Desa::all(),
            'pasar' => Pasar::all(),
            'content' => 'admin/survey/add'
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
        $data = $request->validate([
            'tanggal'              => 'required',
            'kecamatan_id'              => 'required',
            'desa_id'              => 'required',
            'pasar_id'              => 'required',
        ]);

        $data['user_id']    = auth()->user()->id;

        Survey::create($data);
        Alert::success('Sukses', 'Survey telah ditambahkan');
        //return redirect back();
        return redirect('/admin/survey');
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
        // echo $id;
        $survey = Survey::with(['pasar', 'komoditi'])->find($id);
        // dd($survey);
        $data = [
            'title'   => 'Manajemen Survey',
            'survey' =>  $survey,
            'survey_detail' => SurveyDetail::with('komoditi')->whereSurveyId($id)->get(),
            'komoditi' => Komoditi::all(),
            'content' => 'admin/survey/detail'
        ];
        return view('admin/layouts/wrapper', $data);
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
        $survey = Survey::find($id);
        $data = [
            'title'   => 'Edit Survey',
            'survey' => $survey,
            'content' => 'admin/survey/add'
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
        $survey = Survey::find($id);
        $data = $request->validate([
            'name'              => 'required|min:3',
            'satuan'              => 'required|min:3',
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
            $data['gambar'] = $survey->gambar;
        }

        $survey->update($data);
        Alert::success('Sukses', 'Survey telah ditambahkan');
        //return redirect back();
        return redirect('/admin/survey');
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
        DB::table('surveys')->delete($id);
        Alert::success('success', 'Kateogri telah dihapus');
        return redirect('/admin/master/survey');
    }
}
