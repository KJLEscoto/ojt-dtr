{{-- scanner modal --}}
{{-- <x-modal.scanner id="scanner-modal" /> --}}

{{-- time in modal --}}
<x-modal.time-in-time-out-modal id="time-in-time-out-modal" />


<!-- HTML5 QR Code Scanner -->
<script src="https://unpkg.com/html5-qrcode"></script>

<!-- Camera -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

@if (session('success'))
    <x-modal.flash-msg msg="success" />
@elseif ($errors->has('invalid'))
    <x-modal.flash-msg msg="invalid" />
@elseif (session('invalid'))
    <x-modal.flash-msg msg="invalid" />
@endif

<x-main-layout :array_daily="$array_daily" :ranking="$ranking">
    <main class="container mx-auto max-w-screen-xl">
        <div class="flex flex-col gap-10 w-full h-auto">

            {{-- <div class="w-full gap-2 flex items-center justify-start">
                <x-button primary label="Open QR Scanner" button openModal="scanner-modal"
                    leftIcon="iconamoon--scanner-fill" className="px-7 modal-button" />
            </div> --}}

            <div class="h-[550px] w-full p-5 overflow-hidden object-center border bg-white rounded-xl border-gray-200">
                <!-- Scanner Section -->
                <div id="reader" class="h-full w-full max-w-xl mx-auto"></div>
            </div>

            @php
                $totals = [
                    ['label' => 'Total Scans', 'number' => $totalScans],
                    ['label' => 'Time In', 'number' => $totalTimeIn],
                    ['label' => 'Time Out', 'number' => $totalTimeOut],
                    ['label' => 'Total Registered', 'number' => $totalRegister],
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
                        @foreach ($recentlyAddedUser as $user)
                            <section class="px-7 py-5 w-full flex justify-between items-center even:bg-custom-orange/5">
                                <div class="flex items-center gap-5">
                                    <x-image className="w-12 h-12 rounded-full border border-custom-orange"
                                        path="resources/img/default-male.png" />
                                    <h1 class="font-semibold capitalize">{{ $user['fullname'] }}</h1>
                                </div>
                                <p>{{ $user['ago'] }}</p>
                            </section>
                        @endforeach
                        <button type="button" data-pd-overlay="#time-in-time-out-modal"
                            data-modal-target="time-in-time-out-modal" data-modal-toggle="time-in-time-out-modal"
                            name="showTimeShift" class="hidden modal-button">hello</button>
                    </div>
                </section>
            </div>
        </div>
    </main>
</x-main-layout>


<script>
    let scannerInstance = null; // Store scanner instance globally

    function closeCamera() {
        if (scannerInstance) {
            alert('hello')
            scannerInstance.clear()
                .then(() => {
                    console.log("Scanner stopped");
                    document.getElementById("reader").innerHTML = ""; // Clear the scanner UI
                })
                .catch(err => {
                    console.error("Error stopping scanner:", err);
                });
        }
    }

    // Initialize QR Scanner
    function initScanner() {
        scannerInstance = new Html5QrcodeScanner('reader', {
            qrbox: {
                width: 250,
                height: 250
            },
            fps: 10
        });

        scannerInstance.render(onScanSuccess, onScanError);
    }

    async function onScanSuccess(decodedText) {
        try {
            const response = await axios.get(`/scanner/${encodeURIComponent(decodedText)}`);
            console.log(response.data); // Debugging log

            // Open modal
            const modalButton = document.querySelector('[name="showTimeShift"]');
            if (modalButton) {
                modalButton.click();
            } else {
                console.error("Modal button not found!");
            }

            // Get elements
            const nameEmail = document.querySelector('[name="email"]');
            const nameFullname = document.querySelector('[name="fullname"]');
            const nameStudentNo = document.querySelector('[name="student_no"]');
            const namePhone = document.querySelector('[name="phone"]');
            const nameQrCode = document.querySelector('[name="qr_code"]');
            const nameTotalHours = document.querySelector('[name="total_hours"]');
            const nameButtonTimeIn = document.querySelector('[name="button_time_in"]');
            const nameButtonTimeOut = document.querySelector('[name="button_time_out"]');
            const nameLoadingButton = document.querySelector('[name="loading_button"]');

            // Ensure all elements exist
            if (!nameStudentNo || !namePhone || !nameQrCode || !nameTotalHours ||
                !nameButtonTimeIn || !nameButtonTimeOut) {
                console.error("One or more elements were not found in the DOM.");
                return;
            }

            // Assign values
            nameFullname.textContent = response.data.user.firstname + ' ' +
                response.data.user.middlename + ' ' + response.data.user.lastname;
            nameEmail.textContent = response.data.user.email;
            nameStudentNo.textContent = response.data.user.student_no;
            namePhone.textContent = response.data.user.phone;
            nameQrCode.textContent = response.data.user.qr_code;
            nameTotalHours.textContent = "0 Hours";

            // Remove old event listeners
            nameButtonTimeIn.replaceWith(nameButtonTimeIn.cloneNode(true));
            nameButtonTimeOut.replaceWith(nameButtonTimeOut.cloneNode(true));

            // Get the new button references
            const newButtonTimeIn = document.querySelector('[name="button_time_in"]');
            const newButtonTimeOut = document.querySelector('[name="button_time_out"]');


            // Add event listeners
            newButtonTimeIn.addEventListener('click', async function() {
                try {
                    newButtonTimeIn.classList.add('hidden');
                    newButtonTimeOut.classList.add('hidden');
                    nameLoadingButton.classList.remove('hidden');
                    nameLoadingButton.classList.add('block');
                    nameLoadingButton.innerHTML =
                        "<div class='flex justify-center items-center w-full'><span class='line-md--loading-loop'></span><span> Time In </span></div>";
                    const res = await axios.post('/history', {
                        qr_code: response.data.user.qr_code,
                        type: 'time_in',
                    });
                    console.log("Time In Success", res.data);
                    setTimeout(() => location.reload(true), 0);
                } catch (error) {
                    console.error("Error in Time In:", error);
                }
            });

            newButtonTimeOut.addEventListener('click', async function() {
                try {
                    newButtonTimeIn.classList.add('hidden');
                    newButtonTimeOut.classList.add('hidden');
                    nameLoadingButton.classList.remove('hidden');
                    nameLoadingButton.classList.add('block');
                    nameLoadingButton.innerHTML =
                        "<div class='flex justify-center items-center w-full'><span class='line-md--loading-loop'></span><span> Time Out </span></div>";

                    const res = await axios.post('/history', {
                        qr_code: response.data.user.qr_code,
                        type: 'time_out',
                    });
                    console.log("Time Out Success", res.data);
                    alert(response.data.success); // Display success message
                    setTimeout(() => location.reload(true), 1);
                } catch (error) {
                    console.error("Error in Time Out:", error);
                }
            });

        } catch (error) {
            console.error("Error fetching QR data:", error.response ? error.response.data : error.message);
        }
    }


    const onScanError = (errorMessage) => {
        // Ignore the specific "No MultiFormat Readers" error
        if (!errorMessage.includes("No MultiFormat Readers were able to detect the code")) {
            console.error("QR Scan error:", errorMessage);
        }
    };

    function timeIn() {
        console.log('hello');
    }

    // Ensure DOM is fully loaded before initializing scanner
    document.addEventListener('DOMContentLoaded', () => {
        initScanner();

        // Attach event listener to close button after DOM is ready
        document.getElementById("closeButton").addEventListener("click", closeCamera);
    });
</script>
