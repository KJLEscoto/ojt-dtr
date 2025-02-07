<x-main-layout>
    <div class="w-full">
        <x-logo />
    </div>

    <x-page-title title="create intern account" />

    <x-form.container routeName="show.login" className="space-y-10 w-full">

        <section class="space-y-5 w-full">
            <x-form.section-title title="Personal Information" />
            <div class="grid grid-cols-3 w-full gap-5">
                <x-form.input label="First Name" type="text" name_id="first_name" placeholder="John"
                    labelClass="text-lg font-medium" small />
                <x-form.input label="Last Name" type="text" name_id="last_name" placeholder="Doe"
                    labelClass="text-lg font-medium" small />
                <x-form.input label="Middle Name" type="text" name_id="middle_name" placeholder="Watson"
                    labelClass="text-lg font-medium" small />
            </div>
            <div class="grid grid-cols-2 w-full gap-5">
                <x-form.input label="Gender" type="text" name_id="gender" placeholder="Select a gender"
                    labelClass="text-lg font-medium" small />
                <x-form.input label="Phone" type="text" name_id="phone" placeholder="+63"
                    labelClass="text-lg font-medium" small />
            </div>
            <div class="grid grid-cols-2 w-full gap-5">
                <x-form.input label="Address" type="text" name_id="address" placeholder="Davao City"
                    labelClass="text-lg font-medium" small />
                <x-form.input label="School" type="text" name_id="school" placeholder="School name"
                    labelClass="text-lg font-medium" small />
            </div>
        </section>

        <section class="space-y-5 w-full">
            <x-form.section-title title="Account Information" />
            <div class="grid grid-cols-2 w-full gap-5">
                <x-form.input label="Email" type="email" name_id="email_address" placeholder="example@gmail.com"
                    labelClass="text-lg font-medium" small />
                <x-form.input label="Starting Date" type="date" name_id="starting_date" placeholder="MMM DD, YYY"
                    labelClass="text-lg font-medium" small />
            </div>
            <div class="grid grid-cols-2 w-full gap-5">
                <x-form.input label="Password" type="password" name_id="password" placeholder="••••••••"
                    labelClass="text-lg font-medium" small />
                <x-form.input label="Confirm Password" type="password" name_id="password_confirmation"
                    placeholder="••••••••" labelClass="text-lg font-medium" small />
            </div>
        </section>

        <section class="space-y-5 w-full">
            <x-form.section-title title="Emergency Contact" />
            <div class="grid grid-cols-3 w-full gap-5">
                <x-form.input label="Full Name" type="text" name_id="emergency_full_name" placeholder="Johny Doe"
                    labelClass="text-lg font-medium" small />
                <x-form.input label="Contact No." type="text" name_id="emergency_contact_no" placeholder="+63"
                    labelClass="text-lg font-medium" small />
                <x-form.input label="Address" type="text" name_id="emergency_address" placeholder="Davao City"
                    labelClass="text-lg font-medium" small />
            </div>
        </section>

        <x-button primary label="Register" submit />
    </x-form.container>
</x-main-layout>
