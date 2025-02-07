{{-- scanner modal --}}
<x-modal.scanner id="scanner-modal" />

<x-main-layout>
    <main class="container mx-auto max-w-screen-xl">
        <div class="flex flex-col gap-10 w-full h-auto">

            <div class="w-full gap-2 flex items-center justify-start">
                <x-button primary label="Open Scanner" button openModal="scanner-modal" leftIcon="iconamoon--scanner-fill"
                    className="px-7 modal-button" />
            </div>

            <section class="grid grid-cols-2 gap-10 w-full h-full">

                <div class="grid grid-cols-2 gap-5 w-full h-auto">
                    @for ($i = 1; $i <= 4; $i++)
                        <section class="p-5 w-full h-full border bg-white border-gray-200 rounded-xl">
                            <h1 class="font-semibold text-sm">Totals</h1>
                            <p class="font-bold text-xl text-custom-red">0</p>
                        </section>
                    @endfor
                </div>

                <div class="w-full h-full">
                    <div class="p-5 rounded-xl border border-gray-200 bg-white h-full w-full space-y-5">
                        <section class="flex gap-2 items-center text-custom-red">
                            <span class="hugeicons--champion"></span>
                            <p class="font-semibold text-lg">Monthly Performer</p>
                        </section>

                        <!--HTML CODE-->
                        <div class="w-full relative h-full">
                            <div class="swiper progress-slide-carousel swiper-container relative">
                                <div class="swiper-wrapper">
                                    @for ($i = 1; $i <= 3; $i++)
                                        <div class="swiper-slide">
                                            <div
                                                class="bg-custom-orange/5 rounded-md py-10 h-full flex justify-center items-center">
                                                <span class="text-xl font-semibold text-custom-red">
                                                    Intern {{ $i }} </span>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                                <div class="swiper-pagination !bottom-5 !top-auto !w-80 right-0 mx-auto bg-gray-100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full h-full ">
                    <section
                        class="p-5 w-full border bg-white border-gray-200 rounded-xl h-[500px] overflow-hidden space-y-5">
                        <div class="flex items-center gap-2 text-custom-red font-semibold">
                            <span class="material-symbols--co-present-outline"></span>
                            <p class="font-semibold text-lg">Daily Attendance</p>
                        </div>
                        <div class="h-[90%] w-full bg-white overflow-y-auto border border-gray-100 rounded-md">
                            @for ($i = 1; $i <= 12; $i++)
                                <section
                                    class="px-7 py-5 w-full flex justify-between items-center even:bg-custom-orange/5">
                                    <div class="flex items-center gap-5">
                                        <x-image className="w-12 h-12 rounded-full"
                                            path="resources/img/default-male.png" />
                                        <div>
                                            <section class="font-bold text-custom-red text-lg">8:00 am</section>
                                            <p class="text-sm font-medium text-gray-700">Feb 1, 2025</p>
                                        </div>
                                    </div>
                                    <div class="text-green-500 flex  items-center gap-1 select-none">
                                        <span class="lets-icons--in"></span>
                                        <p>Time in</p>
                                    </div>
                                    {{-- <div class="text-red-500 flex items-center gap-1 select-none">
                                        <span class="lets-icons--out"></span>
                                        <p>Time out</p>
                                    </div> --}}
                                </section>
                            @endfor
                        </div>
                    </section>
                </div>

                <div class="w-full h-full">
                    <section class="p-5 w-full border bg-white border-gray-200 rounded-xl h-[500px]">
                        <div class="flex items-center gap-2 text-custom-red font-semibold">
                            <span class="cuida--user-add-outline"></span>
                            <p class="font-semibold text-lg">Recently Added Users</p>
                        </div>

                    </section>
                </div>
            </section>
        </div>
    </main>
</x-main-layout>

<style>
    /* CSS Code */
    .swiper-wrapper {
        width: 100%;
        height: max-content !important;
        padding-bottom: 64px !important;
        -webkit-transition-timing-function: linear !important;
        transition-timing-function: linear !important;
        position: relative;
    }

    .swiper-pagination-progressbar .swiper-pagination-progressbar-fill {
        background: #F57D11 !important;
    }
</style>

<!--JAVASCRIPT CODE-->
<script>
    var swiper = new Swiper(".progress-slide-carousel", {
        loop: true,
        fraction: true,
        autoplay: {
            delay: 1200,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".progress-slide-carousel .swiper-pagination",
            type: "progressbar",
        },
    });
</script>
