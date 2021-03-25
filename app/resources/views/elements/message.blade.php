@foreach (['danger', 'warning', 'success', 'info'] as $key)
    @if(session()->has($key))
        <p class="alert alert-{{ $key }}">{{ session()->get($key) }}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></p>
    @endif
@endforeach