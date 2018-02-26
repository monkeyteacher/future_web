@extends('layouts.mainLayout')

@section('title','知識點分析')
	
@section('head_area')
    <link href="{{ asset('css/BaseQualitiesAnalysis_css.css') }}" rel="stylesheet">
@stop

@section('content')

<div class="right_side">
    <h1 class="right_side_title">基本素養分析</h1>
    <div>
        <table class="table table-bordered" id="BaseQuality_table">
            <tr>
                <th colspan="9">基本素養：</th>
            </tr>
            <tr>
                <th class="text-center">編號</th>
                <th colspan="5" class="text-center">名稱</th>
                <th colspan="3"></th>
            </tr>
            @for($i=0;$i<count($data);$i++)
                <tr>
                    <td class="text-center">{{ $i+1 }}</td>
                    <td colspan="5" class="text-center">{{ $data[$i]['BaseName'] }}</td>
                    <td colspan="3" class="text-right"><a id='{{ $data[$i]['BaseID'] }}' class="BaseQuality_btn">[列出素養能力]</a></td>
                </tr>
                <tbody id="BaseQuality{{ $data[$i]['BaseID'] }}">
                    <tr>
                        <th rowspan="4"></th>
                        <th class="text-center" colspan="2">素養能力</th>
                        <th class="text-center" colspan="1">考題數量</th>
                        <th class="text-center" colspan="2">平均第一次回答正確比率</th>
                        <th class="text-center" colspan="2">平均回答正確率</th>
                        <th colspan="1"></th>
                    </tr>
                    @for($j=0;$j<count($data[$i]['QualityAbilitiesData']);$j++)
                        <tr>
                            <td class="text-center" colspan="2">{{ $data[$i]['QualityAbilitiesData'][$j]['AbilityName'] }}</td>
                            <td class="text-center" colspan="1">{{ $data[$i]['QualityAbilitiesData'][$j]['num'] }}</td>
                            <td class="text-center" colspan="2">{{ (int)($data[$i]['QualityAbilitiesData'][$j]['AnswerRate']*100).'%' }}</td>
                            <td class="text-center" colspan="2">{{ (int)($data[$i]['QualityAbilitiesData'][$j]['AnswerRate2']*100).'%' }}</td>
                            <td class="text-right" colspan="1"><a href="{{ route('getAbilityData',['AbilityID'=>$data[$i]['QualityAbilitiesData'][$j]['AbilityID']]) }}" >列出詳細</a></td>
                        </tr>
                    @endfor
                </tbody>
            @endfor
            
        </table>
    </div>
    <div class="my_chart_bar">
        <h1 class="right_side_title">基本素養分析圖表</h1>
        <h3>計算方式：各基本素養 = 每一題答對人數的總和 / 人數 X 題數</h3>
        <div style="width: 75%">
            <canvas id="my_chart"></canvas>
        </div>
        
    </div>
</div>

@if(count($AbilityData))
    @include('partials.AbilityDataMessage')
@endif

<script>
    $(document).ready(function () {
        $('.message_close').click(function(){
            $('#myModal').hide();
        });
        $('.BaseQuality_btn').click(function(){
            var BaseID = $(this).attr('id');
            $('#BaseQuality'+BaseID).toggle();
        });
    });    
</script>

@stop