@props(['imgPath' => '', 'routePath' => '', 'title', 'desc', 'btnLabel' => ''])

<div class="relative md:h-screen h-full p-5 bg-cover bg-center bg-no-repeat"
    style="background-image: url('{{ $imgPath }}');">
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-custom-orange via-custom-orange/90 to-custom-red opacity-80">
    </div>

    <!-- Content Section (Ensures text stays above the overlay) -->
    <section class="relative flex flex-col gap-5 items-center justify-center h-full text-white text-center">
        <h1 class="lg:text-4xl sm:text-2xl text-xl font-bold">{{ $title }}</h1>
        <p class="lg:text-lg md:text-base text-sm">{{ $desc }}</p>
        <x-button secondary button label="{{ $btnLabel }}" routePath="{{ $routePath }}" />
    </section>
</div>
