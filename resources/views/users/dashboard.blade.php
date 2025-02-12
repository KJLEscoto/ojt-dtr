<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<span>
    <x-modal.qr-code id="qr-code-modal" />
</span>

<x-main-layout>

    {{-- <main class="flex w-full h-screen">
        <div class="w-2/3 pb-20 h-screen bg-gray-100 overflow-auto">
            <div class="min-h-screen px-14 py-20 space-y-7">
                <div class="flex items-end gap-7 w-full h-auto">
                    <section
                        class="p-10 rounded-lg border border-gray-200 bg-white w-full relative overflow-hidden h-full space-y-10">
                        <div class="w-full h-[200px] absolute top-0 left-0 inset-0 z-10">
                            <img src="resources/img/banner.jpg" alt="Banner" class="w-full h-full object-cover" />
                        </div>
                        <!-- Profile Section -->
                        <section class="relative z-30">
                            <div class="flex items-center flex-col gap-5 w-full">
                                <!-- Profile Image -->
                                <div class="w-auto h-full">
                                    <div
                                        class="h-52 w-52 overflow-hidden flex items-center justify-center shadow-md rounded-full bg-white">
                                        <x-image path="resources/img/default-male.png"
                                            className="object-cover w-full h-full" />
                                    </div>
                                </div>
                                <!-- User Info -->
                                <div class="w-full h-auto space-y-3">
                                    <section class="flex items-start gap-5">
                                        <div class="w-fit h-fit">
                                            <span class="fontisto--male text-custom-red"></span>
                                        </div>
                                        <h1 class="font-bold text-xl capitalize">
                                            {{ $user->firstname }} {{ $user->lastname }}
                                        </h1>
                                    </section>
                                    <section class="flex items-start gap-5">
                                        <div class="w-fit h-fit">
                                            <span class="ic--round-email text-custom-red"></span>
                                        </div>
                                        <p class="text-custom-red">{{ $user->email }}</p>
                                    </section>
                                    <section class="flex items-start gap-5">
                                        <div class="w-fit h-fit">
                                            <span class="solar--phone-bold text-custom-red"></span>
                                        </div>
                                        <p class="text-black">+63 {{ $user->phone }}</p>
                                    </section>
                                    <section class="flex items-start gap-5">
                                        <div class="w-fit h-fit">

                                            <span class="ic--round-date-range text-custom-red"></span>
                                        </div>
                                        <p class="text-gray-600">{{ $userTimeStarted }}</p>
                                    </section>
                                </div>
                            </div>
                        </section>
                    </section>

                    <section class="space-y-5 w-full h-full">
                        <div
                            class="flex items-center justify-center gap-2 bg-gradient-to-r from-custom-orange via-custom-orange/90 to-custom-red px-3 py-2 rounded-lg text-white h-fit">
                            <span class="fluent--scan-qr-code-24-filled"></span>
                            <h1 class="font-semibold">Total Scans</h1>
                            <p class="px-2 py-1 rounded-md border font-semibold bg-white text-custom-red">
                                {{ $totalScan }}
                            </p>
                        </div>
                        <div
                            class="p-5 rounded-lg border border-gray-200 bg-white w-full h-full text-center gap-3 flex flex-col items-center justify-center">
                            <h1 class="text-sm font-semibold">YOUR PERSONAL QR CODE</h1>
                            <!-- Button with QR Code -->
                            <span hidden id="hidden-data-qr-text">{{ $user->qr_code }}</span>
                            <button data-modal-target="qr-code-modal" data-qr-text="{{ $user->qr_code }}"
                                class="modal-button h-40 w-40 p-5 overflow-hidden flex items-center justify-center border bg-white rounded-xl border-black cursor-pointer">
                                <!-- Small QR Code -->
                                <div id="small-qr-code-img"></div>
                            </button>
                            <p class="text-xs font-medium">Click QR to enlarge</p>
                            <button
                                class='py-3 border rounded-full text-custom-orange hover:border-custom-orange animate-transition flex items-center justify-center gap-2
                                            text-sm px-8'
                                id="download-qr-small-btn">
                                <span class="material-symbols--download-rounded">download</span>
                                Download QR
                            </button>
                        </div>
                    </section>
                </div>
                <div class="p-10 rounded-lg border border-gray-200 bg-white w-full space-y-5">
                    <x-page-title title="Additional Information" titleClass="text-xl font-semibold" />
                    <section class="flex items-center gap-5">
                        <h1 class="text-lg font-semibold">Address</h1>
                        <p class=" text-lg ">{{ $user->address }}</p>
                    </section>
                    <section class="flex items-center gap-5">
                        <h1 class="text-lg font-semibold">School</h1>
                        <p class=" text-lg ">{{ $user->school }}</p>
                    </section>
                </div>
                <div class="p-10 rounded-lg border border-gray-200 bg-white w-full space-y-5">
                    <x-page-title title="Emergency Contact" titleClass="text-xl font-semibold" />

                    <section class="flex items-center gap-5">
                        <h1 class="text-lg font-semibold">Name</h1>
                        <p class=" text-lg ">{{ $user->emergency_contact_fullname }}</p>
                    </section>
                    <section class="flex items-center gap-5">
                        <h1 class="text-lg font-semibold">Contact No.</h1>
                        <p class=" text-lg ">+63 {{ $user->emergency_contact_number }}</p>
                    </section>
                    <section class="flex items-center gap-5">
                        <h1 class="text-lg font-semibold">Address</h1>
                        <p class=" text-lg ">{{ $user->emergency_contact_address }}</p>
                    </section>
                </div>
            </div>
        </div>

        <div
            class="fixed top-0 right-0 w-1/3 h-screen bg-gradient-to-r from-custom-orange via-custom-orange/90 to-custom-red">
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
                                <section class="font-bold text-lg">{{ $history['timeFormat'] }}</section>
                                <p class="text-sm font-medium text-gray-700">{{ $history['datetime'] }}</p>
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
            </section>
        </div>
    </main> --}}

    <main class="w-full h-auto">
        <div class="container mx-auto max-w-screen-xl">
            <div class="grid grid-cols-12">
                <section class="col-span-8 w-full h-[calc(100vh-7rem)] overflow-auto p-10">
                    <div class="flex items-start gap-7 w-full h-auto">
                        <section
                            class="p-10 rounded-lg border border-gray-200 bg-white w-full relative overflow-hidden h-full space-y-10">
                            <div class="w-full h-[200px] absolute top-0 left-0 inset-0 z-10">
                                <img src="resources/img/banner.jpg" alt="Banner" class="w-full h-full object-cover" />
                            </div>
                            <!-- Profile Section -->
                            <section class="relative z-30">
                                <div class="flex items-center flex-col gap-5 w-full">
                                    <!-- Profile Image -->
                                    <div class="w-auto h-full">
                                        <div
                                            class="h-52 w-52 overflow-hidden flex items-center justify-center shadow-md rounded-full bg-white">
                                            <x-image path="resources/img/default-male.png"
                                                className="object-cover w-full h-full" />
                                        </div>
                                    </div>
                                    <!-- User Info -->
                                    <div class="w-full h-auto space-y-3">
                                        <section class="flex items-start gap-5">
                                            <div class="w-fit h-fit">
                                                <span class="fontisto--male text-custom-red"></span>
                                            </div>
                                            <h1 class="font-bold text-xl capitalize">
                                                {{ $user->firstname }} {{ $user->lastname }}
                                            </h1>
                                        </section>
                                        <section class="flex items-start gap-5">
                                            <div class="w-fit h-fit">
                                                <span class="ic--round-email text-custom-red"></span>
                                            </div>
                                            <p class="text-custom-red">{{ $user->email }}</p>
                                        </section>
                                        <section class="flex items-start gap-5">
                                            <div class="w-fit h-fit">
                                                <span class="solar--phone-bold text-custom-red"></span>
                                            </div>
                                            <p class="text-black">+63 {{ $user->phone }}</p>
                                        </section>
                                        <section class="flex items-start gap-5">
                                            <div class="w-fit h-fit">

                                                <span class="ic--round-date-range text-custom-red"></span>
                                            </div>
                                            <p class="text-gray-600">{{ $userTimeStarted }}</p>
                                        </section>
                                    </div>
                                </div>
                            </section>
                        </section>

                        <section class="space-y-5 w-full h-full">
                            {{-- <div
                                class="flex items-center justify-center gap-2 bg-gradient-to-r from-custom-orange via-custom-orange/90 to-custom-red px-3 py-2 rounded-lg text-white h-fit">
                                <span class="fluent--scan-qr-code-24-filled"></span>
                                <h1 class="font-semibold">Total Scans</h1>
                                <p class="px-2 py-1 rounded-md border font-semibold bg-white text-custom-red">
                                    {{ $totalScan }}
                                </p>
                            </div> --}}
                            <div
                                class="p-5 rounded-lg border border-gray-200 bg-white w-full h-full text-center gap-3 flex flex-col items-center justify-center">
                                <h1 class="text-sm font-semibold">YOUR PERSONAL QR CODE</h1>
                                <!-- Button with QR Code -->
                                <span hidden id="hidden-data-qr-text">{{ $user->qr_code }}</span>
                                <button data-modal-target="qr-code-modal" data-qr-text="{{ $user->qr_code }}"
                                    class="modal-button h-40 w-40 p-5 overflow-hidden flex items-center justify-center border bg-white rounded-xl border-black cursor-pointer">
                                    <!-- Small QR Code -->
                                    <div id="small-qr-code-img"></div>
                                </button>
                                <p class="text-xs font-medium">Click QR to enlarge</p>
                                <button
                                    class='py-3 border rounded-full text-custom-orange hover:border-custom-orange animate-transition flex items-center justify-center gap-2
                                            text-sm px-8'
                                    id="download-qr-small-btn">
                                    <span class="material-symbols--download-rounded">download</span>
                                    Download QR
                                </button>
                            </div>
                        </section>
                    </div>
                </section>
                <section
                    class="col-span-4 w-full h-[calc(100vh-7rem)] overflow-auto p-10 sticky top-0 bg-gradient-to-r from-custom-orange via-custom-orange/90 to-custom-red">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere qui quis, expedita ducimus quae
                    incidunt iure nulla nobis aspernatur? Eligendi quo optio magni blanditiis adipisci delectus
                    voluptatibus rerum accusamus. Iure.
                    Optio fugit harum, rerum aliquam omnis aspernatur at unde aut officia quaerat? Neque facilis sed
                    non, error debitis dolorem aliquam saepe deleniti harum sint a esse eos voluptate possimus quam.
                    Odio, omnis? Natus adipisci labore voluptas ut a enim ex, aliquam dolor laboriosam modi ipsam
                    provident exercitationem officiis praesentium suscipit recusandae minus laudantium assumenda
                    delectus quisquam consectetur dolorum. Velit, laboriosam.
                    Quaerat itaque aspernatur nobis aliquid maiores ullam obcaecati. Aliquid, ut eaque unde veniam harum
                    quisquam quo culpa alias a distinctio, asperiores, atque necessitatibus dolorem odit! Consectetur
                    minima at soluta magni!
                    Cumque quaerat accusantium aut autem doloremque consequuntur, animi minus deleniti. Minus illum
                    voluptas numquam sequi rem non odit molestias nam veritatis debitis explicabo neque ipsum, rerum
                    corporis commodi minima in?
                    Eveniet, natus quidem consequuntur molestias assumenda dolorem itaque soluta, odio doloremque
                    tempore unde quia autem enim minima maxime exercitationem cum. Tenetur inventore nam molestias nisi
                    maiores mollitia a iusto alias?
                    Rerum nulla architecto voluptatum autem nobis sit amet porro dolore dolorem cum tenetur laudantium
                    corrupti hic, sint unde aut enim aliquid incidunt quibusdam, itaque dignissimos vel impedit!
                    Quaerat, itaque pariatur!
                    Ducimus praesentium nisi deleniti expedita voluptate fugit voluptatum accusantium quae libero,
                    quidem maxime et delectus, animi commodi suscipit rem dignissimos tempora, doloribus ex facilis?
                    Mollitia at perspiciatis unde asperiores eaque.
                    Suscipit excepturi nulla consequuntur ipsa iusto, corrupti quaerat repellendus molestias eaque aut
                    eos, dicta reprehenderit! Officia eos, fuga unde explicabo odit, assumenda qui et itaque illum
                    quisquam rerum eligendi obcaecati.
                    Dicta numquam autem saepe sint quisquam delectus placeat necessitatibus omnis odit maxime cupiditate
                    ratione cumque quidem consectetur assumenda dolorum illo velit dolores, sequi dolore eius.
                    Dignissimos officia commodi voluptates ex.
                    Delectus ex deleniti reprehenderit nemo dolorem sed libero, maxime excepturi pariatur eaque
                    dignissimos. Modi facilis veniam doloribus cumque voluptatibus temporibus a recusandae quae,
                    suscipit, praesentium sit aut perferendis, necessitatibus cum!
                    Nisi consectetur magni, accusantium aliquam soluta excepturi sunt dolore totam iure ipsa ullam
                    corrupti assumenda suscipit, illum, dignissimos repellat! Obcaecati sunt ad, aspernatur dolorum
                    deserunt voluptatibus labore soluta. Blanditiis, accusamus?
                    Expedita animi excepturi facere obcaecati odit voluptatem consequatur, dolore eveniet magnam? Ab
                    autem aperiam distinctio placeat debitis? Ea voluptate provident voluptas vitae ut dolorem odit
                    accusantium ex porro architecto? Sapiente.
                    Magnam tempora dolor commodi saepe explicabo perspiciatis sint pariatur facere iste ipsa iure
                    praesentium esse ipsam maxime accusantium, qui et vero est quos sed molestiae reiciendis? Sed soluta
                    culpa impedit.
                    Quo culpa doloribus dolorum voluptatum reprehenderit eligendi nam, ab sequi corporis dolor odio
                    distinctio non ut pariatur, aliquam quia maxime odit eum fugiat dolore similique! Iste repellat
                    dolore laboriosam suscipit!
                    Voluptas nisi cum illo id eligendi accusamus reprehenderit ipsum vitae iste odit nulla doloremque
                    consequatur optio, doloribus repellendus dignissimos asperiores at, non ad aliquid maiores odio.
                    Necessitatibus vitae inventore dolor.
                    Maiores dicta dignissimos incidunt sapiente debitis rerum harum repellendus soluta quos unde numquam
                    molestiae quaerat quia sunt culpa aliquid aut et perferendis eum quam blanditiis, accusamus
                    corporis! Iste, excepturi odio.
                    Quos, in iste libero corporis fugit voluptatibus eaque vitae porro ipsam cum a adipisci odio numquam
                    itaque esse qui hic? Accusamus assumenda hic, debitis eos perspiciatis vitae magni voluptatum
                    commodi.
                    Assumenda voluptatem, id molestiae quasi ducimus neque sequi cumque, dignissimos voluptate, ratione
                    mollitia? Reiciendis, rem culpa non nulla, tempora iusto, sapiente explicabo iure accusamus
                    accusantium qui eaque pariatur itaque maiores?
                    Recusandae dolores id ut cumque molestiae. Qui reiciendis quam nihil cumque sit illo, aut delectus
                    rem laboriosam ullam ipsum animi amet nostrum harum, quo eius aliquam placeat. Voluptatem,
                    accusantium quam!
                </section>
            </div>
        </div>
    </main>


</x-main-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Generate the small QR code when the page loads
        const qrCodeText = document.getElementById("hidden-data-qr-text").innerText;

        new QRCode(document.getElementById("small-qr-code-img"), {
            text: qrCodeText,
            width: 120,
            height: 120
        });

        // Add event listener to download QR image
        document.getElementById("download-qr-small-btn").addEventListener("click", function() {

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
                document.body.removeChild(
                    downloadLink); // Clean up the link after triggering the download
            } else {
                console.error("QR code not found in the container!");
            }
        });
    });

    //this one for clicking the modal and passing some data in the enlarge modal
    document.addEventListener("DOMContentLoaded", function() {
        const qrButtons = document.querySelectorAll("[data-modal-target='qr-code-modal']");

        qrButtons.forEach(button => {
            button.addEventListener("click", function() {
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
            button.addEventListener("click", function() {
                document.getElementById("qr-code-modal").classList.add("hidden");
            });
        });
    });
</script>
