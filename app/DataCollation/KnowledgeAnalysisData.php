<?php
namespace App\DataCollation;
use App\Model\KnowledgeHistory;
use App\Model\Knowledges;
use App\Model\ExamHistory;
use DB;
class KnowledgeAnalysisData{

    public function getKnowledges($CourseID){
        $Knowledges = Knowledges::leftjoin('Stories','Stories.StoryID','=','Knowledges.StoryID')
        ->where('CourseID',$CourseID)
        ->orderBy('KnowID')
        ->select('KnowID','KnowName')
        ->get();
        return $Knowledges;
    }
    public function getKnowledgeData($CourseID,$KnowID){
        if($KnowID == null){
            $KnowlegeArray = Knowledges::leftjoin('Stories','Stories.StoryID','=','Knowledges.StoryID')
            ->where('CourseID',$CourseID)
            ->orderby('KnowID')
            ->get();
            $KnowID = $KnowlegeArray[0]['KnowID'];
        }

        $KnowledgeData = KnowledgeHistory::leftjoin('Members','Members.MemberID','=','KnowledgeHistory.MemberID')
        ->leftjoin('Knowledges','Knowledges.KnowID','=','KnowledgeHistory.KnowID')
        ->groupby('Members.MemberID','Members.Name','KnowledgeHistory.KnowID','Knowledges.KnowName')
        ->where('KnowledgeHistory.KnowID',$KnowID)
        ->select(DB::raw("
             Members.MemberID
            ,Members.Name
            ,KnowledgeHistory.KnowID
            ,Knowledges.KnowName
            ,Max(Round) as 'round'
            ,Max(IsClear) as 'isClear'
            ,Max(KnowledgeHistory.UpdateTime) as 'Time'"
        ))->get();
        
        return $KnowledgeData;
    }

    public function getStudentData($KnowID,$MemberID){
        $StudentData = KnowledgeHistory::where('KnowID',$KnowID)
        ->where('MemberID',$MemberID)
        ->get();
        return $StudentData;
    }

    public function getExamsData($KnowID, $MemberID, $Round){
        $ExamsData  = KnowledgeHistory::leftjoin('ExamHistory', function($join){
            $join->on('ExamHistory.MemberID','=','KnowledgeHistory.MemberID')->on('ExamHistory.Round','=','KnowledgeHistory.Round');
        })->leftjoin('Exams','ExamHistory.ExamID','=','Exams.ExamID')
        ->where('ExamHistory.MemberID',$MemberID)
        ->where('ExamHistory.KnowID',$KnowID)
        ->where('ExamHistory.Round',$Round)
        ->select('ExamHistory.IsCorrect','Exams.ExamContent')
        ->distinct()
        ->get();
        return $ExamsData;
    }
}