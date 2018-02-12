<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
	function __construct()
	{
		$this->port = "8089";
	}

    public function login(Request $request)
    {
        $this->getService($port, $url)->post();

        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                $result = [
                    'status' => 400,
                    'result' => [],
                    'message' => 'Invalid email or password',
                    'error' => true,
                ];
                return response()->json($result, 400);
            }
        } catch (JWTAuthException $e) {
            $result = [
                'status' => 400,
                'result' => [],
                'message' => 'Failed to create token',
                'error' => true,
            ];
            return response()->json($result, 400);
        }

        $user = Auth::user();
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();
        $result = [
            'status' => 200,
            'result' => ['token' => $token],
            'message' => 'Login success',
            'error' => false,
        ];
        return response()->json($result, 200);
    }
    
}
