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
    public function index()
    {   
        return public_path();
        
        $token = Session::get('token'); 

        $response = Curl::to('128.199.161.172:9099/getlist')
                    ->asJson(true)
                    ->withHeader('Authorization:'.$token)
                    ->get(); 
        $data     = $response['result'];
        // return $data;
        //list data club for dropdown
        $list     = Curl::to('128.199.161.172:8091/all')
                    ->asJson(true)
                    ->get();
        $list_data     = $list['value'];

        $list_club = collect($list_data)->pluck('name','gtcode');
        
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
        $token = Session::get('token'); 

        if ($request->hasFile('gambar')) {
            if($request->file('gambar')->isValid()) {
                try {
                    $file         = $request->file('gambar');
                    $filename     = $file->getClientOriginalName();

                    $image_resize = Image::make($file->getRealPath());  
                    $image_resize->resize(150, 150);
                    $image_resize->save('/home/rahmat/Documents/' .$filename);

                    $resize_image = ('/home/rahmat/Documents/' .$filename); 

                    $image = base64_encode(file_get_contents($resize_image));

                } catch (FileNotFoundException $e) {
                    echo "catch";

                }
            }

        if ($request->hasFile('gambar1')) {
            if($request->file('gambar1')->isValid()) {
                try {
                    $file         = $request->file('gambar1');
                    $filename     = $file->getClientOriginalName();

                    $image_resize = Image::make($file->getRealPath());  
                    $image_resize->resize(150, 150);
                    $image_resize->save(public_path('image/' .$filename));


                    $resize_image = (public_path('image/' .$filename)); 

                    $image1 = base64_encode(file_get_contents($resize_image));

                } catch (FileNotFoundException $e) {
                    echo "catch";

                }
            }


        $response = Curl::to('128.199.161.172:9099/additem')
                    ->withData([
                    "gttop"	=> $request->input('gttopstadion'), 
                    "gtcode"=> $request->input('gtcode'), 
                    "name"	=> $request->input('name'),
                    "name1" => $request->input('name1'),
                    "jam"	=> $request->input('jam'),
                    "date"	=> $request->input('date'),
                    "desc"	=> $request->input('desc'),
                    "image"	=> $image,
                    "image1"=> $image1,
                    "value"	=>  [['gttoptrib' => $request->input('gtcode'),
                                'gtcodetrib'=> $request->input('gtcodetrib'),
                                'tribun'    => $request->input('tribun'),
                                'price'     => $request->input('price')]] 
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
            
            $message = "Kode Item sudah tersedia, Anda tidak bisa menambahkan stadion dengan kode yang sama";
            Alert::message($message)->autoclose(4000);
        }

        return redirect()->route('jadwal.index');
        }
    }
}

    public function update(Request $request)
    {
        $token = Session::get('token');        
        // return $token;
        if ($request->hasFile('gambar')) {
            if($request->file('gambar')->isValid()) {
                try {
                    $file  = $request->file('gambar');
                    $image = base64_encode(file_get_contents($request->file('gambar')->path()));

                } catch (FileNotFoundException $e) {
                    echo "catch";

                }
            }

        if ($request->hasFile('gambar1')) {
            if($request->file('gambar1')->isValid()) {
                try {
                    $file   = $request->file('gambar1');
                    $image1 = base64_encode(file_get_contents($request->file('gambar1')->path()));

                } catch (FileNotFoundException $e) {
                    echo "catch";

                }
            }


            $response = Curl::to('128.199.161.172:9099/edititem/')
                        ->withData([
                        "gttop" => $request->input('gttopstadion'), 
                        "gtcode"=> $request->input('gtcode'), 
                        "name"  => $request->input('name'),
                        "name1" => $request->input('name1'),
                        "jam"   => $request->input('jam'),
                        "date"  => $request->input('date'),
                        "desc"  => $request->input('desc'),
                        "image" => $image,
                        "image1"=> $image1,
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
                
                $message = "Kode Item sudah tersedia, Anda tidak bisa menambahkan stadion dengan kode yang sama";
                Alert::message($message)->autoclose(4000);
            }

            return redirect()->route('jadwal.index');
            }
        }
    }

    public function destroy($id)
    {  
    	$token = Session::get('token'); 

        $response = Curl::to('128.199.161.172:9099/deleteitem/'.$id)       				
                    ->withHeader('Authorization:'.$token)
                    ->delete();

        return redirect()->route('jadwal.index');
    }
}
