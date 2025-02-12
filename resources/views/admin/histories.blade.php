<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">


<x-main-layout :array_daily="$array_daily" :ranking="$ranking">
    <div class="h-auto w-full space-y-10">
        <section class="flex items-center justify-between w-full gap-10">
            <span class="w-1/2">
                <x-form.input id="search" name_id="search" placeholder="Search" small />
            </span>

            <input class="px-5 py-2 rounded-full cursor-pointer border border-gray-200" type="month" id="month">
        </section>

        <section class="h-auto w-full">
            <div class="overflow-x-auto bg-white rounded-lg shadow-md">
                <table id="recordsTable" class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-custom-orange border">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-custom-orange border">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-custom-orange border">Description
                            </th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-custom-orange border">Date & Time
                            </th>
                            {{-- 
                                currently not used
                            <th class="px-6 py-3 text-left text-sm font-semibold text-custom-orange border">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody id="recordsBody">
                        @foreach ($records as $record)
                            <tr class="border hover:bg-gray-100">
                                <td class="px-6 py-4 border">{{ $record['user']->firstname }}</td>
                                <td class="px-6 py-4 border">{{ $record['user']->email }}</td>
                                <td class="px-6 py-4 border">{{ $record['history']->description }}</td>
                                <td class="px-6 py-4 border">{{ $record['history']->datetime }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination Controls -->
            <div class="flex items-center justify-between mt-4">
                <span id="pagination-info" class="text-sm text-gray-600"></span>
                <div class="flex items-center gap-3">
                    <button id="prev-page"
                        class="px-4 py-2 bg-gray-300 rounded disabled:opacity-50 hover:bg-custom-orange hover:text-white animate-transition disabled:hover:bg-gray-300 disabled:hover:text-current"
                        disabled>Prev</button>

                    {{-- fix this page 1 of --}}
                    <span id="page-info">Page 1 of </span>
                    <button id="next-page"
                        class="px-4 py-2 bg-gray-300 rounded disabled:opacity-50 hover:bg-custom-orange hover:text-white animate-transition disabled:hover:bg-gray-300 disabled:hover:text-current">Next</button>
                </div>
            </div>
        </section>
    </div>
</x-main-layout>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    axios.defaults.headers.common["X-CSRF-TOKEN"] = csrfToken;
    axios.defaults.headers.common["Content-Type"] = "application/json";

    let currentPage = 1;
    let perPage = 10;
    let totalRecords = 0;

    function fetchRecords(searchQuery = '', selectedMonth = '', page = 1) {
        axios.post('/admin/history/search', {
                query: searchQuery,
                date: selectedMonth, // Month filter in YYYY-MM format
                page: page
            })
            .then(response => {
                let data = response.data;
                totalRecords = data.total;
                perPage = data.perPage;
                currentPage = data.currentPage;

                let recordsBody = document.getElementById('recordsBody');
                let paginationInfo = document.getElementById('pagination-info');
                let prevPageBtn = document.getElementById('prev-page');
                let nextPageBtn = document.getElementById('next-page');

                recordsBody.innerHTML = '';

                for (let record of data.records) {
                    let row = document.createElement('tr');
                    row.classList.add('border', 'hover:bg-gray-100');

                    let descriptionClass = record.history.description === 'time in' ?
                        'text-sm font-semibold text-green-500' : 'text-sm font-semibold text-red-500';

                    row.innerHTML = `
                        <td class="px-6 py-4 border">${record.user.firstname}</td>
                        <td class="px-6 py-4 border">${record.user.email}</td>
                        <td class="px-6 py-4 border">
                            <span class="${descriptionClass}">${record.history.description}</span>
                        </td>
                        <td class="px-6 py-4 border">${record.history.datetime}</td>
                    `;

                    recordsBody.appendChild(row);
                }

                paginationInfo.textContent =
                    `Showing ${((currentPage - 1) * perPage) + 1} - ${Math.min(currentPage * perPage, totalRecords)} of ${totalRecords}`;

                let pageInfo = document.getElementById('page-info');
                pageInfo.textContent = `Page ${currentPage} of ${Math.ceil(totalRecords / perPage)}`;

                prevPageBtn.disabled = currentPage === 1;
                nextPageBtn.disabled = currentPage * perPage >= totalRecords;
            })
            .catch(error => console.error('Error:', error));
    }

    document.getElementById('search').addEventListener('keyup', function() {
        let searchQuery = this.value;
        let selectedMonth = document.getElementById('month').value;
        if (searchQuery.length > 2 || searchQuery.length === 0) {
            currentPage = 1;
            fetchRecords(searchQuery, selectedMonth, currentPage);
        }
    });

    document.getElementById('month').addEventListener('change', function() {
        let selectedMonth = this.value;
        let searchQuery = document.getElementById('search').value;
        currentPage = 1;
        fetchRecords(searchQuery, selectedMonth, currentPage);
    });

    document.getElementById('prev-page').addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            let searchQuery = document.getElementById('search').value;
            let selectedMonth = document.getElementById('month').value;
            fetchRecords(searchQuery, selectedMonth, currentPage);
        }
    });

    document.getElementById('next-page').addEventListener('click', function() {
        if (currentPage * perPage < totalRecords) {
            currentPage++;
            let searchQuery = document.getElementById('search').value;
            let selectedMonth = document.getElementById('month').value;
            fetchRecords(searchQuery, selectedMonth, currentPage);
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        let monthInput = document.getElementById("month");
        let today = new Date();
        let currentMonth = today.toISOString().slice(0, 7); // Format: YYYY-MM
        monthInput.value = currentMonth; // Set the input's initial value
    });

    fetchRecords();
</script>
