<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{
    //

    function testCurrency()
    {
        // $number = number_format(round(12345.6789), 2);
        $number = round((8994 * 2) / 1000) * 500;
        return $number;
    }
}
