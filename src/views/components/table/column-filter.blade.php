@if ( $obj->isFilterable() )
<div class="input-group">
	<input type="text" name="{{ $obj->field() }}" class="input-xs" value="{{ $obj->value() }}" placeholder="{{ $obj->i18n() }}" />
</div>
@endif