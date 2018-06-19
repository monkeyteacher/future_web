<?php

namespace App\Excel;
use Excel;
use Config;
use Log;
use Storage;


class ExcelExamsImport{

    public function import($filename){
        // $filename = iconv('UTF-8','BIG5',$filename);
        $filePath = 'storage/app/Exams/'.$filename;
        $results = $this->ExcelReader($filePath,'slugged',1);//$ExcelContent;
        $titleArray = array_keys($results[0]);
        $ExcelContent['StoryName'] = $titleArray[1];
        //return $results;
        for($i=0;$i<count($results);$i++){
            if(str_contains($results[$i][$ExcelContent['StoryName']],'支線故事')){
                $ExcelContent['StoryInfo'] = $results[$i+1][$ExcelContent['StoryName']];
            }else if(str_contains($results[$i][$ExcelContent['StoryName']],'編號')){
                $ExcelContent['KnowNodeStart'] = $i+2;
            }else if(str_contains($results[$i][$ExcelContent['StoryName']],'能力指標與題庫')){
                $ExcelContent['KnowNodeEnd'] = $i;
            }else if(str_contains($results[$i][$ExcelContent['StoryName']],'基本素養')){
                $ExcelContent['ExamStart'] = $i+2;
            }
        }
        $ExcelContent['KnowNodes'] = $this->ExcelReader($filePath,'slugged',$ExcelContent['KnowNodeStart'],$ExcelContent['KnowNodeEnd']);
        $ExcelContent['KnowNodes'] = $this->DelNullArray($ExcelContent['KnowNodes'],'編號');
        
        $ExamsArray = $this->ExcelReader($filePath,'slugged',$ExcelContent['ExamStart']);
        //return $ExamsArray;

        $ExcelContent['Exams'] = $this->ExamsContent($ExamsArray);
        return $ExcelContent;
        //return $this->index($ExcelContent);
    }

    public function ExcelReader($filePath,$heading,$StarRow,$EndRows = null){
        Config::set('excel.import.heading',$heading);
        Config::set('excel.import.startRow', $StarRow);
        if($EndRows == null){
            $results = Excel::load($filePath,function($reader){})->all()->toArray();
            return $results[0];
        }else{
            $results = Excel::load($filePath,function($reader){})->takeRows($EndRows)->toArray();
            return $results[0];
        }
        
    }
    public function ExamsContent($ExamsContent){
        $results='';
        $ExamsNum = -1;
        $BaseName = '';
        $AbilityName = '';
        $Exam = '';
        $TrueAnswer = 0;
        for($i=0;$i<count($ExamsContent);$i++){
            if($ExamsContent[$i]['基本素養']!=null){
                $BaseName = $ExamsContent[$i]['基本素養'];
            }
            if($ExamsContent[$i]['素養能力']!=null){
                $AbilityName = $ExamsContent[$i]['素養能力'];
            }
            if($ExamsContent[$i]['題目']!=null){
                $TrueAnswer = 0;
                $ExamsNum++;
                $ExamContent = $ExamsContent[$i]['題目'];
                $ExamsSNum = $ExamsContent[$i]['題號'];
                $results[$ExamsNum]['BaseName'] = $BaseName;
                $results[$ExamsNum]['AbilityName'] = $AbilityName;
                $results[$ExamsNum]['ExamsSNum'] = $ExamsSNum;
                $results[$ExamsNum]['Exam'] = $ExamContent;
                $results[$ExamsNum]['ExamAnswers'] = $ExamsContent[$i]['選答'];
            }
            if($ExamsContent[$i]['題目']==null &&!is_null($ExamsContent[$i]['選答'])){
                $results[$ExamsNum]['ExamAnswers'] = $results[$ExamsNum]['ExamAnswers'].','.$ExamsContent[$i]['選答'];
            }
            if(!is_null($ExamsContent[$i]['正確答案'])){
                $results[$ExamsNum]['TrueAnswer'] = $TrueAnswer;
            }
            $TrueAnswer++;
        }
        return $results;
    }

    public function DelNullArray($tempArray,$key){
        for($i=0;$i<count($tempArray);$i++){
            if(is_null($tempArray[$i][$key])){
                array_splice($tempArray,$i);
            }
        }
    return $tempArray; 
    }
}