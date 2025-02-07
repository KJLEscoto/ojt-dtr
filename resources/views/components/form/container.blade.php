@props(['routeName' => 'path-needed', 'method' => 'POST', 'className' => ''])

<form action="{{ route($routeName) }}" method="{{ $method }}" class="{{ $className }}">
    @csrf

    {{ $slot }}
</form>
