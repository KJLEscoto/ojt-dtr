<x-main-layout :array_daily="$array_daily" :ranking="$ranking">
    <div class="w-full h-auto space-y-10">
        <section class="flex items-center justify-between w-full gap-10">
            <span class="w-1/2">
                <x-form.input name_id="search" placeholder="Search" small />
            </span>

            <x-button primary label="Add User" button className="w-fit" />
        </section>

        <section class="grid grid-cols-3 gap-5">
            @for ($i = 1; $i <= 9; $i++)
                <div
                    class="p-5 border border-gray-200 rounded-xl cursor-pointer hover:border-custom-orange flex flex-col gap-5 items-center justify-center h-auto w-full bg-white">
                    <div class="w-auto h-auto">
                        <x-image className="w-24 h-24 rounded-full border border-custom-orange"
                            path="resources/img/default-male.png" />
                    </div>
                    <div class="text-center mx-auto w-full">
                        <h1 class="text-lg font-semibold">Full name</h1>
                        <p class="text-gray-500">Student No.</p>
                    </div>
                </div>
            @endfor
        </section>

        <section class="flex items-center justify-between w-full">
            <p class="text-sm text-gray-500">
                Showing 9 of 29
            </p>

            <div>
                Pagination
            </div>
        </section>
    </div>
</x-main-layout>
