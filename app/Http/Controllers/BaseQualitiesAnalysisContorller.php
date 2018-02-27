<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataCollation\BaseQualitiesAnalysisData;

class BaseQualitiesAnalysisContorller extends Controller
{
    //
    private $BQAD;

    public function __construct(BaseQualitiesAnalysisData $BQAD){
        $this->BQAD = $BQAD;
    }

    public function index(){
        $BaseQualitiesData = $this->BQAD->getBaseQualitiesData();
        return view('BaseQualitiesAnalysis',['data'=>$BaseQualitiesData]);
    }

    public function getBaseQulitiesChart(){
        $BaseQualitiesChartData = $this->BQAD->getBaseQulitiesChart();
        return $BaseQualitiesChartData;
    }

    public function getAbilityData(Request $Request){
        $AbilityID = $Request->input('AbilityID');
        $AbilityData = $this->BQAD->getAbilityData($AbilityID);
        return $AbilityData;
    }
}
