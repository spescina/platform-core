@include('pangea-core::blocks/form/parts/label')
<div class="col-sm-{{ $attributes['fieldWidth'] }}">
    @yield('field')
</div>
@include('pangea-core::blocks/form/parts/help')