<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Stories;
use App\Model\Knowledges;
use App\DataCollation\MainHomeData;
use Session;

class MainHomeController extends Controller
{
    //
    private $MHD;

    public function __construct(MainHomeData $MHD){
        $this->MHD = $MHD;
    }


    public function index($CourseID = 1, $StoreID = null){
        // $CourseID = Session::get('CourseID');

        $Course = $this->MHD->getCourseData($CourseID);

        //取得所有章節
        $Stories = Stories::where('CourseID',$CourseID)->orderBy('Priority')->get();

        //取得知識點(依照章節分)
        $Knowledges = $this->MHD->getKnowledgesData($CourseID,$StoreID);

        //取得目前章節名稱
        if($StoreID==null){
            $StoreTitle = '全';
        }else{
            $Store = Stories::where('StoryID',$StoreID)->get();
            $StoreTitle = $Store['0']['StoryName'];
        
        }

        $data = array('Course'=>$Course,'Stories'=>$Stories,'Knowledges'=>$Knowledges,'StoreTitle'=>$StoreTitle);
        //return $data;
        return view('Index',['data'=>$data]);
    }

    public function test($CourseID = null){
        return $this->MHD->getCourseData($CourseID);
    }
    
}
