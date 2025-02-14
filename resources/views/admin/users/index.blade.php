<x-main-layout :array_daily="$array_daily" :ranking="$ranking">
    <div class="w-full h-auto space-y-10">
        <section class="flex items-center justify-between w-full gap-10">
            <span class="w-1/2">
                <x-form.input name_id="search" placeholder="Search" small />
            </span>

            <x-button primary leftIcon="cuida--user-add-outline" label="Add User" button className="w-fit"
                className="px-10" />
        </section>

        <section class="grid md:grid-cols-3 grid-cols-2 gap-5" id="user-container">
            @foreach ($users as $user)
                <a href="{{ route('admin.users.details', $user->id) }}"
                    class="p-5 border border-gray-200 rounded-xl cursor-pointer group animate-transition hover:border-custom-orange flex flex-col gap-5 items-center justify-center h-auto w-full bg-white user-card"
                    data-name="{{ strtolower($user->firstname) }}"
                    data-student_no="{{ strtolower($user->student_no) }}">

                    <div class="w-auto h-auto">
                        <x-image className="w-24 h-24 rounded-full border border-custom-orange"
                            path="resources/img/default-male.png" />
                    </div>
                    <div class="text-center mx-auto w-full">
                        <h1 class="text-lg font-semibold group-hover:text-custom-orange animate-transition truncate">
                            {{ $user->firstname }}</h1>
                        <p class="text-gray-500 truncate">{{ $user->student_no }}</p>
                    </div>
                </a>
            @endforeach
        </section>

        <!-- Pagination Controls -->
        <section class="flex items-center justify-between w-full mt-5">
            <p class="text-sm text-gray-500">
                Showing <span id="first-item">1</span> - <span id="last-item">10</span> of <span
                    id="total-items">{{ count($users) }}</span>
            </p>

            <div class="flex gap-3 items-center">
                <button id="prev-page"
                    class="px-4 py-2 bg-gray-300 rounded disabled:opacity-50 hover:bg-custom-orange hover:text-white animate-transition disabled:hover:bg-gray-300 disabled:hover:text-current"
                    disabled>Prev</button>
                <span id="page-info">Page 1 of </span>
                <button id="next-page"
                    class="px-4 py-2 bg-gray-300 rounded disabled:opacity-50 hover:bg-custom-orange hover:text-white animate-transition disabled:hover:bg-gray-300 disabled:hover:text-current">Next</button>
            </div>
        </section>
    </div>
</x-main-layout>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.querySelector('[name="search"]');
        const userContainer = document.getElementById("user-container");
        const userCards = Array.from(document.querySelectorAll(".user-card"));
        const firstItem = document.getElementById("first-item");
        const lastItem = document.getElementById("last-item");
        const totalItems = document.getElementById("total-items");
        const prevPageBtn = document.getElementById("prev-page");
        const nextPageBtn = document.getElementById("next-page");
        const pageInfo = document.getElementById("page-info");

        let currentPage = 1;
        const itemsPerPage = 20; // Change this to adjust pagination size
        let filteredUsers = [...userCards]; // Start with all users

        function renderUsers() {
            userContainer.innerHTML = "";
            const start = (currentPage - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            const paginatedUsers = filteredUsers.slice(start, end);

            paginatedUsers.forEach(user => userContainer.appendChild(user));

            // Update total pages dynamically
            const totalPages = Math.ceil(filteredUsers.length / itemsPerPage);
            pageInfo.textContent = `Page ${currentPage} of ${totalPages}`;

            firstItem.textContent = filteredUsers.length === 0 ? 0 : start + 1;
            lastItem.textContent = Math.min(end, filteredUsers.length);
            totalItems.textContent = filteredUsers.length;

            prevPageBtn.disabled = currentPage === 1;
            nextPageBtn.disabled = currentPage >= totalPages;
        }


        function handleSearch() {
            const query = searchInput.value.toLowerCase();
            filteredUsers = userCards.filter(card => {
                const name = card.dataset.name;
                const studentNo = card.dataset.student_no;
                return name.includes(query) || studentNo.includes(query);
            });

            currentPage = 1; // Reset to first page after search
            renderUsers();
        }

        searchInput.addEventListener("input", handleSearch);

        prevPageBtn.addEventListener("click", () => {
            if (currentPage > 1) {
                currentPage--;
                renderUsers();
            }
        });

        nextPageBtn.addEventListener("click", () => {
            if (currentPage * itemsPerPage < filteredUsers.length) {
                currentPage++;
                renderUsers();
            }
        });

        renderUsers(); // Initial Render
    });
</script>
