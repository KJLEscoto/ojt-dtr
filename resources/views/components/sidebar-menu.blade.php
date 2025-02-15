@props(['route' => ''])

<a href="{{ route($route) }}"
    class="{{ Request::routeIs($route . '*') ? 'flex items-center gap-2 px-5 py-5 w-full border-r-8 border-custom-red font-semibold text-custom-red cursor-pointer' : 'flex items-center gap-2 px-5 py-5 w-full border-r-8 border-white font-semibold text-gray-500 cursor-pointer' }}">
    {{ $slot }}
</a>
