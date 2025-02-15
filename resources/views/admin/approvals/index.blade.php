<x-main-layout>
    <div class="h-auto w-full flex flex-col gap-5">
        <div class="flex justify-between items-center flex-wrap gap-5 w-full">
            <span class="lg:!w-1/2 w-full">
                <x-form.input id="search" name_id="search" placeholder="Search" small />
            </span>
            <div class="flex items-center gap-2 flex-wrap">
                {{-- <button class="px-2 py-1 bg-blue-500 text-white text-sm rounded flex items-center gap-1">
                    <span class="basil--eye-solid w-4 h-4"></span>
                    <p>View</p>
                </button> --}}
                <button id="btn-approve"
                    class="px-3 py-2 bg-green-500 text-white text-sm rounded flex items-center gap-1 disabled:opacity-50">
                    <span class="uil--check w-5 h-5"></span>
                    <p>Approve All</p>
                </button>
                <button id="btn-decline"
                    class="px-3 py-2 bg-red-500 text-white text-sm rounded flex items-center gap-1 disabled:opacity-50">
                    <span class="iconamoon--close-light w-5 h-5"></span>
                    <p>Decline All</p>
                </button>
                <button id="btn-clear"
                    class="px-3 py-2 bg-gray-500 text-white text-sm rounded disabled:opacity-50">Clear
                    Selection</button>
            </div>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table id="recordsTable" class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="*:px-6 *:py-3 *:text-left *:text-sm *:font-semibold *:bg-custom-orange *:text-white">
                        <th>
                            {{-- <input type="checkbox"  class="cursor-pointers"> --}}
                        </th>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Date Requested</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @php
                        $approvals = collect(range(1, 10))
                            ->map(function ($i) {
                                return [
                                    'id' => $i,
                                    'name' => 'John Doe',
                                    'title' => 'Request for DTR Approval',
                                    'date_requested' => now()->subDays($i)->format('Y-m-d'),
                                ];
                            })
                            ->sortByDesc('date_requested');
                    @endphp

                    @forelse ($approvals as $approval)
                        <tr class="border hover:bg-gray-100 *:px-6 *:py-4 row-item" data-id="{{ $approval['id'] }}">
                            <td class="text-center">
                                <input type="checkbox" class="row-checkbox cursor-pointer" id="select-all"
                                    value="{{ $approval['id'] }}">
                            </td>
                            <td>{{ $approval['name'] }}</td>
                            <td>{{ $approval['title'] }}</td>
                            <td>{{ $approval['date_requested'] }}</td>
                            <td class="flex items-center gap-2">
                                <div class="relative group">
                                    <button class="px-2 py-1 bg-blue-500 text-white rounded flex items-center gap-1">
                                        <span class="basil--eye-solid w-6 h-6"></span>
                                    </button>
                                    <span
                                        class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition">
                                        View
                                    </span>
                                </div>

                                <div class="relative group">
                                    <button class="px-2 py-1 bg-green-500 text-white rounded flex items-center gap-1">
                                        <span class="uil--check w-6 h-6"></span>
                                    </button>
                                    <span
                                        class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition">
                                        Approve
                                    </span>
                                </div>

                                <div class="relative group">
                                    <button class="px-2 py-1 bg-red-500 text-white rounded flex items-center gap-1">
                                        <span class="iconamoon--close-light w-6 h-6"></span>
                                    </button>
                                    <span
                                        class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-2 py-1 text-xs text-white bg-gray-800 rounded opacity-0 group-hover:opacity-100 transition">
                                        Decline
                                    </span>
                                </div>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No Data Available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-5 w-full">
            <p>no pagination yet.</p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const selectAllCheckbox = document.getElementById("select-all");
            const checkboxes = document.querySelectorAll(".row-checkbox");
            const rows = document.querySelectorAll(".row-item");
            const approveButton = document.getElementById("btn-approve");
            const declineButton = document.getElementById("btn-decline");
            const clearButton = document.getElementById("btn-clear");
            const searchInput = document.getElementById("search");

            // Initially disable buttons
            approveButton.disabled = true;
            declineButton.disabled = true;
            clearButton.disabled = true;

            function updateActionButtons() {
                const checkedCount = document.querySelectorAll(".row-checkbox:checked").length;

                // Approve and Decline buttons enable when at least one is selected
                approveButton.disabled = checkedCount === 0;
                declineButton.disabled = checkedCount === 0;

                // Clear Selection button enables only if 2 or more are selected
                clearButton.disabled = checkedCount < 2;
            }

            selectAllCheckbox.addEventListener("change", function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = selectAllCheckbox.checked;
                    toggleRowSelection(checkbox.closest("tr"), checkbox.checked);
                });
                updateActionButtons();
            });

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", function() {
                    toggleRowSelection(checkbox.closest("tr"), checkbox.checked);
                    updateActionButtons();
                });
            });

            rows.forEach(row => {
                row.addEventListener("click", function(event) {
                    if (event.target.type !== "checkbox") {
                        const checkbox = row.querySelector(".row-checkbox");
                        checkbox.checked = !checkbox.checked;
                        toggleRowSelection(row, checkbox.checked);
                        updateActionButtons();
                    }
                });
            });

            function toggleRowSelection(row, isSelected) {
                if (isSelected) {
                    row.classList.add("bg-custom-orange/20", "hover:!bg-custom-orange/20", "text-black");
                } else {
                    row.classList.remove("bg-custom-orange/20", "hover:!bg-custom-orange/20", "text-black");
                }
            }

            clearButton.addEventListener("click", function() {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                    toggleRowSelection(checkbox.closest("tr"), false);
                });
                selectAllCheckbox.checked = false;
                updateActionButtons();
            });

            searchInput.addEventListener("keyup", function() {
                const searchTerm = searchInput.value.toLowerCase();
                rows.forEach(row => {
                    const name = row.cells[1].textContent.toLowerCase();
                    const title = row.cells[2].textContent.toLowerCase();
                    const dateRequested = row.cells[3].textContent.toLowerCase();
                    const isVisible = name.includes(searchTerm) || title.includes(searchTerm) ||
                        dateRequested.includes(searchTerm);
                    row.style.display = isVisible ? "" : "none";
                });
            });
        });
    </script>

</x-main-layout>
