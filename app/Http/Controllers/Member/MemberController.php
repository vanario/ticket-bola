<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\pagination\LengthAwarePaginator;

class MemberController extends Controller
{
    public function index()
    {   
        $token = Session::get('token'); 

        $response = Curl::to('128.199.161.172:8106/all')
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

        return view('Member.member',['data' => $data,]);
    }

    public function store(Request $request)
    {
        $token = Session::get('token'); 

        $value = [	'gttop'			=>'TB', 
        			'gtcode'		=> $request->input('gtcode'), 
        			'idmember' 		=> $request->input('idmember'),
        			'name' 			=> $request->input('name'),
        			'tipemember'	=> $request->input('tipemember'),
        			'periodemember'	=> [
        								'start'		=> $request->input('start'),
        								'end'		=> $request->input('end')
        								],
        			'status'		=> $request->input('status'),
        		 ]

        $response = Curl::to('128.199.161.172:8106/add')
                    ->withData(["value"=> $value])
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->post();      

        if ($response['status'] == "OK") {
            
            $message = "Data Berhasil Ditambahkan";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
        }

        else {
            
            $message = "Kode member sudah tersedia, Anda tidak bisa menambahkan data dengan kode yang sama";
            Alert::message($message)->autoclose(4000);
        }

        return redirect()->route('member.index');
    }

    public function update(Request $request)
    {
        $token = Session::get('token'); 

       $value = [	'gttop'			=>'TB', 
        			'gtcode'		=> $request->input('gtcode'), 
        			'idmember' 		=> $request->input('idmember'),
        			'name' 			=> $request->input('name'),
        			'tipemember'	=> $request->input('tipemember'),
        			'periodemember'	=> [
        								'start'		=> $request->input('start'),
        								'end'		=> $request->input('end')
        								],
        			'status'		=> $request->input('status'),
        		 ]

        $response = Curl::to('128.199.161.172:8106/edit')
                    ->withData(["value"=> $value])
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->post();
                     
        if ($response['status'] == "OK") {
            
            $message = "Data Berhasil Di Update";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
        }

        else {
            
            $message = "Kode member sudah tersedia, Anda tidak bisa menambahkan data dengan kode yang sama";
            Alert::message($message)->autoclose(4000);
        }


        return redirect()->route('club.index');
    }

    public function destroy($id)
    {  
    	$token = Session::get('token'); 

        $response = Curl::to('128.199.161.172:8106/delete/'.$id)       				
                    ->withHeader('Authorization:'.$token)
                    ->delete();

        return redirect()->route('club.index');
    }
}
