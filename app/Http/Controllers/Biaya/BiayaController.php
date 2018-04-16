<?php

namespace App\Http\Controllers\Biaya;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Authentication\LoginController;
use Session;
use Alert;

class BiayaController extends Controller
{
    public function index(Request $request)
    {   
        $token = Session::get('token');

        $response = Curl::to('128.199.161.172:8092/partial/0/10')
        ->withHeader('Authorization:'.$token)
        ->asJson(true)
        ->get();

        $data           = $response['value'];
        $total          = $response['totvalue'];
        $val_page       = ($total/10);
        $total_page     = ceil($val_page);
       
        return view('Biaya/biaya',compact('data','total','total_page'));
    }

    public function page(Request $request)
    {
        $token = Session::get('token');

        $id = $request->keys();
        $obj_id = implode($id);
        
        $limit  = 10;

        $offset = $obj_id*10-10;
        $page   = $offset."/".$limit;


        $response = Curl::to('128.199.161.172:8092/partial/'.$page)
        ->withHeader('Authorization:'.$token)
        ->asJson(true)
        ->get();

        // return $currentPage;

        $data           = $response['value'];
        $total          = $response['totvalue'];
        $val_page       = ($total/10);
        $total_page     = ceil($val_page);
        
        return view('Biaya/biaya',compact('data','total','total_page'));
    }

    public function store(Request $request)
    {
        $token = Session::get('token'); 

        $value    = ['gttop'    =>'TB', 
                     'gtcode'   => $request->input('gtcode'), 
                     'custcode' => $request->input('custcode'), 
                     'name'     => $request->input('name'), 
                     'address'  => $request->input('address'), 
                     'email'    => $request->input('address'), 
                     'telp'     => $request->input('telp') ];

        $response = Curl::to('128.199.161.172:8092/add')
                    ->withData([
                    "kind"=> "add#denah",
                    "version"=> "1.0",
                    "value"=> $value ])
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->post();


        if ($response['status'] == "OK") {
            
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

        return redirect()->route('biaya.index');
    }

    public function update(Request $request)
    {
        $token = Session::get('token'); 

        $value    = ['gttop'    =>'TB', 
                     'gtcode'   => $request->input('gtcode'), 
                     'custcode' => $request->input('custcode'), 
                     'name'     => $request->input('name'), 
                     'address'  => $request->input('address'), 
                     'email'    => $request->input('address'), 
                     'telp'     => $request->input('telp') ];

        $response = Curl::to('128.199.161.172:8092/edit')
                    ->withData([
                    "kind"=> "add#denah",
                    "version"=> "1.0",
                    "value"=> $value ])
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


        return redirect()->route('biaya.index');
    }

    public function destroy($id)
    {  
        $token = Session::get('token');

        $response = Curl::to('128.199.161.172:8092/delete/'.$id)                    
                    ->withHeader('Authorization:'.$token)
                    ->delete();

        return redirect()->route('biaya.index');
    }
}
