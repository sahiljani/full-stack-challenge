<x-app-layout>
    <style>
        /* Enable smooth scrolling for the page */
        html {
            scroll-behavior: smooth;
        }

        /* Add a fade-in effect for the job details card */
        .fade-enter-active, .fade-leave-active {
            transition: opacity 0.5s ease;
        }

        .fade-enter, .fade-leave-to {
            opacity: 0;
        }

        /* Hide job details sidebar on mobile */
        @media (max-width: 1024px) {
            .job-details-container {
                display: none;
            }
        }
    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Job Postings') }}
        </h2>
    </x-slot>

    <div class="mt-5 max-w-7xl mx-auto sm:px-6 lg:px-8 relative" x-data="jobPostingData()" x-init="init()">
        <!-- Create Job Button -->
        <a href="{{ route('admin.job_postings.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg transition-transform transform hover:scale-105 shadow-md hover:shadow-lg duration-200 ease-in-out mb-5 w-fit block">
            {{ __('Create New Job Posting') }}
        </a>

        <div class="flex flex-col lg:flex-row h-full">
            <!-- Sidebar with Job Listings -->
            <div class="lg:w-2/5 w-full bg-gray-50 dark:bg-gray-800 border-r p-4 space-y-4 h-[80vh] overflow-y-auto job-listings-container transition-all duration-300 ease-in-out" @scroll="handleScroll">
                <!-- No Job Postings Message -->
                <template x-if="jobPostings.length === 0 && !loading">
                    <div class="bg-red-200 text-red-600 p-4 rounded-md">
                        <p class="font-semibold">No Job Postings Available.</p>
                        <p>Please create a job posting.</p>
                    </div>
                </template>

                <!-- Job Postings List -->
                <template x-for="job in jobPostings" :key="job.id">
                    <div
                        @click="toggleJobDetails(job)"
                        :class="{
                            'border-b-2 border-blue-600 ': selectedJob && selectedJob.id === job.id,
                            '': !(selectedJob && selectedJob.id === job.id)
                        }"
                        class="rounded-lg shadow-lg p-4 cursor-pointer transition-transform transform hover:scale-105 hover:shadow-xl bg-white dark:bg-gray-700 duration-200 ease-in-out">
                        <div class="flex items-start justify-between">
                            <template x-if="job.company.logo">
                                <img :src="job.company.logo ? '{{ asset('storage/') }}/' + job.company.logo : 'logo.jpg'" class="w-16 h-16 object-cover rounded-full" alt="Company Logo">
                            </template>
                        </div>
                        <div class="mt-4">
                            <h5 class="text-lg font-bold text-gray-800 dark:text-gray-200" x-text="job.title"></h5>
                            <p class="text-gray-500 dark:text-gray-400">
                                <span x-text="job.company.name"></span>
                                <span class="mx-2">·</span>
                                <span x-text="job.location ?? 'N/A'"></span>
                            </p>
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <h6 class="text-xl font-bold text-gray-900 dark:text-gray-200">
                                $<span x-text="job.salary"></span>/<span class="text-gray-500 text-md">Mo</span>
                            </h6>
                        </div>

                        <!-- Job Details directly below the card for mobile -->
                        <template x-if="selectedJob && selectedJob.id === job.id && isMobile()">
                            <div id="job-details-mobile" class="mt-4 bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                <h4 class="text-lg font-bold text-gray-600 dark:text-gray-400">Job Description</h4>
                                <p class="text-gray-600 dark:text-gray-400" x-html="selectedJob.description"></p>
                            </div>
                        </template>
                    </div>
                </template>

                <!-- Loading Spinner -->
                <div x-show="loading" class="flex justify-center items-center mt-4">
                    <svg class="animate-spin h-10 w-10 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                    </svg>
                </div>

                <!-- End of Results Message -->
                <div x-show="!loading && page > totalPages" class="text-center text-gray-500 dark:text-gray-400 mt-4">
                    <p>End of job postings</p>
                </div>
            </div>

            <!-- Job Details Section for larger screens -->
            <div class="lg:w-3/5 h-full relative ml-3 job-details-container sticky top-[20px] h-fit">
                <template x-if="selectedJob">
                    <div x-show="selectedJob" x-transition.opacity.duration.500ms
                         class="bg-white dark:bg-gray-800 shadow-lg p-6 rounded-lg sticky top-5 transition-opacity duration-300 ease-in-out">
                        <div class="flex justify-between items-center">
                            <div class="flex items-start space-x-4">
                                <img :src="selectedJob.company.logo ? '{{ asset('storage/') }}/' + selectedJob.company.logo : 'logo.jpg'"
                                     class="w-16 h-16 object-cover rounded-full">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-200" x-text="selectedJob.title"></h2>
                                    <p class="text-gray-600 dark:text-gray-400">In <a href="#" class="text-blue-600" x-text="selectedJob.company.name"></a></p>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <a :href="`{{ route('admin.job_postings.editForm', ':jobId') }}`.replace(':jobId', selectedJob.id)" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Edit</a>

                                <form @submit.prevent="deleteJob(selectedJob.id)">
                                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg">Delete</button>
                                </form>
                            </div>
                        </div>

                        <div class="mt-5">
                            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-200">Insights</h4>
                            <ul class="grid grid-cols-2 gap-4 mt-2">
                                <li>
                                    <div>
                                        <span class="block font-semibold text-gray-900 dark:text-gray-200">Posted Date</span>
                                        <span class="text-gray-600 dark:text-gray-400" x-text="formatDateToRelative(selectedJob.created_at)"></span>
                                    </div>
                                </li>
                                <li>
                                    <div>
                                        <span class="block font-semibold text-gray-900 dark:text-gray-200">Location</span>
                                        <span class="text-gray-600 dark:text-gray-400" x-text="selectedJob.location"></span>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex flex-col">
                                        <span class="text-gray-600 dark:text-gray-400">Salary</span>
                                        <span class="text-gray-600 dark:text-gray-400">$<span x-text="selectedJob.salary"></span></span>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-5">
                            <h4 class="text-lg font-bold text-gray-600 dark:text-gray-400">Job Description</h4>
                            <p class="text-gray-600 dark:text-gray-400" x-html="selectedJob.description"></p>
                        </div>
                    </div>
                </template>

                <!-- Placeholder when no job is selected -->
                <template x-if="!selectedJob">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg text-center">
                        <p class="text-gray-500 dark:text-gray-400">Select a job from the list to view details.</p>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <script>
    function jobPostingData() {
    return {
        jobPostings: [],
        page: 1,
        totalPages: null,
        selectedJob: null,
        loading: false,

        async init() {
            await this.loadJobPostings();
            // Automatically select the first job if none is selected
            if (!this.selectedJob && this.jobPostings.length > 0) {
                this.selectedJob = this.jobPostings[0];
            }
        },

        async loadJobPostings() {
            if (this.loading || (this.totalPages && this.page > this.totalPages)) return;

            this.loading = true;

            const loadMoreUrl = `{{ route('admin.job_postings.loadmore') }}?page=${this.page}`;
            const response = await fetch(loadMoreUrl);
            const data = await response.json();

            this.jobPostings.push(...data.data);
            this.totalPages = data.last_page;
            this.page++;

            // Automatically select the first job if none is selected
            if (!this.selectedJob && this.jobPostings.length > 0) {
                this.selectedJob = this.jobPostings[0];
            }

            this.loading = false;
        },

        handleScroll(event) {
            const container = event.target;
            const scrollTop = container.scrollTop;
            const containerHeight = container.scrollHeight;
            const visibleHeight = container.clientHeight;

            // Check if the user is near the bottom of the container
            if (scrollTop + visibleHeight >= containerHeight - 50) {
                this.loadJobPostings();
            }
        },

        toggleJobDetails(job) {
            if (this.isMobile()) {
                this.selectedJob = this.selectedJob && this.selectedJob.id === job.id ? null : job;

                // Scroll to the selected job on mobile after rendering the details below
                if (this.selectedJob) {
                    setTimeout(() => {
                        document.getElementById(`job-details-${job.id}`).scrollIntoView({
                            behavior: 'smooth'
                        });
                    }, 0);
                }
            } else {
                this.selectedJob = job;
            }
        },

        isMobile() {
            return window.innerWidth <= 1024;
        },

        formatDateToRelative(dateString) {
            const now = new Date();
            const jobDate = new Date(dateString);
            const diffInMs = now - jobDate;
            const diffInDays = Math.floor(diffInMs / (1000 * 60 * 60 * 24));

            if (diffInDays < 1) {
                return 'Today';
            } else if (diffInDays === 1) {
                return '1 day ago';
            } else {
                return `${diffInDays} days ago`;
            }
        }
    }
}
    </script>
</x-app-layout>
