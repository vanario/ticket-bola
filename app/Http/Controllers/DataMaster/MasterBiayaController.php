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
        $token    = Session::get('token');
        $profile  = Session::get('profile');

        $clubcode = $profile['clubcode'];

        $value    = [
                     'gttop'    => $clubcode, 
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

        if ($response['responcode'] == "201") {
            
            $message = "Data Berhasil Ditambahkan";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
            return redirect()->back();
        }
        else {
            $message = "Gagal Tambah Data";
            Alert::message($message)->autoclose(4000);
            return redirect()->back();
        }

        return redirect()->route('masterbiaya.index');
    }

    public function update(Request $request)
    {
        $token = Session::get('token'); 

        $value    = [
                     'gtcode'   => $request->input('gtcode'), 
                     'akunname' => $request->input('akunname'), 
                     'akuntype' => $request->input('akuntype')
                    ];

        $response = Curl::to('128.199.161.172:8112/akun-biaya/edit')
                    ->withData([
                    "kind"      =>"edit#akunbiaya",
                    "version"   => "1.0",
                    "values"    => $value ])
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->put();

       if ($response['responcode'] == "200") {
            
            $message = "Data Berhasil update";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
            return redirect()->back();
        }
        else {
            $message = "Gagal Tambah Data";
            Alert::message($message)->autoclose(4000);
            return redirect()->back();
        }


        return redirect()->route('masterbiaya.index');
    }

    public function destroy($id)
    {  
        $token = Session::get('token');

        $response = Curl::to('128.199.161.172:8112/akun-biaya/del/'.$id)                    
                    ->withHeader('Authorization:'.$token)
                    ->delete();

        return redirect()->back();
    }
}
