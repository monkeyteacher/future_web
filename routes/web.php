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
    return view('KnowledgeAnalysis');
});

Route::get('test/{KnowID?}',[
    'as'=>'test',
    'uses'=>'KnowledgeAnalysisController@test'
]);

Route::get('MainHome/{CourseID?}/{StoreID?}',[
    'as'=>'MainHome',
    'uses'=>'MainHomeController@index'
]);

Route::get('KnowledgeAnalysis/{KnowID?}',[
    'as'=>'KnowledgeAnalysis',
    'uses'=>'KnowledgeAnalysisController@index'
]);

Route::get('getStudentData/{KnowID?}/{MemberID?}',[
    'as'=>'getStudentData',
    'uses'=>'KnowledgeAnalysisController@getStudentData'    
]);

Route::get('getExamsData/{KnowID?}/{MemberID?}/{Round?}',[
    'as'=>'getExamsData',
    'uses'=>'KnowledgeAnalysisController@getExamsData'    
]);

Route::post('postKnowledgeData',[
    'as'=>'postKnowledgeData',
    'uses'=>'KnowledgeAnalysisController@postKnowledgeData'    
]);


