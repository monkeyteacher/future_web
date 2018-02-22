<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Knowledges;
use App\DataCollation\KnowledgeAnalysisData;


class KnowledgeAnalysisController extends Controller
{
    //
    private $KAD;

    public function __construct(KnowledgeAnalysisData $KAD){
        $this->KAD = $KAD;
    }

    public function index($KnowID = null,$StudentData = null,$ExamsData = null){
        $Knowledges = Knowledges::orderBy('KnowID')->select('KnowID','KnowName')->get();

        $KnowledgeData = $this->KAD->getKnowledgeData($KnowID);

        $data = array('Knowledges'=>$Knowledges,'KnowledgeData'=>$KnowledgeData,'StudentData'=>$StudentData,'ExamsData'=>$ExamsData);
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
