
<x-main-layout :array_daily="$array_daily" :ranking="$ranking">
        <section class="w-full h-auto overflow-auto lg:p-10 p-5 space-y-7">

            {{-- <x-modal.dtr-summary id="dtr-summary-modal" /> --}}
            <div class="flex w-full items-center justify-center">
                <div class="xl:w-[75%] lg:w-[85%] md:w-[95%] w-[100%] h-auto lg:pb-20 pb-24">
                    <div
                        class="w-auto h-auto border bg-white border-gray-100 shadow-md resize-none p-8 space-y-5 select-none">
                        <section class="flex items-start justify-between">
                            <x-logo width="lg:w-[200px] w-[150px]" />
                            <x-image path="resources/img/school-logo/sti.png" className="lg:w-16 w-12 h-auto" />
                        </section>
                        <section class="my-7 text-center">
                            <p class="text-custom-orange font-semibold sm:text-base text-sm">OJT Daily Time Record</p>
                            <h1 class="lg:text-xl sm:text-lg text-base md:mt-2 font-bold">
                                {{ $pagination['currentMonth']['name'] }}</h1>
                        </section>
                        <hr>
                        <section class="sm:space-y-2">
                            <p class="lg:text-sm text-xs font-semibold">Name: <span
                                    class="font-normal lg:text-base text-sm capitalize">{{ $user->firstname }}
                                    {{ $user->middlename }}
                                    {{ $user->lastname }}</span></p>
                            <p class="lg:text-sm text-xs font-semibold">Position: <span
                                    class="font-normal lg:text-base text-sm">Intern</span>
                            </p>
                            <div class="flex items-center justify-between gap-3">
                                <p class="lg:text-sm text-xs font-semibold">Hours This Month: <span
                                        class="font-normal lg:text-base text-sm">{{ $totalHoursPerMonth }}
                                        Hours</span></p>
                            </div>
                        </section>

                        <section class="h-auto w-full border border-gray-200 overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-300">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th
                                            class="border lg:text-sm sm:text-xs text-[10px] text-white bg-custom-orange border-custom-orange/80 px-4 py-2">
                                            Day
                                        </th>
                                        <th
                                            class="border lg:text-sm sm:text-xs text-[10px] text-white bg-custom-orange border-custom-orange/80 px-4 py-2">
                                            Time In</th>
                                        <th
                                            class="border lg:text-sm sm:text-xs text-[10px] text-white bg-custom-orange border-custom-orange/80 px-4 py-2">
                                            Time Out
                                        </th>
                                        <th
                                            class="border lg:text-sm sm:text-xs text-[10px] text-white bg-custom-orange border-custom-orange/80 px-4 py-2">
                                            Total Hours
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($records) && count($records) > 0)
                                        @foreach ($records as $date => $data)
                                            <tr class="text-center">
                                                <td
                                                    class="border border-gray-300 px-4 py-2 lg:text-base sm:text-sm text-[10px]">
                                                    {{ \Carbon\Carbon::parse($data['date'])->format(' j') }}</td>
                                                <td
                                                    class="border border-gray-300 px-4 py-2 lg:text-base sm:text-sm text-[10px]">
                                                    {{ $data['time_in'] }}</td>
                                                <td
                                                    class="border border-gray-300 px-4 py-2 lg:text-base sm:text-sm text-[10px]">
                                                    {{ $data['time_out'] }}
                                                </td>
                                                @if ($data['hours_worked'] == '—')
                                                    <td
                                                        class="border border-gray-300 px-4 py-2 lg:text-base sm:text-sm text-[10px]">
                                                        —
                                                    </td>
                                                @else
                                                    @if ($data['hours_worked'] <= 0)
                                                        <td
                                                            class="border border-gray-300 px-4 py-2 lg:text-base sm:text-sm text-[10px]">
                                                            Less than 1 hour
                                                        </td>
                                                    @elseif($data['hours_worked'] <= 1)
                                                        <td
                                                            class="border border-gray-300 px-4 py-2 lg:text-base sm:text-sm text-[10px]">
                                                            {{ $data['hours_worked'] }} hour</td>
                                                    @elseif($data['hours_worked'] > 1)
                                                        <td
                                                            class="border border-gray-300 px-4 py-2 lg:text-base sm:text-sm text-[10px]">
                                                            {{ $data['hours_worked'] }} hours</td>
                                                    @endif
                                                @endif
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="text-center">
                                            <td colspan="4"
                                                class="border border-gray-300 px-4 py-2 lg:text-base sm:text-sm text-[10px]">
                                                No records
                                                found
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </section>

                    </div>
                </div>

                <div
                    class="w-full grid lg:grid-cols-2 grid-cols-1 text-nowrap gap-5 bg-white p-3 border border-gray-200 shadow-lg absolute bottom-5 z-30 rounded-full max-w-screen-xl mx-auto">

                    <section class="lg:col-span-1 lg:flex justify-start items-start hidden">
                        <form action="{{ route('admin.users.dtr.post', ['id' => $user->id]) }}" method="POST" class="inline">
                            @csrf
                            @method('POST')
                            <input type="month" name="searchDate" id="searchDate"
                                class="px-5 py-2 rounded-full cursor-pointer border border-gray-200 text-sm"
                                value="{{ \Carbon\Carbon::parse($pagination['currentMonth']['name'])->format('Y-m') }}"
                                onchange="this.form.submit()">
                        </form>
                        {{-- <form action="{{ route('admin.users.dtr.post') }}" method="POST" class="flex items-center">
                            @csrf
                            @method('POST')
                            <div class="flex items-center gap-5"> --}}
                            
                    </section>

                    {{-- <section class="flex items-center gap-3 col-span-1 lg:justify-center justify-start">
                        <form action="{{ route('users.dtr.post') }}" method="POST" class="inline">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="month" value="{{ $pagination['previousMonth']['month'] }}">
                            <input type="hidden" name="year" value="{{ $pagination['previousMonth']['year'] }}">
                            <button type="submit"
                                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg flex items-center text-sm">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                                <span
                                    class="sm:block hidden">{{ \Carbon\Carbon::parse($pagination['previousMonth']['name'])->format('F Y') }}</span>
                            </button>
                        </form>
                        <form action="{{ route('users.dtr.post') }}" method="POST" class="inline">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="month" value="{{ $pagination['nextMonth']['month'] }}">
                            <input type="hidden" name="year" value="{{ $pagination['nextMonth']['year'] }}">
                            <button type="submit"
                                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg flex items-center text-sm">
                                <span
                                    class="sm:block hidden">{{ \Carbon\Carbon::parse($pagination['nextMonth']['name'])->format('F Y') }}</span>
                                <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </form>
                    </section> --}}

                    <section class="flex items-center gap-3 col-span-1 justify-end">
                        {{-- <x-button tertiary label="DTR Summary" routePath="users.dtr.summary"
                            className="text-xs px-8 modal-button" /> --}}
                        <form
                            action="{{ route('download.pdf', ['records' => $records, 'pagination' => $pagination, 'totalHoursPerMonth' => $totalHoursPerMonth]) }}"
                            method="POST">
                            @csrf
                            @method('POST')
                            <x-button primary label="Download PDF" showLabel="{{ true }}"
                                leftIcon="material-symbols--download-rounded" submit
                                className="text-xs lg:px-8 px-4" />
                        </form>
                    </section>
                </div>
            </div>


        </section>
</x-main-layout>