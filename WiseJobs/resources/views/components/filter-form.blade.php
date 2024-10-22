<form id="filterForm" action="{{ route('jobs.index') }}" method="GET" class="w-1/3 pr-10">
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
