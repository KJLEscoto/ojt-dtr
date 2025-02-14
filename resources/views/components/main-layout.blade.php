<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>

    <link rel="icon" href="{{ asset('resources/img/rweb_icon.png') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- modal script --}}
    <link href="https://cdn.jsdelivr.net/npm/pagedone@1.2.2/src/css/pagedone.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/pagedone@1.2.2/src/js/pagedone.js"></script>

    {{-- font url --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{-- hedvig font --}}
    <link href="https://fonts.googleapis.com/css2?family=Hedvig+Letters+Sans&display=swap" rel="stylesheet">

    {{-- swiper --}}
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


    <style>
        .swiper-wrapper {
            width: 100%;
            height: max-content !important;
            padding-bottom: 64px !important;
            -webkit-transition-timing-function: linear !important;
            transition-timing-function: linear !important;
            position: relative;
        }

        .swiper-pagination-progressbar .swiper-pagination-progressbar-fill {
            background: #F57D11 !important;
        }
    </style>

</head>

<body class="hedvig-letters-sans-regular tracking-wide overflow-hidden">

    {{-- guest layout --}}
    @if (Request::routeIs('show.login*') || Request::routeIs('show.register*'))
        <main class="container max-w-screen-xl mx-auto">
            <div class="md:!grid md:!grid-cols-12 h-[calc(100vh)] w-full overflow-auto">
                <section class="md:col-span-8 md:h-[calc(100vh)] overflow-auto w-full md:!p-10 p-5 bg-white">
                    {{ $slot }}
                </section>

                <section class="md:col-span-4 md:h-[calc(100vh)] w-full h-[calc(100vh-50%)] md:sticky md:top-0">
                    @if (Request::routeIs('show.register'))
                        <x-form.option imgPath="/resources/img/register.png" title="Have an account?"
                            routePath="show.login" desc="Stay on top of your schedule!" btnLabel="Login" />

                        {{-- register button --}}
                    @elseif (Request::routeIs('show.login'))
                        <x-form.option imgPath="/resources/img/login.png" title="New Intern?" routePath="show.register"
                            desc="Sign up to keep track of your daily attendance." btnLabel="Register" />
                    @endif
                </section>
            </div>
        </main>

        {{-- users/intern layout --}}
    @elseif (Request::routeIs('users.dashboard*') || Request::routeIs('users.settings*') || Request::routeIs('users.dtr*'))
        <div class="w-full h-auto">
            <nav class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
                <div class="lg:hidden flex items-center justify-between gap-5 px-5 py-3">
                    <x-logo width="w-[200px]" />
                    <button id="intern-menu-toggle" class="p-2 border rounded-md">
                        ☰
                    </button>
                </div>

                <div class="hidden lg:grid grid-cols-3 text-nowrap h-auto px-10 border shadow-md">
                    <section class="flex items-center justify-start">
                        <x-logo />
                    </section>
                    <section class="flex items-center justify-center">
                        <a href="{{ route('users.dashboard') }}"
                            class="{{ Request::routeIs('users.dashboard*') ? 'border-custom-red text-custom-red py-10 px-7 border-b-4 flex items-center gap-2 font-semibold' : 'text-gray-600 border-white cursor-pointer font-semibold py-8 px-7 border-b-4 flex items-center gap-2' }}">
                            <span class="akar-icons--dashboard"></span>
                            <p>Dashboard</p>
                        </a>
                        <a href="{{ route('users.dtr') }}"
                            class="{{ Request::routeIs('users.dtr*') ? 'border-custom-red text-custom-red py-10 px-7 border-b-4 flex items-center gap-2 font-semibold' : 'text-gray-600 border-white cursor-pointer font-semibold py-8 px-7 border-b-4 flex items-center gap-2' }}">
                            <span class="mingcute--paper-line"></span>
                            <p>DTR</p>
                        </a>
                        <a href="{{ route('users.settings') }}"
                            class="{{ Request::routeIs('users.settings') ? 'border-custom-red text-custom-red py-10 px-7 border-b-4 flex items-center gap-2 font-semibold' : 'text-gray-600 border-white cursor-pointer font-semibold py-8 px-7 border-b-4 flex items-center gap-2' }}">
                            <span class="solar--settings-linear"></span>
                            <p>Settings</p>
                        </a>
                    </section>
                    <x-form.container routeName="logout" className="flex items-center justify-end">
                        @csrf
                        <button
                            class="flex items-center opacity-100 gap-1 w-fit px-8 py-3 rounded-lg font-semibold bg-custom-red hover:bg-custom-red/80 text-white animate-transition"><span
                                class="material-symbols--logout-rounded"></span>Logout</button>
                    </x-form.container>
                </div>
            </nav>

            <aside id="mobile-menu"
                class="fixed top-[70px] right-0 mt-1 w-64 h-[calc(100vh-3rem)] bg-white shadow-md transform translate-x-full transition-transform lg:hidden overflow-auto z-50 flex flex-col justify-between">
                <nav>
                    <a href="{{ route('users.dashboard') }}"
                        class="{{ Request::routeIs('users.dashboard*') ? 'border-custom-red text-custom-red py-5 px-7 border-l-4 flex items-center gap-2 font-semibold' : 'text-gray-600 border-white cursor-pointer font-semibold py-5 px-7 border-l-4 flex items-center gap-2' }}">
                        <span class="akar-icons--dashboard"></span>
                        <p>Dashboard</p>
                    </a>
                    <a href="{{ route('users.dtr') }}"
                        class="{{ Request::routeIs('users.dtr*') ? 'border-custom-red text-custom-red py-5 px-7 border-l-4 flex items-center gap-2 font-semibold' : 'text-gray-600 border-white cursor-pointer font-semibold py-5 px-7 border-l-4 flex items-center gap-2' }}">
                        <span class="mingcute--paper-line"></span>
                        <p>DTR</p>
                    </a>
                    <a href="{{ route('users.settings') }}"
                        class="{{ Request::routeIs('users.settings*') ? 'border-custom-red text-custom-red py-5 px-7 border-l-4 flex items-center gap-2 font-semibold' : 'text-gray-600 border-white cursor-pointer font-semibold py-5 px-7 border-l-4 flex items-center gap-2' }}">
                        <span class="solar--settings-linear"></span>
                        <p>Settings</p>
                    </a>
                </nav>

                <x-form.container routeName="logout" className="flex items-center justify-center">
                    @csrf
                    <button
                        class="flex items-center opacity-100 gap-1 w-full px-8 py-5 font-semibold bg-custom-red hover:bg-custom-red/80 text-white animate-transition"><span
                            class="material-symbols--logout-rounded"></span>Logout</button>
                </x-form.container>
            </aside>

            <main class="lg:!mt-[110px] mt-[73px] bg-gray-100">
                {{ $slot }}
            </main>
        </div>

        <script>
            const menuToggle = document.getElementById("intern-menu-toggle");
            const mobileMenu = document.getElementById("mobile-menu");

            menuToggle.addEventListener("click", () => {
                mobileMenu.classList.toggle("translate-x-full");
            });

            // swiper
            var swiper = new Swiper(".progress-slide-carousel", {
                loop: true,
                fraction: true,
                autoplay: {
                    delay: 1200,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".progress-slide-carousel .swiper-pagination",
                    type: "progressbar",
                },
            });

            document.addEventListener("DOMContentLoaded", function() {
                const dropdownToggle = document.getElementById("dropdown-toggle");
                const dropdownMenu = document.getElementById("dropdown-menu");

                // Toggle dropdown visibility on button click
                dropdownToggle.addEventListener("click", function() {
                    dropdownMenu.classList.toggle("hidden");
                });

                // Close dropdown when clicking outside
                document.addEventListener("click", function(event) {
                    if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.classList.add("hidden");
                    }
                });
            });
        </script>

        {{-- admin layout --}}
    @elseif (Request::routeIs('admin.dashboard*') ||
            Request::routeIs('admin.users*') ||
            Request::routeIs('admin.histories*') ||
            Request::routeIs('admin.profile*'))
        @props(['array_daily' => '', 'ranking' => ''])
        <!-- Navbar (Sticky at the Top) -->
        <nav class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
            <div class="flex justify-between items-center lg:px-10 px-5 py-4">
                <button id="menu-toggle" class="lg:hidden p-2 border rounded-md">
                    ☰
                </button>
                <x-logo width="lg:!w-[250px] sm:!w-[200px] !w-[150px]" />
                <div class="flex items-center gap-2">
                    <p class="lg:block hidden capitalize">Hi, {{ Auth::user()->firstname }}!</p>
                    <button type="button" class="">
                    </button>
                    <div class="dropdown relative inline-flex">
                        <button type="button" id="dropdown-toggle"
                            class="dropdown-toggle inline-flex cursor-pointer h-14 w-14 overflow-hidden items-center justify-center shadow-md rounded-full bg-white border-custom-orange border">
                            <x-image path="resources/img/default-male.png" className="object-cover w-full h-full " />
                        </button>
                        <div id="dropdown-menu"
                            class="dropdown-menu hidden rounded-xl shadow-lg border border-gray-300 bg-white absolute top-full right-0 w-72 mt-2 divide-y divide-gray-200">
                            <ul class="py-2">
                                <li>
                                    <a class="block px-6 py-2 hover:bg-gray-100 text-gray-900 font-semibold"
                                        href="javascript:;"> Profile </a>
                                </li>
                            </ul>
                            <div class="pt-2">
                                <x-form.container routeName="logout" method="POST" className="w-full">
                                    <x-button label="Logout"
                                        className="px-6 py-2 hover:bg-gray-100 text-custom-red font-semibold w-full text-start"
                                        submit />
                                </x-form.container>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Sidebar Menu (Hidden on Large Screens) -->
        <aside id="mobile-menu"
            class="fixed top-22 left-0 w-64 h-screen bg-white shadow-md transform -translate-x-full transition-transform lg:hidden overflow-auto z-50">
            <nav>
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ Request::routeIs('admin.dashboard*') ? 'flex items-center gap-2 px-10 py-5 w-full border-r-8 border-custom-red font-semibold text-custom-red cursor-pointer' : 'flex items-center gap-2 px-10 py-5 w-full border-r-8 border-white font-semibold text-gray-500 cursor-pointer' }}">
                    <div class="w-auto h-auto flex items-center"><span class="akar-icons--dashboard"></span></div>
                    <p>Dashboard</p>
                </a>
                <a href="{{ route('admin.users') }}"
                    class="{{ Request::routeIs('admin.users*') ? 'flex items-center gap-2 px-10 py-5 w-full border-r-8 border-custom-red font-semibold text-custom-red cursor-pointer' : 'flex items-center gap-2 px-10 py-5 w-full border-r-8 border-white font-semibold text-gray-500 cursor-pointer' }}">
                    <div class="w-auto h-auto flex items-center"><span class="cuida--users-outline"></span></div>
                    <p>Users</p>
                </a>
                <a href="{{ route('admin.histories') }}"
                    class="{{ Request::routeIs('admin.histories*') ? 'flex items-center gap-2 px-10 py-5 w-full border-r-8 border-custom-red font-semibold text-custom-red cursor-pointer' : 'flex items-center gap-2 px-10 py-5 w-full border-r-8 border-white font-semibold text-gray-500 cursor-pointer' }}">
                    <div class="w-auto h-auto flex items-center"><span
                            class="material-symbols--history-rounded w-6 h-6"></span></div>
                    <p>History</p>
                </a>
                {{-- <a href="{{ route('admin.school') }}"
                        class="{{ Request::routeIs('admin.school*') ? 'flex items-center gap-2 px-10 py-5 w-full border-r-8 border-custom-red font-semibold text-custom-red cursor-pointer' : 'flex items-center gap-2 px-10 py-5 w-full border-r-8 border-white font-semibold text-gray-500 cursor-pointer' }}">
                        <div class="w-auto h-auto flex items-center"><span
                                class="tabler--school"></span></div>
                        <p>School</p>
                    </a> --}}
                <a href="{{ route('admin.profile') }}"
                    class="{{ Request::routeIs('admin.profile*') ? 'flex items-center gap-2 px-10 py-5 w-full border-r-8 border-custom-red font-semibold text-custom-red cursor-pointer' : 'flex items-center gap-2 px-10 py-5 w-full border-r-8 border-white font-semibold text-gray-500 cursor-pointer' }}">
                    <div class="w-auto h-auto flex items-center"><span class="cuida--user-outline"></span></div>
                    <p>Profile</p>
                </a>
            </nav>
        </aside>

        {{-- <main class="container max-w-screen-xl mx-auto"> --}}
        <div class="lg:mt-[93px] mt-[89px] h-full w-full lg:grid lg:grid-cols-12">

            <!-- Left Sidebar (Sticky on Large Screens) -->
            <aside
                class="hidden lg:block md:col-span-2 bg-white shadow-xl sticky top-20 h-[calc(100vh-5rem)] overflow-auto py-5">
                <!-- Navigation -->
                <nav>
                    <a href="{{ route('admin.dashboard') }}"
                        class="{{ Request::routeIs('admin.dashboard*') ? 'flex items-center gap-2 px-10 py-5 w-full border-r-8 border-custom-red font-semibold text-custom-red cursor-pointer' : 'flex items-center gap-2 px-10 py-5 w-full border-r-8 border-white font-semibold text-gray-500 cursor-pointer' }}">
                        <div class="w-auto h-auto flex items-center"><span class="akar-icons--dashboard"></span></div>
                        <p>Dashboard</p>
                    </a>
                    <a href="{{ route('admin.users') }}"
                        class="{{ Request::routeIs('admin.users*') ? 'flex items-center gap-2 px-10 py-5 w-full border-r-8 border-custom-red font-semibold text-custom-red cursor-pointer' : 'flex items-center gap-2 px-10 py-5 w-full border-r-8 border-white font-semibold text-gray-500 cursor-pointer' }}">
                        <div class="w-auto h-auto flex items-center"><span class="cuida--users-outline"></span></div>
                        <p>Users</p>
                    </a>
                    <a href="{{ route('admin.histories') }}"
                        class="{{ Request::routeIs('admin.histories*') ? 'flex items-center gap-2 px-10 py-5 w-full border-r-8 border-custom-red font-semibold text-custom-red cursor-pointer' : 'flex items-center gap-2 px-10 py-5 w-full border-r-8 border-white font-semibold text-gray-500 cursor-pointer' }}">
                        <div class="w-auto h-auto flex items-center"><span
                                class="material-symbols--history-rounded w-6 h-6"></span></div>
                        <p>History</p>
                    </a>
                    <a href="{{ route('admin.profile') }}"
                        class="{{ Request::routeIs('admin.profile*') ? 'flex items-center gap-2 px-10 py-5 w-full border-r-8 border-custom-red font-semibold text-custom-red cursor-pointer' : 'flex items-center gap-2 px-10 py-5 w-full border-r-8 border-white font-semibold text-gray-500 cursor-pointer' }}">
                        <div class="w-auto h-auto flex items-center"><span class="cuida--user-outline"></span></div>
                        <p>Profile</p>
                    </a>
                </nav>
            </aside>

            <!-- Main Content (Auto Scroll) -->
            <main class="lg:col-span-6 overflow-auto lg:!p-10 px-5 pt-5 pb-20 h-[calc(100vh-5rem)] bg-gray-100">
                {{ $slot }}
            </main>

            <!-- ✅ Unique Button for Toggling (Outside Panel) -->
            <button id="toggleAttendance"
                class="w-full sticky bottom-0 lg:hidden flex items-center justify-center py-3 bg-custom-red text-white">
                <span class="icon-park-outline--to-top-one mr-2"></span>
                View Attendance
            </button>

            <!-- ✅ Attendance Panel -->
            <aside id="attendancePanel"
                class="lg:col-span-4 lg:!h-[calc(100vh-5rem)] lg:static bg-gradient-to-r from-custom-orange via-custom-orange/90 to-custom-red shadow-md fixed bottom-0 left-0 w-full h-1/2 lg:!p-10 p-5 overflow-auto hidden lg:block z-30">

                <!-- ✅ Unique Button for Hiding (Inside Panel) -->
                <button id="toggleAttendance"
                    class="fixed bottom-1/2 left-0 w-full lg:hidden flex items-center justify-center py-3 bg-custom-red text-white z-30">
                    <span class="icon-park-outline--to-top-one mr-2 rotate-180"></span>
                    Hide Attendance
                </button>

                <div class="w-full h-auto space-y-7">
                    <section class="w-full h-fit">
                        <div class="p-5 rounded-xl border border-gray-200 bg-white h-auto w-full space-y-5">
                            <div
                                class="flex items-end flex-wrap gap-2 text-custom-red justify-between w-full font-semibold">
                                <div class="flex items-start gap-2">
                                    <span class="hugeicons--champion"></span>
                                    <p class="font-semibold text-lg">Top 3 Performer</p>
                                </div>
                                <p class="text-sm font-semibold">Highest Hour Basis</p>
                            </div>

                            <!--HTML CODE-->
                            <div class="w-full relative h-fit">
                                <div class="swiper progress-slide-carousel swiper-container relative">
                                    <div class="swiper-wrapper">
                                        @forelse ($ranking as $index => $user)
                                            <div class="swiper-slide">
                                                <div
                                                    class="bg-custom-orange/5 rounded-md h-52 py-3 w-full overflow-hidden relative flex items-center justify-center">

                                                    <!-- Centered & Blended Image -->
                                                    <x-image path="resources/img/default-male.png"
                                                        className="absolute inset-0 mx-auto h-full scale-125 w-auto opacity-20 z-0" />

                                                    <section
                                                        class="flex items-end text-center gap-2 w-full h-full p-3 rounded-md z-20 relative">
                                                        <div class="w-full space-y-1 px-5">
                                                            <p class="text-sm font-semibold">TOP {{ $index + 1 }}
                                                            </p>
                                                            <h1 class="text-sm truncate capitalize text-gray-500/80">
                                                                {{ $user['name'] }}
                                                            </h1>
                                                            <p class="text-xl font-semibold text-custom-orange">
                                                                {{ $user['hours_worked'] }} hours
                                                            </p>
                                                        </div>
                                                    </section>
                                                </div>
                                            </div>
                                        @empty
                                            <div
                                                class="flex w-full items-center justify-center h-full font-semibold text-gray-500">
                                                No top performer yet.
                                            </div>
                                        @endforelse


                                    </div>
                                    <div
                                        class="swiper-pagination !bottom-5 !top-auto !w-80 right-0 mx-auto bg-gray-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section
                        class="p-5 w-full border bg-white border-gray-200 rounded-xl h-[500px] overflow-hidden space-y-5">
                        <div
                            class="flex items-end flex-wrap gap-2 text-custom-red justify-between w-full font-semibold">
                            <div class="flex items-start gap-2">
                                <span class="material-symbols--co-present-outline"></span>
                                <p class="font-semibold text-lg">Daily Attendance</p>
                            </div>

                            <div class="text-sm font-semibold">{{ \Carbon\Carbon::now()->format('M d, Y') }}</div>
                        </div>
                        <div class="h-[90%] w-full bg-white overflow-y-auto border border-gray-100 rounded-md">
                            @forelse ($array_daily as $daily)
                                <section
                                    class="px-7 py-5 w-full flex flex-wrap justify-between odd:bg-custom-orange/5 bg-white items-center">
                                    <div class="flex items-start gap-5 w-full">
                                        <x-image className="w-12 h-12 rounded-full border border-custom-orange"
                                            path="resources/img/default-male.png" />
                                        <div class="flex items-center flex-wrap justify-between w-full gap-x-2">
                                            <div>
                                                <section class="font-bold text-black text-lg truncate">
                                                    {{ $daily['timeFormat'] }}
                                                </section>
                                                <p class="text-sm font-medium text-gray-700 capitalize truncate">
                                                    {{ $daily['name'] }}</p>
                                            </div>
                                            @if ($daily['description'] === 'time in')
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
                                        </div>
                                    </div>
                                </section>
                            @empty
                                <h1
                                    class="text-center flex items-center justify-center h-full font-semibold text-gray-500">
                                    Waiting for attendees...
                                </h1>
                            @endforelse
                        </div>
                    </section>
                </div>
            </aside>
        </div>

        <script>
            document.querySelectorAll('#toggleAttendance').forEach(button => {
                button.addEventListener('click', function() {
                    const panel = document.getElementById('attendancePanel');
                    const allButtons = document.querySelectorAll('#toggleAttendance');

                    const isHidden = panel.classList.contains('hidden');

                    allButtons.forEach(btn => {
                        const icon = btn.querySelector('span'); // Get the icon inside the button

                        if (isHidden) {
                            panel.classList.remove('hidden');
                            panel.classList.add('block'); // Show panel
                            btn.innerHTML =
                                '<span class="icon-park-outline--to-top-one mr-2 rotate-180"></span> Hide Attendance';
                        } else {
                            panel.classList.remove('block');
                            panel.classList.add('hidden'); // Hide panel
                            btn.innerHTML =
                                '<span class="icon-park-outline--to-top-one mr-2"></span> View Attendance';
                        }
                    });
                });
            });
        </script>

        {{-- </main> --}}


        <script>
            const menuToggle = document.getElementById("menu-toggle");
            const mobileMenu = document.getElementById("mobile-menu");

            menuToggle.addEventListener("click", () => {
                mobileMenu.classList.toggle("-translate-x-full");
            });

            // swiper
            var swiper = new Swiper(".progress-slide-carousel", {
                loop: true,
                fraction: true,
                autoplay: {
                    delay: 1200,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".progress-slide-carousel .swiper-pagination",
                    type: "progressbar",
                },
            });

            document.addEventListener("DOMContentLoaded", function() {
                const dropdownToggle = document.getElementById("dropdown-toggle");
                const dropdownMenu = document.getElementById("dropdown-menu");

                // Toggle dropdown visibility on button click
                dropdownToggle.addEventListener("click", function() {
                    dropdownMenu.classList.toggle("hidden");
                });

                // Close dropdown when clicking outside
                document.addEventListener("click", function(event) {
                    if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                        dropdownMenu.classList.add("hidden");
                    }
                });
            });
        </script>
    @else
        {{-- login / register form --}}
        <main class="h-full w-full bg-white">
            {{ $slot }}
        </main>
    @endif
</body>

</html>
