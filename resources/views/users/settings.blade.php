<x-main-layout>
    <div class="container mx-auto max-w-screen-xl">
        <main class="px-20 py-20 min-h-screen w-full relative">
            <x-form.container routeName="show.login" className="grid grid-cols-12 gap-10 w-full h-full">

                <!-- Profile Section -->
                <div class="col-span-4 h-full w-full">
                    <section
                        class="fixed h-full left-0 top-0 w-1/3 py-10 px-10 bg-white border border-gray-200 shadow-lg">
                        <div class="flex flex-col items-center justify-center gap-20 h-full">

                            <!-- Profile Picture -->
                            <section class="flex flex-col items-center gap-5">
                                <span
                                    class="h-64 w-64 overflow-hidden flex items-center justify-center shadow-md rounded-full">
                                    <x-image path="resources/img/default-male.png"
                                        className="h-full w-full object-cover rounded-full bg-white" />
                                </span>
                                <x-button tertiary leftIcon="bx--image" label="Change" />
                            </section>

                            <!-- Actions -->
                            <section class="flex flex-col items-center gap-5">
                                <x-button primary label="Save Changes" submit leftIcon="eva--save-outline" />
                                <a href="#" class="tracking-wide text-custom-orange">
                                    Reset Password
                                </a>
                            </section>

                        </div>
                    </section>
                </div>

                <!-- Content Section -->
                <section class="col-span-8 w-full h-auto">
                    <div class="space-y-10 w-full h-auto">

                        <section class="space-y-5 w-full">
                            <x-form.section-title title="Personal Information" />
                            <div class="grid grid-cols-3 w-full gap-5">
                                <x-form.input label="First Name" type="text" name_id="first_name" placeholder="John"
                                    labelClass="text-lg font-medium" small />
                                <x-form.input label="Last Name" type="text" name_id="last_name" placeholder="Doe"
                                    labelClass="text-lg font-medium" small />
                                <x-form.input label="Middle Name" type="text" name_id="middle_name"
                                    placeholder="Watson" labelClass="text-lg font-medium" small />
                            </div>
                            <div class="grid grid-cols-2 w-full gap-5">
                                <x-form.input label="Gender" type="text" name_id="gender"
                                    placeholder="Select a gender" labelClass="text-lg font-medium" small />
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
                                <x-form.input label="Email" type="email" name_id="email_address"
                                    placeholder="example@gmail.com" labelClass="text-lg font-medium" small />
                                <x-form.input label="Starting Date" type="date" name_id="starting_date"
                                    placeholder="MMM DD, YYY" labelClass="text-lg font-medium" small />
                            </div>
                        </section>

                        <section class="space-y-5 w-full">
                            <x-form.section-title title="Emergency Contact" />
                            <div class="grid grid-cols-3 w-full gap-5">
                                <x-form.input label="Full Name" type="text" name_id="emergency_full_name"
                                    placeholder="Johny Doe" labelClass="text-lg font-medium" small />
                                <x-form.input label="Contact No." type="text" name_id="emergency_contact_no"
                                    placeholder="+63" labelClass="text-lg font-medium" small />
                                <x-form.input label="Address" type="text" name_id="emergency_address"
                                    placeholder="Davao City" labelClass="text-lg font-medium" small />
                            </div>
                        </section>
                    </div>
                </section>

            </x-form.container>
        </main>
    </div>
</x-main-layout>
