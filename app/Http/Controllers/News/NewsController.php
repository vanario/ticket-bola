<?php

namespace App\Http\Controllers\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Alert;
use Intervention\Image\ImageManagerStatic as Image;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Pagination\LengthAwarePaginator;


class NewsController extends Controller
{
    public function index()
    {   
        $token = Session::get('token'); 
        $profile  = Session::get('profile');
        $clubcode = $profile['clubcode'];

        $response = Curl::to('128.199.161.172:8108/gettopnews/'.$clubcode)
                    ->asJson(true)
                    ->withHeader('Authorization:'.$token)
                    ->get(); 


        $data     = $response['value'];

        // return ($data);
        //pagination        
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $col = collect($data);

        $perPage = 20;
        $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $data = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage, $currentPage,['path' => LengthAwarePaginator::resolveCurrentPath()] );

        return view('News/news', compact('data'));
    }

    public function store(Request $request)
    {
        $token = Session::get('token'); 

        $profile  = Session::get('profile');
        $clubcode = $profile['clubcode'];

        if ($request->hasFile('gambar')) {
            if($request->file('gambar')->isValid()) {
                try {
                    $file         = $request->file('gambar');
                    $filename     = $file->getClientOriginalName();
                    $image_resize = Image::make($file->getRealPath());  
                    $image_resize->resize(150, 150);

                    $image_resize->save(public_path('image/' .$filename));
                    $resize_image = (public_path('image/' .$filename)); 

                    $image = base64_encode(file_get_contents($resize_image));
                } catch (FileNotFoundException $e) {
                    echo "catch";
                }
            }
        }

        $response = Curl::to('128.199.161.172:8108/addnews')
                    ->withData([
                    "gttop"	=> $clubcode, 
                    "gtcode"=> $request->input('gtcode'), 
                    "title"	=> $request->input('title'),
                    "img" 	=> $image,
                    "desc"	=> $request->input('desc'),
                    "date"	=> $request->input('date'),
                    "berita"=> $request->input('berita'),
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

        return redirect()->route('news.index');
        }

    public function update(Request $request)
    {
        $token = Session::get('token');  
        $profile  = Session::get('profile');
        $clubcode = $profile['clubcode'];      
        // return $token;
        return $image = $request->file('gambar1');

        if ($request->hasFile('gambar')) {
            if($request->file('gambar')->isValid()) {
                try {
                    $file         = $request->file('gambar');
                    $filename     = $file->getClientOriginalName();
                    $image_resize = Image::make($file->getRealPath());  
                    $image_resize->resize(150, 150);
                    // $image_resize->save('/var/www/image/' .$filename);
                    // $resize_image = ('/var/www/image/' .$filename); 
                    
                    $image_resize->save(public_path('image/' .$filename));
                    $resize_image = (public_path('image/' .$filename)); 
                    $image = base64_encode(file_get_contents($resize_image));
                } catch (FileNotFoundException $e) {
                    echo "catch";
                }
            }
        }
        else{
            $image = $request->input('gambar_');
        }
        
            $response = Curl::to('128.199.161.172:8108/editnews')
                        ->withData([
	                    "gttop"	=> $clubcode, 
	                    "gtcode"=> $request->input('gtcode'), 
	                    "title"	=> $request->input('title'),
	                    "img" 	=> $image,
	                    "desc"	=> $request->input('desc'),
	                    "date"	=> $request->input('date'),
	                    "berita"	=> $request->input('berita'),
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

            return redirect()->route('news.index');
            }
        

    public function destroy($id)
    {  
    	$token = Session::get('token'); 

        $response = Curl::to('128.199.161.172:8108/delnews/'.$id)       				
                    ->withHeader('Authorization:'.$token)
                    ->delete();

        return redirect()->route('news.index');
    }
}
