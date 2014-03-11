@extends ('platform-core::components/form/fields/base-field')

@section ('field')
@foreach ($obj->entries() as $label => $value)
<div class="radio">
	<label>
	{{ Form::radio($obj->slug(), $value, $obj->equal($value)) }}
	</label>
	{{ $obj->localize($label) }}
</div>
@endforeach
@overwrite