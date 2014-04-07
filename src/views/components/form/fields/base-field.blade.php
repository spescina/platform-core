{{ $obj->label()->show() }}

<div class="col-md-{{ $obj->width() }}">
        @yield ('field')
</div>

@yield ('extra')

@if ( $obj->hasHelp() )
{{ $obj->help()->show() }}
@endif