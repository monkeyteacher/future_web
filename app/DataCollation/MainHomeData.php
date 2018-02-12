<?php
namespace App\DataCollation;
use App\Model\KnowledgeHistory;
use App\Model\Knowledges;
use App\Model\Stories;
use DB;
class MainHomeData{
    public function getKnowledgesData($StoreID){
        $KnowledgesData = $this->CompletionRate()
            ->groupBy('Stories.StoryID','Knowledges.KnowID','KnowName','Knowledges.IsOpen')
            ->select(DB::raw("
                Stories.StoryID
                ,Knowledges.IsOpen
                ,Knowledges.KnowID
                ,Knowledges.KnowName
                ,Count(KH.Clear) as 'completedNum'
                ,Sum(KH.Clear) as 'participateNum'
                ,(CAST(Sum(KH.Clear)AS float)/Count(KH.Clear)) as 'CompletionRate'
                "));

        if($StoreID==null){
            return $KnowledgesData->get();
        }else{
            return $KnowledgesData->where('Stories.StoryID',$StoreID)->get();
        }
    }

    public function getCourseData($CourseID = 1){
        $CourseData = $this->CompletionRate()
            ->leftjoin('Courses','Stories.CourseID','=','Courses.CourseID')
            ->groupBy('Courses.CourseID','Courses.CourseName','Courses.IsOpen')
            ->select(DB::raw("
                Courses.CourseID
                ,Courses.CourseName
                ,Courses.IsOpen
                ,Count(KH.Clear) as 'completedNum'
                ,Sum(KH.Clear) as 'participateNum'
                ,(CAST(Sum(KH.Clear)AS float)/Count(KH.Clear)) as 'CompletionRate'
                "));

        if($CourseID==null){
            return $CourseData->get();
        }else{
            return $CourseData->where('Courses.CourseID',$CourseID)->get();
        }
    }

    function CompletionRate(){
        $joinKH = DB::raw('(SELECT MemberID
            ,[KnowID]
            ,MAX([IsClear]) as Clear
            FROM [PBLServerDB].[dbo].[KnowledgeHistory]
            Group by MemberID,[KnowID]) as KH ');

        $CompletionRateData = Stories::leftjoin('Knowledges','Stories.StoryID','=','Knowledges.StoryID')
        ->leftjoin($joinKH,
            function($join){
                $join->on('KH.KnowID','=','Knowledges.KnowID');
            }
        );
        return $CompletionRateData;
    }
}

?>
  