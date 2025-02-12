<x-main-layout>
    <div class="container mx-auto max-w-screen-xl">
        <div class="h-screen w-full flex flex-col">
            <div class="flex items-center space-x-4">
                <form action="{{ route('users.dtr.post') }}" method="POST" class="flex items-center space-x-4">
                    @csrf
                    @method('POST')

                    <div class="flex space-x-2">
                        <form action="{{ route('users.dtr.post') }}" method="POST" class="inline">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="month" value="{{ $pagination['previousMonth']['month'] }}">
                            <input type="hidden" name="year" value="{{ $pagination['previousMonth']['year'] }}">
                            <button type="submit" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg flex items-center">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                                Previous Month
                            </button>
                        </form>

                        <form action="{{ route('users.dtr.post') }}" method="POST" class="inline">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="month" value="{{ $pagination['nextMonth']['month'] }}">
                            <input type="hidden" name="year" value="{{ $pagination['nextMonth']['year'] }}">
                            <button type="submit" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg flex items-center">
                                Next Month
                                <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </form>

                <div class="ml-auto">
                    <span class="font-bold">Total Hours: </span>
                    <span>{{ $totalHoursPerMonth }} hours</span>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <span class="font-bold">Month: </span>
                    <span>{{ $pagination['currentMonth']['name'] }}</span>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <span class="font-bold">Fullname: </span>
                    <span>{{ $user->firstname }} {{ $user->lastname }}</span>
                </div>
            </div>
            
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 px-4 py-2">Day</th>
                        <th class="border border-gray-300 px-4 py-2">Time In</th>
                        <th class="border border-gray-300 px-4 py-2">Time Out</th>
                        <th class="border border-gray-300 px-4 py-2">Hours Worked</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($records) && count($records) > 0)
                        @foreach($records as $date => $data)
                            <tr class="text-center">
                                {{-- <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</td> --}}
                                <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($data['date'])->format(' j') }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $data['time_in'] }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $data['time_out'] }}</td>
                                @if($data['hours_worked'] == '—')
                                    <td class="border border-gray-300 px-4 py-2">—</td>
                                @else
                                    @if($data['hours_worked'] < 0)
                                        <td class="border border-gray-300 px-4 py-2">Less than 1 hour</td>
                                    @elseif($data['hours_worked'] <= 1)
                                        <td class="border border-gray-300 px-4 py-2">{{ $data['hours_worked'] }} hour</td>
                                    @elseif($data['hours_worked'] > 1)
                                        <td class="border border-gray-300 px-4 py-2">{{ $data['hours_worked'] }} hours</td>
                                    @endif
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr class="text-center">
                            <td colspan="4" class="border border-gray-300 px-4 py-2">No records found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-main-layout>

