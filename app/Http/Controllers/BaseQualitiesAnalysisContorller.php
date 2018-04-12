<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataCollation\BaseQualitiesAnalysisData;
use Session;
class BaseQualitiesAnalysisContorller extends Controller
{
    //
    private $BQAD;

    public function __construct(BaseQualitiesAnalysisData $BQAD){
        $this->BQAD = $BQAD;
    }

    public function index(){
        $CourseID = Session::get('CourseID');
        $BaseQualitiesData = $this->BQAD->getBaseQualitiesData($CourseID);
        //return $BaseQualitiesData;
        return view('BaseQualitiesAnalysis',['data'=>$BaseQualitiesData]);
    }

    public function getBaseQulitiesChart(){
        $CourseID = Session::get('CourseID');
        $BaseQualitiesChartData = $this->BQAD->getBaseQulitiesChart($CourseID);
        return $BaseQualitiesChartData;
    }

    public function getAbilityData(Request $Request){
        $AbilityID = $Request->input('AbilityID');
        $AbilityData = $this->BQAD->getAbilityData($AbilityID);
        return $AbilityData;
    }
}
