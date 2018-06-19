<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Excel\ExcelExamsImport;
use App\Excel\ExamsInsert;
use Excel;
use Config;
use Log;
use Storage;
use App\Model\Courses;

class ExcelController extends Controller
{
    private $EEI;
    private $EI;

    public function __construct(ExcelExamsImport $EEI,ExamsInsert $EI){
        $this->EEI = $EEI;
        $this->EI = $EI;
    }
    
    //Excel文件导出功能 By Laravel学院
    public function index($file_name = null,$ExcelContent = null){
        return view('ImportExams',['ExcelContent'=>$ExcelContent,'file_name'=>$file_name]);
    }

    public function test(){
        $Courses = Courses::all();
        return $Courses;
        // $file_name = '1521968607aWt7H.xlsx';
        // $ExcelContent = $this->EEI->import($file_name);
        //return $ExcelContent;
        // return $this->index($file_name,$ExcelContent);
    }

    public function ExamsInsert(Request $Request){
        $file_name = $Request->Input('file_name');
        $ExcelContent = $this->EEI->import($file_name);
        $result= '初始';
        try{
            $result = $this->EI->ExamsInsert($ExcelContent);
        }catch(\Exception $e){
            $result = $e;
        }finally{
            if($result){
                return $this->index();
            }else{
                return $result;
            }
        }
    }

    public function PostExcel(Request $Request){
        $file = $Request->file('ExamsExcel');
        $extension = $file->getClientOriginalExtension();
        $file_name = strval(time()).str_random(5).'.'.$extension;
        $tmpName = $file ->getFileName();
        Storage::put(
            'Exams/'.$file_name,
            file_get_contents($file)
        );
        $ExcelContent = $this->EEI->import($file_name);
        //return $ExcelContent;
        return $this->index($file_name,$ExcelContent);
    }

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

    
}
