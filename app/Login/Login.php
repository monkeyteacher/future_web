<?php
namespace App\Login;
use Log;
use App\Model\ExamHistory;
use App\Model\Members;
class Login{
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

    public function UserDataCheck($userAccount,$CourseID){
        $UserData = ExamHistory::leftjoin('Knowledges','ExamHistory.KnowID','Knowledges.KnowID')
        ->leftjoin('Stories','Stories.StoryID','Knowledges.StoryID')
        ->where('ExamHistory.MemberID',$userAccount)
        ->where('Stories.CourseID',$CourseID)
        ->get();
        if(count($UserData)){
            $MemberData = Members::where('MemberID',$UserData[0]['MemberID'])->get();
            $MemberData[0]['CourseID'] = $CourseID;
        }else{
            $MemberData = null;
        }
        return $MemberData;
    }
}

