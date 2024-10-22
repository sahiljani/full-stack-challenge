<form id="searchForm" action="{{ route('jobs.index') }}" method="GET" class="flex space-x-6">
    <input type="text" name="search" placeholder="Job title or keyword..." class="text-black w-3/5 p-5 text-lg border rounded dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300" value="{{ request('search') }}">
    
    <button type="submit" class="
    flex flex-col items-center justify-center w-fit w-1/5 bg-green-600 hover:bg-green-500 text-white dark:bg-green-700 dark:hover:bg-green-600 dark:text-gray-300 font-bold text-lg p-5 rounded md:w-1/5">
        Search
    </button>
</form>
