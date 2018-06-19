@extends('layouts.mainLayout')

@section('title','知識點分析')
	
@section('head_area')
    <link href="{{ asset('css/KnowledgeAnalysis_css.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="right_side">
    <h1 class="right_side_title">知識點分析</h1>
    <div class="row form_div">
        <form method="POST" action="{{ Route('postKnowledgeData') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-md-6">
                <h3>知識點</h3>
                <select name='KnowID' class="form-control" id="Knowledges_node">
                    @for($i=0;$i<count($data['Knowledges']);$i++)
                        @if($data['Knowledges'][$i]['KnowID'] == $data['KnowledgeData'][0]['KnowID'])
                        <option value="{{ $data['Knowledges'][$i]['KnowID'] }}" selected>{{ $data['Knowledges'][$i]['KnowName'] }}</option>
                        @else
                        <option value="{{ $data['Knowledges'][$i]['KnowID'] }}" >{{ $data['Knowledges'][$i]['KnowName'] }}</option>
                        @endif
                    @endfor
                </select>
                <button type="submit" class="btn btn-default btn_sent text-center" style="bottom: 0; position: relative;">確認</button>
            </div>
            {{--  <div class="col-md-6">
                <h3>學號</h3>
                <input type="StuID" class="form-control" id="stuID" placeholder="輸入學號">
            </div>  --}}
        </form>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="9" class="text-center" id="Know_node">{{ $data['KnowledgeData'][0]['KnowName'] }}</th>
                </tr>
                <tr>
                    <th class="text-center">編號</th>
                    <th class="text-center">學號</th>
                    <th class="text-center">名字</th>
                    <th class="text-center">進行關卡次數</th>
                    <th class="text-center">目前進度</th>
                    <th class="text-center">時間</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="CountKnowledgeHistory">
                @for($i=0;$i<count($data['KnowledgeData']); $i++)
                    @if($data['status']=='STU'&&$data['KnowledgeData'][$i]['MemberID']==$data['MemberID'])
                        <tr>
                            <th class="text-center">{{ $i+1 }}</th>
                            <th class="text-center">{{ $data['KnowledgeData'][$i]['MemberID'] }}</th>
                            <th class="text-center">{{ $data['KnowledgeData'][$i]['Name'] }}</th>
                            <th class="text-center">{{ $data['KnowledgeData'][$i]['round'] }}</th>
                            <th class="text-center">{{ $data['KnowledgeData'][$i]['isClear']?'成功':'未成功' }}</th>
                            <th class="text-center">{{ date('Y-m-d H:i:s',strtotime(str_replace('-','/', $data['KnowledgeData'][$i]['Time']))) }}</th>
                            <th class="text-center"><a href="{{ route('getStudentData',['KnowID'=>$data['KnowledgeData'][$i]['KnowID'],'MemberID'=>$data['KnowledgeData'][$i]['MemberID']]) }}">[查看詳細分析]</a></th>
                        </tr>
                    @elseif($data['status']=='STU'&&$data['KnowledgeData'][$i]['MemberID']!=$data['MemberID'])
                        <tr>
                            <th class="text-center">{{ $i+1 }}</th>
                            <th class="text-center">***</th>
                            <th class="text-center">***</th>
                            <th class="text-center">{{ $data['KnowledgeData'][$i]['round'] }}</th>
                            <th class="text-center">{{ $data['KnowledgeData'][$i]['isClear']?'成功':'未成功' }}</th>
                            <th class="text-center">{{ date('Y-m-d H:i:s',strtotime(str_replace('-','/', $data['KnowledgeData'][$i]['Time']))) }}</th>
                            <th class="text-center"><a href="#"</th>
                        </tr>
                    @elseif($data['status']=='TA')
                        <tr>
                            <th class="text-center">{{ $i+1 }}</th>
                            <th class="text-center">{{ $data['KnowledgeData'][$i]['MemberID'] }}</th>
                            <th class="text-center">{{ $data['KnowledgeData'][$i]['Name'] }}</th>
                            <th class="text-center">{{ $data['KnowledgeData'][$i]['round'] }}</th>
                            <th class="text-center">{{ $data['KnowledgeData'][$i]['isClear']?'成功':'未成功' }}</th>
                            <th class="text-center">{{ date('Y-m-d H:i:s',strtotime(str_replace('-','/', $data['KnowledgeData'][$i]['Time']))) }}</th>
                            <th class="text-center"><a href="{{ route('getStudentData',['KnowID'=>$data['KnowledgeData'][$i]['KnowID'],'MemberID'=>$data['KnowledgeData'][$i]['MemberID']]) }}">[查看詳細分析]</a></th>
                        </tr>
                    @endif
                @endfor
            </tbody>
        </table>
    </div>
    @if(count($data['StudentData']))
        @include('partials.studentAnalysis')
    @endif

    @if(count($data['ExamsData']))
        @include('partials.ExamsDataMessage')
    @endif
</div>

<script>
        var correctCount = 0;
        var errorCount = 0;
        
        $(document).ready(function () {
            init();
            $('.message_close').click(function(){
                $('#myModal').hide();
            });
        });
    
        function init(){
            $('.correctCount').each(function(){
                correctCount = correctCount + parseInt($(this).text());
            });
            $('.errorCount').each(function(){
                errorCount = errorCount + parseInt($(this).text());
            });
    
            var pieData = [{
                        value: correctCount,
                        color:"#46BFBD",
                        highlight: "#5AD3D1",
                        label: "正確答題數"
                    },
                    {
                        value: errorCount,
                        color: "#F7464A",
                        highlight: "#FF5A5E",
                        label: "錯誤答題數"
                    }]
    
                
            var pie = $("#my_chart").get(0).getContext("2d");
            myChartPie = new Chart(pie).Pie(pieData, {
                responsive: true
            });
            $('html,body').animate({ scrollTop: $('.scrollTop').offset().top }, 300);
        }
    </script>
@stop