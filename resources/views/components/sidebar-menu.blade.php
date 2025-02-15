@props(['route' => '', 'type' => ''])


{{-- @switch($type)
    @case('admin')
        <a href="{{ route($route) }}"
            class="{{ Request::routeIs($route . '*') ? 'flex items-center gap-2 px-5 py-5 w-full border-r-8 border-custom-red font-semibold text-custom-red cursor-pointer hover:bg-gray-100' : 'hover:bg-gray-100 flex items-center gap-2 px-5 py-5 w-full border-white font-semibold text-gray-500 cursor-pointer' }}">
            {{ $slot }}
        </a>
    @break

    @case('intern')
        <a href="{{ route($route) }}"
            class="{{ Request::routeIs($route . '*') ? 'border-custom-red text-custom-red py-5 px-7 border-l-4 flex items-center gap-2 font-semibold' : 'text-gray-600 border-white cursor-pointer font-semibold py-5 px-7 border-l-4 flex items-center gap-2' }}">
            {{ $slot }}
        </a>
    @break
@endswitch --}}

<a href="{{ route($route) }}"
    class="{{ Request::routeIs($route . '*') ? 'flex items-center gap-2 px-7 py-5 w-full border-r-8 border-custom-red font-semibold text-custom-red cursor-pointer hover:bg-gray-100' : 'hover:bg-gray-100 flex items-center gap-2 px-7 py-5 w-full border-white font-semibold text-gray-500 cursor-pointer' }}">
    {{ $slot }}
</a>
