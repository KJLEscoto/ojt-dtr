<x-modal.forgot-password id="forgot-password-modal" />
<x-modal.confirmation-email id="confirmation-email-modal" />

<x-main-layout>
    <div class="container mx-auto max-w-screen-xl">
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
                        <x-form.input disabled label="Starting Date" type="date" name_id="starting_date"
                            value="{{ $user->starting_date }}" placeholder="MMM DD, YYY"
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
    </div>
</x-main-layout>
