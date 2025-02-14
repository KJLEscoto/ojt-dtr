<x-main-layout :array_daily="$array_daily" :ranking="$ranking">

    {{-- <x-form.container routeName="users.settings.update" method="POST"
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
            <x-button routePath="admin.users" label="Back" tertiary button leftIcon="eva--arrow-back-fill"
                className="px-8" />
            <x-button primary label="Save Changes" submit leftIcon="eva--save-outline" className="px-8" />
        </div>

        <div class="">
            <div class="flex items-center w-full justify-center flex-col gap-4">
                <div class="w-auto h-auto">
                    <x-image className="w-40 h-40 rounded-full border border-custom-orange"
                        path="resources/img/default-male.png" />
                </div>
                <x-button tertiary leftIcon="bx--image" label="Change" button className="px-10" />
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
                <x-form.input label="Expiry Date" type="date" name_id="expiry_date"
                    value="{{ $user->expiry_date }}" placeholder="MMM DD, YYY" labelClass="text-lg font-medium"
                    small />
                <x-form.input label="Status" type="select" name_id="status"
                    value="{{ $user->status }}" placeholder="{{ ucfirst($user->status) }}"
                    :options="['active' => 'Active', 'inactive' => 'Inactive']" labelClass="text-lg font-medium"
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

    </x-form.container> --}}

    <div class="h-auto w-full flex flex-col gap-6">
        <section class="flex items-center justify-between gap-5">
            <x-button routePath="admin.users" label="Back" tertiary button leftIcon="eva--arrow-back-fill"
                className="px-8" />
            <div class="flex items-center gap-2">
                <x-button tertiary label="View DTR" routePath="admin.users.dtr" :params="['id' => $user->id]" button className="px-8 font-semibold" />
                <x-button primary label="Edit User" button className="px-8" />
            </div>
        </section>

        <section class="rounded-lg p-7 border border-gray-200 bg-white h-auto w-full space-y-5">

            <x-form.section-title title="User Details" vectorClass="!h-3" />
            <div class="w-full flex items-start gap-5">
                <div class="w-auto h-auto">
                    <x-image className="w-40 h-40 rounded-full border border-custom-orange"
                        path="resources/img/default-male.png" />
                </div>

                <div class="space-y-2">

                    <h1 class="capitalize font-semibold text-lg">{{ $user->firstname }}
                        {{ substr($user->middlename, 0, 1) }}. {{ $user->lastname }}</h1>
                    <section class="flex items-start gap-x-2">
                        <div class="text-sm font-semibold text-gray-700">Gender:</div>
                        <p class="text-base -mt-[3px] capitalize">{{ $user->gender }}</p>
                    </section>
                    <section class="flex items-start gap-x-2">
                        <div class="text-sm font-semibold text-gray-700">Email:</div>
                        <p class="text-base -mt-[3px]">{{ $user->email }}</p>
                    </section>
                    <section class="flex items-start gap-x-2">
                        <div class="text-sm font-semibold text-gray-700">Phone No:</div>
                        <p class="text-base -mt-[3px]">{{ $user->phone }}</p>
                    </section>
                    <section class="flex items-start gap-x-2">
                        <div class="text-sm font-semibold text-gray-600">Address:</div>
                        <p class="text-base -mt-[3px]">{{ $user->address }}</p>
                    </section>
                </div>
            </div>

            <hr>

            <div class="space-y-2">
                <x-form.section-title title="Emergency Contact" vectorClass="!h-3" />
                <section class="flex items-start gap-x-2">
                    <div class="text-sm font-semibold text-gray-700">Name:</div>
                    <p class="text-base -mt-[3px]">{{ $user->emergency_contact_fullname }}</p>
                </section>
                <section class="flex items-start gap-x-2">
                    <div class="text-sm font-semibold text-gray-700">Address:</div>
                    <p class="text-base -mt-[3px]">{{ $user->emergency_contact_address }}</p>
                </section>
                <section class="flex items-start gap-x-2">
                    <div class="text-sm font-semibold text-gray-700">Contact No:</div>
                    <p class="text-base -mt-[3px]">{{ $user->emergency_contact_number }}</p>
                </section>
            </div>

            <hr>

            <div class="space-y-2">
                <x-form.section-title title="Account Status" vectorClass="!h-3" />
                <section class="flex items-start gap-x-2">
                    <div class="text-sm font-semibold text-gray-700">Account Started:</div>
                    <p class="text-base -mt-[3px]">{{ $user->starting_date }}</p>
                </section>
                <section class="flex items-start gap-x-2">
                    <div class="text-sm font-semibold text-gray-700">Account Expiration:</div>
                    <p class="text-base -mt-[3px]">{{ $user->expiry_date }}</p>
                </section>
            </div>
        </section>

        <section class="h-auto w-full border border-gray-200 rounded-lg">
            <div
                class="flex items-center gap-1 px-7 py-5 bg-gradient-to-r from-custom-orange via-custom-orange/90 to-custom-red rounded-t-lg text-white shadow-md w-full">
                <span class="material-symbols--history-rounded w-6 h-6"></span>
                <h1 class="font-semibold">Logged History</h1>
            </div>

            @php
                // $histories = [
                //     ['description' => 'time in', 'timeFormat' => '2025-02-05 08:48:35', 'datetime' => '2025-02-05'],
                //     ['description' => 'time in', 'timeFormat' => '2025-02-05 08:48:35', 'datetime' => '2025-02-05'],
                //     ['description' => 'time in', 'timeFormat' => '2025-02-05 08:48:35', 'datetime' => '2025-02-05'],
                //     ['description' => 'time in', 'timeFormat' => '2025-02-05 08:48:35', 'datetime' => '2025-02-05'],
                //     ['description' => 'time in', 'timeFormat' => '2025-02-05 08:48:35', 'datetime' => '2025-02-05'],
                //     ['description' => 'time in', 'timeFormat' => '2025-02-05 08:48:35', 'datetime' => '2025-02-05'],
                // ];
            @endphp

            <div class="h-60 w-full bg-white overflow-auto rounded-b-lg">
                <div class="text-black flex flex-col items-start justify-start">
                    @foreach ($histories as $history)
                        <section
                            class="px-7 py-5 w-full flex flex-wrap gap-2 justify-between items-center odd:bg-custom-orange/5">
                            <div>
                                <section class="font-bold">{{ $history['timeFormat'] ?? 'N/A' }}</section>
                                <p class="text-sm font-medium text-gray-700">
                                    {{ $history['datetime'] ?? 'No date available' }}
                                </p>
                            </div>
                            @if (!empty($history['description']) && $history['description'] === 'time in')
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
            </div>

        </section>
    </div>
</x-main-layout>
