{{-- admin login --}}
@if (Request::routeIs('show.admin.login'))
<main class="container mx-auto max-w-screen-xl">
        <x-main-layout>
        
            <x-form.container routeName="show.reset-password" method="POST"
                className="flex flex-col gap-10 w-1/3 p-10 border border-gray-200 rounded-2xl shadow-xl">

                <div class="flex justify-center">
                    <x-logo />
                </div>

                <div class="flex justify-center">
                    <x-page-title title="admin login" />
                </div>

                <div class="space-y-7">
                    <x-form.input label="Email" name_id="email_address" type="email" big
                        placeholder="admin@email.com" />
                    <x-form.input label="Password" name_id="password" type="password" big placeholder="••••••••" />
                    <x-button primary submit label="Login" className="w-full" />
                </div>
            </x-form.container>
        </x-main-layout>
    </main>

    {{-- user/intern login --}}
@elseif (Request::routeIs('show.login'))
            @if (session('invalid'))
                <p>{{session('invalid')}}</p>
            @endif
    <span>
        <x-modal.forgot-password id="forgot-password-modal" />
        <x-modal.confirmation-email id="confirmation-email-modal" />
    </span>
    <x-main-layout>
        {{-- rweb logo --}}
        <div class="w-full">
            <x-logo />
        </div>

        {{-- title --}}
        <x-page-title title="intern login" />

        {{-- login form --}}
        <x-form.container routeName="login" method="POST" className="space-y-5 w-full">
            @csrf

            {{-- email --}}
            <x-form.input label="Email" classLabel="font-medium text-2xl" name_id="email"
                placeholder="example@gmail.com" type="" labelClass="text-xl font-medium" big />

            {{-- password --}}
            <x-form.input label="Password" classLabel="font-medium text-2xl" name_id="password" placeholder="••••••••"
                type="password" labelClass="text-xl font-medium" big />

            {{-- forgot password --}}
            <section class="flex items-center gap-1">
                <p>Forgot Password?</p>
                <button type="button" data-pd-overlay="#forgot-password-modal"
                    data-modal-target="forgot-password-modal" data-modal-toggle="forgot-password-modal"
                    class="modal-button font-bold hover:text-custom-orange cursor-pointer">Click
                    here.</button>
                {{-- <x-button tertiary label="Click here." className="modal-button" openModal="forgot-password-modal" button /> --}}
            </section>

            {{-- button --}}
            <x-button primary label="Login" submit />

            {{-- <a href="{{ route('show.reset.password') }}">Reset</a> --}}

        </x-form.container>
    </x-main-layout>
@endif
