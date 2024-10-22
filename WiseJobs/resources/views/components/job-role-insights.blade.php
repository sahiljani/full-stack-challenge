<div class="bg-white dark:bg-gray-800 p-6 md:p-10 rounded-lg shadow-lg">
    <h4 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-gray-200 mb-4">Job Role Insights</h4>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
        <div class="border p-4 md:p-6 rounded-lg text-center dark:border-gray-700">
            <h6 class="font-semibold text-xl md:text-2xl text-gray-900 dark:text-gray-200">Posted Date</h6>
            <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400">{{ $job->created_at->format('d M Y') }}</p>
        </div>
        <div class="border p-4 md:p-6 rounded-lg text-center dark:border-gray-700">
            <h6 class="font-semibold text-xl md:text-2xl text-gray-900 dark:text-gray-200">Job Location</h6>
            <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400">{{ $job->location }}</p>
        </div>
        <div class="border p-4 md:p-6 rounded-lg text-center dark:border-gray-700">
            <h6 class="font-semibold text-xl md:text-2xl text-gray-900 dark:text-gray-200">Offered Salary</h6>
            <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400">${{ number_format($job->salary, 2) }} Per {{ $job->salary_type }}</p>
        </div>
    </div>
</div>
