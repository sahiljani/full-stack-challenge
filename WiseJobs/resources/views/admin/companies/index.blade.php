<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 dark:text-white leading-tight">
            {{ __('Manage Companies') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ openModal: null, previewLogo: null }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <!-- Flash Message Section -->
              @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif
            <div class="bg-white dark:bg-gray-900 shadow-lg sm:rounded-lg p-8">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-3xl font-semibold text-gray-900 dark:text-gray-100">{{ __('Manage Companies') }}</h1>
                    <button @click="$dispatch('open-modal', 'create')" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none">
                        {{ __('Create New Company') }}
                    </button>
                </div>

                <!-- Table for displaying companies -->
                <div class="overflow-x-auto">
                    <table class="table-auto w-full bg-white dark:bg-gray-800 rounded-lg shadow">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-sm leading-normal h-16">
                                <th class="py-3 px-6 text-center">{{ __('Company Logo') }}</th>
                                <th class="py-3 px-6 text-center">{{ __('Company Name') }}</th>
                                <th class="py-3 px-6 text-center">{{ __('Location') }}</th>
                                <th class="py-3 px-6 text-center">{{ __('Job Postings') }}</th>
                                <th class="py-3 px-6 text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 dark:text-gray-400 text-sm font-light">
                            @foreach($companies as $company)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-300 dark:hover:bg-gray-900 transition duration-150">
                                <td class="py-3 px-6 text-center">
                                    @if($company->logo)
                                        <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }} Logo" class="w-20 h-20 object-cover rounded-full mx-auto">
                                    @else
                                        <span class="text-gray-500">No Logo</span>
                                    @endif
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ $company->name }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ $company->location ?? 'Location not available' }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    {{ $company->job_postings_count }} Job{{ $company->job_postings_count !== 1 ? 's' : '' }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex justify-center space-x-4">
                                        <button @click="$dispatch('open-modal', 'view-{{ $company->id }}')" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 transition">{{ __('View') }}</button>
                                        <button @click="$dispatch('open-modal', 'edit-{{ $company->id }}')" class="text-green-600 dark:text-green-400 hover:text-green-800 transition">{{ __('Edit') }}</button>
                                        <button @click="$dispatch('open-modal', 'delete-{{ $company->id }}')" class="text-red-600 dark:text-red-400 hover:text-red-800 transition">{{ __('Delete') }}</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Links -->
                <div class="mt-6">
                    {{ $companies->links() }}
                </div>

                <!-- Create Modal -->
                <x-modal name="create">
                    <div class="p-6">
                        <h2 class="text-2xl font-semibold mb-6 text-gray-900 dark:text-gray-100">{{ __('Create New Company') }}</h2>
                        <form method="POST" action="{{ route('admin.companies.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700 dark:text-gray-300">{{ __('Company Name') }}</label>
                                <input id="name" name="name" type="text" required class="w-full px-4 py-2 border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300" />
                            </div>
                            <div class="mb-4">
                                <label for="location" class="block text-gray-700 dark:text-gray-300">{{ __('Location') }}</label>
                                <input id="location" name="location" type="text" class="w-full px-4 py-2 border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300" />
                            </div>
                            <div class="mb-4">
                                <label for="logo" class="block text-gray-700 dark:text-gray-300">{{ __('Company Logo') }}</label>
                                <input id="logo" name="logo" type="file" accept="image/*" class="w-full px-4 py-2 border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300" onchange="previewImage(event, 'preview-create')" />
                                <img id="preview-create" class="mt-2 w-32 h-32 object-cover border hidden" alt="Logo Preview">
                            </div>
                            <div class="flex justify-end space-x-4">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">{{ __('Create') }}</button>
                                <button type="button" @click="$dispatch('close-modal', 'create')" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">{{ __('Cancel') }}</button>
                            </div>
                        </form>
                    </div>
                </x-modal>

                <!-- View/Edit/Delete Modal Loops -->
                @foreach($companies as $company)
                    <!-- View Modal -->
                    <x-modal name="view-{{ $company->id }}">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold mb-4 text-gray-100 dark:text-gray-100">{{ $company->name }}</h2>
                            <p class="text-gray-700 dark:text-gray-300">{{ __('Location: ') . $company->location }}</p>
                            <p class="text-gray-700 dark:text-gray-300">{{ __('Number of Job Postings: ') . $company->job_postings_count }}</p>
                            @if($company->logo)
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo" class="w-16 h-16 object-cover mt-2">
                            @endif
                            <div class="flex justify-end space-x-4 mt-4">
                                <button @click="$dispatch('close-modal', 'view-{{ $company->id }}')" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-4 py-2 rounded transition duration-150 ease-in-out">{{ __('Close') }}</button>
                            </div>
                        </div>
                    </x-modal>

                    <!-- Edit Modal -->
                    <x-modal name="edit-{{ $company->id }}">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold mb-4">{{ __('Edit Company') }}</h2>
                            <form method="POST" action="{{ route('admin.companies.update', $company->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="page" value="{{ request()->get('page', 1) }}">
                                <div class="mb-4">
                                    <label for="name-{{ $company->id }}" class="block text-gray-700 dark:text-gray-300">{{ __('Company Name') }}</label>
                                    <input id="name-{{ $company->id }}" name="name" type="text" value="{{ $company->name }}" required class="w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-300" />
                                </div>
                                <div class="mb-4">
                                    <label for="location-{{ $company->id }}" class="block text-gray-700 dark:text-gray-300">{{ __('Location') }}</label>
                                    <input id="location-{{ $company->id }}" name="location" type="text" value="{{ $company->location }}" class="w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-300" />
                                </div>
                                <div class="mb-4">
                                    <label for="logo-{{ $company->id }}" class="block text-gray-700 dark:text-gray-300">{{ __('Company Logo') }}</label>
                                    <input id="logo-{{ $company->id }}" name="logo" type="file" accept="image/*" class="w-full border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-gray-300" onchange="previewImage(event, 'preview-edit-{{ $company->id }}')" />
                                    <img id="preview-edit-{{ $company->id }}" src="{{ asset('storage/' . $company->logo) }}" class="mt-2 w-32 h-32 object-cover border" alt="Logo Preview" @if(!$company->logo) style="display: none;" @endif>
                                </div>
                                <div class="flex justify-end space-x-4">
                                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded transition duration-150 ease-in-out">{{ __('Update') }}</button>
                                    <button type="button" @click="$dispatch('close-modal', 'edit-{{ $company->id }}')" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-4 py-2 rounded transition duration-150 ease-in-out">{{ __('Cancel') }}</button>
                                </div>
                            </form>
                        </div>
                    </x-modal>

                    <!-- Delete Modal -->
                    <x-modal name="delete-{{ $company->id }}">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold mb-4 text-red-600">{{ __('Delete Company') }}</h2>
                            <p class="text-gray-700 dark:text-gray-300">{{ __('Are you sure you want to delete ') . $company->name . '?' }}</p>
                            <div class="flex justify-end space-x-4 mt-4">
                                <form method="POST" action="{{ route('admin.companies.destroy', $company->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="page" value="{{ request()->get('page', 1) }}">
                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded transition duration-150 ease-in-out">{{ __('Delete') }}</button>
                                </form>
                                <button type="button" @click="$dispatch('close-modal', 'delete-{{ $company->id }}')" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-4 py-2 rounded transition duration-150 ease-in-out">{{ __('Cancel') }}</button>
                            </div>
                        </div>
                    </x-modal>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function previewImage(event, previewId) {
            const input = event.target;
            const preview = document.getElementById(previewId);
            const file = input.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
</x-app-layout>
