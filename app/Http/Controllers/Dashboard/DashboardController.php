<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Curl\CurlController as CurlController;
use Ixudra\Curl\Facades\Curl;
use Session;
use Alert;

class DashboardController extends Controller
{
    public function index()
    {
        $clubcode = Session::get('clubcode');

        $port           = '8109';
        $url            = '/report/tiket/sumcurrent/'.$clubcode;
        $response       = CurlController::curldata($port,$url);

        $col            = $response['values'];
        $data 	        = collect($col);
        // $idr            = "Rp " . number_format($data['tot_nominal'],2,',','.');
        $idr            = "";
        // return $data;

        return view('home', compact('data', 'idr'));
    }
}
