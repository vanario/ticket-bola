<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Session;
use Alert;

class DashboardController extends Controller
{
    public function index()
    {   
        $token = Session::get('token'); 

        $response = Curl::to('http://128.199.161.172:8109/report/tiket/sumcurrent/12')
        			->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->get(); 

        $col     = $response['values'][0];
        $data 	 = collect($col);
        // return $data;
        return view('home',['data' => $data,]);
    }
}
