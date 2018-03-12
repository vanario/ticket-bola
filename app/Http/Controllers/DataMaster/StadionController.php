<?php

namespace App\Http\Controllers\DataMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Pagination\LengthAwarePaginator;
use Alert;
use Session;

class StadionController extends Controller
{
    public function index()
    {   
        $token = Session::get('token'); 

        $response = Curl::to('128.199.161.172:8103/getliststadion/TB')
                    ->asJson(true)
                    ->get(); 

        $data     = $response['result'];


        //make pagination

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $col = collect($data);
        $perPage = 5;
        $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $data = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage, $currentPage,['path' => LengthAwarePaginator::resolveCurrentPath()] );    
        
        return view('DataMaster/Stadion.stadion',compact('data','response'));
    }

    public function store(Request $request)
    {
        $gtcode = $request->input('gtcode');
        $name = $request->input('name');
        $token = Session::get('token'); 


        $response = Curl::to('128.199.161.172:8103/addstadion')
                    ->withData(['gttop'=>'TB', 'gtcode'=>$gtcode, 'name'=>$name])
                    // ->withHeader('Authorization', $token)
                    ->asJson(true)
                    ->post(); 

        // return $response;

        if ($response['result'] == "OK") {
            
            $message = "Data Berhasil Ditambahkan";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
        }

        else {
            
            $message = "Kode stadion sudah tersedia, Anda tidak bisa menambahkan stadion dengan kode yang sama";
            Alert::message($message)->autoclose(4000);
        }

        return redirect()->route('stadion.index');
    }

    public function update(Request $request)
    {
        $token = Session::get('token'); 
        $gtcode = $request->input('gtcode');
        $name   = $request->input('name');

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


        return redirect()->route('stadion.index');
    }

    public function destroy($id)
    {   
        $token = Session::get('token'); 
        $response = Curl::to('128.199.161.172:8103/deletestadion/'.$id)
                    ->delete();

        return redirect()->route('stadion.index');
    }
}
