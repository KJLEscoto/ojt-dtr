<x-main-layout :array_daily="$array_daily" :ranking="$ranking">
    <div class="h-auto w-full space-y-10">
        <section class="flex items-center justify-between w-full gap-10">
            <span class="w-1/2">
                <x-form.input name_id="search" placeholder="Search" small />
            </span>

            <x-button primary label="Filter Month" button className="w-fit" />
        </section>

        <x-main-layout :array_daily="$array_daily" :ranking="$ranking">
            <div class="h-auto w-full space-y-10">
                <section class="flex items-center justify-between w-full gap-10">
                    <span class="w-1/2">
                        <x-form.input name_id="search" placeholder="Search" small />
                    </span>

                    <x-button primary label="Filter Month" button className="w-fit" />
                </section>

                <section class="h-auto w-full">
                    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
                        <table class="w-full border-collapse border border-gray-300">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border">Name</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border">Email
                                    </th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border">
                                        Description</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border">Date &
                                        Time</th>
                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border">Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($records as $history)
                                    <tr class="border hover:bg-gray-50">
                                        <td class="px-6 py-4 border">{{ $history->firstname }}</td>
                                        <td class="px-6 py-4 border">{{ $history->email }}</td>
                                        <td class="px-6 py-4 border">{{ $history->description }}</td>
                                        <td class="px-6 py-4 border">{{ $history->date_time }}</td>
                                        <td class="px-6 py-4 border text-center">
                                            <a href="{{ route('history.view', $history->id) }}"
                                                class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </x-main-layout>

    </div>
</x-main-layout>
