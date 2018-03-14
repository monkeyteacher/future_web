<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Session;
use App\Model\Members;

class LoginController extends Controller
{
    //
    public function index($message = null){
        return view('Login',['message'=>$message]);
    }

    public function PostLogin(Request $Request){
        //驗證Mssql
        $userAccount = $Request->input('userAccount');
        $userPassword = $Request->input('userPassword');
        $result = $this->LoginCheck($userAccount,$userPassword);
        if($result =='password correct!'){
            $Member = Members::where('MemberID',$userAccount)->get();
            log::info($Member);
            if(count($Member)){
                //ip位子不一樣
                Session::put('userAccount', $Member[0]['MemberID']);
                Session::put('status','STU');
                Session::put('Email', $Member[0]['Email']);
                $userAccount = Session::get('userAccount');
                Log::info('登入成功:'.$userAccount);
                return redirect()->route('MainHome');
            }else{
                //判別是否老師
                Session::put('status','TA');
                return $this->index('登入成功，但無紀錄');
            }
        }
        else return '登入失敗';
    }

    public function LoginCheck($userAccount,$userPassword){
        $url = "http://163.13.127.72:1202";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array("userAccount"=>$userAccount,"userPassword"=>$userPassword))); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $output = curl_exec($ch); 
        curl_close($ch);
        Log::info($output.':'.$userAccount);
        return $output;
    }

    public function Logout(){
        $userAccount = Session::get('userAccount');
        Log::info('登出成功:'.$userAccount);
        Session::forget('userAccount');
        Session::forget('status');
        Session::forget('Email');
        return $this->index('已登出');
    }
}
