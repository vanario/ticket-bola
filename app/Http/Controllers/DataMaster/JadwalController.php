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

        // list club
        $list       = Curl::to('128.199.161.172:8091/getbygttop/TB')
                    ->asJson(true)
                    ->get();
        $list_data  = $list['value'];
        $list_club  = collect($list_data)->pluck('name','gtcode');

        //list data tribun
        $dataTribun     = Curl::to('http://128.199.161.172:8113/getalltribun')
                        ->withHeader('Authorization:'.$token)
                        ->asJson(true)
                        ->get();

        $listDataTribun = $dataTribun['value'];
        //pagination
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $col = collect($data);
        $perPage = 5;
        $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $data = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage, $currentPage,['path' => LengthAwarePaginator::resolveCurrentPath()] );

        return view('DataMaster/Jadwal.jadwal', compact('data','list_club', 'listDataTribun'));
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

        $gttop       =  $request->input('gttop');
        $gtcode      =  $request->input('gtcode');
        $jumlah      =  $request->input('jumlah');
        $harga       =  $request->input('harga');

        for ($i=0; $i < count($jumlah); $i++) {
            $data = array();
            $data['roottrib']    = $gttop[$i];
            $data['nodetrib']    = $gtcode[$i];
            $data['quota']       = (int)$harga[$i];
            $data['price']       = (int)$jumlah[$i];

            $resultData[] = $data;
        }


       

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
                    "tribun"    => $resultData,
                    ])
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->post();

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

         return redirect()->route('jadwal.index');
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

                $message = "Data Berhasil Diubah";
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
}
