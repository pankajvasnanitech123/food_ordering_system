@foreach (['danger', 'warning', 'success', 'info'] as $key)
    @if(session()->has($key))
        <p class="alert alert-{{ $key }}">{{ session()->get($key) }}</p>
    @endif
@endforeach