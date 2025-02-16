<main class="container mx-auto max-w-screen-xl">

    <x-main-layout>
        <x-modal.confirmation-update-password-modal id="confirmation-update-password-modal" />

        <div class="w-full items-center justify-center flex h-full">
            @php
                $token = request()->query('token');
                $email = request()->query('email');
            @endphp
            <x-form.container routeName="reset-password-validation" method="POST"
                className="w-1/2 border rounded-lg border-gray-100 shadow-md p-10 flex flex-col items-center gap-7">
                <x-logo />

                <x-page-title title="reset password" />

                <div class="space-y-5 w-full">
                    <x-form.input label="New Password" name_id="password" type="password" big placeholder="••••••••" />
                    <x-form.input label="Confirm Password" name_id="password_confirmation" type="password" big
                        placeholder="••••••••" />
                    <x-form.input name_id="token" type="text" hidden value="{{ $token }}" />
                    <x-form.input name_id="email" type="text" hidden value="{{ $email }}" />
                    <div class="flex justify-end">
                        <x-button primary submit openModal="confirmation-update-password-modal" className="modal-button"
                            label="Update Password" big />
                    </div>
                </div>
            </x-form.container>
        </div>
    </x-main-layout>
</main>
