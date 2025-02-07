@props(['id' => ''])

{{-- large qr code --}}
<div id="{{ $id }}" class="pd-overlay hidden">
    <div
        class="w-full h-full fixed top-0 left-0 z-[100] flex items-center justify-center  overflow-x-hidden overflow-y-auto bg-black bg-opacity-70">
        <div
            class="w-1/2 flex items-center justify-center p-10 transition-all ease-out opacity-0 sm:mx-auto modal-open:opacity-100 modal-open:duration-500">
            <div class="flex flex-col px-10 py-5 gap-5 bg-white rounded-2xl w-full">
                <div class="flex flex-col gap-5 items-center justify-center">
                    <h4 class="font-bold text-2xl text-gray-900">QR SCANNER</h4>
                </div>
                <div class="w-full h-auto space-y-5 flex flex-col items-center justify-center">
                    <div
                        class="h-[550px] w-[550px] p-5 overflow-hiddem object-center border bg-white rounded-xl border-black">
                        <p class="text-center font-bold">CAMERA HERE</p>
                    </div>
                    <p class="text-sm text-gray-600">Position the QR code within the frame to scan.</p>
                    <x-button primary label="STOP SCANNING" leftIcon="mdi--video-off"
                        className="text-sm px-8 close-modal-button" closeModal="{{ $id }}" />
                </div>
            </div>
        </div>
    </div>
</div>
