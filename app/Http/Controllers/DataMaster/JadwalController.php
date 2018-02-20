<?php

namespace App\Http\Controllers\DataMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Pagination\LengthAwarePaginator;
use Alert;


class JadwalController extends Controller
{
	public function index()
    {   
    	$token    ='eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE1MTkxNzgxNjEsImlhdCI6MTUxOTA5MTc2MX0.Mlwgwhfsw-rgmi9KVe0YwvkP4ChZMbSb3h25zj8SnuI';

    	$response = Curl::to('128.199.161.172:9099/getlist')
                    ->asJson(true)
                    ->withHeader('Authorization:'.$token)
                    ->get(); 
        $data 	  = $response['result'];

        
        //list data club for dropdown
        $list	  = Curl::to('128.199.161.172:8091/all')
                    ->asJson(true)
                    ->get();

        $list_data     = $response['result'];

        $list_club = collect($response)->pluck('name','gtcode');
		
		//pagination        
		$currentPage = LengthAwarePaginator::resolveCurrentPage();
		$col = collect($data);
		$perPage = 5;
		$currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
		// $data = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);
		$data = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage, $currentPage,['path' => LengthAwarePaginator::resolveCurrentPath()] );

        // return $data;

        return view('DataMaster/Jadwal.jadwal',['data' => $data, 'list_club'=>$list_club]);
    }

    public function store(Request $request)
    {
        $gtcode = $request->input('gtcode');
        $name = $request->input('name');
        $token    ='eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE1MTkxNzgxNjEsImlhdCI6MTUxOTA5MTc2MX0.Mlwgwhfsw-rgmi9KVe0YwvkP4ChZMbSb3h25zj8SnuI';

        $value = [	'gttoptrib'	=> $request->input('gttoptrib'), 
        			'gtcodetrib'=> $request->input('gtcodetrib'), 
        			'tribun' 	=> $request->input('tribun'), 
        			'price'		=> $request->input('price')];

        $response = Curl::to('128.199.161.172:9099/additem')
                    ->withData([
                    "gttop"	=> $request->input('gttop'), 
                    "gtcode"=> $request->input('gtcode'), 
                    "name"	=> $request->input('name'),
                    "name1" => $request->input('name1'),
                    "jam"	=> $request->input('jam'),
                    "date"	=> $request->input('date'),
                    "desc"	=> $request->input('desc'),
                    "image"	=> $request->input('image'),
                    "image1"=> $request->input('image1'),
                    "value"	=> $value ])
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->post();      

        if ($response['status'] == "OK") {
            
            $message = "Data Berhasil Ditambahkan";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
        }

        else {
            
            $message = "Kode stadion sudah tersedia, Anda tidak bisa menambahkan stadion dengan kode yang sama";
            Alert::message($message)->autoclose(4000);
        }

        return redirect()->route('club.index');
    }

    public function update(Request $request)
    {
        $gtcode = $request->input('gtcode');
        $name   = $request->input('name');

        $token    ='eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE1MTkxNzgxNjEsImlhdCI6MTUxOTA5MTc2MX0.Mlwgwhfsw-rgmi9KVe0YwvkP4ChZMbSb3h25zj8SnuI';

        $value = ['gttop'=>'TB', 'gtcode'=>$gtcode, 'name' => $name];

        $response = Curl::to('128.199.161.172:8091/edit')
                    ->withData([
                    "kind"=> "edit#groupping",
                    "version"=> "1.0",
                    "value"=> $value ])
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->put();
                     
        if ($response['status'] == "OK") {
            
            $message = "Data Berhasil Di Update";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
        }

        else {
            
            $message = "Kode stadion sudah tersedia, Anda tidak bisa menambahkan stadion dengan kode yang sama";
            Alert::message($message)->autoclose(4000);
        }


        return redirect()->route('club.index');
    }

    public function destroy($id)
    {  
    	$token    ='eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE1MTkxNzgxNjEsImlhdCI6MTUxOTA5MTc2MX0.Mlwgwhfsw-rgmi9KVe0YwvkP4ChZMbSb3h25zj8SnuI';

        $response = Curl::to('128.199.161.172:8091/delete/'.$id)       				
                    ->withHeader('Authorization:'.$token)
                    ->delete();

        return redirect()->route('club.index');
    }
}
