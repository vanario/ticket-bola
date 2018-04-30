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

        $data     = $response['value'];

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
        }

        // return $data;
                
        //pagination        
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $col = collect($data);
        $perPage = 5;
        $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $data = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage, $currentPage,['path' => LengthAwarePaginator::resolveCurrentPath()] );

        return view('DataMaster/Jadwal.jadwal', compact('data', 'list_club', 'value','listtribun','id'));
    }

    public function createjadwal()
    {
        $gtcodetrib = "";

        //list data club for dropdown

        $list       = Curl::to('128.199.161.172:8091/getbygttop/TB')
                    ->asJson(true)
                    ->get();
                    
        $list_data  = $list['value'];


        $list_club  = collect($list_data)->pluck('name','gtcode');

        return view('DataMaster/Jadwal.createjadwal', compact('list_club', 'gtcodetrib'));
    }

    public function createtribun()
    {
        $gtcodetrib = "";

        //list data club for dropdown

        $list       = Curl::to('128.199.161.172:8091/getbygttop/TB')
                    ->asJson(true)
                    ->get();
                    
        $list_data  = $list['value'];


        $list_club  = collect($list_data)->pluck('name','gtcode');

        return view('DataMaster/Jadwal.createtribun', compact('list_club', 'gtcodetrib'));
    }

    public function edit($gttop,$gtcode)
    {
        $token = Session::get('token');

        $response = Curl::to('128.199.161.172:9099/getitemtribun/'.$gttop.'/'.$gtcode)
                    ->asJson(true)
                    ->withHeader('Authorization:'.$token)
                    ->get(); 

        $data     = $response['value'];

        //list data club for dropdown
        $list       = Curl::to('128.199.161.172:8091/getbygttop/TB')
                    ->asJson(true)
                    ->get();       

        $list_data  = $list['value'];


        $list_club  = collect($list_data)->pluck('name','gtcode');

        return view('DataMaster/Jadwal.edit', compact('list_club', 'data', 'gtcodetrib','postribun_depan','postribun_tengah','postribun_belakang'));
    }

    public function store(Request $request)
    {
        $token = Session::get('token');

        $response = Curl::to('128.199.161.172:9099/additem')
                    ->withData([
                    "gttop"     => $request->input('gttopstadion'), 
                    "namehome"  => $request->input('namehome'),
                    "nameaway"  => $request->input('nameaway'),
                    "jam"       => $request->input('jam'),
                    "date"      => $request->input('date'),
                    "stadion"   => $request->input('stadion'),
                    "kota"      => $request->input('kota'),                    
                    "event"     => $request->input('event'),
                    ])
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->post();

        // return $response;
        

        $gtcodetrib = "";
        if ($response['value']['gtcode']) {
            $gtcodetrib = $response['value']['gtcode'];
        }


        $list       = Curl::to('128.199.161.172:8091/getbygttop/TB')
                    ->asJson(true)
                    ->get();
                    
        $list_data  = $list['value'];


        $list_club  = collect($list_data)->pluck('name','gtcode');

        if ($response['rescode'] == "201") {
            
            $message = "Data Berhasil Ditambahkan";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
        }

        else {
            
            $message = "Kode Item sudah tersedia, Anda tidak bisa menambahkan data dengan kode yang sama";
            Alert::message($message)->autoclose(4000);
        }

        return view('DataMaster/Jadwal.createtribun', compact('gtcodetrib', 'list_club'));
    }

    public function update(Request $request)
    {
        $token = Session::get('token');        
        // return $token;
        
            $response = Curl::to('128.199.161.172:9099/edititem/')
                        ->withData([
                        "gttop"     => $request->input('gttopstadion'), 
                        "gtcode"    => $request->input('gtcode'), 
                        "namehome"  => $request->input('namehome'),
                        "nameaway"  => $request->input('nameaway'),
                        "jam"       => $request->input('jam'),
                        "date"      => $request->input('date'),
                        "stadion"   => $request->input('stadion'),
                        "kota"      => $request->input('kota'),                    
                        "event"     => $request->input('event'),
                        ])
                        ->withHeader('Authorization:'.$token)
                        ->asJson(true)
                        ->post();
                        
            if ($response['rescode'] == "200") {
                
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
        

    public function destroy($gttoptrib,$gtcodetrib)
    {  
    	$token = Session::get('token'); 

        $response = Curl::to('128.199.161.172:9099/deleteitem/'.$gttoptrib.'/'.$gtcodetrib)       				
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

        $response = Curl::to('128.199.161.172:8113/addtribun')
                    ->withData([    'gttop'     => $request->input('gtcodetrib'),
                                    'gtcode'    => $gtcodetrib,
                                    'tribun'    => $tribun,
                                    'color'     => $color,
                                    'postribun'=> [[    'gttop'  => $gtcodetrib,
                                                        'gtcode' => "1",
                                                        'posisi' => "depan",
                                                        'image'  => $imagedepan,
                                                        'price'  => (int)$pricedepan,
                                                        'qty'    => (int)$qtydepan
                                                    ],
                                                    [   'gttop'  => $gtcodetrib,
                                                        'gtcode' => "2",
                                                        'posisi' => "tengah",
                                                        'image'  => $imagetengah,
                                                        'price'  => (int)$pricetengah,
                                                        'qty'    => (int)$qtytengah
                                                    ],
                                                    [   'gttop'  => $gtcodetrib,
                                                        'gtcode' => "3",
                                                        'posisi' => "belakang",
                                                        'image'  => $imagebelakang,
                                                        'price'  => (int)$pricebelakang,
                                                        'qty'    => (int)$qtybelakang
                                                    ]
                                                ]

                                
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

        return redirect()->route('jadwal.index');
    }

    public function updatetrib(Request $request)
    {
        $token  = Session::get('token'); 
        $tribun = $request->input('tribun');

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

        $response = Curl::to('128.199.161.172:8113/edittribun')
                    ->withData([
                    "gtcode" => $request->input('gtcode'), 
                    "tribun" => [[  'gttoptrib' => $request->input('gtcode'),
                                    'gtcodetrib'=> $gtcodetrib,
                                    'tribun'    => $request->input('tribun'),
                                    'color'     => $color,
                                    'posttribun'=> [[   'gttop'  => $gtcodetrib,
                                                        'gtcode' => "1",
                                                        'posisi' => "depan",
                                                        'imgdpn' => $imagedepan,
                                                        'price'  => (int)$request->input('pricedepan'),
                                                        'qty'    => (int)$request->input('qtydepan')
                                                    ],
                                                    [   'gttop'  => $gtcodetrib,
                                                        'gtcode' => "2",
                                                        'posisi' => "tengah",
                                                        'imgtgh' => $imagetengah,
                                                        'price'  => (int)$request->input('pricetengah'),
                                                        'qty'    => (int)$request->input('qtytengah')
                                                    ],
                                                    [   'gttop'  => $gtcodetrib,
                                                        'gtcode' => "3",
                                                        'posisi' => "belakang",
                                                        'imgblkg'=> $imagebelakang,
                                                        'price'  => (int)$request->input('pricebelakang'),
                                                        'qty'    => (int)$request->input('qtybelakang')
                                                    ]
                                                ]

                                ]] 
                            ])
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->post();

        return $response; 
        
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

    public function destroytrib($gtcodetrib)
    {  
        $token  = Session::get('token'); 
        $response = Curl::to('128.199.161.172:8113/deletetribun/'.$gtcodetrib)
                    ->withHeader('Authorization:'.$token)
                    ->delete();

        return redirect()->route('jadwal.index');
    }    
}