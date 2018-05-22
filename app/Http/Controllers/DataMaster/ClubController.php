<?php

namespace App\Http\Controllers\DataMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Curl\CurlController as CurlController;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\UploadedFile;
use Session;
use Alert;

class ClubController extends Controller
{
    public function image($hasFile,$fileInput,$fileInputElse)
    {
      if ($hasFile) {
          if($fileInput->isValid()) {
              try {
                  $file         = $fileInput;
                  $filename     = $file->getClientOriginalName();
                  $image_resize = Image::make($file->getRealPath());
                  $image_resize->resize(150, 150);
                  $image_resize->save(public_path('image/' .$filename));
                  $resize_image = (public_path('image/' .$filename));
                  $image        = base64_encode(file_get_contents($resize_image));
              } catch (FileNotFoundException $e) {
                  echo "catch";
              }
          }
      }

      else{
          $image = $fileInputElse;
      }

      return $image;
    }

    public function index()
    {
        $port    = '8091';
        $url     = '/getbygttop/TB';
        $response = CurlController::curldata($port,$url);

        $data     = $response['value'];

    		$currentPage = LengthAwarePaginator::resolveCurrentPage();
    		$col = collect($data);
    		$perPage = 10;
    		$currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
    		// $data = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);
    		$data = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage, $currentPage,['path' => LengthAwarePaginator::resolveCurrentPath()] );

        return view('DataMaster/Club.club',['data' => $data,]);
    }

    public function store(Request $request)
    {
        //image logo
        $hasFile        = $request->hasFile('gambar');
        $fileInput      = $request->file('gambar');
        $fileInputElse  = '';
        $imglg          = $this->image($hasFile,$fileInput,$fileInputElse);

        // image background
        $hasFile_1        = $request->hasFile('gambar1');
        $fileInput_1      = $request->file('gambar1');
        $imgbg            = $this->image($hasFile_1,$fileInput_1,$fileInputElse);


        $data=  [   'gttop' =>'TB',
                    'gtcode'=> $request->input('gtcode'),
                    'name'  => $request->input('name'),
                    'tags'  => $request->input('tags'),
                    'imglg' => $imglg,
                    'imgbg1'=> $imgbg,
                ];

        $port    = '8091';
        $url     = '/groupadd';
        $response = CurlController::curldata_post($port,$url,$data);

        if ($response['status'] == "OK") {

            $message = "Data Berhasil Ditambahkan";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
        }

        else {

            $message = "Gagal Menambahkan data";
            Alert::message($message)->autoclose(4000);
        }

        return redirect()->route('club.index');
    }

    public function update(Request $request)
    {
        //image logo
        $hasFile        = $request->hasFile('gambar');
        $fileInput      = $request->file('gambar');
        $fileInputElse  = $request->input('gambar_');
        $imglg          = $this->image($hasFile,$fileInput,$fileInputElse);

        // image background
        $hasFile_1        = $request->hasFile('gambar1');
        $fileInput_1      = $request->file('gambar1');
        $fileInputElse_1  = $request->input('gambar1_');
        $imgbg            = $this->image($hasFile_1,$fileInput_1,$fileInputElse_1);


        $data=  [   'gttop' =>'TB',
                    'gtcode'=> $request->input('gtcode'),
                    'name'  => $request->input('name'),
                    'tags'  => $request->input('tags'),
                    'imglg' => $imglg,
                    'imgbg1'=> $imgbg,
                ];

        $port    = '8091';
        $url     = '/edit';
        $response = CurlController::curldata_post($port,$url,$data);

        if ($response['rescode'] == "200") {

            $message = "Data Berhasil Di Ubah";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
        }

        else {

            $message = "Gagal Mengubah Data";
            Alert::message($message)->autoclose(4000);
        }

        return redirect()->route('club.index');
    }

    public function destroy($id)
    {
        $port    = '8091';
        $url     = '/delete/'.$id;
        $response = CurlController::curldata_delete($port,$url);

        return redirect()->route('club.index');
    }
}
