<?php
namespace App\DataCollation;
use App\Model\KnowledgeHistory;
use App\Model\Knowledges;
use DB;
class KnowledgeAnalysisData{
    public function getKnowledgeData($KnowID){
        if($KnowID == null){
            $KnowlegeArray = Knowledges::orderby('KnowID')->get();
            $KnowID = $KnowlegeArray[0]['KnowID'];
        }

        $KnowledgeData = KnowledgeHistory::leftjoin('Members','Members.MemberID','=','KnowledgeHistory.MemberID')
        ->groupby('Members.MemberID','Members.Name','KnowID')
        ->where('KnowID',$KnowID)
        ->select(DB::raw("
             Members.MemberID
            ,Members.Name
            ,KnowID
            ,Max(Round) as 'round'
            ,Max(IsClear) as 'isClear'
            ,Max(UpdateTime) as 'Time'"
        ))->get();
        
        return $KnowledgeData;
    }
}