@props(['title' => '', 'vectorClass' => 'h-5'])


<div class="flex items-center gap-2">
    <x-image path="resources/img/vector_icon.png" className="w-auto {{ $vectorClass }}" />

    <h1 class="lg:text-2xl text-base font-semibold text-custom-red">{{ $title }}</h1>
</div>
