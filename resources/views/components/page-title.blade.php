@props(['title' => 'title here', 'vectorClass' => 'lg:h-5 h-3', 'titleClass' => ''])

<div class="flex items-center gap-2 select-none">
    <x-image path="resources/img/vector_icon.png" className="w-auto {{ $vectorClass }}" />
    <h1 class="lg:text-xl sm:text-base text-sm font-semibold text-custom-red uppercase {{ $titleClass }}">
        {{ $title }}
    </h1>
</div>
