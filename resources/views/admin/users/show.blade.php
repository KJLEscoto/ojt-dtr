<x-main-layout :array_daily="$array_daily" :ranking="$ranking">

    <x-form.container routeName="users.settings.update" method="POST"
        className="h-auto w-full flex flex-col gap-10 overflow-auto px-3">
        @method('PUT')

        @if (session('success'))
            <x-modal.flash-msg msg="success" />
        @elseif (session('update'))
            <x-modal.flash-msg msg="update" />
        @elseif ($errors->has('invalid'))
            <x-modal.flash-msg msg="invalid" />
        @elseif (session('invalid'))
            <x-modal.flash-msg msg="invalid" />
        @endif

        <div class="flex items-center justify-between gap-5">
            <x-button routePath="admin.users" label="Back" tertiary button />
            <x-button primary label="Save Changes" submit leftIcon="eva--save-outline" />
        </div>

        <div class="">
            <div class="flex items-center w-full justify-center flex-col gap-4">
                <div class="w-auto h-auto">
                    <x-image className="w-40 h-40 rounded-full border border-custom-orange"
                        path="resources/img/default-male.png" />
                </div>
                <x-button tertiary leftIcon="bx--image" label="Change" button />
            </div>
        </div>
        <section class="space-y-5 w-full">
            <x-form.section-title title="Personal Information" />
            <div class="grid grid-cols-3 w-full gap-5">
                <x-form.input label="First Name" type="text" name_id="firstname" placeholder="John"
                    value="{{ $user->firstname }}" labelClass="text-lg font-medium" small />
                <x-form.input label="Last Name" type="text" name_id="lastname" placeholder="Doe"
                    value="{{ $user->lastname }}" labelClass="text-lg font-medium" small />
                <x-form.input label="Middle Name" type="text" name_id="middlename" value="{{ $user->middlename }}"
                    placeholder="Watson" labelClass="text-lg font-medium" small />
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
                <x-form.input label="Starting Date" type="date" name_id="starting_date"
                    value="{{ $user->starting_date }}" placeholder="MMM DD, YYY" labelClass="text-lg font-medium"
                    small />
            </div>
        </section>

        <section class="space-y-5 w-full">
            <x-form.section-title title="Emergency Contact" />
            <div class="grid grid-cols-3 w-full gap-5">
                <x-form.input label="Full Name" type="text" name_id="emergency_contact_fullname"
                    value="{{ $user->emergency_contact_fullname }}" placeholder="Johny Doe"
                    labelClass="text-lg font-medium" small />
                <x-form.input label="Contact No." type="text" name_id="emergency_contact_number"
                    value="{{ $user->emergency_contact_number }}" placeholder="+63" labelClass="text-lg font-medium"
                    small />
                <x-form.input label="Address" type="text" name_id="emergency_contact_address"
                    value="{{ $user->emergency_contact_address }}" placeholder="Davao City"
                    labelClass="text-lg font-medium" small />
                <x-form.input type="text" name_id="user_id" hidden placeholder="user id"
                    value="{{ $user->id }}" labelClass="text-lg font-medium" small />
            </div>
        </section>

    </x-form.container>
</x-main-layout>
