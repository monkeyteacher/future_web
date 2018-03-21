<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
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
        $filename = "test2"; 
        // $filename = iconv('UTF-8','BIG5',$filename);
        $filePath = 'storage/exports/'.$filename.'.xlsx';
        $reader = Excel::load($filePath);
        $reader->dd();
        return $excelArray;

        // Excel::create('New file', function($excel) {

        //     $excel->sheet('New sheet', function($sheet) {
        
        //         $sheet->loadView('folder.view');
        
        //     });
        
        // });
    }

    
}
