<?php

namespace App\Http\Controllers\DataMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Pagination\LengthAwarePaginator;
use Alert;

class MitraController extends Controller
{
    public function index()
    {   
        $response = Curl::to('128.199.161.172:8103/getliststadion/TB')
                    ->asJson(true)
                    ->get(); 

        $data     = $response['result'];


        //make pagination
        $result = collect($data);

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentResults = $result->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $results = new LengthAwarePaginator($currentResults, $result->count(), $perPage);
        

        
        return view('DataMaster/Stadion.stadion',compact('data','response'));
    }

    public function store(Request $request)
    {
        $gtcode = $request->input('gtcode');
        $name = $request->input('name');
		$token    ='eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE1MTkxNzgxNjEsImlhdCI6MTUxOTA5MTc2MX0.Mlwgwhfsw-rgmi9KVe0YwvkP4ChZMbSb3h25zj8SnuI';

        $response = Curl::to('128.199.161.172:8099/add')
                    ->withData(['gttop'=>'TB', 'gtcode'=>$gtcode, 'name'=>$name])
                    ->withHeader('Authorization', $token)
                    ->asJson(true)
                    ->post(); 

        return $response;

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
        $response = Curl::to('128.199.161.172:8103/deletestadion/'.$id)
                    ->delete();

        return redirect()->route('stadion.index');
    }
}
