<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Login');
});

Route::get('excel/export','ExcelController@export');
Route::get('excel/import','ExcelController@import');

Route::get('test',[
    'as'=>'test',
    'uses'=>'ExcelController@test'
]);



Route::get('ImportExams',[
    'as'=>'ImportExams',
    'uses'=>'ExcelController@Index',
]);

Route::post('PostExcel',[
    'as'=>'PostExcel',
    'uses'=>'ExcelController@PostExcel',
]);

Route::Post('ExamsInsert',[
    'as'=>'ExamsInsert',
    'uses'=>'ExcelController@ExamsInsert'
]);


Route::get('Login',[
    'as'=>'Login',
    'uses'=>'LoginController@index'
]);

Route::get('Logout',[
    'as'=>'Logout',
    'uses'=>'LoginController@Logout'
]);

Route::post('PostLogin',[
    'as'=>'PostLogin',
    'uses'=>'LoginController@PostLogin'
]);

Route::get('MainHome/{CourseID?}/{StoreID?}',[
    'as'=>'MainHome',
    'uses'=>'MainHomeController@index'
]);

Route::get('KnowledgeAnalysis/{KnowID?}',[
    'as'=>'KnowledgeAnalysis',
    'uses'=>'KnowledgeAnalysisController@index'
]);

Route::post('postKnowledgeData',[
    'as'=>'postKnowledgeData',
    'uses'=>'KnowledgeAnalysisController@postKnowledgeData'    
]);

Route::get('getStudentData/{KnowID?}/{MemberID?}',[
    'as'=>'getStudentData',
    'uses'=>'KnowledgeAnalysisController@getStudentData'    
]);

Route::get('getExamsData/{KnowID?}/{MemberID?}/{Round?}',[
    'as'=>'getExamsData',
    'uses'=>'KnowledgeAnalysisController@getExamsData'    
]);

Route::get('BaseQualitiesAnalysis',[
    'as'=>'BaseQualitiesAnalysis',
    'uses'=>'BaseQualitiesAnalysisContorller@index'
]);

Route::post('getAbilityData',[
    'as'=>'getAbilityData',
    'uses'=>'BaseQualitiesAnalysisContorller@getAbilityData'
]);

Route::get('getBaseQulitiesChart',[
    'as'=>'getBaseQulitiesChart',
    'uses'=>'BaseQualitiesAnalysisContorller@getBaseQulitiesChart'
]);



