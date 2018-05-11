<?php

namespace App\Http\Controllers\Register;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Pagination\LengthAwarePaginator;
use Session;
use Alert;

class RegisterController extends Controller
{
    public function index(Request $request)
    {   
       $token = Session::get('token');
       $club  = Session::get('clubcode');

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

        $data     = $response['value'];
        $total    = $response['totvalue'];
        $val_page       = ($total/10);
        $total_page     = ceil($val_page);

        return view('Register.register',compact('data', 'total','total_page'));

    }

    public function page(Request $request)
    {
        $token = Session::get('token');

        $id = $request->keys();
        $obj_id = implode($id);
        
        $limit  = 10;

        $offset = $obj_id*10-10;
        $page   = $offset."/".$limit;

         $response = Curl::to('128.199.161.172:8083/searchpartial')
        ->withHeader('Authorization:'.$token)
        ->withData([
                    "kind"      => "",
                    "version"   => "",
                    "value"     => [ 'offset'    => $offset, 
                                     'limit'     => 10, 
                                ]
                     ])
        ->asJson(true)
        ->post();

        $data        = $response['value'];
        $total       = $response['totvalue'];
        $val_page    = ($total/10);
        $total_page  = ceil($val_page);

        return view('Register/register',compact('data','total','total_page'));
    }
      
    public function approve(Request $request)
    {
        $token = Session::get('token');
        
        $id = $request->keys();

        if ($id !=null){
            $gtcode = implode($id);
            $response = Curl::to('128.199.161.172:8083/approval')                    
                        ->withHeader('Authorization:'.$token)
                        ->withData([ "gtcode" => $gtcode,
                                     "status" => 'Aktif',
                                    ])
                        ->asJson(true)
                        ->put();
            if ($response['status'] == "Aktif") {
            
            $message = "Data Berhasil Di update";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
            }
        }
        else
        {
            $message = "Kode user tidak tersedia, data gagal diupdate ";
            Alert::message($message)->autoclose(4000);
        }


        return redirect()->route('register.index');
    }
}
