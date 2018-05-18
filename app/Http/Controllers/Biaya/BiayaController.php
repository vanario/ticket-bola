<?php

namespace App\Http\Controllers\Biaya;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Authentication\LoginController;
use Session;
use Alert;

class BiayaController extends Controller
{
    public function index(Request $request)
    {
        $token = Session::get('token');
        $profile  = Session::get('profile');
        $clubcode = $profile['clubcode'];

        $schedule_code   = $request->input('schedule_code');

        $response = Curl::to('128.199.161.172:8112/transaksi-biaya/bypartial/'.$schedule_code.'/0/10')
        ->withHeader('Authorization:'.$token)
        ->asJson(true)
        ->get();

        $data           = $response['values'];

        $total          = $response['totalvalue'];
        $total_page     = $response['totalpage'];

        // get data from master biaya use for dropdown
        $databiaya   = Curl::to('128.199.161.172:8112/akun-biaya/bytop/'.$clubcode)
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->get();

        $listdatabiaya   = $databiaya['values'];
        $list_biaya      = collect($listdatabiaya)->pluck('akunname','gtcode');

        //get data from item use for dropdown

        $datajadwal = Curl::to('128.199.161.172:9099/getlist')
                    ->asJson(true)
                    ->withHeader('Authorization:'.$token)
                    ->get();

        $listdatajadwal   = $datajadwal['value'];
        $list_jadwal      = collect($listdatajadwal)->pluck('namehome','gtcode');

        return view('Biaya/biaya',compact('data','total','total_page','list_biaya','list_jadwal'));
    }

    public function page(Request $request)
    {
        $token = Session::get('token');

        $id = $request->keys();
        $obj_id = implode($id);

        $limit  = 10;

        $offset = $obj_id*10-10;
        $page   = $offset."/".$limit;


        $response = Curl::to('128.199.161.172:8112/transaksi-biaya/bypartial/'.$clubcode.'/'.$page)
        ->withHeader('Authorization:'.$token)
        ->asJson(true)
        ->get();

        $data           = $response['value'];
        $total          = $response['totalvalue'];
        $total_page     = $response['totalpage'];

        return view('Biaya/biaya',compact('data','total','total_page'));
    }

    public function store(Request $request)
    {
        $token       = Session::get('token');

        $jadwal      =  $request->input('gttop');
        $akunname    =  $request->input('akun_name');
        $nominal     =  $request->input('nominal');

        foreach ($akunname as $value) {
            $response = Curl::to('128.199.161.172:8112/akun-biaya/bycode/'.$value)
            ->withHeader('Authorization:'.$token)
            ->asJson(true)
            ->get();

            $biaya[] = $response['values'];
        }

        for ($i=0; $i < count($nominal); $i++) {
            $data = array();
            $data = $biaya[$i];
            $data['nominal'] = (int)$nominal[$i];

            $resultData[] = $data;
        }

        $value    = ['gttop'              => $jadwal,
                     'transaction_date'   => $request->input('date'),
                     'biaya'              => $resultData,
                     ];

        $response = Curl::to('http://128.199.161.172:8112/transaksi-biaya/add')
                    ->withData([
                    "kind"      => "add#biaya",
                    "version"   => "1.0",
                    "values"    => $value ])
                    ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->post();

        if ($response['responcode'] == "201") {

            $message = "Data Berhasil Ditambahkan";
            alert()->success('');
            Alert::success($message,'Sukses')->autoclose(4000);
            return redirect()->back();
        }

        else {

            $message = "Gagal tambah data";
            Alert::message($message)->autoclose(4000);
            return redirect()->back();
        }

        return redirect()->route('biaya.index');
    }

    public function destroy($gttop,$gtcode)
    {
        $token = Session::get('token');

        $response = Curl::to('128.199.161.172:8112/transaksi-biaya/del/'.$gttop.'/'.$gtcode)
                    ->withHeader('Authorization:'.$token)
                    ->delete();

        return redirect()->back();
    }
}
