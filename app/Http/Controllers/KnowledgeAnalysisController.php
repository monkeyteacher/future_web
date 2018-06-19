<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Knowledges;
use App\DataCollation\KnowledgeAnalysisData;
use Session;

class KnowledgeAnalysisController extends Controller
{
    //
    private $KAD;

    public function __construct(KnowledgeAnalysisData $KAD){
        $this->KAD = $KAD;
    }

    public function index($KnowID = null,$StudentData = null,$ExamsData = null){
        $CourseID = Session::get('CourseID');
        $status = Session::get('status');
        if($status == 'STU'){
            $MemberID = Session::get('userAccount');
        }else{
            $MemberID = 'TA';
        }
        $Knowledges = $this->KAD->getKnowledges($CourseID);

        $KnowledgeData = $this->KAD->getKnowledgeData($CourseID,$KnowID);

        $data = array('Knowledges'=>$Knowledges,'KnowledgeData'=>$KnowledgeData,'StudentData'=>$StudentData,'ExamsData'=>$ExamsData,'status'=>$status,'MemberID'=>$MemberID);
        //return $data;
        return view('KnowledgeAnalysis',['data'=>$data]);
    }

    public function postKnowledgeData(Request $Request){
        //return $Request->all();
        $KnowID = $Request->input('KnowID');
        //return $KnowID;
        return $this->index($KnowID);
    }

    public function getStudentData($KnowID = null , $MemberID = null){
        //return $KnowID.'<br/>'.$MemberID;
        $StudentData = $this->KAD->getStudentData($KnowID,$MemberID);
        return $this->index($KnowID,$StudentData);
    }

    public function getExamsData($KnowID = null , $MemberID = null , $Round = null){
        //return $KnowID.'</br>'.$MemberID.'<br/>'.$Round;
        $StudentData = $this->KAD->getStudentData($KnowID,$MemberID);
        $ExamsData = $this->KAD->getExamsData($KnowID,$MemberID,$Round);
        //return $ExamsData;
        return $this->index($KnowID,$StudentData,$ExamsData);
    }

    public function test($KnowID = null){
        return $this->KAD->getKnowledgeData($KnowID);
    }
}
