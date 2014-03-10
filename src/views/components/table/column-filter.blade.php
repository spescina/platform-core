@if ( $obj->isFilterable() )
<input type="text" name="{{ $obj->field() }}" class="form-control input-sm" value="{{ $obj->value() }}" placeholder="{{ $obj->i18n() }}" />
@endif