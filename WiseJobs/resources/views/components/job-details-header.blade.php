<div class="bg-white dark:bg-gray-800 p-6 md:p-10 rounded-lg shadow-lg flex flex-col md:flex-row align-center justify-between">
    <div class="flex items-center space-x-6 md:space-x-8">
        <img src="{{ asset('storage/' . $jobPosting->company->logo) }}" alt="{{ $jobPosting->company->name }} Logo" class="w-16 h-16 md:w-20 md:h-20 rounded-full" aria-hidden="true">
        <div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-gray-200">{{ $jobPosting->title }}</h2>
            <div class="flex flex-row md:space-x-2 text-lg md:text-xl text-gray-600 dark:text-gray-400">
                <span><a href="#" class="text-green-600 dark:text-green-400">{{ $jobPosting->company->name }}</a></span>
                <span>•</span>
                <span><a href="#" class="text-green-600 dark:text-green-400">{{ $jobPosting->position_type }}</a></span>
            </div>
            <div class="flex gap-2 text-lg md:text-xl text-gray-600 dark:text-gray-400 mt-2 flex-wrap">
                <div><i class="bi bi-geo-alt-fill"></i> <span>{{ $jobPosting->location }}</span></div>
                <div><i class="bi bi-person-badge"></i> <span>{{ $jobPosting->position_type }} </span></div>
                <div><i class="bi bi-clock"></i> <span>{{ $jobPosting->created_at->diffForHumans() }}</span></div>
            </div>
        </div>
    </div>
    <div class="mt-4 md:mt-0 flex justify-center md:justify-end flex-col w-fit">
        <a href="#" class="bg-green-600 hover:bg-green-500 text-white dark:bg-green-700 dark:hover:bg-green-600 px-6 md:px-8 py-4 rounded-lg font-bold text-lg md:text-2xl" aria-label="Apply for {{ $jobPosting->title }}">Apply</a>
    </div>
</div>