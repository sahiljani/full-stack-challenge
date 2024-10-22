<div class="bg-white dark:bg-gray-800 p-10 rounded-lg shadow-lg mb-10">
    <div class="flex justify-between items-center">
        <div class="flex items-start space-x-8">
            <img src="{{ asset('storage/' . $job->company->logo) }}" class="w-20 h-20 rounded-full" loading="lazy" alt="Company Logo">
            <div>
                <h3 class="font-bold text-2xl text-gray-900 dark:text-gray-200 mb-3">{{ $job->title }}</h3>
                <div class="text-xl text-gray-600 dark:text-gray-400 mb-2">
                    <span class="font-medium">{{ $job->company->name }}</span> - <span>{{ $job->location }}</span>
                </div>
                <div class="text-xl text-gray-600 dark:text-gray-400">
                    <span class="font-medium">Salary:</span> ${{ number_format($job->salary, 2) }} • {{ $job->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
        <a href="{{ route('jobs.show', $job->id) }}" class="bg-green-600 hover:bg-green-500 text-white px-8 py-4 rounded-lg dark:bg-green-700 dark:hover:bg-green-600 dark:text-gray-300 text-lg font-bold">View</a>
    </div>
</div>
