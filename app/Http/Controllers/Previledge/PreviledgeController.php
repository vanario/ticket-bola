<?php

namespace App\Http\Controllers\Previledge;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PreviledgeController extends Controller
{
    public function index()
    {
    	return view('Previledge.previledge');
    }
}
