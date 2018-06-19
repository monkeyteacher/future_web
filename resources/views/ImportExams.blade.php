@extends('layouts.mainLayout')

@section('title','匯入題庫')
	
@section('head_area')
    <link href="{{-- asset('css/BaseQualitiesAnalysis_css.css') --}}" rel="stylesheet">
@stop

@section('content')

<div class="right_side">
    <h1 class="right_side_title">匯入題庫</h1>
    <form class="form-inline" method="POST" action="{{ Route('PostExcel') }}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="exampleInputEmail1">匯入題庫</label>
            <input type="file" class="form-control" id="ExamsExcel" name='ExamsExcel' placeholder="匯入題庫">
        </div>
        <button type="submit" class="btn btn-default">送出</button>
    </form>
    @if(count($ExcelContent)!= null)
        <div class="alert alert-warning" role="alert">
            <p>請確認匯入題庫內容</p>
            <form method="POST" action="{{ Route('ExamsInsert') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="file_name" value="{{ $file_name }}">
                <button type="submit" class="btn btn-warning">確認完畢</button>
            </form>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">知識點</h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <tr>
                        <th class="col-lg-1">編號</th>
                        <th class="col-lg-2">知識主題</th>
                        <th class="col-lg-3">主題簡述</th>
                        <th class="col-lg-4">資料提供</th>
                        <th class="col-lg-2">對應題號</th>
                    </tr>
                    @for($i=0;$i<count($ExcelContent['KnowNodes']);$i++)
                        <tr>
                            <td>{{ !is_null($ExcelContent['KnowNodes'][$i]['編號'])?$ExcelContent['KnowNodes'][$i]['編號']:'資料格式錯誤' }}</td>
                            <td>{{ !is_null($ExcelContent['KnowNodes'][$i]['知識主題'])?$ExcelContent['KnowNodes'][$i]['知識主題']:'資料格式錯誤' }}</td>
                            <td>{{ !is_null($ExcelContent['KnowNodes'][$i]['主題簡述'])?$ExcelContent['KnowNodes'][$i]['主題簡述']:'資料格式錯誤' }}</td>
                            <td>{{ !is_null($ExcelContent['KnowNodes'][$i]['資料提供'])?$ExcelContent['KnowNodes'][$i]['資料提供']:'資料格式錯誤' }}</td>
                            <td>{{ !is_null($ExcelContent['KnowNodes'][$i]['對應題號'])?$ExcelContent['KnowNodes'][$i]['對應題號']:'資料格式錯誤' }}</td>
                        </tr>
                    @endfor
                </table>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">題庫</h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <tr>
                        <th class="col-lg-1">基本素養</th>
                        <th class="col-lg-2">素養能力</th>
                        <th class="col-lg-3">題目</th>
                        <th class="col-lg-1">題號</th>
                        <th class="col-lg-4">選答</th>
                        <th class="col-lg-1">正確答案</th>
                    </tr>
                    @for($i=0;$i<count($ExcelContent['Exams']);$i++)
                        <tr>
                            <td>{{ $ExcelContent['Exams'][$i]['BaseName'] }}</td>
                            <td>{{ $ExcelContent['Exams'][$i]['AbilityName'] }}</td>
                            <td>{{ $ExcelContent['Exams'][$i]['Exam'] }}</td>
                            <td>{{ $ExcelContent['Exams'][$i]['ExamsSNum'] }}</td>
                            <td>{{ $ExcelContent['Exams'][$i]['ExamAnswers'] }}</td>
                            <td>{{ $ExcelContent['Exams'][$i]['TrueAnswer'] }}</td>
                        </tr>
                    @endfor
                </table>
            </div>
        </div>
    @endif
    
    
</div>


{{--  @if(count($AbilityData))
    
@endif  --}}
@stop