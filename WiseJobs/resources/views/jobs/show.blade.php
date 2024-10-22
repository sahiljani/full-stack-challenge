<x-front-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <div class="container mx-auto py-6 px-4 md:py-12 md:px-6">
        <nav class="text-gray-700 dark:text-gray-400 text-sm md:text-lg mb-6" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex space-x-2 md:space-x-4">
                <li class="inline-flex items-center">
                    <a href="{{ route('jobs.index') }}" class="hover:underline" aria-label="Back to jobs list">Jobs</a>
                </li>
                <li class="inline-flex items-center">
                    <span class="mx-2 text-gray-500">/</span>
                    <span class="text-gray-500 dark:text-gray-300">{{ $jobPosting->title }}</span>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Job Details Section -->
            <div class="lg:col-span-2 space-y-6 md:space-y-8">
                <!-- Job Header -->
                <x-job-details-header :jobPosting="$jobPosting" />
                <x-job-role-insights :job="$jobPosting" />

                <!-- Job Description -->
                <div class="bg-white dark:bg-gray-800 p-6 md:p-10 rounded-lg shadow-lg">
                    <h4 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-gray-200 mb-4">Job Description</h4>
                    <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400 mb-4">{{ $jobPosting->description }}</p>
                </div>

                <!-- Similar Jobs Card -->
                <x-similar-jobs :similarJobs="$similarJobs" />

            </div>

            <!-- Sidebar Section -->
            <div class="space-y-6 md:space-y-8">
                <!-- Apply Job Box -->
                <div class="bg-white dark:bg-gray-800 p-6 md:p-10 rounded-lg shadow-lg">
                    <h4 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-gray-200 mb-4">Interested in this job?</h4>
                    <a href="#" class="bg-green-600 hover:bg-green-500 text-white dark:bg-green-700 dark:hover:bg-green-600 w-full text-center py-4 rounded-lg font-bold text-lg md:text-2xl block" aria-label="Apply for job">Apply Job</a>
                </div>

                <!-- Employer Information -->
                <div class="bg-white dark:bg-gray-800 p-6 md:p-10 rounded-lg shadow-lg">
                    <h4 class="text-2xl md:text-3xl font-semibold text-gray-900 dark:text-gray-200 mb-4">Company Details</h4>
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('storage/' . $jobPosting->company->logo) }}" alt="{{ $jobPosting->company->name }}" class="w-12 h-12 md:w-16 md:h-16 rounded-full mr-4" aria-hidden="true">
                        <div>
                            <h5 class="font-semibold text-xl md:text-2xl text-gray-900 dark:text-gray-200">{{ $jobPosting->company->name }}</h5>
                            <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400">{{ $jobPosting->company->location }}</p>
                        </div>
                    </div>
                </div>

                <!-- Other Jobs at Company -->
                <x-other-company-jobs :jobPosting="$jobPosting" :companyJobs="$companyJobs" />

            </div>
        </div>
    </div>
</x-front-layout>
