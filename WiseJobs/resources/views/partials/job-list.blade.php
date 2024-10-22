<div id="job-listings">
    @forelse ($jobPostings as $job)
        <x-job-card :job="$job" />
    @empty
        <p class="text-center text-gray-600 dark:text-gray-300">No jobs found matching your criteria.</p>
    @endforelse
</div>
