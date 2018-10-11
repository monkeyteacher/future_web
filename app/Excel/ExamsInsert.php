<?php

namespace App\Excel;
use App\Model\Stories;
use App\Model\Knowledges;
use App\Model\Exams;
use App\Model\BaseQualities;
use App\Model\QualityAbilities;
use Log;


class ExamsInsert{
    public function ExamsInsert($ExcelContent){
        $StoryID = $this->getStroy($ExcelContent['StoryName']);
        $str = ''; 
        for($i=0;$i<count($ExcelContent['KnowNodes']);$i++){
            $KnowArray[$i] = $this->getKnowNode($StoryID,$ExcelContent['KnowNodes'][$i]);
        }
        for($i=0;$i<count($ExcelContent['Exams']);$i++){
            $KnowID = $this->getKnowID($KnowArray,$ExcelContent['Exams'][$i]['ExamsSNum']);
            $BaseID = $this->getBaseID($ExcelContent['Exams'][$i]['BaseName']);
            $AbilityID = $this->getAbilityID($BaseID,$ExcelContent['Exams'][$i]['AbilityName']);
            $ExamID = $this->setExams($KnowID,$AbilityID,$ExcelContent['Exams'][$i]);
        }
        return true;
    }

    public function getStroy($StoryName){
        $Story = Stories::where('StoryName',$StoryName)->first();
        if(count($Story)==null){
            $NowDate = date("Y-m-d");
            $Story = new Stories();
            $Story->CourseID = 4;
            $Story->StoryName = $StoryName;
            $Story->IsOpen = 1;
            $Story->Priority = 1;
            $Story->TeacherID = 'ALPHA';
            $Story->CreateTime = $NowDate;
            $Story->UpdateTime = $NowDate;
            $Story->save();
            $Story = Stories::where('StoryName',$StoryName)->first();
        }
        return $Story['StoryID'];
    }

    public function getKnowNode($StoryID,$KnowNode){
        $Knowledges = Knowledges::where('StoryID',$StoryID)->where('KnowName',$KnowNode['知識主題'])->first();
        if(count($Knowledges)==null){
            $NowDate = date("Y-m-d");
            $Knowledges = new Knowledges();
            $Knowledges->StoryID = $StoryID;
            $Knowledges->KnowName = $KnowNode['知識主題'];
            $Knowledges->Info = $KnowNode['主題簡述'];
            $Knowledges->Reference = $KnowNode['資料提供'];
            $Knowledges->Gold = 100;
            $Knowledges->Diamond = 1;
            $Knowledges->IsOpen = 1;
            $Knowledges->TeacherID = 'ALPHA';
            $Knowledges->CreateTime = $NowDate;
            $Knowledges->UpdateTime = $NowDate;
            $Knowledges->save();
            $Knowledges = Knowledges::where('StoryID',$StoryID)->where('KnowName',$KnowNode['知識主題'])->first();
        }
        $KnowArray['KnowID'] = $Knowledges['KnowID'];
        $KnowArray['Qnum'] = strtoupper($KnowNode['對應題號']);
        return $KnowArray;
    }
    
    public function getKnowID($KnowArray,$ExamsSNum){
        $ExamsSNum = strtoupper($ExamsSNum);
        for($i=0;$i<count($KnowArray);$i++){
            if(str_contains($KnowArray[$i]['Qnum'],$ExamsSNum)){
                return $KnowArray[$i]['KnowID'];
            }
        }
    }


    public function getBaseID($BaseName){
        $BaseQualities = BaseQualities::where('BaseName',$BaseName)->first();
        if(count($BaseQualities)==null){
            $NowDate = date("Y-m-d");
            $BaseQualities = new BaseQualities();
            $BaseQualities->BaseName = $BaseName;
            $BaseQualities->TeacherID = 'ALPHA';
            $BaseQualities->CreateTime = $NowDate;
            $BaseQualities->UpdateTime = $NowDate;
            $BaseQualities->save();
            $BaseQualities = BaseQualities::where('BaseName',$BaseName)->first();
        }
        return $BaseQualities['BaseID'];
    }
    
    public function getAbilityID($BaseID,$AbilityName){
        $QualityAbilities = QualityAbilities::where('BaseID',$BaseID)->where('AbilityName',$AbilityName)->first();
        if(count($QualityAbilities)==null){
            $NowDate = date("Y-m-d");
            $QualityAbilities = new QualityAbilities();
            $QualityAbilities->BaseID = $BaseID;
            $QualityAbilities->AbilityName = $AbilityName;
            $QualityAbilities->TeacherID = 'ALPHA';
            $QualityAbilities->CreateTime = $NowDate;
            $QualityAbilities->UpdateTime = $NowDate;
            $QualityAbilities->save();
            $QualityAbilities = QualityAbilities::where('BaseID',$BaseID)->where('AbilityName',$AbilityName)->first();
        }
        return $QualityAbilities['AbilityID'];
    }

    public function setExams($KnowID,$AbilityID,$Exam){
        $Exams = Exams::where('KnowID',$KnowID)->where('AbilityID',$AbilityID)->where('ExamContent',$Exam['Exam'])->first();
        if(count($Exams)==null){
            $NowDate = date("Y-m-d");
            $Exams = new Exams();
            $Exams->KnowID = $KnowID;
            $Exams->AbilityID = $AbilityID;
            $Exams->ExamContent = $Exam['Exam'];
            $Exams->ExamAnswers = $Exam['ExamAnswers'];
            $Exams->TrueAnswer = $Exam['TrueAnswer'];
            $Exams->TeacherID = 'ALPHA';
            $Exams->CreateTime = $NowDate;
            $Exams->UpdateTime = $NowDate;
            $Exams->save();
            $Exams = Exams::where('KnowID',$KnowID)->where('AbilityID',$AbilityID)->where('ExamContent',$Exam['Exam'])->first();
        }
        return true;
    }
}