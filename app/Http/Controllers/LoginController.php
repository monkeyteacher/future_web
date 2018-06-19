<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Session;
use App\Model\Courses;
use App\Login\Login;

class LoginController extends Controller
{
    //
    private $Lg;

    public function __construct(Login $Lg){
        $this->Lg = $Lg;
    }

    public function index($message = null){
        $Courses = Courses::all();
        //return $Courses;
        return view('Login',['message'=>$message,'data'=>$Courses]);
    }

    public function test(){
        $data = $this->Lg->UserDataCheck('606410065',2);
        return $data;
    }

    public function PostLogin(Request $Request){
        //驗證Mssql
        $userAccount = $Request->input('userAccount');
        $userPassword = $Request->input('userPassword');
        $CourseID = $Request->input('CourseID');
        $result = $this->Lg->LoginCheck($userAccount,$userPassword);
        if($result =='password correct!'){
            $Member = $this->Lg->UserDataCheck($userAccount,$CourseID);
            log::info($Member);
            if(count($Member)&&strlen($userAccount)==9){
                //ip位子不一樣
                Session::put('userAccount', $Member[0]['MemberID']);
                Session::put('status','STU');
                Session::put('Email', $Member[0]['Email']);
                Session::put('CourseID', $Member[0]['CourseID']);
                // $userAccount = Session::get('userAccount');
                Log::info('登入成功:'.$userAccount);
                return redirect()->route('MainHome',['CourseID'=>$CourseID]);
            }else{
                //判別是否老師
                Session::put('userAccount', $userAccount);
                Session::put('status','TA');
                Session::put('CourseID', $CourseID);
                Log::info('登入成功:'.$userAccount);
                return redirect()->route('MainHome',['CourseID'=>$CourseID]);
            }
        }
        else return $this->index('帳號密碼錯誤');
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
