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

    public function index($KnowID = null){
        $Knowledges = Knowledges::orderBy('KnowID')->select('KnowID','KnowName')->get();

        $KnowledgeData = $this->KAD->getKnowledgeData($KnowID);

        $data = array('Knowledges'=>$Knowledges,'KnowledgeData'=>$KnowledgeData);
        //return $data;
        return view('KnowledgeAnalysis',['data'=>$data]);
    }

    public function postKnowledgeData(Request $Request){
        //return $Request->all();
        $KnowID = $Request->input('KnowID');
        //return $KnowID;
        return $this->index($KnowID);
    }

    public function test($KnowID = null){
        return $this->KAD->getKnowledgeData($KnowID);
    }
}
