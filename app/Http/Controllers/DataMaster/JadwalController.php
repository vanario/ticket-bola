<?php

namespace App\Http\Controllers\DataMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Authentication\LoginController;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Pagination\LengthAwarePaginator;
use Intervention\Image\ImageManagerStatic as Image;
use Alert;
use Session;
use Storage;


class JadwalController extends Controller
{   
    public function index(Request $request)
    {   
        $token = Session::get('token'); 

        $response = Curl::to('128.199.161.172:9099/getlist')
                    ->asJson(true)
                    ->withHeader('Authorization:'.$token)
                    ->get(); 

        $data     = $response['result'];

        $data_tribun = ""; 

        $token = Session::get('token');
                
        $id = $request->keys();

        if ($id !=null){
            $gtcode = implode($id);
            $response = Curl::to('128.199.161.172:9099/getcodeitem/'.$gtcode)
                        ->withHeader('Authorization:'.$token)                        
                        ->asJson(true)
                        ->get();

            $data_tribun= $response['value']['value'];
            if ($response['value'] == "OK") {
            
            $message = "Data Berhasil Di update";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
            }
        }
        //list data club for dropdown

        $list       = Curl::to('128.199.161.172:8091/getbygttop/TB')
                    ->asJson(true)
                    ->get();
                    
        $list_data  = $list['value'];


        $list_club  = collect($list_data)->pluck('name','gtcode');
        
        //pagination        
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $col = collect($data);
        $perPage = 5;
        $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $data = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage, $currentPage,['path' => LengthAwarePaginator::resolveCurrentPath()] );

        return view('DataMaster/Jadwal.jadwal', compact('data', 'list_club', 'value','listtribun','id'));
    }

    public function store(Request $request)
    {
        $token = Session::get('token'); 

        $response = Curl::to('128.199.161.172:9099/additem')
                    ->withData([
                    "gttop"	    => $request->input('gttopstadion'), 
                    "gtcode"    => $request->input('gtcode'), 
                    "name"	    => $request->input('name'),
                    "name1"     => $request->input('name1'),
                    "jam"   	=> $request->input('jam'),
                    "date"	    => $request->input('date'),
                    "desc"      => $request->input('desc'),
                    "subdesc"   => $request->input('subdesc'),
                    "image"     => "-",
                    "image1"    => "-",
                    "value"     =>  [[  'gttoptrib' => $request->input('gtcode'),
                                        'gtcodetrib'=> $request->input('gtcodetrib'),
                                        'tribun'    => $request->input('tribun'),
                                        'price'     => $request->input('price')
                                    ]] 
                                ])
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->post();

        if ($response['result'] == "OK") {
            
            $message = "Data Berhasil Ditambahkan";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
        }

        else {
            
            $message = "Kode Item sudah tersedia, Anda tidak bisa menambahkan data dengan kode yang sama";
            Alert::message($message)->autoclose(4000);
        }

        return redirect()->route('jadwal.index');
        }

    public function update(Request $request)
    {
        $token = Session::get('token');        
        // return $token;
        
            $response = Curl::to('128.199.161.172:9099/edititem/')
                        ->withData([
                        "gttop" => $request->input('gttopstadion'), 
                        "gtcode"=> $request->input('gtcode'), 
                        "name"  => $request->input('name'),
                        "name1" => $request->input('name1'),
                        "jam1"  => $request->input('jam'),
                        "date1" => $request->input('date'),
                        "desc"  => $request->input('desc'),
                        "subdesc"	=> $request->input('subdesc'),
                        "image" => "-",
                        "image1"=> "-",
                        "value" =>  [['gttoptrib' => $request->input('gtcode'),
                                    'gtcodetrib'=> $request->input('gtcodetrib'),
                                    'tribun'    => $request->input('tribun'),
                                    'price'     => $request->input('price')]] 
                                    ])
                        ->withHeader('Authorization:'.$token)
                        ->asJson(true)
                        ->post();


            if ($response['result'] == "UPDATED!") {
                
                $message = "Data Berhasil Ditambahkan";
                alert()->success('');
                Alert::success($message,'Sukses')->autoclose(4000);
            }

            else {
                
                $message = "Kode Item sudah tersedia, Anda tidak bisa menambahkan data dengan kode yang sama";
                Alert::message($message)->autoclose(4000);
            }

            return redirect()->route('jadwal.index');
            }
        

    public function destroy($id)
    {  
    	$token = Session::get('token'); 

        $response = Curl::to('128.199.161.172:9099/deleteitem/'.$id)       				
                    ->withHeader('Authorization:'.$token)
                    ->delete();

        return redirect()->route('jadwal.index');
    }

    public function listtribun(Request $request)
    {
        $token = Session::get('token');
                
        $id = $request->keys();

        if ($id !=null){
            $gtcode = implode($id);
            $response = Curl::to('128.199.161.172:9099/getcodeitem/'.$gtcode)
                        ->withHeader('Authorization:'.$token)                        
                        ->asJson(true)
                        ->get();

            $data_tribun= $response['value']['value'];
            if ($response['value'] == "OK") {
            
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


        return view('DataMaster/Jadwal.jadwal', compact('$data_tribun'));
    }

    public function storetrib(Request $request)
    {
        $token  = Session::get('token'); 
        $tribun = $request->input('tribun');

        if ($tribun == "vip") {
            $color = "#f44941";
        }
        elseif ($tribun == "tribun utara" || "tribun selatan")  {
            $color = "#4286f4";
        }
        elseif ($tribun == "tribun timur") {
            $color = '#f4e541';
        }
        elseif ($tribun == "vip 1" || "vip 2") {
            $color = '#41f459';
        }

        $response = Curl::to('128.199.161.172:9099/addtribun')
                    ->withData([
                    "gtcode" => $request->input('gtcode'), 
                    "tribun" =>[[   'gttoptrib' => $request->input('gtcode'),
                                    'gtcodetrib'=> $request->input('gtcodetrib'),
                                    'tribun'    => $request->input('tribun'),
                                    'price'     => $request->input('price'),
                                    'color'     => $color,
                                    'qty'       => $request->input('qty')]] 
                                ])
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->post();
        if ($response['result'] == "Added!") {
            
            $message = "Data Berhasil Ditambahkan";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
        }

        else {
            
            $message = "Kode Item sudah tersedia, Anda tidak bisa menambahkan data dengan kode yang sama";
            Alert::message($message)->autoclose(4000);
        }

        return redirect()->route('jadwal.index');
    }

    public function updatetrib(Request $request)
    {
        $token = Session::get('token'); 

        $tribun = $request->input('tribun');

        if ($tribun== "vip") {
            $color = "#f44941";
        }

        elseif ($tribun == "tribun utara" || "tribun selatan")  {
            $color = "#4286f4";
        }


        elseif ($tribun == "tribun timur") {
            $color = '#f4e541';
        }

        elseif ($tribun == "vip 1" || "vip 2") {
            $color = '#41f459';
        }


        $response = Curl::to('128.199.161.172:9099/updatetribun')
                    ->withData(['gttoptrib' => $request->input('gtcode'),
                                'gtcodetrib'=> $request->input('gtcodetrib'),
                                'tribun'    => $request->input('tribun'),
                                'color'     => $color,
                                'price'     => $request->input('price'), 
                                'qty'       => $request->input('qty') 
                                ])
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->put();

        if ($response['result'] == "Added!") {
            
            $message = "Data Berhasil Ditambahkan";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
        }

        else {
            
            $message = "Kode Item sudah tersedia, Anda tidak bisa menambahkan data dengan kode yang sama";
            Alert::message($message)->autoclose(4000);
        }

        return redirect()->route('jadwal.index');
    }

    public function destroytrib($gttoptrib,$gtcodetrib)
    {  
        $token  = Session::get('token'); 
        $response = Curl::to('128.199.161.172:9099/deltribun/'.$gttoptrib.'/'.$gtcodetrib)
                    ->withHeader('Authorization:'.$token)
                    ->delete();

        return redirect()->route('jadwal.index');
    }    
}