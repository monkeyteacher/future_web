<div class="modal ExamDataMessage" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                        <th class="text-center col-xs-10">題目</th>
                        <th class="text-center col-xs-2">是否正確</th>
                    </tr>
                    <tbody id="ExamHistory">
                        @for($i = 0;$i<count($data['ExamsData']);$i++)
                            <tr>
                                <td class="text-center">{{ $data['ExamsData'][$i]['ExamContent'] }}</td>
                                <td class="text-center">{{ $data['ExamsData'][$i]['IsCorrect']?'正確':'錯誤' }}</td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default message_close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>