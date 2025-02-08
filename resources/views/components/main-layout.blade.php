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

</head>

<body class="hedvig-letters-sans-regular tracking-wide">

    {{-- guest layout --}}
    @if (Request::routeIs('show.login') || Request::routeIs('show.register'))
        <main class="grid grid-cols-12">

            {{-- guest form content --}}
            <div class="col-span-8 h-full w-full">
                <div class="container mx-auto max-w-screen-xl">
                    <div class="min-h-screen flex items-center justify-center flex-col px-32 py-20 space-y-10">
                        {{ $slot }}
                    </div>
                </div>
            </div>

            {{-- options --}}
            <div class="col-span-4 fixed top-0 right-0 w-1/3">

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
    @elseif (Request::routeIs('users.dashboard') || Request::routeIs('users.settings'))
        <nav class="fixed top-0 left-0 w-full h-auto z-50 bg-white">
            <div class="grid grid-cols-3 text-nowrap h-auto px-20 border shadow-md">
                <section class="flex items-center justify-start">
                    <x-logo />
                </section>

                <section class="flex items-center justify-center">
                    <a href="{{ route('users.dashboard') }}"
                        class="{{ Request::routeIs('users.dashboard*') ? 'border-custom-red text-custom-red py-10 px-7 border-b-4 flex items-center gap-2 font-semibold' : 'text-gray-600 border-white cursor-pointer font-semibold py-10 px-7 border-b-4 flex items-center gap-2' }}">
                        <span class="akar-icons--dashboard"></span>
                        <p>Dashboard</p>
                    </a>

                    <a href="{{ route('users.settings') }}"
                        class="{{ Request::routeIs('users.settings') ? 'border-custom-red text-custom-red py-10 px-7 border-b-4 flex items-center gap-2 font-semibold' : 'text-gray-600 border-white cursor-pointer font-semibold py-10 px-7 border-b-4 flex items-center gap-2' }}">
                        <span class="solar--settings-linear"></span>
                        <p>Settings</p>
                    </a>

                </section>

                <x-form.container routeName="logout" className="flex items-center justify-end">
                    @csrf
                    <x-button primary label="Logout" leftIcon="material-symbols--logout-rounded" submit
                        className="px-10 py-3" />
                </x-form.container>
            </div>
        </nav>

        <main class="pt-20">
            {{ $slot }}
        </main>


        <!-- Toggle Button -->
        {{-- <span
                    class="text-custom-red cursor-pointer absolute top-14 right-[-40px] rounded-r bg-white h-fit w-auto flex p-2 shadow-md">
                    <span class="lucide--menu w-7 h-7"></span>
                </span> --}}

        {{-- admin layout --}}
    @elseif (Request::routeIs('admin.dashboard'))
        <main class="w-full h-screen">
            <!-- Sidebar (Fixed & on the Left) -->
            <aside
                class="fixed left-0 top-0 h-full border-r shadow-xl py-10 gap-10 flex flex-col justify-between bg-white z-20 w-1/4">
                <section class="space-y-10">
                    <!-- Logo -->
                    <div class="flex justify-start items-center px-10">
                        <x-logo />
                    </div>

                    <!-- Navigation -->
                    <div>
                        <section
                            class="flex items-center gap-2 px-10 py-5 border-r-8 border-custom-red font-semibold text-custom-red cursor-pointer">
                            <span class="akar-icons--dashboard"></span>
                            <p>Dashboard</p>
                        </section>
                        <section
                            class="flex items-center gap-2 px-10 py-5 border-r-8 border-white font-semibold text-gray-500 cursor-pointer">
                            <span class="material-symbols--history-rounded w-6 h-6"></span>
                            <p>History</p>
                        </section>
                        <section
                            class="flex items-center gap-2 px-10 py-5 border-r-8 border-white font-semibold text-gray-500 cursor-pointer">
                            <span class="tabler--school"></span>
                            <p>Schools</p>
                        </section>
                        <section
                            class="flex items-center gap-2 px-10 py-5 border-r-8 border-white font-semibold text-gray-500 cursor-pointer">
                            <span class="cuida--user-outline"></span>
                            <p>Profile</p>
                        </section>
                    </div>
                </section>

                <!-- Logout Button -->
                <section class="px-10 w-full flex justify-center">
                    <x-button primary button label="Logout" leftIcon="material-symbols--logout-rounded"
                        className="w-full" />
                </section>
            </aside>

            <!-- Main Content (Scrollable & on the Right) -->
            <div class="fixed right-0 top-0 w-3/4 p-10 bg-white overflow-y-auto h-screen">
                {{ $slot }}
            </div>
        </main>
    @else
        {{-- no grid --}}
        <main class="min-h-screen py-10 bg-white w-full flex items-center justify-center">
            {{ $slot }}
        </main>
    @endif
</body>

</html>
