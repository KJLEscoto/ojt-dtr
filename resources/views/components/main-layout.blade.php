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
            height: 100%;
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
    @elseif (Request::routeIs('users.dashboard*') ||
            Request::routeIs('users.settings*') ||
            Request::routeIs('users.dtr*') ||
            Request::routeIs('users.request*'))
        {{-- <div class="w-full h-auto">
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
                class="fixed top-[69px] right-0 mt-1 w-64 h-[calc(100vh-3rem)] bg-white shadow-md transform translate-x-full transition-transform lg:hidden overflow-auto z-50 flex flex-col justify-between">
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
        </div> --}}

        <div class="h-full w-full lg:grid lg:grid-cols-12">
            <section class="sticky lg:hidden top-0 w-full bg-white shadow-md h-auto py-4 z-50">
                <div class="flex items-center justify-between w-full lg:px-10 px-5 gap-5">
                    <section class="grid grid-cols-3 w-full">
                        <div class="col-span-1 flex items-center justify-start w-full">
                            <button id="intern-menu-toggle" class="lg:hidden p-2 border rounded-md w-fit h-fit">
                                ☰
                            </button>
                        </div>
                        <div class="col-span-1 w-full flex items-center justify-center">
                            <x-logo />
                        </div>
                    </section>
                </div>
            </section>

            <!-- Sidebar Menu (Hidden on Large Screens) -->
            <aside id="mobile-menu"
                class="fixed top-22 left-0 mt-0 w-64 h-[calc(100vh-4rem)] bg-white shadow-md transform -translate-x-full transition-transform lg:hidden overflow-auto z-50 flex flex-col justify-between py-5">

                <nav class="w-full flex flex-col gap-10">
                    <section class="w-full flex flex-col gap-2 justify-center items-center px-7">
                        <div class="w-auto h-auto">
                            <x-image path="resources/img/default-male.png"
                                className="h-24 w-24 shadow-md border border-custom-orange rounded-full" />
                        </div>
                        <h1 class="font-bold text-lg capitalize text-center text-ellipsis">{{ Auth::user()->firstname }}
                            {{ substr(Auth::user()->middlename, 0, 1) }}. {{ Auth::user()->lastname }}</h1>
                        <p class="text-custom-red text-center -mt-2">{{ Auth::user()->email }}</p>

                    </section>

                    <section class="w-full border-y border-gray-100 py-5">
                        <x-sidebar-menu route="users.dashboard">
                            <span class="akar-icons--dashboard"></span>
                            <p>Dashboard</p>
                        </x-sidebar-menu>
                        <x-sidebar-menu route="users.dtr">
                            <span class="mingcute--paper-line"></span>
                            <p>DTR</p>
                        </x-sidebar-menu>
                        <x-sidebar-menu route="users.request">
                            <span class="ph--hand-deposit"></span>
                            <p>Request</p>
                        </x-sidebar-menu>
                        <x-sidebar-menu route="users.settings">
                            <span class="solar--settings-linear"></span>
                            <p>Settings</p>
                        </x-sidebar-menu>
                    </section>
                </nav>

                <section class="pt-5 w-full">
                    <x-form.container routeName="logout" className="flex items-center justify-center">
                        @csrf
                        <button
                            class="flex items-center opacity-100 gap-1 w-full px-8 py-5 font-semibold bg-custom-red hover:bg-custom-red/80 text-white animate-transition"><span
                                class="material-symbols--logout-rounded"></span>Logout</button>
                    </x-form.container>
                </section>
            </aside>

            <!-- Left Sidebar (Sticky on Large Screens) -->
            <aside
                class="hidden lg:flex flex-col justify-between items-center col-span-3 bg-white shadow-xl sticky top-0 h-[calc(100vh)] overflow-auto py-5">

                <nav class="w-full flex flex-col gap-10">

                    <div class="px-7 pt-5 w-full flex justify-center">
                        <x-logo />
                    </div>

                    <section class="w-full flex flex-col gap-2 justify-center items-center px-7">
                        <div class="w-auto h-auto">
                            <x-image path="resources/img/default-male.png"
                                className="h-32 w-32 shadow-md border border-custom-orange rounded-full" />
                        </div>
                        <h1 class="font-bold text-lg capitalize text-center text-ellipsis">{{ Auth::user()->firstname }}
                            {{ substr(Auth::user()->middlename, 0, 1) }}. {{ Auth::user()->lastname }}</h1>
                        <p class="text-custom-red text-center -mt-2">{{ Auth::user()->email }}</p>

                    </section>

                    <section class="w-full border-y border-gray-100 py-5">
                        <x-sidebar-menu route="users.dashboard">
                            <span class="akar-icons--dashboard"></span>
                            <p>Dashboard</p>
                        </x-sidebar-menu>
                        <x-sidebar-menu route="users.dtr">
                            <span class="mingcute--paper-line"></span>
                            <p>DTR</p>
                        </x-sidebar-menu>
                        <x-sidebar-menu route="users.request">
                            <span class="ph--hand-deposit"></span>
                            <p>Request</p>
                        </x-sidebar-menu>
                        <x-sidebar-menu route="users.settings">
                            <span class="solar--settings-linear"></span>
                            <p>Settings</p>
                        </x-sidebar-menu>
                    </section>
                </nav>

                <section class="pt-5 w-full">
                    <x-form.container routeName="logout" className="flex items-center justify-center">
                        @csrf
                        <button
                            class="flex items-center opacity-100 gap-1 w-full px-8 py-5 font-semibold bg-custom-red hover:bg-custom-red/80 text-white animate-transition"><span
                                class="material-symbols--logout-rounded"></span>Logout</button>
                    </x-form.container>
                </section>
            </aside>

            <!-- Main Content (Auto Scroll) -->
            <main
                class="col-span-9 overflow-auto w-full lg:!h-[calc(100vh)] h-[calc(100vh-4rem)] bg-gray-100 lg:!p-10 p-5">
                {{ $slot }}
            </main>
        </div>

        <script>
            const menuToggle = document.getElementById("intern-menu-toggle");
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

        {{-- admin layout --}}
    @elseif (Request::routeIs('admin.dashboard*') ||
            Request::routeIs('admin.users*') ||
            Request::routeIs('admin.histories*') ||
            Request::routeIs('admin.profile*') ||
            Request::routeIs('admin.approvals*'))
        @props(['array_daily' => '', 'ranking' => ''])

        {{-- <main class="container max-w-screen-xl mx-auto"> --}}
        <div class="h-full w-full lg:grid lg:grid-cols-12">

            <!-- Sidebar Menu (Hidden on Large Screens) -->
            <aside id="mobile-menu"
                class="fixed top-22 left-0 mt-20 w-64 h-[calc(100vh-5rem)] bg-white shadow-md transform -translate-x-full transition-transform lg:hidden overflow-auto z-50">
                <div class="px-5 pt-7 w-full">
                    <x-logo />
                </div>
                <nav class="mt-5">
                    <x-sidebar-menu route="admin.dashboard">
                        <div class="w-auto h-auto flex items-center"><span class="akar-icons--dashboard"></span>
                        </div>
                        <p>Dashboard</p>
                    </x-sidebar-menu>
                    <x-sidebar-menu route="admin.approvals">
                        <div class="w-auto h-auto flex items-center"><span class="lucide--check-check"></span></div>
                        <p>Approvals</p>
                    </x-sidebar-menu>
                    <x-sidebar-menu route="admin.users">
                        <div class="w-auto h-auto flex items-center"><span class="cuida--users-outline"></span>
                        </div>
                        <p>Users</p>
                    </x-sidebar-menu>
                    <x-sidebar-menu route="admin.histories">
                        <div class="w-auto h-auto flex items-center"><span
                                class="material-symbols--history-rounded w-6 h-6"></span></div>
                        <p>History</p>
                    </x-sidebar-menu>
                    <x-sidebar-menu route="admin.profile">
                        <div class="w-auto h-auto flex items-center"><span class="cuida--user-outline"></span></div>
                        <p>Profile</p>
                    </x-sidebar-menu>
                </nav>
            </aside>

            <!-- Left Sidebar (Sticky on Large Screens) -->
            <aside
                class="hidden lg:block col-span-2 bg-white shadow-xl sticky top-0 h-[calc(100vh)] overflow-auto py-5">
                <div class="px-5 w-full">
                    <x-logo />
                </div>
                <!-- Navigation -->
                <nav class="mt-10">
                    <x-sidebar-menu route="admin.dashboard">
                        <div class="w-auto h-auto flex items-center"><span class="akar-icons--dashboard"></span>
                        </div>
                        <p>Dashboard</p>
                    </x-sidebar-menu>
                    <x-sidebar-menu route="admin.approvals">
                        <div class="w-auto h-auto flex items-center"><span class="lucide--check-check"></span></div>
                        <p>Approvals</p>
                    </x-sidebar-menu>
                    <x-sidebar-menu route="admin.users">
                        <div class="w-auto h-auto flex items-center"><span class="cuida--users-outline"></span>
                        </div>
                        <p>Users</p>
                    </x-sidebar-menu>
                    <x-sidebar-menu route="admin.histories">
                        <div class="w-auto h-auto flex items-center"><span
                                class="material-symbols--history-rounded w-6 h-6"></span></div>
                        <p>History</p>
                    </x-sidebar-menu>
                    <x-sidebar-menu route="admin.profile">
                        <div class="w-auto h-auto flex items-center"><span class="cuida--user-outline"></span></div>
                        <p>Profile</p>
                    </x-sidebar-menu>
                </nav>
            </aside>

            <!-- Main Content (Auto Scroll) -->
            <main class="col-span-10 overflow-auto w-full h-[calc(100vh)] bg-gray-100">
                <section class="sticky top-0 w-full bg-white shadow-md h-auto py-4 z-50">
                    <div class="flex items-center justify-between w-full lg:px-10 px-5 gap-5">
                        <section class="flex items-center gap-4">
                            <button id="menu-toggle" class="lg:hidden p-2 border rounded-md">
                                ☰
                            </button>
                            @if (Request::routeIs('admin.dashboard*'))
                                <x-page-title title="Dashboard" />
                            @elseif (Request::routeIs('admin.approvals*'))
                                <x-page-title title="Approvals" />
                            @elseif (Request::routeIs('admin.users*'))
                                <x-page-title title="Users" />
                            @elseif (Request::routeIs('admin.histories*'))
                                <x-page-title title="History" />
                            @elseif (Request::routeIs('admin.profile*'))
                                <x-page-title title="Profile" />
                            @endif
                        </section>

                        <section class="flex items-center gap-2">
                            <div class="dropdown relative inline-flex self-center">
                                <button type="button" id="dropdown-notification"
                                    class="dropdown-notification w-10 h-10 relative text-gray-500 p-2 rounded-full hover:bg-gray-100 cursor-pointer">
                                    <span class="mi--notification w-full h-full relative"></span>
                                    <div class="absolute top-2 right-2 w-3 h-3 rounded-full bg-custom-red"></div>
                                </button>

                                <div id="dropdown-show-notification"
                                    class="dropdown-menu-notification hidden rounded-lg shadow-lg border border-gray-300 bg-white absolute top-full lg:-right-40 -right-20 mt-2 md:w-[600px] sm:w-[400px] w-[300px] z-20">

                                    <!-- Header -->
                                    <div class="px-4 py-3 flex justify-between items-center text-custom-orange">
                                        <h2 class="text-base font-semibold">Notifications (<span
                                                id="notification-count">9</span>)</h2>
                                        {{-- <button id="close-dropdown"
                                            class="text-gray-500 hover:text-custom-red text-lg">&times;</button> --}}
                                    </div>

                                    <!-- Tabs -->
                                    <div class="flex border-b text-sm">
                                        <button id="tab-all"
                                            class="tab-btn px-4 py-2 text-custom-orange border-custom-orange font-semibold border-b-2">
                                            All
                                        </button>
                                        <button id="tab-unread" class="tab-btn px-4 py-2 text-gray-500">
                                            Unread (7)
                                        </button>
                                        <button id="tab-archived" class="tab-btn px-4 py-2 text-gray-500">
                                            Archived (0)
                                        </button>
                                    </div>

                                    <!-- Tab Content -->
                                    <section id="tab-content-all"
                                        class="divide-y divide-gray-100 w-full h-60 overflow-auto">
                                        <!-- Sample Approval Notification -->
                                        <section>
                                            @for ($i = 1; $i <= 7; $i++)
                                                <div
                                                    class="flex items-center justify-between gap-5 p-3 w-full cursor-pointer hover:bg-custom-orange/5 bg-custom-orange/10">
                                                    <div class="flex items-center gap-3 w-1/2">
                                                        <x-image path="resources/img/default-male.png"
                                                            className="w-10 h-10 rounded-full border border-custom-orange" />
                                                        <div class="w-full truncate">
                                                            <p class="text-sm font-semibold truncate">John Doe Unread
                                                                {{ $i }}
                                                            </p>
                                                            <p class="text-xs text-gray-500 truncate">Request for
                                                                DTR
                                                                Approval</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex items-center space-x-2">
                                                        <button
                                                            class="text-gray-400 hover:bg-gray-400 hover:text-white p-2 rounded-lg text-xs flex items-center gap-1">
                                                            <div class="w-auto h-auto">
                                                                <span
                                                                    class="material-symbols--archive-rounded w-4 h-4"></span>
                                                            </div>
                                                            <p>Archive</p>
                                                        </button>
                                                        <span class="bg-custom-orange w-2 h-2 rounded-full"></span>
                                                    </div>
                                                </div>
                                            @endfor
                                        </section>
                                        <section>
                                            @for ($i = 1; $i <= 2; $i++)
                                                <div
                                                    class="flex items-center justify-between gap-5 p-3 w-full cursor-pointer hover:bg-custom-orange/5 bg-white">
                                                    <div class="flex items-center gap-3 w-1/2">
                                                        <x-image path="resources/img/default-male.png"
                                                            className="w-10 h-10 rounded-full border border-custom-orange" />
                                                        <div class="w-full truncate">
                                                            <p class="text-sm font-semibold truncate">John Doe Read
                                                                {{ $i }}
                                                            </p>
                                                            <p class="text-xs text-gray-500 truncate">Request for
                                                                DTR
                                                                Approval</p>
                                                        </div>
                                                    </div>
                                                    <div class="flex space-x-2">
                                                        <button
                                                            class="text-gray-400 hover:bg-gray-400 hover:text-white p-2 rounded-lg text-xs flex items-center gap-1">
                                                            <div class="w-auto h-auto">
                                                                <span
                                                                    class="material-symbols--archive-rounded w-4 h-4"></span>
                                                            </div>
                                                            <p>Archive</p>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endfor
                                        </section>
                                    </section>

                                    <section id="tab-content-unread"
                                        class="hidden divide-y divide-gray-100 w-full h-60 overflow-auto">
                                        <!-- Sample Approval Notification -->
                                        @for ($i = 1; $i <= 7; $i++)
                                            <div
                                                class="flex items-center justify-between gap-5 p-3 w-full cursor-pointer hover:bg-custom-orange/5 bg-custom-orange/10">
                                                <div class="flex items-center gap-3 w-1/2">
                                                    <x-image path="resources/img/default-male.png"
                                                        className="w-10 h-10 rounded-full border border-custom-orange" />
                                                    <div class="w-full truncate">
                                                        <p class="text-sm font-semibold truncate">John Doe Unread
                                                            {{ $i }}
                                                        </p>
                                                        <p class="text-xs text-gray-500 truncate">Request for
                                                            DTR
                                                            Approval</p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <button
                                                        class="text-gray-400 hover:bg-gray-400 hover:text-white p-2 rounded-lg text-xs flex items-center gap-1">
                                                        <div class="w-auto h-auto">
                                                            <span
                                                                class="material-symbols--archive-rounded w-4 h-4"></span>
                                                        </div>
                                                        <p>Archive</p>
                                                    </button>
                                                    <span class="bg-custom-orange w-2 h-2 rounded-full"></span>
                                                </div>
                                            </div>
                                        @endfor
                                    </section>

                                    <section id="tab-content-archived"
                                        class="hidden divide-y divide-gray-100 w-full h-60 overflow-auto">
                                        <p
                                            class="text-sm text-center text-gray-500 p-4 flex items-center justify-center h-full">
                                            Nothing here.</p>
                                    </section>
                                </div>
                            </div>

                            <div class="dropdown relative inline-flex">
                                <button type="button" id="dropdown-profile" data-target="dropdown-show-profile"
                                    class="dropdown-profile items-center gap-2 hover:bg-gray-100 rounded-lg py-2 px-3 overflow-hidden inline-flex">
                                    <x-image path="resources/img/default-male.png"
                                        className="w-10 h-auto rounded-full shadow border border-custom-red" />
                                    <p class="lg:block hidden capitalize">{{ Auth::user()->firstname }}</p>
                                    <span class="iconamoon--arrow-down-2"></span>
                                </button>
                                <div id="dropdown-show-profile"
                                    class="dropdown-menu-profile hidden rounded-lg shadow-lg border border-gray-300 bg-white absolute top-full right-0 w-72 divide-y divide-gray-200">
                                    <ul class="py-2">
                                        <li>
                                            <a class="block px-6 py-2 hover:bg-gray-100 text-gray-900 font-semibold"
                                                href="{{ route('admin.profile') }}"> Profile </a>
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

                        </section>
                    </div>
                </section>

                <section class="lg:!p-10 p-5">
                    {{ $slot }}
                </section>
            </main>
        </div>
        {{-- </main> --}}

        <script>
            const menuToggle = document.getElementById("menu-toggle");
            const mobileMenu = document.getElementById("mobile-menu");

            menuToggle.addEventListener("click", () => {
                mobileMenu.classList.toggle("-translate-x-full");
            });

            // notifications and profile
            document.addEventListener("DOMContentLoaded", function() {
                const dropdownProfile = document.getElementById("dropdown-profile");
                const dropdownMenuProfile = document.getElementById("dropdown-show-profile");

                const dropdownNotification = document.getElementById("dropdown-notification");
                const dropdownMenuNotification = document.getElementById("dropdown-show-notification");

                const closeDropdown = document.getElementById("close-dropdown");

                const tabs = {
                    all: document.getElementById("tab-all"),
                    unread: document.getElementById("tab-unread"),
                    archived: document.getElementById("tab-archived")
                };

                const tabContents = {
                    all: document.getElementById("tab-content-all"),
                    unread: document.getElementById("tab-content-unread"),
                    archived: document.getElementById("tab-content-archived")
                };

                function closeAllDropdowns() {
                    dropdownMenuProfile?.classList.add("hidden");
                    dropdownMenuNotification?.classList.add("hidden");
                }

                function toggleDropdown(dropdownButton, dropdownMenu, otherDropdownMenu) {
                    if (dropdownMenu.classList.contains("hidden")) {
                        closeAllDropdowns(); // Close any open dropdown first
                        dropdownMenu.classList.remove("hidden"); // Open clicked dropdown
                    } else {
                        dropdownMenu.classList.add("hidden"); // Close dropdown if already open
                    }
                }

                // Toggle profile dropdown
                dropdownProfile?.addEventListener("click", function(event) {
                    event.stopPropagation();
                    toggleDropdown(dropdownProfile, dropdownMenuProfile, dropdownMenuNotification);
                });

                // Toggle notification dropdown
                dropdownNotification?.addEventListener("click", function(event) {
                    event.stopPropagation();
                    toggleDropdown(dropdownNotification, dropdownMenuNotification, dropdownMenuProfile);
                });

                closeDropdown?.addEventListener("click", function() {
                    closeAllDropdowns();
                });

                // Close dropdown when clicking outside
                document.addEventListener("click", function(event) {
                    if (
                        !dropdownProfile?.contains(event.target) &&
                        !dropdownMenuProfile?.contains(event.target) &&
                        !dropdownNotification?.contains(event.target) &&
                        !dropdownMenuNotification?.contains(event.target)
                    ) {
                        closeAllDropdowns();
                    }
                });

                // Tab switching functionality
                function switchTab(activeTab, activeContent) {
                    // Reset all tabs
                    Object.values(tabs).forEach(tab => {
                        tab.classList.remove("text-custom-orange", "border-custom-orange", "font-semibold",
                            "border-b-2");
                        tab.classList.add("text-gray-500");
                    });

                    Object.values(tabContents).forEach(content => content.classList.add("hidden"));

                    // Activate selected tab
                    activeTab.classList.add("text-custom-orange", "border-custom-orange", "font-semibold",
                        "border-b-2");
                    activeTab.classList.remove("text-gray-500");

                    activeContent.classList.remove("hidden");
                }

                // Set initial active tab to 'All'
                switchTab(tabs.all, tabContents.all);

                // Add event listeners for tab clicks
                Object.keys(tabs).forEach(key => {
                    tabs[key].addEventListener("click", function() {
                        switchTab(tabs[key], tabContents[key]);
                    });
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
