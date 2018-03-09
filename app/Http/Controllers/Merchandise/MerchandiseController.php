<?php

namespace App\Http\Controllers\Merchandise;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Alert;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Pagination\LengthAwarePaginator;

class MerchandiseController extends Controller
{
    public function index()
    {   
        $token = Session::get('token'); 

        $response = Curl::to('128.199.161.172:8107/10')
                    ->asJson(true)
                    ->withHeader('Authorization:'.$token)
                    ->get(); 

        $data     = $response['value'];
        return dd($response);
        //pagination        
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $col = collect($data);
        $perPage = 5;
        $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $data = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage, $currentPage,['path' => LengthAwarePaginator::resolveCurrentPath()] );

        return view('Merchandise/merchandise', compact('data', 'list_club', 'value'));
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
                    $image_resize->save('/var/www/image/' .$filename);
                    $resize_image = ('/var/www/image/' .$filename); 
                    
                    // $image_resize->save(public_path('image/' .$filename));
                    // $resize_image = (public_path('image/' .$filename)); 
                    $image = base64_encode(file_get_contents($resize_image));
                } catch (FileNotFoundException $e) {
                    echo "catch";
                }
            }
        }

        $response = Curl::to('128.199.161.172:8107/addmerch')
                    ->withData([
                    "gttop"	=> 'TB', 
                    "gtcode"=> $request->input('gtcode'), 
                    "title"	=> $request->input('title'),
                    "img" 	=> $image,
                    "desc"	=> $request->input('desc'),
                    "price"	=> $request->input('price'),
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

        return redirect()->route('merchandise.index');
        }

    public function update(Request $request)
    {
        $token = Session::get('token');        
        // return $token;

        if ($request->hasFile('gambar')) {
            if($request->file('gambar')->isValid()) {
                try {
                    $file         = $request->file('gambar');
                    $filename     = $file->getClientOriginalName();
                    $image_resize = Image::make($file->getRealPath());  
                    $image_resize->resize(150, 150);
                    $image_resize->save('/var/www/image/' .$filename);
                    $resize_image = ('/var/www/image/' .$filename); 
                    
                    // $image_resize->save(public_path('image/' .$filename));
                    // $resize_image = (public_path('image/' .$filename)); 
                    $image = base64_encode(file_get_contents($resize_image));
                } catch (FileNotFoundException $e) {
                    echo "catch";
                }
            }
        }
        
            $response = Curl::to('128.199.161.172:8107/editmerch')
                        ->withData([
	                    "gttop"	=> 'TB', 
	                    "gtcode"=> $request->input('gtcode'), 
	                    "title"	=> $request->input('title'),
	                    "img" 	=> $image,
	                    "desc"	=> $request->input('desc'),
	                    "price"	=> $request->input('price'),
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

            return redirect()->route('merchandise.index');
            }
        

    public function destroy($id)
    {  
    	$token = Session::get('token'); 

        $response = Curl::to('128.199.161.172:9099/delmerch/'.$id)       				
                    ->withHeader('Authorization:'.$token)
                    ->delete();

        return redirect()->route('merchandise.index');
    }
}
