<div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <ul>
                @foreach ($items as $item)
                <li>{{ $item }}</li>
                @endforeach
        </ul>
</div>