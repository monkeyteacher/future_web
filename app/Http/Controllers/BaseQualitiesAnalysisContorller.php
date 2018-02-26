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

    public function index($AbilityData = null){
        $BaseQualitiesData = $this->BQAD->getBaseQualitiesData();
        //return $AbilityData;
        //return $BaseQualitiesData;
        //$data = array('BaseQualitiesData'=>$BaseQualitiesData);
        return view('BaseQualitiesAnalysis',['data'=>$BaseQualitiesData,'AbilityData'=>$AbilityData]);
    }

    public function getAbilityData($AbilityID){
        $AbilityData = $this->BQAD->getAbilityData($AbilityID);
        //return $AbilityData;
        return $this->index($AbilityData);
    }
}
