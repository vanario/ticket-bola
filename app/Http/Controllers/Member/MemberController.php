<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Pagination\LengthAwarePaginator;
use Session;
use Alert;

class MemberController extends Controller
{
    public function index()
    {   
       $token = Session::get('token');

        $response = Curl::to('128.199.161.172:8083/searchpartial')
        ->withHeader('Authorization:'.$token)
        ->withData([
                    "kind"      => "",
                    "version"   => "",
                    "value"     => [ 'offset'    => 0, 
                                     'limit'     => 10, 
                                ]
                     ])
        ->asJson(true)
        ->post();

         //list data club for dropdown
        $list     = Curl::to('128.199.161.172:8091/getbygttop/TB')
                    ->asJson(true)
                    ->get();
        $list_data  = $list['value'];

        $list_club = collect($list_data)->pluck('name','gtcode');

        $data     = $response['value'];
        $total    = $response['totvalue'];
        $val_page       = ($total/10);
        $total_page     = ceil($val_page);

        // return $data;

        return view('Member.member',compact('data','list_club', 'total_page'));
    }

    public function page(Request $request)
    {
        $token = Session::get('token');

        $id = $request->keys();
        $obj_id = implode($id);
        
        $limit  = 10;

        $offset = $obj_id*10-10;
        // $page   = $offset."/".$limit;

        $response = Curl::to('128.199.161.172:8083/searchpartial')
        ->withHeader('Authorization:'.$token)
        ->withData([
                    "kind"      => "",
                    "version"   => "",
                    "value"     => [ 'offset'    => $offset, 
                                     'limit'     => $limit, 
                                ]
                     ])
        ->asJson(true)
        ->post();

        $data     = $response['value'];
        $total    = $response['totvalue'];
        $val_page       = ($total/10);
        $total_page     = ceil($val_page);

        return view('Member.member',compact('data','total_page'));
    }
      
    public function store(Request $request)
    {
        $token = Session::get('token'); 

        $value = [  'gttop'         => 'TB', 
                    'gtcode'        => $request->input('gtcode'),
                    'userid'        => $request->input('userid'),
                    'username'      => $request->input('username'),
                    'pass'          => $request->input('pass'),
                    'telp'          => $request->input('telp'),
                    'jenis_kelamin' => $request->input('jenis_kelamin'),
                    'tgl_lahir'     => $request->input('tgl_lahir'),
                    'alamat'        => $request->input('alamat'),
                    'idcard'        => $request->input('idcard'),
                    'typeuser'      => $request->input('typeuser'),
                    'status'        => $request->input('status'),
                    'clubcode'      => $request->input('clubcode'), 

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

        return redirect()->route('member.index');
    }

    public function update(Request $request)
    {
        $token = Session::get('token'); 

        $value = [  'gttop'         => 'TB', 
                    'gtcode'        => $request->input('gtcode'),
                    'userid'        => $request->input('userid'),
                    'username'      => $request->input('username'),
                    'pass'          => $request->input('pass'),
                    'telp'          => $request->input('telp'),
                    'jenis_kelamin' => $request->input('jenis_kelamin'),
                    'tgl_lahir'     => $request->input('tgl_lahir1'),
                    'alamat'        => $request->input('alamat'),
                    'idcard'        => $request->input('idcard'),
                    'status'        => $request->input('status'),
                    'clubcode'      => $request->input('clubcode'),
                    'typeuser'      => $request->input('typeuser'), 
                ];

        $response = Curl::to('128.199.161.172:8083/edit')
                    ->asJson(true)
                    ->withData($value)
                    ->put(); 
        return $response;
        if ($response['status'] == "OK") {
            
            $message = "Data Berhasil Di update";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
        }

        else {
            
            $message = "Kode User sudah tersedia, Anda tidak bisa menambahkan data dengan kode yang sama";
            Alert::message($message)->autoclose(4000);
        }

        return redirect()->route('member.index');
    }

}
