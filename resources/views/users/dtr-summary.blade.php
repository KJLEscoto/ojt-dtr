<x-main-layout >
    <main class="flex flex-col gap-5 justify-center items-center pt-[8rem]">
        <x-button primary label="Back" routePath="users.dtr" className="text-xs px-8" />
        <div class=" bg-white shadow-md rounded-lg p-4 w-full max-w-3xl border">
            <div class="flex items-start space-x-6 border-b pb-4">
                <!-- Profile Image -->
                <img src="{{ $profile_image ?? 'https://via.placeholder.com/100' }}" alt="Profile Image" class="w-24 h-24 rounded-full border">
                {{-- @dd($monthlyTotals); --}}
                <!-- Info Section -->
                <div class="flex-1 grid grid-cols-3 gap-x-4 gap-y-1 text-sm">
                    <span class="font-semibold">Full Name</span> <span class="col-span-2">: {{ $user->firstname }} {{ $user->lastname }}</span>
                    <span class="font-semibold">Email</span> <span class="col-span-2">: {{ $user->email }}</span>
                    <span class="font-semibold">Phone</span> <span class="col-span-2">: {{ $user->phone }}</span>
                    <span class="font-semibold">School ID</span> <span class="col-span-2">: {{ $user->student_no }}</span>
                    
                    <span class="font-semibold">Address</span> <span class="col-span-2">: {{ $user->address }}</span>
                    <span class="font-semibold">Gender</span> <span class="col-span-2">: {{ $user->gender }}</span>
                    <span class="font-semibold">Date Started</span> <span class="col-span-2">: {{ $user->starting_date }}</span>
    
                    <span class="font-semibold">E-Name</span> <span class="col-span-2">: {{ $user->emergency_contact_fullname }}</span>
                    <span class="font-semibold">E-Contact</span> <span class="col-span-2">: {{ $user->emergency_contact_number }}</span>
                    <span class="font-semibold">E-Address</span> <span class="col-span-2">: {{ $user->emergency_contact_address }}</span>
                </div>
            </div>
    
            <!-- Hours Summary -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold mb-4">Monthly Hours Summary</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 font-semibold">Month</th>
                                <th class="px-4 py-2 font-semibold text-right">Total Hours</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @php $totalHoursOverall = 0; @endphp
                            @foreach($monthlyTotals as $monthData)
                                @php $totalHoursOverall += $monthData['total_hours']; @endphp
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3">{{ $monthData['month_name'] }}</td>
                                    <td class="px-4 py-3 text-right">{{ $monthData['total_hours'] }} hrs</td>
                                </tr>
                            @endforeach
                            <tr class="bg-gray-50 font-semibold">
                                <td class="px-4 py-3">Total Overall Hours</td>
                                <td class="px-4 py-3 text-right">{{ $totalHoursOverall }} hrs</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</x-main-layout>