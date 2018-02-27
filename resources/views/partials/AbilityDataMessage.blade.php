<div class="modal AbilityDataMessage" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-backdrop fade in" style="height: 974px;"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close message_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">答題詳細</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <th class='text-center' colspan='5'>題目</th>
                        <th class='text-center' colspan='1'>第一次回答正確比率</th>
                        <th class='text-center' colspan='1'>回答正確率</th>
                    </tr>
                    <tbody id="ExamHistory">
                        {{--  @for($i = 0;$i<count($AbilityData);$i++)
                            <tr>
                                <th class='text-center' colspan='5'>{{ $AbilityData[$i]['ExamContent'] }}</th>
                                <th class='text-center' colspan='1'>{{ (int)($AbilityData[$i]['AnswerRate']*100).'%' }}</th>
                                <th class='text-center' colspan='1'>{{ (int)($AbilityData[$i]['AnswerRate2']*100).'%' }}</th>
                            </tr>
                        @endfor  --}}
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default message_close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>