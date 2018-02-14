<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Ixudra\Curl\Facades\Curl;
use JWTAuth;
use JWTAuthException;
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

        $data = $response['value'];

        return $data['token'];
    	
    	return redirect()->route('auth.home');

    }

    public function home()
    {
    	return view('home');
    }

     
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'response' => 'error',
                    'message' => 'invalid_email_or_password',
                ]);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'message' => 'failed_to_create_token',
            ]);
        }
        return response()->json([
            'response' => 'success',
            'result' => [
                'token' => $token,
            ],
        ]);
    }

    public function getAuthUser(Request $request){
        $user = JWTAuth::toUser($request->token);        
        return response()->json(['result' => $user]);
    }
}
