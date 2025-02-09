{{-- scanner modal --}}
<x-modal.scanner id="scanner-modal" />

<x-main-layout>
    <main class="container mx-auto max-w-screen-xl">
        <div class="flex flex-col gap-10 w-full h-auto">

            <div class="w-full gap-2 flex items-center justify-start">
                <x-button primary label="Open QR Scanner" button openModal="scanner-modal"
                    leftIcon="iconamoon--scanner-fill" className="px-7 modal-button" />
            </div>

            @php
                $totals = [
                    ['label' => 'Total Scans', 'number' => rand(20, 40)],
                    ['label' => 'Time In', 'number' => rand(20, 40)],
                    ['label' => 'Time Out', 'number' => rand(20, 40)],
                    ['label' => 'Registered Users', 'number' => rand(20, 40)],
                ];
            @endphp

            <div class="grid grid-cols-2 gap-5 w-full h-auto">
                @foreach ($totals as $total)
                    <section class="p-5 w-full flex justify-between h-full border bg-white border-gray-200 rounded-xl">
                        <h1 class="font-semibold text-sm">{{ $total['label'] }}</h1>
                        <p class="font-bold text-xl text-custom-red">{{ $total['number'] }}</p>
                    </section>
                @endforeach
            </div>

            <div class="w-full h-full">
                <section class="p-5 w-full border bg-white border-gray-200 rounded-xl h-[500px] space-y-5">
                    <div class="flex items-center gap-2 text-custom-red font-semibold">
                        <span class="cuida--user-add-outline"></span>
                        <p class="font-semibold text-lg">Recently Added Users</p>
                    </div>
                    <div class="h-[90%] w-full bg-white overflow-y-auto border border-gray-100 rounded-md">
                        @for ($i = 1; $i <= 12; $i++)
                            <section class="px-7 py-5 w-full flex justify-between items-center even:bg-custom-orange/5">
                                <div class="flex items-center gap-5">
                                    <x-image className="w-12 h-12 rounded-full border border-custom-orange"
                                        path="resources/img/default-male.png" />
                                    <h1 class="font-semibold">Full Name</h1>
                                </div>
                                <p>1 min ago</p>
                            </section>
                        @endfor
                    </div>
                </section>
            </div>
        </div>
    </main>
</x-main-layout>
