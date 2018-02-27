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
                <tbody id="BaseQuality{{ $data[$i]['BaseID'] }}" class="BaseQualityArea">
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
                            <td class="text-right" colspan="1"><a class="getAbilityData" data-AbilityID="{{ $data[$i]['QualityAbilitiesData'][$j]['AbilityID'] }}" >列出詳細</a></td>
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

@include('partials.AbilityDataMessage')

{{--  @if(count($AbilityData))
    
@endif  --}}

<script>
    $(document).ready(function () {
        init();
        $('.message_close').click(function(){
            $('#myModal').hide();
        });
        $('.BaseQuality_btn').click(function(){
            var BaseID = $(this).attr('id');
            $('#BaseQuality'+BaseID).toggle();
        });
        $('.getAbilityData').click(function(){
            var AbilityID = $(this).attr('data-AbilityID');
            getAbilityData(AbilityID);
        });
    });    

    function init(){
        $('.BaseQualityArea').hide();
        $('#myModal').hide();
        getBaseQulitiesChart();
    }

    function getAbilityData(AbilityID){
        $.ajax({
            url: "{{ route('getAbilityData') }}",
            dataType: "JSON",
            method: "POST",
            data: {
                    AbilityID: AbilityID,
                    _token:'{{ csrf_token() }}',
                },
            success: function(data) {
                //console.log(data); 
                setAbilityData(data);
            },
            error: function(jqXHR) {
                alert("發生錯誤: " + jqXHR.status);
            }
        });
    }

    function getBaseQulitiesChart(){
        $.ajax({
            url: "{{ route('getBaseQulitiesChart') }}",
            dataType: "JSON",
            method: "GET",
            success: function(data) {
                console.log(data); 
                setBaseQulitiesChart(data)
            },
            error: function(jqXHR) {
                alert("發生錯誤: " + jqXHR.status);
            }
        });
    }

    function setAbilityData(data){
        var string = '';
        for(var i=0;i<data.length;i++){
            var AnswerRate = parseInt(data[i]['AnswerRate']*100)+'%';
            var AnswerRate2 = parseInt(data[i]['AnswerRate2']*100)+'%';
            string = string + "<tr>\
                                <th class='text-center' colspan='5'>"+data[i]['ExamContent']+"</th>\
                                <th class='text-center' colspan='1'>"+AnswerRate+"</th>\
                                <th class='text-center' colspan='1'>"+AnswerRate2+"</th>\
                            </tr>";
        }
        $('#ExamHistory').html(string);
        $('#myModal').show();
        //console.log(string);
    }

    function setBaseQulitiesChart(data){
        var labels = new Array();
        var ChartData = new Array();
        var color_Array = new Array();
        for(var i=0;i<data.length;i++){
            labels[i] = data[i]['BaseName'];
            ChartData[i] = data[i]['AnswerRate'];
            if (data[i]['AnswerRate'] < 50) {
                color_Array[i] = "rgba(255,0,0,0.7)";
            } else {
                color_Array[i] = "rgba(151,187,205,0.5)";
            }
        }
        var barChartData = {
            labels: labels,
            datasets: [{
                fillColor: color_Array,
                data: ChartData,
            }]
        }
        var bar = $("#my_chart").get(0).getContext("2d");
        myChartBar = new Chart(bar).Bar(barChartData, {
            responsive: true, 
            barValueSpacing: 80,
            scales: {
                yAxes: [{
                    display: true,
                    ticks: {
                        beginAtZero: true,
                        max: 100
                    }
                }]
            },
        });
    }


</script>

@stop