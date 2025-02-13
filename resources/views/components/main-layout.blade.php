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
        <main class="w-full h-screen flex">

            {{-- guest form content --}}
            <div class="w-2/3 h-screen">
                <div class="container mx-auto max-w-screen-xl px-20 py-10 w-full h-full overflow-auto">
                    {{ $slot }}
                </div>

            </div>

            {{-- options --}}
            <div class="fixed top-0 right-0 w-1/3">

                {{-- login button --}}
                @if (Request::routeIs('show.register'))
                    <x-form.option imgPath="/resources/img/register.png" title="Have an account?" routePath="show.login"
                        desc="Stay on top of your schedule!" btnLabel="Login" />

                    {{-- register button --}}
                @elseif (Request::routeIs('show.login'))
                    <x-form.option imgPath="/resources/img/login.png" title="New Intern?" routePath="show.register"
                        desc="Sign up to keep track of your daily attendance." btnLabel="Register" />
                @endif
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

            <main class="lg:mt-28 mt-[75px] bg-gray-100">
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
            <div class="flex justify-between items-center px-10 py-4">
                <button id="menu-toggle" class="lg:hidden p-2 border rounded-md">
                    ☰
                </button>
                <x-logo />
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
            class="fixed top-20 left-0 w-64 h-screen mt-5 bg-white shadow-md transform -translate-x-full transition-transform lg:hidden overflow-auto z-50">
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

        <div class="mt-24 h-[calc(100vh-6rem)] w-full grid lg:grid-cols-12 grid-cols-10">
            <!-- Left Sidebar (Sticky on Large Screens) -->
            <aside
                class="hidden lg:block md:col-span-2 bg-white shadow-xl sticky top-20 h-[calc(100vh-6rem)] overflow-auto py-5">
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

            <!-- Main Content (Auto Scroll) -->
            <main class="md:col-span-6 col-span-full overflow-auto p-10 h-[calc(100vh-6rem)] bg-gray-100">
                {{ $slot }}
            </main>

            <!-- Right Sidebar (Sticky on Large Screens) -->
            <aside
                class="hidden md:block md:col-span-4 bg-gradient-to-r from-custom-orange via-custom-orange/90 to-custom-red shadow-md sticky h-[calc(100vh-6rem)] top-20 p-10 overflow-auto">
                <div class="w-full h-auto space-y-10">
                    <section class="w-full h-fit">
                        <div class="p-5 rounded-xl border border-gray-200 bg-white h-auto w-full space-y-5">
                            <section class="flex gap-2 items-start text-custom-red">
                                <span class="hugeicons--champion"></span>
                                <div class="flex items-end justify-between w-full">
                                    <p class="font-semibold text-lg">Top 3 Performer</p>
                                    <p class="text-sm font-semibold">Highest Hour Basis</p>
                                </div>
                            </section>

                            <!--HTML CODE-->
                            <div class="w-full relative h-fit">
                                <div class="swiper progress-slide-carousel swiper-container relative">
                                    <div class="swiper-wrapper">
                                        @foreach ($ranking as $user)
                                            <div class="swiper-slide">
                                                <div
                                                    class="bg-custom-orange/5 rounded-md py-10 h-full flex justify-center items-center">
                                                    <span class="text-xl font-semibold text-custom-red">
                                                        Intern {{ $user['name'] }} {{ $user['hours_worked'] }} Hours
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
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
                        <div class="flex items-end gap-2 text-custom-red justify-between w-full font-semibold">
                            <div class="flex items-start gap-2">
                                <span class="material-symbols--co-present-outline"></span>
                                <p class="font-semibold text-lg">Daily Attendance</p>
                            </div>

                            @foreach ($array_daily as $daily)
                                <p class="text-sm font-semibold">{{ $daily['datetime'] }}</p>
                            @break
                        @endforeach
                    </div>
                    <div class="h-[90%] w-full bg-white overflow-y-auto border border-gray-100 rounded-md">
                        @foreach ($array_daily as $daily)
                            <section
                                class="px-7 py-5 w-full flex justify-between even:bg-custom-orange/5 bg-white items-center">
                                <div class="flex items-center gap-5">
                                    <x-image className="w-12 h-12 rounded-full border border-custom-orange"
                                        path="resources/img/default-male.png" />

                                    <div>
                                        <section class="font-bold text-black text-lg">{{ $daily['timeFormat'] }}
                                        </section>
                                        <p class="text-sm font-medium text-gray-700 capitalize">
                                            {{ $daily['name'] }}</p>
                                    </div>
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
                            </section>
                        @endforeach
                    </div>
                </section>
            </div>
        </aside>
    </div>


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
    <main class="h-screen w-full overflow-auto bg-white">
        {{ $slot }}
    </main>
@endif
</body>

</html>
