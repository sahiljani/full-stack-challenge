<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Job Posting') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-5">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
           
            <form action="{{ route('admin.job_postings.store') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Job Title -->
                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Job Title</label>
                    <input type="text" name="title" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 dark:bg-gray-700 dark:text-gray-200" />
                </div>

                <!-- Two input fields in one line -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Company -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Company</label>
                        <select name="company_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 dark:bg-gray-700 dark:text-gray-200">
                            <option value="">Select a company</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Location -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Location</label>
                        <input type="text" name="location" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 dark:bg-gray-700 dark:text-gray-200" />
                    </div>
                </div>

                <!-- Salary and Job Type in one line -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Salary -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Salary</label>
                        <input type="number" name="salary" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 dark:bg-gray-700 dark:text-gray-200" />
                    </div>
                    
                    <!-- Job Type -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">Job Type</label>
                        <select name="job_type" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 dark:bg-gray-700 dark:text-gray-200">
                            <option value="remote">remote</option>
                            <option value="in-person">in-person</option>
                        </select>
                    </div>
                </div>

                <!-- Job Description with Pell Editor -->
                <div>
                    <label class="block text-gray-700 dark:text-gray-300">Job Description</label>
                    <div id="editor" class="pell block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 dark:bg-gray-700 dark:text-gray-200"></div>
                    <input type="hidden" name="description" id="description-input">
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.job_postings.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold px-4 py-2 rounded">Cancel</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">Create Job</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/pell"></script>
    <script>
      
        const editor = pell.init({
            element: document.getElementById('editor'),
            onChange: (html) => {
                document.getElementById('description-input').value = html;
            },
            defaultParagraphSeparator: 'p',
            styleWithCSS: true,
            actions: ['bold', 'underline', 'italic', 'link']
        });
    </script>
    <style>
      
    </style>
</x-app-layout>
