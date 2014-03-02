<a href="?{{ $queryVars }}" title="{{ $label }}">
    {{ $label }}
    @if (!empty($currentIcon))
    <span class="glyphicon glyphicon-{{ $currentIcon }}"></span>
    @endif
</a>