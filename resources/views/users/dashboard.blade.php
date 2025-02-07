<span>
    <x-modal.qr-code id="qr-code-modal" />
</span>

<x-main-layout>
    <main class="grid grid-cols-12">

        {{-- intern content --}}
        <div class="col-span-8 h-full w-full bg-gray-100">
            <div class="container mx-auto max-w-screen-xl">
                <div class="min-h-screen h-full px-14 py-20 space-y-7">
                    <div class="flex gap-7 w-full">
                        <section
                            class="p-10 rounded-lg border border-gray-200 bg-white w-full space-y-2 relative overflow-hidden h-full">
                            <!-- Banner Wrapper -->
                            <x-image path="resources/img/banner.jpg"
                                className="w-full h-[55%] z-10 absolute top-0 left-0 inset-0 object-cover" />

                            <div class="relative z-30">
                                <!-- Total Scans Section -->
                                <span class="w-full flex justify-end">
                                    <div
                                        class="flex items-center justify-end gap-2 w-fit text-white bg-gradient-to-r from-custom-orange via-custom-orange/90 to-custom-red px-3 py-2 rounded-lg select-none">
                                        <span class="fluent--scan-qr-code-24-filled"></span>
                                        <h1 class="font-semibold">Total Scans</h1>
                                        <p class="px-2 py-1 rounded-md border font-semibold bg-white text-custom-red">
                                            10
                                        </p>
                                    </div>
                                </span>
                                <!-- Profile Section -->
                                <div class="flex items-end gap-10 w-full h-auto">
                                    <section>
                                        <span
                                            class="h-52 w-52 overflow-hidden flex items-center justify-center shadow-md rounded-full ">
                                            <!-- Profile Image -->
                                            <x-image path="resources/img/default-male.png"
                                                className="h-full w-full object-cover rounded-full bg-white" />
                                        </span>
                                    </section>

                                    <section class="grid grid-cols-5 gap-x-2 gap-y-3 items-center">
                                        <span class="fontisto--male text-custom-red col-span-1"></span>
                                        <h1 class="font-bold col-span-4 text-xl">John Doe</h1>
                                        <span class="ic--round-email text-custom-red col-span-1"></span>
                                        <p class="font-medium col-span-4 text-custom-red">johndoe@gmail.com</p>
                                        <span class="solar--phone-bold text-custom-red col-span-1"></span>
                                        <p class="font-medium col-span-4 text-gray-600">+63 9123456789</p>
                                    </section>
                                </div>
                            </div>
                        </section>

                        {{-- small qr code --}}
                        <section
                            class="p-5 rounded-lg border border-gray-200 bg-white w-1/2 h-auto text-center gap-3 flex flex-col items-center justify-center">
                            <h1 class="text-sm font-semibold">YOUR PERSONAL QR CODE</h1>
                            <button data-pd-overlay="#qr-code-modal" data-modal-target="qr-code-modal"
                                data-modal-toggle="qr-code-modal"
                                class=" modal-button h-32 w-32 p-5 overflow-hidden flex items-center justify-center border bg-white rounded-xl border-black cursor-pointer">
                                <x-image path="resources/img/sample-qr.png" className="h-full w-full" />
                            </button>
                            <p class="text-xs font-medium">Click QR to enlarge</p>
                            <x-button tertiary label="Download QR" leftIcon="material-symbols--download-rounded"
                                className="text-sm px-8" />
                        </section>
                    </div>

                    <div class="p-10 rounded-lg border border-gray-200 bg-white w-full space-y-5">
                        <x-page-title title="Additional Information" titleClass="text-xl font-semibold" />
                        <div class="grid grid-cols-4 gap-2 w-full">
                            <h1 class="text-lg font-semibold col-span-1">Address</h1>
                            <p class="text-lg font-normal col-span-3">Davao City</p>
                            <h1 class="text-lg font-semibold col-span-1">School</h1>
                            <p class="text-lg font-normal col-span-3">STI College Davao</p>
                        </div>
                    </div>

                    <div class="p-10 rounded-lg border border-gray-200 bg-white w-full space-y-5">
                        <x-page-title title="Emergency Contact" titleClass="text-xl font-semibold" />
                        <div class="grid grid-cols-4 gap-2 w-full">
                            <h1 class="text-lg font-semibold col-span-1">Name</h1>
                            <p class="text-lg font-normal col-span-3">Johnny Doe</p>
                            <h1 class="text-lg font-semibold col-span-1">Contact No.</h1>
                            <p class="text-lg font-normal col-span-3">+63 9123456789</p>
                            <h1 class="text-lg font-semibold col-span-1">Address</h1>
                            <p class="text-lg font-normal col-span-3">Davao City</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- history --}}
        <div class="col-span-4 fixed top-0 right-0 w-1/3">
            <div class="h-screen bg-gradient-to-r from-custom-orange via-custom-orange/90 to-custom-red w-full">
                <section class="flex flex-col gap-5 h-full text-white items-center px-[10%] pt-40">
                    <div class="flex items-center gap-1 text-3xl">
                        <span class="material-symbols--history-rounded w-8 h-8"></span>
                        <h1 class="font-semibold">Logged History</h1>
                    </div>

                    <div
                        class="h-[75%] w-full rounded-xl bg-white overflow-auto text-black flex flex-col items-start justify-start">
                        @for ($i = 1; $i <= 12; $i++)
                            <section class="px-7 py-5 w-full flex justify-between items-center even:bg-custom-orange/5">
                                <div class="">
                                    <section class="font-bold text-lg">8:00 am</section>
                                    <p class="text-sm font-medium text-gray-700">Feb 1, 2025</p>
                                </div>
                                <div class="text-green-500 flex items-center gap-1 select-none">
                                    <span class="lets-icons--in"></span>
                                    <p>Time in</p>
                                </div>
                                <div class="text-red-500 flex items-center gap-1 select-none">
                                    <span class="lets-icons--out"></span>
                                    <p>Time out</p>
                                </div>
                            </section>
                        @endfor
                    </div>

                    <div class="tracking-wider flex items-center gap-2 select-none">
                        <span class="ic--round-date-range"></span>
                        <p class="">Starting Date:</p>
                        <span class="">Feb 1, 2025</span>
                    </div>
                </section>
            </div>


        </div>
    </main>

</x-main-layout>
