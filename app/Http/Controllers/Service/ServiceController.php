<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Ixudra\Curl\Facades\Curl;

class ServiceController extends Controller
{
	
    public function getService($port, $url)
    {
    	$response = Curl::to('128.199.161.172:$port/$url');
    }
}
