<?php

namespace App\Http\Controllers\Curl;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;
use Session;
use Common;

class CurlController extends Controller
{
    static public function curldata($port, $url)
    {
    	$token    = Session::get('token');
    	$response = Curl::to('128.199.161.172:'.$port.$url)
        			      ->withHeader('Authorization:'.$token)
                    ->asJson(true)
                    ->get();

        return $response;
    }

    static public function curldata_post($port, $url,$data)
    {
    	$token    = Session::get('token');
    	$response = Curl::to('128.199.161.172:'.$port.$url)
        			      ->withHeader('Authorization:'.$token)
                    ->withData($data)
                    ->asJson(true)
                    ->post();
      return $response;
    }

    static public function curldata_put($port, $url,$data)
    {
    	$token    = Session::get('token');
    	$response = Curl::to('128.199.161.172:'.$port.$url)
        			      ->withHeader('Authorization:'.$token)
                    ->withData($data)
                    ->asJson(true)
                    ->put();
      return $response;
    }

    static public function curldata_delete($port, $url)
    {
    	$token    = Session::get('token');
    	$response = Curl::to('128.199.161.172:'.$port.$url)
        			      ->withHeader('Authorization:'.$token)
                    ->delete();

      return $response;
    }
}
