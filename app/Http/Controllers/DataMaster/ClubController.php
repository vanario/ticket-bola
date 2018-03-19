<?php

namespace App\Http\Controllers\DataMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Authentication\LoginController;
use Intervention\Image\ImageManagerStatic as Image;
use Session;
use Alert;

class ClubController extends Controller
{
    public function index()
    {   
        $token = Session::get('token'); 

        $response = Curl::to('128.199.161.172:8091/getbygttop/TB')
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

        return view('DataMaster/Club.club',['data' => $data,]);
    }

    public function store(Request $request)
    {
        $gtcode = $request->input('gtcode');
        $name = $request->input('name');

                
        $token = Session::get('token');

        if ($request->hasFile('gambar')) {
            if($request->file('gambar')->isValid()) {
                try {
                    $file         = $request->file('gambar');
                    $filename     = $file->getClientOriginalName();
                    $image_resize = Image::make($file->getRealPath());  
                    $image_resize->resize(150, 150);                                     
                    $image_resize->save(public_path('image/' .$filename));
                    $resize_image = (public_path('image/' .$filename)); 
                    $imglg = base64_encode(file_get_contents($resize_image));
                } catch (FileNotFoundException $e) {
                    echo "catch";
                }
            }
        }
        if ($request->hasFile('gambar1')) {
            if($request->file('gambar1')->isValid()) {
                try {
                    $file         = $request->file('gambar1');
                    $filename     = $file->getClientOriginalName();
                    $image_resize = Image::make($file->getRealPath());  
                    $image_resize->resize(300, 200);
                    $image_resize->save(public_path('image/' .$filename));
                    $resize_image = (public_path('image/' .$filename)); 
                    $imgbg1 = base64_encode(file_get_contents($resize_image));
                } catch (FileNotFoundException $e) {
                    echo "catch";
                }
            } 
        }
        
        $response = Curl::to('128.199.161.172:8091/groupadd')
                    ->withData(['gttop' =>'TB', 
                                'gtcode'=> $request->input('gtcode'), 
                                'name'  => $request->input('name'),
                                'imglg' => $imglg,
                                'imgbg1'=> $imgbg1,
                                'imgbg2'=> '-',
                                'img4'  => '-',])
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->post();

        if ($response['status'] == "OK") {
            
            $message = "Data Berhasil Ditambahkan";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
        }

        else {
            
            $message = "Kode club sudah tersedia, Anda tidak bisa menambahkan data dengan kode yang sama";
            Alert::message($message)->autoclose(4000);
        }

        return redirect()->route('club.index');
    }

    public function update(Request $request)
    {
        $gtcode = $request->input('gtcode');
        $name   = $request->input('name');

        return $request->file('gambar2');
        
        $token = Session::get('token'); 

        if ($request->hasFile('gambar')) {
            if($request->file('gambar')->isValid()) {
                try {
                    $file         = $request->file('gambar');
                    $filename     = $file->getClientOriginalName();
                    $image_resize = Image::make($file->getRealPath());  
                    $image_resize->resize(150, 150);
                    $image_resize->save(public_path('image/' .$filename));
                    $resize_image = (public_path('image/' .$filename));

                    $imglg = base64_encode(file_get_contents($resize_image));
                } catch (FileNotFoundException $e) {
                    echo "catch";
                }
            }
        }
        else{
            $imglg = $request->input('gambar_');
        }
        
        if ($request->hasFile('gambar1')) {
            if($request->file('gambar1')->isValid()) {
                try {
                    $file         = $request->file('gambar1');
                    $filename     = $file->getClientOriginalName();
                    $image_resize = Image::make($file->getRealPath());  
                    $image_resize->resize(300, 200);
                    $image_resize->save(public_path('image/' .$filename));
                    $resize_image = (public_path('image/' .$filename)); 
                    $imgbg1 = base64_encode(file_get_contents($resize_image));
                } catch (FileNotFoundException $e) {
                    echo "catch";
                }
            } 
        }
        else{
            $imgbg1 = $request->input('gambar1_');
        }

        $response = Curl::to('128.199.161.172:8091/edit')
                    ->withData(['gttop' =>'TB', 
                                'gtcode'=> $request->input('gtcode'), 
                                'name'  => $request->input('name'),
                                'imglg' => $imglg,
                                'imgbg1'=> $imgbg1,
                                'imgbg2'=> '-',
                                'img4'  => '-',
                            ])
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->put();
                     
        return redirect()->route('club.index');
    }

    public function destroy($id)
    {     	
        $token = Session::get('token'); 
       
        $response = Curl::to('128.199.161.172:8091/delete/'.$id)       				
                    ->withHeader('Authorization:'.$token)
                    ->delete();

        return redirect()->route('club.index');
    }
}
