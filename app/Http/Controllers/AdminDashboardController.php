<?php

namespace App\Http\Controllers;

use App\Models\Komoditi;
use App\Models\Pasar;
use App\Models\Survey;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //

    function index()
    {
        $komoditi = Komoditi::count();
        $pasar = Pasar::count();
        $survey = Survey::count();
        $data = [
            'komoditi'  => $komoditi,
            'pasar'  => $pasar,
            'survey'  => $survey,
            'content' => 'admin/dashboard/index'
        ];
        return view('admin/layouts/wrapper', $data);
    }
}
