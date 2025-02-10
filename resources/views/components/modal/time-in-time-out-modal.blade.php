@props(['id' => ''])

{{-- confirmation --}}
<div id="{{ $id }}" class="pd-overlay hidden">
    <div
        class="w-full h-full fixed top-0 left-0 z-[100] flex items-center justify-center  overflow-x-hidden overflow-y-auto bg-black bg-opacity-70">
        <div
            class="w-1/3 flex items-center justify-center p-10 transition-all ease-out opacity-0 sm:mx-auto modal-open:opacity-100 modal-open:duration-500">
            <div class="flex flex-col items-center w-full p-10 gap-5 bg-white rounded-2xl">
                <x-page-title title="User Details Found" titleClass="text-xl" />
                <div class="w-fit">
                    <x-image className="w-40 h-40 rounded-full border border-custom-orange"
                        path="resources/img/default-male.png" />
                </div>
                <div class="text-center space-y-1">
                    <h1 class="font-semibold text-xl">Full Name</h1>
                    <p class="text-custom-orange">user email</p>
                </div>

                @php
                    $details = [
                        ['label' => 'Student No.', 'value' => '02-134523-223'],
                        ['label' => 'Phone', 'value' => '+63 9123456789'],
                        ['label' => 'QR Code', 'value' => 'dpsfkf_3jnf_34'],
                        ['label' => 'Total Hours', 'value' => '30 hours'],
                    ];
                @endphp

                <div class="grid grid-cols-2 gap-4 w-full">
                    @foreach ($details as $detail)
                        <section class="p-4 border border-gray-200 bg-white rounded-lg w-full">
                            <h1 class="text-sm text-custom-red font-semibold">{{ $detail['label'] }}</h1>
                            <span class="w-full flex justify-end">
                                <h1 class="text-lg text-black">{{ $detail['value'] }}</h1>
                            </span>
                        </section>
                    @endforeach
                </div>
                <div class="w-full flex items-center gap-4 justify-center">
                    <x-button primary label="Time In" button className="close-modal-button"
                        closeModal="{{ $id }}" />
                    <x-button primary label="Time Out" button className="close-modal-button"
                        closeModal="{{ $id }}" />
                </div>
                <div class="w-full flex justify-center">
                    <x-button label="Re-scan QR Code" button
                        className="close-modal-button hover:underline hover:text-custom-orange w-fit"
                        closeModal="{{ $id }}" />
                </div>
            </div>
        </div>
    </div>
</div>
