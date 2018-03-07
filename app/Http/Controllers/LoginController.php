<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class LoginController extends Controller
{
    //
    public function index(){
        return view('Login');
    }

    public function PostLogin(Request $Request){
        Log::info($Request->all());
        return $Request->all();
    }
}
