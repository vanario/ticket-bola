<?php

namespace App\Http\Controllers\DataMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Pagination\LengthAwarePaginator;
use Alert;
use Session;

class TribunController extends Controller
{   
    public function index(Request $request)
    {
        $token = Session::get('token');     

        $gtcode   = $request->input('gttopstadion');

        // return $gtcode;

        $response = Curl::to('128.199.161.172:8102/bycode/'.$gtcode)
                    ->asJson(true)
                    ->withHeader('Authorization:'.$token)
                    ->get(); 


        $data     = $response['value'];

        $response = Curl::to('128.199.161.172:8103/getliststadion/TB')
                    ->asJson(true)
                    ->get(); 

        $stadion     = $response['result'];

        $list_stadion = collect($stadion)->pluck('name','gtcode');

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $col = collect($data);
        $perPage = 10;
        $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $data = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage, $currentPage,['path' => LengthAwarePaginator::resolveCurrentPath()] );

        return view('DataMaster/Tribun.tribun',compact('data','tribun', 'list_stadion'));
    }

    public function store(Request $request)
    {   
        $token = Session::get('token');           

        $gttop 		= $request->input('gttop');
        $gtcode 	= $request->input('gtcode');
        $tribun 	= $request->input('tribun');
        $kapasitas 	= $request->input('kapasitas');
        $descriction= $request->input('description');

        $prefix     = "A";

        $kursi = '';

        for ($x = 1; $x <=$kapasitas; $x++) {
          $kursi .= "{Kursi: $prefix$x},";
        }

        $value = ['gttop'=>$gttop, 'gtcode'=>'16', 'tribun'=>$tribun, 'kapasitas' => $kapasitas, 'descriction'=>$descriction, 'layout' => [$kursi]];

        $response = Curl::to('128.199.161.172:8102/add')
                    ->withData([
                    "kind"=> "add#denah",
                    "version"=> "1.0",
                    "value"=> $value ])
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->post();
        // return $response;
            
        if ($response['status'] == "OK") {
            
            $message = "Data Berhasil Ditambahkan";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
        }

        else {
            
            $message = "Kode sudah tersedia, Anda tidak bisa menambahkan tribun dengan kode yang sama";
            Alert::message($message)->autoclose(4000);
        }

        return redirect()->route('tribun.index');
    }

}
