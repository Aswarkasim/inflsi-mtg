<?php

namespace App\Exports;

use App\Models\RekapSurvey;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class RekapExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $kecamatan_id;
    protected $tanggal;

    function __construct($kecamatan_id, $tanggal)
    {
        $this->kecamatan_id = $kecamatan_id;
        $this->tanggal = $tanggal;
    }
    public function view(): View
    {
        $data['rekap']  = RekapSurvey::whereKecamatanId($this->kecamatan_id)->whereTanggal($this->tanggal)->get();
        return view('home.laporan.export', $data);
    }
}
