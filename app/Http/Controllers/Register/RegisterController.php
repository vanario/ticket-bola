<?php

namespace App\Http\Controllers\Register;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Authentication\LoginController;
use Session;
use Alert;

class RegisterController extends Controller
{
    public function index(Request $request)
    {   
        $token = Session::get('token');

        $response = Curl::to('128.199.161.172:8083/searchpartial/0/10')
        ->withHeader('Authorization:'.$token)
        ->asJson(true)
        ->get();

        return $response;

        $data     = $response['value'];
        $total    = $response['totvalue'];
       
        return view('DataMaster/Mitra.mitra',compact('data','total'));
    }

    public function page(Request $request)
    {
        $token = Session::get('token');

        $id = $request->keys();
        $obj_id = implode($id);
        
        $limit  = 10;

        $offset = $obj_id*10-10;
        $page   = $offset."/".$limit;

        $response = Curl::to('128.199.161.172:8083/partial/'.$page)
        ->withHeader('Authorization:'.$token)
        ->asJson(true)
        ->post();

        $data     = $response['value'];
        $total    = $response['totvalue'];

        return view('DataMaster/Mitra.mitra',compact('data','total'));
    }
      
    public function store(Request $request)
    {
        $token = Session::get('token'); 

        $value = [	'gttop'			=> 'TB', 
        			'gtcode'		=> $request->input('gtcode'),
        			'userid'		=> $request->input('userid'),
        			'username'		=> $request->input('username'),
        			'pass'			=> $request->input('pass'),
        			'telp'			=> $request->input('telp'),
        			'jenis_kelamin'	=> $request->input('jenis_kelamin'),
        			'tgl_lahir'		=> $request->input('tgl_lahir'),
        			'alamat'		=> $request->input('alamat'),
        		];

        $response = Curl::to('128.199.161.172:8083/add')
                    ->asJson(true)
                    ->withData($value)
                    ->post(); 
     

        if ($response['status'] == "OK") {
            
            $message = "Data Berhasil Di update";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
        }

        else {
            
            $message = "Kode User sudah tersedia, Anda tidak bisa menambahkan data dengan kode yang sama";
            Alert::message($message)->autoclose(4000);
        }

        return redirect()->route('club.index');
    }

}
