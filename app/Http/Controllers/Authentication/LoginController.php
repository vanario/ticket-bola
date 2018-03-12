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
                    
        foreach ($response  as $key) {
            $data = $key;    
        }          

        $data  = $response['value'];
        $token = $data['token'];
        Session::put('token', $token);

        if ($response['resocde'] == 201){
            return redirect()->route('auth.home');
        }
        else{
            return redirect()->route('login');
            $message = "Kode sudah tersedia, Anda tidak bisa menambahkan tribun dengan kode yang sama";
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
    	return view('home');
    }
}
