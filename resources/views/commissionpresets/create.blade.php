<x-app-layout>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg p-5 my-4">
            <form action="{{ isset($commissionPreset) ? route('commissionpresets.update', $commissionPreset) : route('commissionpresets.store') }}" class="space-y-8 divide-y divide-gray-200" method="POST" enctype="multipart/form-data">
                @csrf
                @method(isset($commissionPreset) ? 'PUT' : 'POST')
                <div class="space-y-8 divide-y divide-gray-200">
                    <div>
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                General Information
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Explain your service and name your price here.
                            </p>
                        </div>

                        <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="title" class="block text-sm font-medium text-gray-700">
                                    Title @error('title') <span class="text-red-400">[{{$message}}]</span> @enderror
                                </label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <input value="{{ $commissionPreset->title ?? old('title') }}" type="text" name="title" id="title" autocomplete="title"
                                           class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-md sm:text-sm
                                           @error('title')
                                               border-red-300
                                           @enderror
                                           border-gray-300
                                            ">
                                </div>
                            </div>

                            <div class="sm:col-span-6">
                                <label for="description" class="block text-sm font-medium text-gray-700">
                                    Description @error('description') <span class="text-red-400">[{{$message}}]</span> @enderror
                                </label>
                                <div class="mt-1">
                                    <textarea id="description" name="description" rows="3"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm
                                    @error('title')
                                        border-red-300
                                    @enderror
                                    border-gray-300
                                    rounded-md">{{ $commissionPreset->description ?? old('description') }}</textarea>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Write a few sentences about what you offer.</p>
                            </div>

                            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-1 col-span-2">
                                <div class="sm:col-span-6">
                                    <label for="price" class="block text-sm font-medium text-gray-700">
                                        Price ($USD) @error('price') <span class="text-red-400">[{{$message}}]</span> @enderror
                                    </label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                      $
                                    </span>
                                        <input value="{{ $commissionPreset->price ?? old('price') ?? 5 }}" type="number" min="5" max="1000" step="0.01" name="price" id="price" autocomplete="price" class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300">
                                    </div>
                                </div>
                            </div>
                    </div>

                        <div class="pt-8">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Timeline
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Specify your minimum deadline for this type of commission.
                                </p>
                            </div>
                            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                                    <div class="sm:col-span-4">
                                        <label for="minimum_days" class="block text-sm font-medium text-gray-700">
                                            Minimum days to complete order @error('days_to_complete') <span class="text-red-400">[{{$message}}]</span> @enderror
                                        </label>
                                        <div class="mt-1 flex rounded-md shadow-sm">
                                            <input value="{{ $commissionPreset->days_to_complete ?? old('days_to_complete') ?? 7 }}" type="number" min="1" step="1" name="days_to_complete" id="days_to_complete" autocomplete="days_to_complete" class="flex-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full min-w-0 rounded-none rounded-l-md sm:text-sm border-gray-300">
                                            <span class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">
                                        days
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-8">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Customization (Optional)
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">
                                    Add some additional flair to your presets to help them stand out.
                                </p>
                            </div>
                            <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
                                    <div class="sm:col-span-4">
                                            <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">Cover photo</label>
                                            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                                <div class="text-center">
                                                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                                                    </svg>
                                                    <div class="mt-4 flex text-sm leading-6 text-gray-600">
                                                        <label for="image" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                            <span>Upload a file</span>
                                                            <input id="image" name="image" type="file" class="sr-only">
                                                        </label>
                                                        <p class="pl-1">or drag and drop</p>
                                                    </div>
                                                    <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                                                    @error('image')
                                                    <p class="text-xs text-red-400">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>

                <div class="pt-5">
                    <div class="flex justify-end">
                        <a href="{{ redirect()->back()->getTargetUrl() }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancel
                        </a>
                        <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
