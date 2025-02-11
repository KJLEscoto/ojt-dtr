{{-- scanner modal --}}
<x-modal.scanner id="scanner-modal" />

{{-- time in modal --}}
<x-modal.time-in-time-out-modal id="time-in-time-out-modal" />

<x-main-layout :array_daily="$array_daily" :ranking="$ranking">
    <main class="container mx-auto max-w-screen-xl">
        <div class="flex flex-col gap-10 w-full h-auto">

            <div class="w-full gap-2 flex items-center justify-start">
                <x-button primary label="Open QR Scanner" button openModal="scanner-modal"
                    leftIcon="iconamoon--scanner-fill" className="px-7 modal-button" />
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
                                    <h1 class="font-semibold">{{ $user['fullname'] }}</h1>
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
            const response = await axios.get(`/scanner/${decodedText}`);
            console.log(response); // Debugging log
            console.log(response.data.user.firstname);

            // Find the button and trigger the click event
            const modalButton = document.querySelector('[name="showTimeShift"]');
            if (modalButton) {
                modalButton.click(); // Simulate a click on the button
            } else {
                console.error("Modal button not found!");
            }

            const nameStudentNo = document.querySelector('[name="student_no"]');
            const namePhone = document.querySelector('[name="phone"]');
            const nameQrCode = document.querySelector('[name="qr_code"]');
            const nameTotalHours = document.querySelector('[name="total_hours"]');
            const nameButtonTimeIn = document.querySelector('[name="button_time_in"]');
            const nameButtonTimeOut = document.querySelector('[name="button_time_out"]');


            if (nameStudentNo && namePhone && nameQrCode && nameTotalHours &&
                nameButtonTimeIn && nameButtonTimeIn && nameButtonTimeOut) {

                nameStudentNo.textContent = response.data.user.student_no; // Use value for input elements
                namePhone.textContent = response.data.user.phone;
                nameQrCode.textContent = response.data.user.qr_code;
                nameTotalHours.textContent = "0 Hours";

                nameButtonTimeIn.addEventListener('click', async function() {
                    try {
                        const res = await axios.post('/history', {
                            qr_code: response.data.user.qr_code,
                            type: 'time_in',
                        });
                        console.error("Time In Success", res.data);
                    } catch (error) {
                        console.error("Error in Time in:", error);
                    }
                });

                nameButtonTimeOut.addEventListener('click', async function() {
                    try {
                        const res = await axios.post('/history', {
                            qr_code: response.data.user.qr_code,
                            type: 'time_out',
                        });
                        console.error("Time Out Success", res.data);
                    } catch (error) {
                        console.error("Error in Time out:", error);
                    }
                });

            } else {
                console.error("error");
            }
        } catch (error) {
            console.error("Error:", error);
        }
    }

    function onScanError(error) {
        console.warn('QR Scan error:', error);

        alert('error');
    }

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
