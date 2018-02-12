@extends('layouts.mainLayout')

@section('title','未來學網站')
	
@section('head_area')
    <link href="{{ asset('css/index_css.css') }}" rel="stylesheet">
@stop

@section('content')
    <div>
        <h1>課程分析</h1>
        <div>
            <table id="stories" class="table table-bordered">
                <tr>
                    <th colspan='{{ count($data['Stories'])+3 }}'>課程列表</th>
                </tr>
                <tr>
                    <th rowspan='{{ count($data['Stories'])+3 }}'>{{ $data['Course'][0]['IsOpen']?'開放':'未開放' }}</th>
                    <th>編號</th>
                    <th colspan='2'>課程名稱</th>
                    <th colspan='2'>學生課程參與次數</th>
                    <th>學生課程完成次數</th>
                    <th>完成率</th>
                    <th><a href= '#'>[新增課程(導入題庫)]</a>
                    </th>
                </tr>
                <tr>
                    <td>{{ $data['Course'][0]['CourseID'] }}</td>
                    <td colspan='2'>{{ $data['Course'][0]['CourseName'] }}</td>
                    <td colspan='2'>{{ $data['Course'][0]['completedNum'] }}</td>
                    <td>{{ $data['Course'][0]['participateNum'] }}</td>
                    <td>{{ (int)($data['Course'][0]['CompletionRate']*100).'%' }}</td>
                    <td class='text-right'><a href='#'>[編輯]</a><a href='#'>[列出章節列表]</a></td>
                </tr>
                <tr>
                    <td>開放</td>
                    <td>編號</td>
                    <td colspan='2'>章節名稱</td>
                    <td colspan='4'></td>
                </tr>
                @for($i=0;$i<count($data['Stories']);$i++)
                    <tr>
                        <td>{{ $data['Stories'][$i]['IsOpen']?'開放':'未開放' }}</td>
                        <td>{{ $data['Stories'][$i]['Priority'] }}</td>
                        <td colspan='2' class='StoryName'>{{ $data['Stories'][$i]['StoryName'] }}</td>
                        <td colspan='4' class='text-right'><a class='stroy_detail' href="{{ route('MainHome',['CourseID'=>$data['Course'][0]['CourseID'],'StoreID'=>$data['Stories'][$i]['StoryID']]) }}">[查看詳細]</a></td>
                    </tr>
                @endfor
            </table>
        </div>
        <div>
            <h1>章節分析</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th id="chapter" colspan="9">章節：{{ $data['StoreTitle'] }}</th>
                    </tr>
                    <tr>
                        <th>開放</th>
                        <th>編號</th>
                        <th>知識點名稱</th>
                        <th>完成人數</th>
                        <th>參與人數</th>
                        <th>學生完成率</th>
                        <th colspan="3">查看詳細分析</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i=0;$i<count($data['Knowledges']);$i++)
                        <tr>
                            <td>{{ $data['Knowledges'][$i]['IsOpen']?'開放':'未開放' }}</td>
                            <td>{{ $data['Knowledges'][$i]['KnowID'] }}</td>
                            <td>{{ $data['Knowledges'][$i]['KnowName'] }}</td>
                            <td>{{ $data['Knowledges'][$i]['completedNum'] }}</td>
                            <td>{{ $data['Knowledges'][$i]['participateNum'] }}</td>
                            <td>{{ (int)($data['Knowledges'][$i]['CompletionRate']*100).'%' }}</td>
                            <td colspan='3' class='text-right'><a href='#'>[查看詳細分析]</a></td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
@stop