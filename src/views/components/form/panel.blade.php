@if ( $obj->isMain() )
<div class="tab-pane active" id="{{ $obj->slug() }}">
@else
<div class="tab-pane" id="{{ $obj->slug() }}">
@endif
<?/*@foreach ($structure as $fieldName => $fieldAttributes)
<div class="form-group">
{{ \PangeaHtml::create($fieldName, $fieldAttributes)->show() }}
</div>
@endforeach*/?>
</div>
