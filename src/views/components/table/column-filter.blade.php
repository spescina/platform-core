@if ( $obj->isFilterable() )
<div class="input-group input-group-sm">
	<input type="text" name="{{ $obj->field() }}" class="form-control input-xs" value="{{ $obj->value() }}" placeholder="{{ $obj->i18n() }}" />
	<div class="input-group-btn">
		<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">Equal <span class="caret"></span></button>
		<ul class="dropdown-menu pull-right">
			<li><a href="#">Equal</a></li>
			<li><a href="#">Contains</a></li>
		</ul>
	</div>
</div>
@endif