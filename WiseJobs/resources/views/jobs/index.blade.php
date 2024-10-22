<x-front-layout>
    <div class="bg-green-700 dark:bg-gray-900 py-10">
        <div class="container mx-auto mb-12">
            <div class="text-black dark:text-gray-200 mb-8">
                <h2 class="text-4xl text-white font-bold">Discover Best Jobs for you</h2>
            </div>
            <x-search-form />
        </div>
    </div>


    <div class="container mx-auto py-10">
        <div class="flex gap-8">
            <x-filter-form />
            <div class="w-full md:w-2/3">
                @forelse ($jobPostings as $job)
                    <x-job-card :job="$job" />
                @empty
                    <p class="text-center text-gray-600 dark:text-gray-300">No jobs found matching your criteria.</p>
                @endforelse

                <!-- Pagination Links -->
                <div class="mt-10">
                    {{ $jobPostings->links() }}
                </div>
            </div>
        </div>
    </div>


</x-front-layout>