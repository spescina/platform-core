<footer></footer>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">{{ PPage::i18n_ui('delete_record') }}</h4>
			</div>
			<div class="modal-body">
				<p>{{ PPage::i18n_ui('delete_record_confirm_text') }}</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">{{ PPage::i18n_ui('button_cancel') }}</button>
				<button id="deleteConfirm" type="button" class="btn btn-primary">{{ PPage::i18n_ui('button_confirm') }}</button>
			</div>
		</div>
	</div>
</div>