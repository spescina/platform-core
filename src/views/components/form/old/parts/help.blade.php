@if (\Lang::has(\Pangea::getModelName().'.help.'.$name))
<div class="col-sm-4">
	<button type="button" class="btn btn-info inline-help" title="{{ \Lang::get(\Pangea::getModelName().'.help.'.$name) }}">?</button>
</div>
@endif