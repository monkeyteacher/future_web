<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use Config;
use Log;
class ExcelController extends Controller
{
    //Excel文件导出功能 By Laravel学院
    public function export(){
        $filename = "中文檔名"; 
        $filename = iconv('UTF-8','BIG5',$filename);
        $cellData = [
            ['学号','姓名','成绩'],
            ['10001','AAAAA','99'],
            ['10002','BBBBB','92'],
            ['10003','CCCCC','95'],
            ['10004','DDDDD','89'],
            ['10005','EEEEE','96'],
        ];
        Excel::create($filename,function($excel) use ($cellData){
            $excel->sheet('score', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
       })->store('xls')->export('xls');
    }

    public function import(){
        $filename = "test4"; 
        // $filename = iconv('UTF-8','BIG5',$filename);
        $filePath = 'storage/exports/'.$filename.'.xlsx';
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
        $ExamsArray = $this->ExcelReader($filePath,'slugged',$ExcelContent['ExamStart']);
        //return $ExcelContent['Exams'];

        $ExcelContent['Exams'] = $this->ExamsContent($ExamsArray);
        return $ExcelContent;
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
                $results[$ExamsNum]['BaseName'] = $BaseName;
                $results[$ExamsNum]['AbilityName'] = $AbilityName;
                $results[$ExamsNum]['Exam'] = $ExamContent;
                $results[$ExamsNum]['ExamAnswers'] = $ExamsContent[$i]['選答'];
            }
            if($ExamsContent[$i]['題目']==null &&$ExamsContent[$i]['選答']!=null){
                $results[$ExamsNum]['ExamAnswers'] = $results[$ExamsNum]['ExamAnswers'].','.$ExamsContent[$i]['選答'];
            }
            if($ExamsContent[$i]['正確答案'] == "P"){
                $results[$ExamsNum]['TrueAnswer'] = $TrueAnswer;
            }
            $TrueAnswer++;
        }
        return $results;
    }
}
