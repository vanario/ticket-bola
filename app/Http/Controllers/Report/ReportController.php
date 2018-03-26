<?php

namespace App\Http\Controllers\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Authentication\LoginController;
use Session;
use Alert;

class ReportController extends Controller
{
    public function index()
    {
        return view('Report/index');
    }

    public function club()
    {
        $token = Session::get('token'); 

        $response = Curl::to('128.199.161.172:8091/getbygttop/TB')
                    ->asJson(true)
                    ->get(); 

        $data     = $response['value'];
        
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $col = collect($data);
        $perPage = 10;
        $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        // $data = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);
        $data = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage, $currentPage,['path' => LengthAwarePaginator::resolveCurrentPath()] );

        // return $data;

        return view('Report/Club/club',['data' => $data,]);
    }

    public function clubReport($id)
    {
        $token = Session::get('token'); 

        $clubResponse = Curl::to('128.199.161.172:8091/getbygtcode/'.$id)
                    ->asJson(true)
                    ->withHeader('Authorization:'.$token)
                    ->get(); 

        $sumCurrentResponse = Curl::to('http://128.199.161.172:8109/report/tiket/sumcurrent/'.$id)
                    ->asJson(true)
                    ->withHeader('Authorization:'.$token)
                    ->get(); 

        $listCurrentResponse = Curl::to('http://128.199.161.172:8109/report/tiket/listcurrent/'.$id)
                    ->asJson(true)
                    ->withHeader('Authorization:'.$token)
                    ->get(); 


        $sumCurrent     = $sumCurrentResponse['values'];
        $listCurrent    = $listCurrentResponse['values'];
        $club           = $clubResponse['value'];

        return view('Report/Club/detail', compact('sumCurrent', 'listCurrent', 'club'));
    }
}
