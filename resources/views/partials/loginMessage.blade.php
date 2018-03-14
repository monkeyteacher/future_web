<div class="modal LoginMessage" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-backdrop fade in" style="height: 974px;"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close message_close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Login Message</h4>
            </div>
            <div class="modal-body LoginMessageText">
                {{ $message }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default message_close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>