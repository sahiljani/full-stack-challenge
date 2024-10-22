<!-- Filter Toggle Button (Visible on Mobile) -->
<button id="filterToggleBtn" class="lg:hidden fixed top-5 right-5 p-3 bg-green-600 text-white rounded-lg shadow-lg z-50">
    Filters
</button>

<!-- Filter Drawer (Hidden on Mobile by Default) -->
<div id="filterDrawer" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden">
    <div class="w-2/3 sm:w-1/3 bg-white dark:bg-gray-800 h-full p-6 shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out">
        <!-- Close Drawer Button -->
        <button id="closeFilterBtn" class="text-gray-600 dark:text-gray-300 text-2xl">&times;</button>
        
        <!-- Filter Form (Inside Drawer) -->
        <form id="filterForm" action="{{ route('jobs.index') }}"  method="GET" class="mt-4">
            <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
                <!-- Salary Range Filter -->
                <div class="mb-8">
                    <h5 class="font-semibold text-2xl mb-4 text-gray-900 dark:text-gray-200">Salary Range</h5>
                    <input type="range" name="salary_min" min="5000" max="20000" class="w-full mb-4 dark:bg-gray-700" value="{{ request('salary_min') ?? 7000 }}">
                    <span class="block text-xl text-gray-600 dark:text-gray-300">
                        ${{ request('salary_min') ?? 7000 }} — ${{ request('salary_max') ?? 12000 }}
                    </span>
                </div>

                <!-- Position Filter -->
                <div class="mb-8">
                    <h5 class="font-semibold text-2xl mb-4 text-gray-900 dark:text-gray-200">Position Type</h5>
                    <div class="flex flex-col gap-6 text-lg text-gray-900 dark:text-gray-300 sm:grid sm:grid-cols-2">

                        <label class="inline-flex items-center">
                            <input type="checkbox" name="position[]" value="in-person" class="form-checkbox h-6 w-6 text-green-600 dark:bg-gray-700" {{ is_array(request('position')) && in_array('in-person', request('position')) ? 'checked' : '' }}>
                            <span class="ml-3">in-person</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="position[]" value="remote" class="form-checkbox h-6 w-6 text-green-600 dark:bg-gray-700" {{ is_array(request('position')) && in_array('remote', request('position')) ? 'checked' : '' }}>
                            <span class="ml-3">remote</span>
                        </label>
                    </div>
                </div>

                <!-- Company Filter -->
                <div class="mb-8">
                    <h5 class="font-semibold text-2xl mb-4 text-gray-900 dark:text-gray-200">Company</h5>
                    <input type="text" name="company" placeholder="Enter company name..." class="text-black w-full p-4 text-lg border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" value="{{ request('company') }}">
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Filter Form (Visible on Larger Screens) -->
<div class="hidden lg:block w-1/3 pr-10">
    <form id="filterForm" action="{{ route('jobs.index') }}" method="GET" class="w-full">
        <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg">
            <!-- Salary Range Filter -->
            <div class="mb-8">
                <h5 class="font-semibold text-2xl mb-4 text-gray-900 dark:text-gray-200">Salary Range</h5>
                <input type="range" name="salary_min" min="5000" max="20000" class="w-full mb-4 dark:bg-gray-700" value="{{ request('salary_min') ?? 7000 }}">
                <span class="block text-xl text-gray-600 dark:text-gray-300">
                    ${{ request('salary_min') ?? 7000 }} — ${{ request('salary_max') ?? 12000 }}
                </span>
            </div>

            <!-- Position Filter -->
            <div class="mb-8">
                <h5 class="font-semibold text-2xl mb-4 text-gray-900 dark:text-gray-200">Position Type</h5>
                <div class="grid grid-cols-2 gap-6 text-lg text-gray-900 dark:text-gray-300">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="position[]" value="in-person" class="form-checkbox h-6 w-6 text-green-600 dark:bg-gray-700" {{ is_array(request('position')) && in_array('in-person', request('position')) ? 'checked' : '' }}>
                        <span class="ml-3">in-person</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="position[]" value="remote" class="form-checkbox h-6 w-6 text-green-600 dark:bg-gray-700" {{ is_array(request('position')) && in_array('remote', request('position')) ? 'checked' : '' }}>
                        <span class="ml-3">remote</span>
                    </label>
                </div>
            </div>

            <!-- Company Filter -->
            <div class="mb-8">
                <h5 class="font-semibold text-2xl mb-4 text-gray-900 dark:text-gray-200">Company</h5>
                <input type="text" name="company" placeholder="Enter company name..." class="text-black w-full p-4 text-lg border rounded dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300" value="{{ request('company') }}">
            </div>
        </div>
    </form>
</div>

<!-- JavaScript for toggling the drawer -->
<script>
    const filterToggleBtn = document.getElementById('filterToggleBtn');
    const filterDrawer = document.getElementById('filterDrawer');
    const closeFilterBtn = document.getElementById('closeFilterBtn');

    filterToggleBtn.addEventListener('click', () => {
        filterDrawer.classList.toggle('hidden');
        filterDrawer.firstElementChild.classList.toggle('-translate-x-full');
    });

    closeFilterBtn.addEventListener('click', () => {
        filterDrawer.classList.add('hidden');
        filterDrawer.firstElementChild.classList.add('-translate-x-full');
    });

    filterDrawer.addEventListener('click', (e) => {
        if (e.target === filterDrawer) {
            filterDrawer.classList.add('hidden');
            filterDrawer.firstElementChild.classList.add('-translate-x-full');
        }
    });
</script>
