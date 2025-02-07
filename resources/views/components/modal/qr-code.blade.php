@props(['id' => ''])

{{-- large qr code --}}
<div id="{{ $id }}" class="pd-overlay hidden z-50">
    <div
        class="w-full h-full fixed top-0 left-0 z-[100] flex items-center justify-center  overflow-x-hidden overflow-y-auto bg-black bg-opacity-70">
        <div
            class="w-auto flex items-center justify-center p-10 transition-all ease-out opacity-0 sm:mx-auto modal-open:opacity-100 modal-open:duration-500">
            <div class="flex flex-col px-10 py-5 gap-5 bg-white rounded-2xl">
                <div class="flex items-center justify-between">
                    <h4 class="font-semibold text-gray-900">YOUR PERSONAL QR CODE</h4>
                    <button class="block cursor-pointer close-modal-button" data-pd-overlay="#qr-code-modal"
                        data-modal-target="qr-code-modal">
                        <span class="gg--close-o cursor-pointer hover:text-custom-red text-gray-600"></span>
                    </button>
                </div>
                <div class="w-full h-auto space-y-5 flex flex-col items-center justify-center">
                    <div
                        class="h-[350px] w-[350px] p-10 overflow-hiddem object-center border bg-white rounded-xl border-black">
                        <x-image path="resources/img/sample-qr.png" className="h-full w-full" />
                    </div>
                    <p class="text-sm"><span class="font-bold">QR CODE:</span> MF_JFDBN2JF_IFH</p>
                    <x-button tertiary label="Download QR" leftIcon="material-symbols--download-rounded"
                        className="text-sm px-8" />
                </div>
            </div>
        </div>
    </div>
</div>
