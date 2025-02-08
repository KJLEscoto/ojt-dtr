<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
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
                                            {{$totalScan}}
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
                                        <h1 class="font-bold col-span-4 text-xl">{{$user->firstname}} {{$user->lastname}}</h1>
                                        <span class="ic--round-email text-custom-red col-span-1"></span>
                                        <p class="font-medium col-span-4 text-custom-red">{{$user->email}}</p>
                                        <span class="solar--phone-bold text-custom-red col-span-1"></span>
                                        <p class="font-medium col-span-4 text-gray-600">{{$user->phone}}</p>
                                    </section>
                                </div>
                            </div>
                        </section>

                        {{-- small qr code --}}
                        <section
                            class="p-5 rounded-lg border border-gray-200 bg-white w-1/2 h-auto text-center gap-3 flex flex-col items-center justify-center">
                            <h1 class="text-sm font-semibold">YOUR PERSONAL QR CODE</h1>
                            
                            <!-- Button with QR Code -->
                            <span hidden id="hidden-data-qr-text">{{$user->qr_code}}</span>
                            <button data-modal-target="qr-code-modal"
                                data-qr-text="{{ $user->qr_code }}"
                                class="modal-button h-32 w-32 p-5 overflow-hidden flex items-center justify-center border bg-white rounded-xl border-black cursor-pointer">

                                <!-- Small QR Code -->  
                                <div id="small-qr-code-img"></div>
                            </button>

                            
                            <p class="text-xs font-medium">Click QR to enlarge</p>
                            {{-- 
                                The x-button is not working but I will use it when it fixed for better generalization of the buttons

                            <x-button tertiary label="Download QR" leftIcon="material-symbols--download-rounded"
                                className="text-sm px-8" onClick="myFunction()" id="download-qr-small-btn" />
                            --}}
                            <button
                            class='px-16 py-3 border rounded-full text-custom-orange hover:border-custom-orange animate-transition flex items-center justify-center gap-2
                            text-sm px-8'
                            id="download-qr-small-btn"
                            >
                                <i class="material-symbols--download-rounded">download</i> 
                                Download QR
                            </button>
                        </section>
                    </div>

                    <div class="p-10 rounded-lg border border-gray-200 bg-white w-full space-y-5">
                        <x-page-title title="Additional Information" titleClass="text-xl font-semibold" />
                        <div class="grid grid-cols-4 gap-2 w-full">
                            <h1 class="text-lg font-semibold col-span-1">Address</h1>
                            <p class="text-lg font-normal col-span-3">{{$user->address}}</p>
                            <h1 class="text-lg font-semibold col-span-1">School</h1>
                            <p class="text-lg font-normal col-span-3">{{$user->school}}</p>
                        </div>
                    </div>

                    <div class="p-10 rounded-lg border border-gray-200 bg-white w-full space-y-5">
                        <x-page-title title="Emergency Contact" titleClass="text-xl font-semibold" />
                        <div class="grid grid-cols-4 gap-2 w-full">
                            <h1 class="text-lg font-semibold col-span-1">Name</h1>
                            <p class="text-lg font-normal col-span-3">{{$user->emergency_contact_fullname}}</p>
                            <h1 class="text-lg font-semibold col-span-1">Contact No.</h1>
                            <p class="text-lg font-normal col-span-3">{{$user->emergency_contact_number}}</p>
                            <h1 class="text-lg font-semibold col-span-1">Address</h1>
                            <p class="text-lg font-normal col-span-3">{{$user->emergency_contact_address}}</p>
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
                        @foreach ($histories as $history)
                            <section class="px-7 py-5 w-full flex justify-between items-center even:bg-custom-orange/5">
                                <div class="">
                                    <section class="font-bold text-lg">{{$history['timeFormat']}}</section>
                                    <p class="text-sm font-medium text-gray-700">{{$history['datetime']}}</p>
                                </div>
                                @if ($history['description'] === 'time in')
                                    <div class="text-green-500 flex items-center gap-1 select-none">
                                        <span class="lets-icons--in"></span>
                                        <p>Time in</p>
                                    </div>
                                @else
                                    <div class="text-red-500 flex items-center gap-1 select-none">
                                        <span class="lets-icons--out"></span>
                                        <p>Time out</p>
                                    </div>
                                @endif
                            </section>
                        @endforeach
                    </div>

                    <div class="tracking-wider flex items-center gap-2 select-none">
                        <span class="ic--round-date-range"></span>
                        <p class="">Starting Date:</p>
                        <span class="">{{$userTimeStarted}}</span>
                    </div>
                </section>
            </div>


        </div>
    </main>

</x-main-layout>

@include('components.modal.qr-code');

<script>

    document.addEventListener("DOMContentLoaded", function () {
        // Generate the small QR code when the page loads
        const qrCodeText = document.getElementById("hidden-data-qr-text").innerText;

        new QRCode(document.getElementById("small-qr-code-img"), {
            text: qrCodeText,
            width: 120,
            height: 120
        });

        // Add event listener to download QR image
        document.getElementById("download-qr-small-btn").addEventListener("click", function () {
        
            const qrCanvas = document.getElementById("small-qr-code-img").querySelector("canvas");
            if (qrCanvas) {
                // Get the image data URL (base64 format)
                const qrImage = qrCanvas.toDataURL("image/png");

                // Create an <a> tag dynamically for downloading the image
                const downloadLink = document.createElement("a");
                downloadLink.href = qrImage;
                downloadLink.download = "QR_Code.png"; // Set the default filename for download
                document.body.appendChild(downloadLink);
                downloadLink.click(); // Trigger the download
                document.body.removeChild(downloadLink); // Clean up the link after triggering the download
            } else {
                console.error("QR code not found in the container!");
            }
        });
    });

    //this one for clicking the modal and passing some data in the enlarge modal
    document.addEventListener("DOMContentLoaded", function () {
        const qrButtons = document.querySelectorAll("[data-modal-target='qr-code-modal']");

        qrButtons.forEach(button => {
            button.addEventListener("click", function () {
                const qrText = this.getAttribute("data-qr-text");

                console.log("QR Modal Opened!", qrText);

                document.getElementById("qr-code-text").innerText = qrText;

                // Generate new QR code
                new QRCode(document.getElementById("large-qr-code-img"), {
                    text: qrText,
                    width: 350,
                    height: 350
                });
                
                // Show the modal
                document.getElementById("qr-code-modal").classList.remove("hidden");
            });
        });

        // Close modal
        document.querySelectorAll(".close-modal-button").forEach(button => {
            button.addEventListener("click", function () {
                document.getElementById("qr-code-modal").classList.add("hidden");
            });
        });
    });
</script>