<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Ixudra\Curl\Facades\Curl;
use App\User;

class LoginController extends Controller
{
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
        
        foreach ($response  as $key) {
            $data = $key;    
        }          

        $data  = $response['value'];

        $token = $data['token'];

        setcookie('Token', $token);
        setcookie('Token', $token, strtotime( '+30 days' ));

        $val_token = $_COOKIE["Token"];

        return redirect()->route('auth.home');

    }

    public function home()
    {
    	return view('home');
    }

    public function getAuthUser(Request $request){
        $user = JWTAuth::toUser($request->token);        
        return response()->json(['result' => $user]);
    }
}
