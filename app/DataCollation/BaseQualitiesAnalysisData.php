<?php
namespace App\DataCollation;
use App\Model\BaseQualities;
use App\Model\QualityAbilities;
use App\Model\ExamHistory;
use DB;
class BaseQualitiesAnalysisData{

    public function getBaseQualitiesData(){
        $BaseQualitiesData = BaseQualities::all();
        for($i = 0; $i<count($BaseQualitiesData);$i++){
            $BaseQualitiesData[$i]['QualityAbilitiesData'] = $this->getQualityAbilitiesData($BaseQualitiesData[$i]['BaseID']);
        }
        return $BaseQualitiesData;
        
    }

    public function getQualityAbilitiesData($BaseID){
        $ExamHistoryA = DB::raw('(
            SELECT ExamID
                ,COUNT(*) as num
                ,Sum(IsCorrect) as Correct
            FROM PBLServerDB.dbo.ExamHistory
            group by ExamID
            ) as ExamHistoryA ');

        $ExamHistoryB = DB::raw('(
            SELECT ExamID
                ,COUNT(*) as num
                ,Sum(IsCorrect) as Correct
            FROM PBLServerDB.dbo.ExamHistory
            where round = 1
            group by ExamID
            ) as ExamHistoryB ');

        $QualityAbilitiesData = BaseQualities::leftjoin('QualityAbilities','BaseQualities.BaseID','=','QualityAbilities.BaseID')
        ->leftjoin('Exams','Exams.AbilityID','=','QualityAbilities.AbilityID')
        ->leftjoin($ExamHistoryA,
            function($join){
                $join->on('Exams.ExamID','=','ExamHistoryA.ExamID');
            })
        ->leftjoin($ExamHistoryB,
            function($join){
                $join->on('Exams.ExamID','=','ExamHistoryB.ExamID');
            })
        ->where('BaseQualities.BaseID',$BaseID)
        ->groupBy('BaseQualities.BaseID'
            ,'BaseQualities.BaseName'
            ,'QualityAbilities.AbilityID'
            ,'QualityAbilities.AbilityName')
        ->select(DB::raw("
             QualityAbilities.AbilityID
            ,QualityAbilities.AbilityName
            ,count(QualityAbilities.AbilityID) as  num
            ,CAST(Sum(ExamHistoryA.Correct) AS float)/Sum(ExamHistoryA.num) as AnswerRate
            ,CAST(Sum(ExamHistoryB.Correct) AS float)/Sum(ExamHistoryB.num) as AnswerRate2
            "))
        ->get();
        return $QualityAbilitiesData;
    }

    public function getAbilityData($AbilityID){
        $ExamHistoryA = DB::raw('(
            SELECT ExamID
                ,COUNT(*) as num
                ,Sum(IsCorrect) as Correct
            FROM PBLServerDB.dbo.ExamHistory
            group by ExamID
            ) as ExamHistoryA ');

        $ExamHistoryB = DB::raw('(
            SELECT ExamID
                ,COUNT(*) as num
                ,Sum(IsCorrect) as Correct
            FROM PBLServerDB.dbo.ExamHistory
            where round = 1
            group by ExamID
            ) as ExamHistoryB ');
        $getAbilityData = QualityAbilities::leftjoin('Exams','Exams.AbilityID','=','QualityAbilities.AbilityID')
        ->leftjoin($ExamHistoryA,
            function($join){
                $join->on('Exams.ExamID','=','ExamHistoryA.ExamID');
            })
        ->leftjoin($ExamHistoryB,
            function($join){
                $join->on('Exams.ExamID','=','ExamHistoryB.ExamID');
            })
        ->where('QualityAbilities.AbilityID',$AbilityID)
        ->groupBy('QualityAbilities.AbilityID','Exams.ExamContent','QualityAbilities.AbilityName')
        ->select(DB::raw("
        QualityAbilities.AbilityID
        ,QualityAbilities.AbilityName
        ,Exams.ExamContent
        ,CAST(Sum(ExamHistoryA.Correct) AS float)/Sum(ExamHistoryA.num) as AnswerRate
        ,CAST(Sum(ExamHistoryB.Correct) AS float)/Sum(ExamHistoryB.num) as AnswerRate2
        "))
        ->get();
        return $getAbilityData;
    }

    public function getBaseQulitiesChart(){
        $ExamHistoryA = DB::raw('(
            SELECT ExamID
                ,COUNT(*) as num
                ,Sum(IsCorrect) as Correct
            FROM PBLServerDB.dbo.ExamHistory
            group by ExamID
            ) as ExamHistoryA ');

        $BaseQulitiesChart = BaseQualities::leftjoin('QualityAbilities','BaseQualities.BaseID','=','QualityAbilities.BaseID')
        ->leftjoin('Exams','Exams.AbilityID','=','QualityAbilities.AbilityID')
        ->leftjoin($ExamHistoryA,
            function($join){
                $join->on('Exams.ExamID','=','ExamHistoryA.ExamID');
            }
        )
        ->groupBy('BaseQualities.BaseID','BaseQualities.BaseName')
        ->select(DB::raw("
        BaseQualities.BaseID
        ,BaseQualities.BaseName
        ,CAST(Sum(ExamHistoryA.Correct) AS float)/Sum(ExamHistoryA.num) as AnswerRate
        "))->get();
        return $BaseQulitiesChart;
    }

}