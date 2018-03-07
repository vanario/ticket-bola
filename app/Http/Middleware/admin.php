<?php

namespace App\Http\Middleware;
use Session;

use Closure;

class admin
{
    public function handle($request, Closure $next, $guard = null)
    {
        $token = Session::get('token');
        
        if($token != null) {
            
            return $next($request);    
        
        } 
        else {

            return redirect()->route('login');
        }
    }
}
