<div class="bg-white dark:bg-gray-800 p-6 md:p-10 rounded-lg shadow-lg">
    <h4 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-gray-200 mb-4">Similar Jobs</h4>

    @if($similarJobs->isEmpty())
        <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400">No similar jobs found.</p>
    @else
        <div class="space-y-4 md:space-y-6">
            @foreach($similarJobs as $job)
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div>
                        <h5 class="font-semibold text-green-600 dark:text-green-400 text-xl md:text-2xl">
                            <a href="{{ route('jobs.show', $job->id) }}">{{ $job->title }}</a>
                        </h5>
                        <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400">
                            <i class="bi bi-geo-alt-fill"></i> {{ $job->location }} • ${{ number_format($job->salary, 2) }} • {{ $job->position_type }}
                        </p>
                    </div>
                    <a href="{{ route('jobs.show', $job->id) }}" class="bg-gray-100 dark:bg-gray-700 text-green-600 dark:text-green-400 px-4 md:px-5 py-2 md:py-3 rounded-lg mt-2 md:mt-0" aria-label="View job {{ $job->title }}">View</a>
                </div>
            @endforeach
        </div>
    @endif
</div>
