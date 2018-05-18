<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Ixudra\Curl\Facades\Curl;
use App\User;
use Session;
use Alert;

class LoginController extends Controller
{
    var $newToken;

	public function __construct()
    {
        $this->user = new User;
    }

    public function index(Request $request)
    {
    	$username = $request->input('email');
    	$password = $request->input('password');

    	$response = Curl::to('128.199.161.172:8089/create')
			    	->withData(['username'=>$username, 'password'=>$password])
			    	->asJson(true)
			    	->post();

        $token  = $response['values']['token'];

        $userid = $response['values']['userid'];

        Session::put('token', $token);

        if ($response['responcode'] == 201){
            $profile_response = Curl::to('128.199.161.172:8110/profile/bycode/TB/'.$userid)
                        ->withHeader('Authorization:'.$token)
                        ->asJson(true)
                        ->get();

            $profile = $profile_response['values'];
            $clubcode= $profile['clubcode'];

            Session::put('profile', $profile);
            Session::put('clubcode', $clubcode);

            return redirect()->route('dashboard.home');
        }
        else{
            return redirect()->route('login');
            Alert::message($message)->autoclose(4000);
        }



    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        return redirect()->route('login');
    }

    public function home()
    {

    }
}
