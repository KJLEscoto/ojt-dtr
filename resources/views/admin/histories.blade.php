<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">


<x-main-layout :array_daily="$array_daily" :ranking="$ranking">
    <div class="h-auto w-full space-y-10">
        <section class="flex items-center justify-between w-full gap-10">
            <span class="w-1/2">
                <x-form.input id="search" name_id="search" placeholder="Search" small />
            </span>

            <x-button primary label="Filter Month" button className="w-fit" />
        </section>

        <section class="h-auto w-full">
            <div class="overflow-x-auto bg-white rounded-lg shadow-md">
                <table id="recordsTable" class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border">Description</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border">Date & Time</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border">Action</th>
                        </tr>
                    </thead>
                    <tbody id="recordsBody">
                        @foreach ($records as $record)
                            <tr class="border hover:bg-gray-50">
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
                <div>
                    <button id="prevPage" class="px-4 py-2 border rounded-md bg-gray-100 text-gray-600 hover:bg-gray-200" disabled>Previous</button>
                    <button id="nextPage" class="px-4 py-2 border rounded-md bg-gray-100 text-gray-600 hover:bg-gray-200">Next</button>
                </div>
            </div>
        </section>
    </div>
</x-main-layout>

{{-- <script>
    // Get CSRF token from meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Set Axios default headers
    axios.defaults.headers.common["X-CSRF-TOKEN"] = csrfToken;
    axios.defaults.headers.common["Content-Type"] = "application/json";
    
    document.getElementById('search').addEventListener('keyup', function () {
    var searchQuery = this.value;

    if (searchQuery.length > 2 || searchQuery.length === 0) { // Wait until 3 characters or clear input
        axios.post('/admin/history/search', { query: searchQuery })
            .then(response => {
                console.log('test');
                var recordsBody = document.getElementById('recordsBody');
                recordsBody.innerHTML = ''; // Clear existing table rows
                
                for (let i = 0; i < response.data.records.length; i++) {
                debugger; // This will pause execution at every iteration

                let record = response.data.records[i];
                let row = document.createElement('tr');
                row.classList.add('border', 'hover:bg-gray-50');

                row.innerHTML = `
                    <td class="px-6 py-4 border">${record.user.firstname}</td>
                    <td class="px-6 py-4 border">${record.user.email}</td>
                    <td class="px-6 py-4 border">${record.history.description}</td>
                    <td class="px-6 py-4 border">${record.history.datetime}</td>
                `;

                recordsBody.appendChild(row);
            }

            })
            .catch(error => console.error('Error:', error));
    }
});

</script> --}}


<script>
    // Get CSRF token from meta tag
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Set Axios default headers
axios.defaults.headers.common["X-CSRF-TOKEN"] = csrfToken;
axios.defaults.headers.common["Content-Type"] = "application/json";

let currentPage = 1;
let perPage = 10;
let totalRecords = 0;

// Function to fetch data with pagination
function fetchRecords(searchQuery = '', page = 1) {
    axios.post('/admin/history/search', { query: searchQuery, page: page })
        .then(response => {
            let data = response.data;
            totalRecords = data.total;
            perPage = data.perPage;
            currentPage = data.currentPage;

            let recordsBody = document.getElementById('recordsBody');
            let paginationInfo = document.getElementById('pagination-info');
            let prevPageBtn = document.getElementById('prevPage');
            let nextPageBtn = document.getElementById('nextPage');

            recordsBody.innerHTML = ''; // Clear existing table rows

            for (let i = 0; i < data.records.length; i++) {
                let record = data.records[i];
                let row = document.createElement('tr');
                row.classList.add('border', 'hover:bg-gray-50');

                row.innerHTML = `
                    <td class="px-6 py-4 border">${record.user.firstname}</td>
                    <td class="px-6 py-4 border">${record.user.email}</td>
                    <td class="px-6 py-4 border">${record.history.description}</td>
                    <td class="px-6 py-4 border">${record.history.datetime}</td>
                `;

                recordsBody.appendChild(row);
            }

            // Update pagination info
            paginationInfo.textContent = `Showing ${((currentPage - 1) * perPage) + 1}-${Math.min(currentPage * perPage, totalRecords)} of ${totalRecords}`;

            // Enable/Disable pagination buttons
            prevPageBtn.disabled = currentPage === 1;
            nextPageBtn.disabled = currentPage * perPage >= totalRecords;
        })
        .catch(error => console.error('Error:', error));
}

// Event listener for search input
document.getElementById('search').addEventListener('keyup', function () {
    let searchQuery = this.value;
    if (searchQuery.length > 2 || searchQuery.length === 0) {
        currentPage = 1; // Reset to first page on new search
        fetchRecords(searchQuery, currentPage);
    }
});

// Pagination Buttons
document.getElementById('prevPage').addEventListener('click', function () {
    if (currentPage > 1) {
        currentPage--;
        fetchRecords(document.getElementById('search').value, currentPage);
    }
});

document.getElementById('nextPage').addEventListener('click', function () {
    if (currentPage * perPage < totalRecords) {
        currentPage++;
        fetchRecords(document.getElementById('search').value, currentPage);
    }
});

// Initial Load
fetchRecords();

</script>