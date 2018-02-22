<h1 class="right_side_title">學生分析</h1>
<div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="7" class="text-center" id="title_KnowledgeHistory">{{ $data['StudentData'][0]['MemberID'] }}學生 - {{ $data['KnowledgeData'][0]['KnowName'] }}</th>
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
            @for($i=0; $i<count($data['StudentData']); $i++)
                <tr>
                    <td class="text-center">{{ $data['StudentData'][$i]['Round'] }}</td>
                    <td class="text-center correctCount">{{ $data['StudentData'][$i]['CorrectCount'] }}</td>
                    <td class="text-center errorCount">{{ $data['StudentData'][$i]['ErrorCount'] }}</td>
                    <td class="text-center">{{ $data['StudentData'][$i]['IsClear']?'通過':'未通過' }}</td>
                <td colspan="3" class="text-right"><a href="{{ route('getExamsData',['KnowID'=>$data['KnowledgeData'][0]['KnowID'],'MemberID'=>$data['StudentData'][$i]['MemberID'],'Round'=>$data['StudentData'][$i]['Round']]) }}">[列出答題詳細]</a></td>
                </tr>
            @endfor
    </table>
</div>
<div class="my_chart_bar scrollTop">
    <h1 class="right_side_title">學生答題狀況統計圖表</h1>
    <h3>藍色:正確答題數比例,  紅色：錯誤答題數比例</h3>
    <div style="width: 75%">
        <canvas id="my_chart"></canvas>
    </div>
</div>