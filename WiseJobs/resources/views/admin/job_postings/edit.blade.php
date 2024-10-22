<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight ">
            {{ __('Edit Job Posting') }}
        </h2>
        <!-- add breadcrumb -->
         
    </x-slot>

    <div class="mt-5 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
        @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">{{ session('success') }}</strong>
    </div>
@endif

@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


            <form action="{{ route('admin.job_postings.update', $jobPosting->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- Job Title and Company -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">{{ __('Job Title') }}</label>
                        <input type="text" name="title" value="{{ old('title', $jobPosting->title) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 dark:bg-gray-700 text-gray-900 dark:text-gray-200" />
                    </div>
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">{{ __('Company') }}</label>
                        <select name="company_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 dark:bg-gray-700  text-gray-900 dark:text-gray-200">
                            <option value="">{{ __('Select a company') }}</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}" {{ $company->id == old('company_id', $jobPosting->company_id) ? 'selected' : '' }}>
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Location and Salary -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">{{ __('Location') }}</label>
                        <input type="text" name="location" value="{{ old('location', $jobPosting->location) }}" required class="mt-1 block w-full border-gray-300 rounded-md  text-gray-900 shadow-sm focus:border-blue-300 dark:bg-gray-700 dark:text-gray-200" />
                    </div>
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">{{ __('Salary') }}</label>
                        <input type="number" name="salary" value="{{ old('salary', $jobPosting->salary) }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-gray-900  focus:border-blue-300 dark:bg-gray-700 dark:text-gray-200" />
                    </div>
                </div>

                <!-- Job Type and Salary Type -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300">{{ __('Job Type') }}</label>
                        <select name="job_type" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 dark:bg-gray-700 dark:text-gray-200 text-gray-900 ">

                            <option value="part-time" {{ old('job_type', $jobPosting->job_type) == 'in-person' ? 'selected' : '' }}>{{ __('in-person') }}</option>
                            <option value="contract" {{ old('job_type', $jobPosting->job_type) == 'remote' ? 'selected' : '' }}>{{ __('remote') }}</option>
                        </select>
                    </div>
                   
                </div>

                <!-- Job Description with Pell Editor -->
                <div>
                    <label class="block text-gray-700 dark:text-gray-300">{{ __('Description') }}</label>
                    <div id="editor" class="text-gray-900  pell mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-300 dark:bg-gray-700 dark:text-gray-200 overflow-auto"></div>
                    <input type="hidden"  name="description" id="description-input" value="{{ old('description', $jobPosting->description) }}">
                </div>

                <!-- Submit and Cancel Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.job_postings.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold px-4 py-2 rounded">{{ __('Cancel') }}</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">{{ __('Update Job') }}</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/pell"></script>
    <script>
        // Initialize the Pell editor
        const editorContent = `{!! old('description', $jobPosting->description) !!}`; // Prepopulate editor with content

        const editor = pell.init({
            element: document.getElementById('editor'),
            onChange: (html) => {
                document.getElementById('description-input').value = html;
            },
            defaultParagraphSeparator: 'p',
            styleWithCSS: true,
            actions: ['bold', 'underline', 'italic', 'link'] // Define allowed actions
        });

        // Set initial content for the editor
        document.querySelector('.pell-content').innerHTML = editorContent;
    </script>

</x-app-layout>
