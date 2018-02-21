@extends('layouts.mainLayout')

@section('title','知識點分析')
	
@section('head_area')
    <link href="{{ asset('css/page2_css.css') }}" rel="stylesheet">
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
                        <option value="{{ $data['Knowledges'][$i]['KnowID'] }}" >{{ $data['Knowledges'][$i]['KnowName'] }}</option>
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
                    <th colspan="9" class="text-center" id="Know_node">綠色經濟的實踐</th>
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
                    <tr>
                        <th class="text-center">{{ $i+1 }}</th>
                        <th class="text-center">{{ $data['KnowledgeData'][$i]['MemberID'] }}</th>
                        <th class="text-center">{{ $data['KnowledgeData'][$i]['Name'] }}</th>
                        <th class="text-center">{{ $data['KnowledgeData'][$i]['round'] }}</th>
                        <th class="text-center">{{ $data['KnowledgeData'][$i]['isClear'] }}</th>
                        <th class="text-center">{{ date('Y-m-d H:i:s',strtotime(str_replace('-','/', $data['KnowledgeData'][$i]['Time']))) }}</th>
                        <th class="text-center"><a href="#">[查看詳細分析]</a></th>
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
    <h1 class="right_side_title">學生分析</h1>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="7" class="text-center" id="title_KnowledgeHistory">4XXXXXXX1學生A - 綠色經濟的實踐</th>
                </tr>
                <tr>
                    <th class="text-center">回合</th>
                    <th class="text-center">正確答題數</th>
                    <th class="text-center">錯誤答題數</th>
                    <th class="text-center">狀態</th>
                    <th colspan="3"></th>
                </tr>
            </thead>
            <tbody id="KnowledgeHistory">
                <tr>
                    <td class="text-center ">1</td>
                    <td class="text-center">1</td>
                    <td class="text-center">4</td>
                    <td class="text-center">成功</td>
                    <td colspan="3" class="text-right"><a href="#">[列出答題詳細]</a></td>
                </tr>
           
        </table>
    </div>
    <div class="my_chart_bar">
        <h1 class="right_side_title">學生答題狀況統計圖表</h1>
        <h3>藍色:正確答題數比例,  紅色：錯誤答題數比例</h3>
        <div style="width: 75%">
            <canvas id="my_chart"></canvas>
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">答題詳細</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <th></th>
                        <th colspan="5" class="text-center">題目</th>
                        <th class="text-center">是否正確</th>
                    </tr>
                    <tbody id="ExamHistory">
                        <tr>
                            <th colspan="5" class="text-center">綠色經濟學強調「經濟」應具…(略)</th>
                            <th class="text-center">錯誤</th>
                        </tr>
                        <tr>
                            <th colspan="5" class="text-center">在香港的｢食得好｣計畫中，居民…(略)</th>
                            <th class="text-center">正確</th>
                        </tr>
                        <tr>
                            <th colspan="5" class="text-center">樸門永續文化（Permaculture）經…(略)</th>
                            <th class="text-center">錯誤</th>
                        </tr>
                        <tr>
                            <th colspan="5" class="text-center">從綠色經濟的角度來看，當我們…(略)</th>
                            <th class="text-center">錯誤</th>
                        </tr>
                        <tr>
                            <th colspan="5" class="text-center">經濟（economy）一詞，來源於oikonomia一字…(略)</th>
                            <th class="text-center">錯誤</th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@stop