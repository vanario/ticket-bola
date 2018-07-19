<?php

namespace App\Http\Controllers\DataMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Pagination\LengthAwarePaginator;
use Intervention\Image\ImageManagerStatic as Image;
use Alert;
use Session;
use Storage;

class TribunController extends Controller
{
    public function index(Request $request)
    {
        $token = Session::get('token');

        $gttop = $request->input('gttop');


        $response = Curl::to('128.199.161.172:8113/tribun/gettop/'.$gttop)
                    ->asJson(true)
                    ->withHeader('Authorization:'.$token)
                    ->get();

        $data     = $response['value'];
        // return $data;
        // get stadion
        $response = Curl::to('128.199.161.172:8103/getliststadion/TB')
                    ->asJson(true)
                    ->get();

        $stadion     = $response['result'];

        $list_stadion = collect($stadion)->pluck('name','gtcode');

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $col = collect($data);
        $perPage = 10;
        $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $data = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage, $currentPage,['path' => LengthAwarePaginator::resolveCurrentPath()] );

        return view('DataMaster/Tribun.tribun',compact('data','tribun', 'list_stadion'));
    }

    public function store(Request $request)
    {
        $token          = Session::get('token');
        $tribun         = $request->input('tribun');
        $pricedepan     = $request->input('pricedepan');
        $pricetengah    = $request->input('pricetengah');
        $pricebelakang  = $request->input('pricebelakang');
        $qtydepan       = $request->input('qtydepan');
        $qtytengah      = $request->input('qtytengah');
        $qtybelakang    = $request->input('qtybelakang');

        if ($request->hasFile('gambardepan')) {
            if($request->file('gambardepan')->isValid()) {
                try {
                    $file         = $request->file('gambardepan');
                    $filename     = $file->getClientOriginalName();
                    $image_resize = Image::make($file->getRealPath());
                    $image_resize->resize(150, 150);

                    $image_resize->save(public_path('image/' .$filename));
                    $resize_image = (public_path('image/' .$filename));

                    $imagedepan = base64_encode(file_get_contents($resize_image));
                } catch (FileNotFoundException $e) {
                    echo "catch";
                }
            }
        }

        if ($request->hasFile('gambartengah')) {
            if($request->file('gambartengah')->isValid()) {
                try {
                    $file         = $request->file('gambartengah');
                    $filename     = $file->getClientOriginalName();
                    $image_resize = Image::make($file->getRealPath());
                    $image_resize->resize(150, 150);

                    $image_resize->save(public_path('image/' .$filename));
                    $resize_image = (public_path('image/' .$filename));

                    $imagetengah = base64_encode(file_get_contents($resize_image));
                } catch (FileNotFoundException $e) {
                    echo "catch";
                }
            }
        }

        if ($request->hasFile('gambarbelakang')) {
            if($request->file('gambarbelakang')->isValid()) {
                try {
                    $file         = $request->file('gambarbelakang');
                    $filename     = $file->getClientOriginalName();
                    $image_resize = Image::make($file->getRealPath());
                    $image_resize->resize(150, 150);

                    $image_resize->save(public_path('image/' .$filename));
                    $resize_image = (public_path('image/' .$filename));

                    $imagebelakang = base64_encode(file_get_contents($resize_image));
                } catch (FileNotFoundException $e) {
                    echo "catch";
                }
            }
        }

        //generate color
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

        //generate gtcode
        if ($tribun == "vip") {
            $gtcodetrib = "1";
        }
        elseif ($tribun == "vip 1")  {
            $gtcodetrib = "2";
        }
        elseif ($tribun == "vip 2") {
            $gtcodetrib = '3';
        }
        elseif ($tribun == "tribun timur") {
            $gtcodetrib = '4';
        }
        elseif ($tribun == "tribun utara") {
            $gtcodetrib = '5';
        }
        elseif ($tribun == "tribun selatan") {
            $gtcodetrib = '6';
        }

        // data postribun
        $layout_depan       = $request->input('layout_depan');
        $layout_tengah      = $request->input('layout_tengah');
        $layout_belakang    = $request->input('layout_belakang');

        if($layout_depan != 'false' ){

            $prefixdepan          = $request->input('prefix_depan') ;
            $nomor_pertama_depan  = $request->input('nomor_pertama_depan') ;
            $nomor_terakhir_depan = $request->input('nomor_terakhir_depan') ;

            for ($i=0; $i < count($prefixdepan); $i++) {
                $data = array();
                $data['firs_number']    = (int)$nomor_pertama_depan[$i];
                $data['last_number']    = (int)$nomor_terakhir_depan[$i];
                $data['prefix']         = $prefixdepan[$i];

                $resultDataDepan[] = $data;
            }


            $postribun_depan =  [   'gttop'  => $gtcodetrib,
                                    'gtcode' => "1",
                                    'posisi' => "depan",
                                    'layout' => true,
                                    'kursi'  => $resultDataDepan,
                                    'image'  => $imagedepan,
                                    'price'  => (int)$pricedepan,
                                    'qty'    => (int)$qtydepan
                                ];

        }
         else{
           $postribun_depan =  [   'gttop'  => $gtcodetrib,
                                    'gtcode' => "1",
                                    'posisi' => "depan",
                                    'layout' => false,
                                    'image'  => $imagedepan,
                                    'price'  => (int)$pricedepan,
                                    'qty'    => (int)$qtydepan
                                ];
        }


        if($layout_tengah != 'false' ){

            $nomor_pertama_tengah  = $request->input('nomor_pertama_tengah');
            $nomor_terakhir_tengah = $request->input('nomor_terakhir_tengah');

            $prefixtengah= $request->input('prefix_tengah') ;
            for ($i=0; $i < count($prefixtengah); $i++) {
                $data = array();
                $data['firs_number']    = (int)$nomor_pertama_tengah[$i];
                $data['last_number']    = (int)$nomor_terakhir_tengah[$i];
                $data['prefix'] = $prefixtengah[$i];

                $resultDataTengah[] = $data;
            }

            $postribun_tengah = [   'gttop'  => $gtcodetrib,
                                    'gtcode' => "2",
                                    'posisi' => "tengah",
                                    'layout' => true,
                                    'kursi'  => $resultDataTengah,
                                    'image'  => $imagetengah,
                                    'price'  => (int)$pricetengah,
                                    'qty'    => (int)$qtytengah
                                ];
        }

        else{
           $postribun_tengah = [   'gttop'  => $gtcodetrib,
                                    'gtcode' => "2",
                                    'posisi' => "tengah",
                                    'layout' => false,
                                    'image'  => $imagetengah,
                                    'price'  => (int)$pricetengah,
                                    'qty'    => (int)$qtytengah
                                ];
        }

        if($layout_belakang != 'false' ){

            $nomor_pertama_belakang  = $request->input('nomor_pertama_belakang') ;
            $nomor_terakhir_belakang = $request->input('nomor_terakhir_belakang') ;

            $prefixbelakang= $request->input('prefix_belakang') ;

            for ($i=0; $i < count($prefixbelakang); $i++) {
                $data = array();
                $data['firs_number']    = (int)$nomor_pertama_belakang[$i];
                $data['last_number']    = (int)$nomor_terakhir_belakang[$i];
                $data['prefix']         = $prefixbelakang[$i];

                $resultDataBelakang[] = $data;
            }

            $postribun_belakang = [ 'gttop'  => $gtcodetrib,
                                    'gtcode' => "3",
                                    'posisi' => "belakang",
                                    'layout' => true,
                                    'kursi'  => $resultDataBelakang,
                                    'image'  => $imagebelakang,
                                    'price'  => (int)$pricebelakang,
                                    'qty'    => (int)$qtybelakang
                                ];
        }
        else {
          $postribun_belakang = [ 'gttop'  => $gtcodetrib,
                                    'gtcode' => "3",
                                    'posisi' => "belakang",
                                    'layout' => false,
                                    'image'  => $imagebelakang,
                                    'price'  => (int)$pricebelakang,
                                    'qty'    => (int)$qtybelakang
                                ];
        }

        $postribun = [ $postribun_depan, $postribun_tengah, $postribun_belakang];

        $response  = Curl::to('128.199.161.172:8113/tribun/add')
                    ->withData([    'gttop'     => $request->input('gttop'),
                                    'gtcode'    => $gtcodetrib,
                                    'tribun'    => $tribun,
                                    'color'     => $color,
                                    'postribun' => $postribun
                            ])
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->post();

        if ($response['rescode'] == "201") {

            //get data gtcode tribun
            $gtcodetrib = "";
            if ($response['value']['gtcode']) {
                $gtcodetrib = $response['value']['gttop'];
            }

            $message = "Data Berhasil Ditambahkan";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
        }

        elseif ($response['rescode'] == "409") {

            $message = "Kode Item sudah tersedia, Anda tidak bisa menambahkan data dengan kode yang sama";
            Alert::message($message)->autoclose(4000);
        }

        else {

            $message = "Data gagal di input";
            Alert::message($message)->autoclose(4000);
        }

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $test           = $request->input('test');
        $token          = Session::get('token');
        $tribun         = $request->input('tribun');
        $pricedepan     = $request->input('pricedepan');
        $pricetengah    = $request->input('pricetengah');
        $pricebelakang  = $request->input('pricebelakang');
        $qtydepan       = $request->input('qtydepan');
        $qtytengah      = $request->input('qtytengah');
        $qtybelakang    = $request->input('qtybelakang');

        if ($request->hasFile('gambardepan')) {
            if($request->file('gambardepan')->isValid()) {
                try {
                    $file         = $request->file('gambardepan');
                    $filename     = $file->getClientOriginalName();
                    $image_resize = Image::make($file->getRealPath());
                    $image_resize->resize(150, 150);

                    $image_resize->save(public_path('image/' .$filename));
                    $resize_image = (public_path('image/' .$filename));

                    $imagedepan = base64_encode(file_get_contents($resize_image));
                } catch (FileNotFoundException $e) {
                    echo "catch";
                }
            }
        }
        else{
            $imagedepan = base64_encode($request->input('gambar_depan'));
        }

        if ($request->hasFile('gambartengah')) {
            if($request->file('gambartengah')->isValid()) {
                try {
                    $file         = $request->file('gambartengah');
                    $filename     = $file->getClientOriginalName();
                    $image_resize = Image::make($file->getRealPath());
                    $image_resize->resize(150, 150);

                    $image_resize->save(public_path('image/' .$filename));
                    $resize_image = (public_path('image/' .$filename));

                    $imagetengah = base64_encode(file_get_contents($resize_image));
                } catch (FileNotFoundException $e) {
                    echo "catch";
                }
            }
        }
        else{
            $imagetengah = base64_encode($request->input('gambar_tengah'));
        }

        if ($request->hasFile('gambarbelakang')) {
            if($request->file('gambarbelakang')->isValid()) {
                try {
                    $file         = $request->file('gambarbelakang');
                    $filename     = $file->getClientOriginalName();
                    $image_resize = Image::make($file->getRealPath());
                    $image_resize->resize(150, 150);

                    $image_resize->save(public_path('image/' .$filename));
                    $resize_image = (public_path('image/' .$filename));

                    $imagebelakang = base64_encode(file_get_contents($resize_image));
                } catch (FileNotFoundException $e) {
                    echo "catch";
                }
            }
        }
        else{
            $imagebelakang = base64_encode($request->input('gambar_belakang'));
        }

        //generate color
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

        //generate gtcode
        if ($tribun == "vip") {
            $gtcodetrib = "1";
        }
        elseif ($tribun == "vip 1")  {
            $gtcodetrib = "2";
        }
        elseif ($tribun == "vip 2") {
            $gtcodetrib = '3';
        }
        elseif ($tribun == "tribun timur") {
            $gtcodetrib = '4';
        }
        elseif ($tribun == "tribun utara") {
            $gtcodetrib = '5';
        }
        elseif ($tribun == "tribun selatan") {
            $gtcodetrib = '6';
        }

        // data postribun
        $layout_depan       = $request->input('layout_depan');
        $layout_tengah      = $request->input('layout_tengah');
        $layout_belakang    = $request->input('layout_belakang');

        if($layout_depan != 'false' ){

            $prefixdepan          = $request->input('prefix_depan') ;
            $nomor_pertama_depan  = $request->input('nomor_pertama_depan') ;
            $nomor_terakhir_depan = $request->input('nomor_terakhir_depan') ;

            for ($i=0; $i < count($prefixdepan); $i++) {
                $data = array();
                $data['firs_number']    = (int)$nomor_pertama_depan[$i];
                $data['last_number']    = (int)$nomor_terakhir_depan[$i];
                $data['prefix']         = $prefixdepan[$i];

                $resultDataDepan[] = $data;
            }
            // return $gtcodetrib;

            $postribun_depan =  [   'gttop'  => $gtcodetrib,
                                    'gtcode' => "1",
                                    'posisi' => "depan",
                                    'layout' => true,
                                    'kursi'  => $resultDataDepan,
                                    'image'  => $imagedepan,
                                    'price'  => (int)$pricedepan,
                                    'qty'    => (int)$qtydepan
                                ];

        }
         else{
           $postribun_depan =  [   'gttop'  => $gtcodetrib,
                                    'gtcode' => "1",
                                    'posisi' => "depan",
                                    'layout' => false,
                                    'image'  => $imagedepan,
                                    'price'  => (int)$pricedepan,
                                    'qty'    => (int)$qtydepan
                                ];
        }


        if($layout_tengah != 'false' ){

            $nomor_pertama_tengah  = $request->input('nomor_pertama_tengah');
            $nomor_terakhir_tengah = $request->input('nomor_terakhir_tengah');

            $prefixtengah= $request->input('prefix_tengah') ;
            for ($i=0; $i < count($prefixtengah); $i++) {
                $data = array();
                $data['firs_number']    = (int)$nomor_pertama_tengah[$i];
                $data['last_number']    = (int)$nomor_terakhir_tengah[$i];
                $data['prefix'] = $prefixtengah[$i];

                $resultDataTengah[] = $data;
            }

            $postribun_tengah = [   'gttop'  => $gtcodetrib,
                                    'gtcode' => "2",
                                    'posisi' => "tengah",
                                    'layout' => true,
                                    'kursi'  => $resultDataTengah,
                                    'image'  => $imagetengah,
                                    'price'  => (int)$pricetengah,
                                    'qty'    => (int)$qtytengah
                                ];
        }

        else{
           $postribun_tengah = [   'gttop'  => $gtcodetrib,
                                    'gtcode' => "2",
                                    'posisi' => "tengah",
                                    'layout' => false,
                                    'image'  => $imagetengah,
                                    'price'  => (int)$pricetengah,
                                    'qty'    => (int)$qtytengah
                                ];
        }

        if($layout_belakang != 'false' ){

            $nomor_pertama_belakang  = $request->input('nomor_pertama_belakang') ;
            $nomor_terakhir_belakang = $request->input('nomor_terakhir_belakang') ;

            $prefixbelakang= $request->input('prefix_belakang') ;

            for ($i=0; $i < count($prefixbelakang); $i++) {
                $data = array();
                $data['firs_number']    = (int)$nomor_pertama_belakang[$i];
                $data['last_number']    = (int)$nomor_terakhir_belakang[$i];
                $data['prefix']         = $prefixbelakang[$i];

                $resultDataBelakang[] = $data;
            }

            $postribun_belakang = [ 'gttop'  => $gtcodetrib,
                                    'gtcode' => "3",
                                    'posisi' => "belakang",
                                    'layout' => true,
                                    'kursi'  => $resultDataBelakang,
                                    'image'  => $imagebelakang,
                                    'price'  => (int)$pricebelakang,
                                    'qty'    => (int)$qtybelakang
                                ];
        }
        else {

            $postribun_belakang = [ 'gttop'  => $gtcodetrib,
                                    'gtcode' => "3",
                                    'posisi' => "belakang",
                                    'layout' => false,
                                    'image'  => $imagebelakang,
                                    'price'  => (int)$pricebelakang,
                                    'qty'    => (int)$qtybelakang
                                ];
        }

        $postribun = [ $postribun_depan, $postribun_tengah, $postribun_belakang];

        $data = [   'gttop'     => $request->input('gttop'),
                    'gtcode'    => $gtcodetrib,
                    'tribun'    => $tribun,
                    'color'     => $color,
                    'postribun' => $postribun
                ];

        $response = Curl::to('128.199.161.172:8113/tribun/edit')
                    ->withData([    'gttop'     => $request->input('gttop'),
                                    'gtcode'    => $gtcodetrib,
                                    'tribun'    => $tribun,
                                    'color'     => $color,
                                    'postribun' => $data,
                            ])
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->put();

        if ($response['rescode'] == "200") {

            //get data gtcode tribun
            $gtcodetrib = "";
            if ($response['value']['gtcode']) {
                $gtcodetrib = $response['value']['gttop'];
            }

            $message = "Data Berhasil Ditambahkan";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
        }

        elseif ($response['rescode'] == "409") {

            $message = "Kode Item sudah tersedia, Anda tidak bisa menambahkan data dengan kode yang sama";
            Alert::message($message)->autoclose(4000);
        }

        else {

            $message = "Data gagal di input";
            Alert::message($message)->autoclose(4000);
        }

        return redirect()->back();

    }

    public function destroy($gtcodetrib)
    {
        $token  = Session::get('token');
        $response = Curl::to('128.199.161.172:8113/deletetribun/'.$gtcodetrib)
                    ->withHeader('Authorization:'.$token)
                    ->delete();

        return redirect()->back();
    }

    public function edittribun($gttop,$gtcode)
    {
        $token = Session::get('token');

        $response = Curl::to('128.199.161.172:8113/tribun/getcode/'.$gttop.'/'.$gtcode)
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->get();

        $val = $response['value'];

        // return $val;

         // get stadion
        $response = Curl::to('128.199.161.172:8103/getliststadion/TB')
                    ->asJson(true)
                    ->get();

        $stadion     = $response['result'];

        $list_stadion = collect($stadion)->pluck('name','gtcode');

        return view('DataMaster/Tribun.edittribun', compact('val','list_stadion'));
    }
}
