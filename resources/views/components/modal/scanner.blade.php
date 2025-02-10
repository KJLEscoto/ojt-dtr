@props(['id' => ''])

<!-- HTML5 QR Code Scanner -->
<script src="https://unpkg.com/html5-qrcode"></script>

<!-- Camera -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

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
                        <!-- Scanner Section -->
                        <div id="reader" class="mt-8 w-full max-w-xl mx-auto"></div>
                    </div>
                    <p class="text-sm text-gray-600">Position the QR code within the frame to scan.</p>
                    <x-button primary label="HIDE SCANNER" leftIcon="mdi--video-off"
                        className="text-sm px-8 close-modal-button" id="closeButton" closeModal="{{ $id }}" />
                </div>
            </div>
        </div>
    </div>
</div>
