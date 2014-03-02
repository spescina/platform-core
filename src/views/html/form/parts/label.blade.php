@if ($attributes['label'])
<label for="{{ $name }}" class="col-sm-{{ $attributes['labelWidth'] }} control-label">{{ $attributes['label'] }}</label>
@else
<label for="{{ $name }}" class="col-sm-{{ $attributes['labelWidth'] }} control-label">{{ \Lang::get(\Pangea::getModelName().'.form.'.$name) }}</label>
@endif
