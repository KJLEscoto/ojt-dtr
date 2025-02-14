<x-modal.forgot-password id="forgot-password-modal" />
<x-modal.confirmation-email id="confirmation-email-modal" />

@if (session('success'))
    <x-modal.flash-msg msg="success" />
@elseif (session('update'))
    <x-modal.flash-msg msg="update" />
@elseif ($errors->has('invalid'))
    <x-modal.flash-msg msg="invalid" />
@elseif (session('invalid'))
    <x-modal.flash-msg msg="invalid" />
@endif

<x-main-layout>
    {{-- <div class="container mx-auto max-w-screen-xl">
        <x-form.container routeName="users.settings.update" method="POST" className="h-screen w-full flex">
            @method('PUT')

            <!-- Profile Section -->
            <section class="fixed h-full left-0 top-0 w-1/3 p-10 bg-white border border-gray-200 shadow-lg">
                <div class="flex flex-col items-center justify-center gap-20 h-full">

                    <!-- Profile Picture -->
                    <section class="flex flex-col items-center gap-5">
                        <span class="h-64 w-64 overflow-hidden flex items-center justify-center shadow-md rounded-full">
                            <x-image path="resources/img/default-male.png" className="h-full w-full object-cover" />
                        </span>
                        <x-button tertiary leftIcon="bx--image" label="Change" />
                    </section>

                    <!-- Actions -->
                    <section class="flex flex-col items-center gap-5">
                        <x-button primary label="Save Changes" submit leftIcon="eva--save-outline"></x-button>
                        <button type="button" data-pd-overlay="#forgot-password-modal"
                            data-modal-target="forgot-password-modal" data-modal-toggle="forgot-password-modal"
                            class="modal-button text-custom-orange cursor-pointer hover:underline">Reset
                            Password</button>
                    </section>

                </div>
            </section>

            <!-- Content Section -->
            <section class="w-2/3 h-screen fixed right-0 overflow-auto p-20 space-y-10">

                <section class="space-y-5 w-full">
                    <x-form.section-title title="Personal Information" />
                    <div class="grid grid-cols-3 w-full gap-5">
                        <x-form.input label="First Name" type="text" name_id="firstname" placeholder="John"
                            value="{{ $user->firstname }}" labelClass="text-lg font-medium" small />
                        <x-form.input label="Last Name" type="text" name_id="lastname" placeholder="Doe"
                            value="{{ $user->lastname }}" labelClass="text-lg font-medium" small />
                        <x-form.input label="Middle Name" type="text" name_id="middlename"
                            value="{{ $user->middlename }}" placeholder="Watson" labelClass="text-lg font-medium"
                            small />
                    </div>
                    <div class="grid grid-cols-2 w-full gap-5">
                        <x-form.input label="Gender" name_id="gender" placeholder="Select a gender" small
                            value="{{ $user->gender }}" type="select" :options="['male' => 'Male', 'female' => 'Female']" />

                        <x-form.input label="Phone" type="text" name_id="phone" placeholder="+63"
                            value="{{ $user->phone }}" labelClass="text-lg font-medium" small />
                    </div>
                    <div class="grid grid-cols-2 w-full gap-5">
                        <x-form.input label="Address" type="text" name_id="address" placeholder="Davao City"
                            value="{{ $user->address }}" labelClass="text-lg font-medium" small />
                        <x-form.input label="School" type="text" name_id="school" placeholder="School name"
                            value="{{ $user->school }}" labelClass="text-lg font-medium" small />
                    </div>
                </section>

                <section class="space-y-5 w-full">
                    <x-form.section-title title="Account Information" />
                    <div class="grid grid-cols-2 w-full gap-5">
                        <x-form.input label="Email" type="email" name_id="email" value="{{ $user->email }}"
                            placeholder="example@gmail.com" labelClass="text-lg font-medium" small />
                        <x-form.input label="School ID" type="text" name_id="student_no" placeholder="School ID"
                            value="{{ $user->student_no }}" labelClass="text-lg font-medium" small />
                        <x-form.input disabled="true" label="Starting Date" type="date" name_id="starting_date"
                            value="{{ $user->starting_date }}" placeholder="MMM DD, YYY"
                            labelClass="text-lg font-medium" small />
                        <x-form.input disabled="true" label="Expiry Date" type="date" name_id="expiry_date"
                            value="{{ $user->expiry_date }}" placeholder="MMM DD, YYY"
                            labelClass="text-lg font-medium" small />
                    </div>
                </section>

                <section class="space-y-5 w-full">
                    <x-form.section-title title="Emergency Contact" />
                    <div class="grid grid-cols-3 w-full gap-5">
                        <x-form.input label="Full Name" type="text" name_id="emergency_contact_fullname"
                            value="{{ $user->emergency_contact_fullname }}" placeholder="Johny Doe"
                            labelClass="text-lg font-medium" small />
                        <x-form.input label="Contact No." type="text" name_id="emergency_contact_number"
                            value="{{ $user->emergency_contact_number }}" placeholder="+63"
                            labelClass="text-lg font-medium" small />
                        <x-form.input label="Address" type="text" name_id="emergency_contact_address"
                            value="{{ $user->emergency_contact_address }}" placeholder="Davao City"
                            labelClass="text-lg font-medium" small />
                        <x-form.input type="text" name_id="user_id" hidden placeholder="user id"
                            value="{{ $user->id }}" labelClass="text-lg font-medium" small />
                    </div>
                </section>
            </section>

        </x-form.container>
    </div> --}}

    <main class="lg:container max-w-screen-xl mx-auto">
        <x-form.container routeName="users.settings.update" method="POST"
            className="grid lg:grid-cols-12 overflow-auto h-full w-full">
            @method('PUT')

            <section
                class="lg:col-span-4 w-full lg:h-[calc(100vh-7rem)] hidden lg:flex items-center justify-center py-7 px-10">
                <div
                    class="rounded-lg border border-gray-200 bg-white w-full h-full p-7 flex flex-col gap-5 overflow-auto overflow-x-hidden justify-between items-center">
                    <section class="flex flex-col items-center gap-5">
                        <span class="h-44 w-44 overflow-hidden flex items-center justify-center shadow-md rounded-full">
                            <x-image path="resources/img/default-male.png" className="h-full w-full object-cover" />
                        </span>
                        <x-button tertiary leftIcon="bx--image" button label="Change" className="px-6" />
                    </section>

                    <section class="flex flex-col items-center gap-5">
                        <x-button primary label="Save Changes" submit leftIcon="eva--save-outline" className="px-6" />
                        <x-button label="Reset Password" button openModal="forgot-password-modal"
                            className="text-custom-orange cursor-pointer hover:underline modal-button lg:text-base sm:text-sm text-xs" />
                    </section>
                </div>
            </section>

            <section
                class="lg:col-span-8 w-full lg:h-[calc(100vh-7rem)] h-[calc(100vh-4rem)] overflow-auto lg:py-7 p-5 lg:pr-10 flex flex-col gap-7">

                <section
                    class="sticky top-0 bg-white border border-gray-200 rounded-full shadow-lg p-4 w-full lg:hidden block z-30">
                    <section class="flex items-center justify-center gap-5">
                        <x-button primary label="Save Changes" submit leftIcon="eva--save-outline" className="px-6" />
                        <x-button label="Reset Password" button openModal="forgot-password-modal"
                            className="text-custom-orange cursor-pointer hover:underline modal-button lg:text-base text-sm" />
                    </section>
                </section>

                <section class="flex flex-col gap-5 w-full p-7 border border-gray-200 rounded-lg bg-white">
                    <div class="flex flex-col items-center gap-5 lg:hidden">
                        <span class="h-64 w-64 overflow-hidden flex items-center justify-center shadow-md rounded-full">
                            <x-image path="resources/img/default-male.png" className="h-full w-full object-cover" />
                        </span>
                        <x-button tertiary leftIcon="bx--image" label="Change" className="px-6" />
                    </div>
                    <x-form.section-title title="Personal Information" />
                    <div class="grid md:grid-cols-3 w-full gap-5">
                        <x-form.input label="First Name" type="text" name_id="firstname" placeholder="John"
                            value="{{ $user->firstname }}" labelClass="text-lg font-medium" small />
                        <x-form.input label="Last Name" type="text" name_id="lastname" placeholder="Doe"
                            value="{{ $user->lastname }}" labelClass="text-lg font-medium" small />
                        <x-form.input label="Middle Name" type="text" name_id="middlename"
                            value="{{ $user->middlename }}" placeholder="Watson" labelClass="text-lg font-medium"
                            small />
                    </div>
                    <div class="grid grid-cols-2 w-full gap-5">
                        <x-form.input label="Gender" name_id="gender" placeholder="Select a gender" small
                            value="{{ $user->gender }}" type="select" :options="['male' => 'Male', 'female' => 'Female']" />

                        <x-form.input label="Phone" type="text" name_id="phone" placeholder="+63"
                            value="{{ $user->phone }}" labelClass="text-lg font-medium" small />
                    </div>
                    <div class="grid grid-cols-2 w-full gap-5">
                        <x-form.input label="Address" type="text" name_id="address" placeholder="Davao City"
                            value="{{ $user->address }}" labelClass="text-lg font-medium" small />
                        <x-form.input label="School" type="text" name_id="school" placeholder="School name"
                            value="{{ $user->school }}" labelClass="text-lg font-medium" small />
                    </div>
                </section>

                <section class="space-y-5 w-full p-7 border border-gray-200 rounded-lg bg-white">
                    <x-form.section-title title="Account Information" />
                    <div class="grid grid-cols-2 w-full gap-5">
                        <x-form.input label="Email" type="email" name_id="email" value="{{ $user->email }}"
                            placeholder="example@gmail.com" labelClass="text-lg font-medium" small />
                        <x-form.input label="School ID" type="text" name_id="student_no" placeholder="School ID"
                            value="{{ $user->student_no }}" labelClass="text-lg font-medium" small />
                        <x-form.input disabled="true" label="Starting Date" type="date" name_id="starting_date"
                            value="{{ $user->starting_date }}" placeholder="MMM DD, YYY"
                            labelClass="text-lg font-medium" small />
                        <x-form.input disabled="true" label="Expiry Date" type="date" name_id="expiry_date"
                            value="{{ $user->expiry_date }}" placeholder="MMM DD, YYY"
                            labelClass="text-lg font-medium" small />
                    </div>
                </section>

                <section class="space-y-5 w-full p-7 border border-gray-200 rounded-lg bg-white">
                    <x-form.section-title title="Emergency Contact" />
                    <div class="grid md:grid-cols-3 w-full gap-5">
                        <x-form.input label="Full Name" type="text" name_id="emergency_contact_fullname"
                            value="{{ $user->emergency_contact_fullname }}" placeholder="Johny Doe"
                            labelClass="text-lg font-medium" small />
                        <x-form.input label="Contact No." type="text" name_id="emergency_contact_number"
                            value="{{ $user->emergency_contact_number }}" placeholder="+63"
                            labelClass="text-lg font-medium" small />
                        <x-form.input label="Address" type="text" name_id="emergency_contact_address"
                            value="{{ $user->emergency_contact_address }}" placeholder="Davao City"
                            labelClass="text-lg font-medium" small />
                        <x-form.input type="text" name_id="user_id" hidden placeholder="user id"
                            value="{{ $user->id }}" labelClass="text-lg font-medium" small />
                    </div>
                </section>
            </section>
        </x-form.container>
    </main>
</x-main-layout>
