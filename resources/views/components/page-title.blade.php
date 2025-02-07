@props(['title' => 'title here', 'vectorClass' => 'h-5', 'titleClass' => 'text-3xl'])

<div class="flex items-center gap-2 select-none">
    <x-image path="resources/img/vector_icon.png" className="w-auto {{ $vectorClass }}" />
    <h1 class="font-bold uppercase {{ $titleClass }}">
        {{ $title }}
    </h1>
</div>
