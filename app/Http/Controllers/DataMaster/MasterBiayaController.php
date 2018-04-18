<?php

namespace App\Http\Controllers\DataMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Authentication\LoginController;
use Session;
use Alert;

class MasterBiayaController extends Controller
{
    public function index(Request $request)
    {   
        $token = Session::get('token');

        $response = Curl::to('128.199.161.172:8112/akun-biaya/bypartial/01/0/10')
        ->withHeader('Authorization:'.$token)
        ->asJson(true)
        ->get();

        $data           = $response['values'];
        $total          = $response['totalvalue'];
        $total_page     = $response['totalpage'];
       
        return view('DataMaster/MasterBiaya.masterbiaya',compact('data','total','total_page'));
    }

    public function page(Request $request)
    {
        $token = Session::get('token');

        $id = $request->keys();
        $obj_id = implode($id);
        
        $limit  = 10;

        $offset = $obj_id*10-10;
        $page   = $offset."/".$limit;


        $response = Curl::to('128.199.161.172:8112/akun-biaya/bypartial/01/'.$page)
        ->withHeader('Authorization:'.$token)
        ->asJson(true)
        ->get();

        // return $currentPage;

        $data           = $response['values'];
        $total          = $response['totalvalue'];
        $total_page     = $response['totalpage'];
        
        return view('DataMaster/MasterBiaya.masterbiaya',compact('data','total','total_page'));
    }

    public function store(Request $request)
    {
        $token = Session::get('token'); 

        $value    = [
                     'gttop'    =>'01', 
                     'akunname' => $request->input('akunname'), 
                     'akuntype' => $request->input('akuntype')
                    ];

        $response = Curl::to('128.199.161.172:8112/akun-biaya/add')
                    ->withData([
                    "kind"      =>"add#akunbiaya",
                    "version"   =>"1.0", 
                    "values"    => $value ])
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->post();
                    
        if ($response['responsestatus'] == "Akun Created") {
            
            $message = "Data Berhasil Ditambahkan";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
            return redirect()->back();
        }

        else {
            
            $message = "Kode sudah tersedia, Anda tidak bisa menambahkan data dengan kode yang sama";
            Alert::message($message)->autoclose(4000);
            return redirect()->back();
        }

        return redirect()->route('masterbiaya.index');
    }

    public function update(Request $request)
    {
        $token = Session::get('token'); 

        $value    = [
                     'gttop'    =>'TB', 
                     'akunname' => $request->input('akunname'), 
                     'akuntype' => $request->input('akuntype')
                    ];

        $response = Curl::to('128.199.161.172:8092/edit')
                    ->withData([
                    "kind"      =>"edit#akunbiaya",
                    "version"   => "1.0",
                    "values"    => $value ])
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->put();


        if ($response['status'] == "OK") {
            
            $message = "Data Berhasil Di Update";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
            return redirect()->back();
        }

        else {
            
            $message = "Kode sudah tersedia, Anda tidak bisa menambahkan data dengan kode yang sama";
            Alert::message($message)->autoclose(4000);
            return redirect()->back();
        }


        return redirect()->route('masterbiaya.index');
    }

    public function destroy($id)
    {  
        $token = Session::get('token');

        $response = Curl::to('128.199.161.172:8112/akun-biaya/del')                    
                    ->withHeader('Authorization:'.$token)
                    ->withData  ([
                                    "kind"      =>"deleled#akunbiaya",
                                    "version"   => "1.0",
                                    "values"    => [    "gtcode" => $id ]
                                ])
                    ->delete();

        return $response;

        return redirect()->route('masterbiaya.index');
    }
}
