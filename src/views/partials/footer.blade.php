<footer></footer>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">{{ \Lang::get('ui.delete_record') }}</h4>
            </div>
            <div class="modal-body">
                <p>{{ \Lang::get('ui.delete_confirm_record_text') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ \Lang::get('ui.button_cancel') }}</button>
                <button id="deleteConfirm" type="button" class="btn btn-primary">{{ \Lang::get('ui.button_confirm') }}</button>
            </div>
        </div>
    </div>
</div>