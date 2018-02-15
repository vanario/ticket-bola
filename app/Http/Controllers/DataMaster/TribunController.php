<?php

namespace App\Http\Controllers\DataMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Alert;

class TribunController extends Controller
{
    public function index()
    {
        $response = Curl::to('128.199.161.172:8102/add')
                    ->asJson(true)
                    ->get(); 

        $data     = $response['result'];


        return view('DataMaster/Tribun.tribun',compact('data'));
    }

    public function store(Request $request)
    {
        $gttop 		= $request->input('gttop');
        $gtcode 	= $request->input('gtcode');
        $tribun 	= $request->input('tribun');
        $kapasitas 	= $request->input('kapasitas');
        $descriction= $request->input('descriction');

        $response = Curl::to('128.199.161.172:8103/addstadion')
                    ->withData(['gttop'=>'TB', 'gtcode'=>$gtcode, 'name'=>$name])
                    ->asJson(true)
                    ->post(); 

        if ($response['result'] == "OK") {
            
            $message = "Data Berhasil Ditambahkan";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
        }

        else {
            
            $message = "Kode stadion sudah tersedia, Anda tidak bisa menambahkan stadion dengan kode yang sama";
            Alert::message($message)->autoclose(4000);
        }

        return redirect()->route('tribun.index');
    }

    public function update(Request $request)
    {
        $gttop 		= $request->input('gttop');
        $gtcode 	= $request->input('gtcode');
        $tribun 	= $request->input('tribun');
        $kapasitas 	= $request->input('kapasitas');
        $descriction= $request->input('descriction');

        $response = Curl::to('128.199.161.172:8103/editstadion/')
                    ->withData(['gttop'=>'TB', 'gtcode'=>$gtcode, 'name'=>$name])
                    ->asJson(true)
                    ->put();
                     
        if ($response['result'] == "UPDATED!") {
            
            $message = "Data Berhasil Ditambahkan";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
        }

        else {
            
            $message = "Kode stadion sudah tersedia, Anda tidak bisa menambahkan stadion dengan kode yang sama";
            Alert::message($message)->autoclose(4000);
        }


        return redirect()->route('tribun.index');
    }

    public function destroy($id)
    { 
        $response = Curl::to('128.199.161.172:8103/deletestadion/'.$id)
                    ->delete();

        return redirect()->route('tribun.index');
    }
}
