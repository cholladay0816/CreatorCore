<x-app-layout>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <!-- Be sure to use this with a layout container that is full-width on mobile -->
    <div class="bg-gray-50 overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Commission Details
                    </h3>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">
                        Details about the proposed commission.
                    </p>
                </div>
                <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                Buyer
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{$commission->buyer->name}}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                Seller
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{$commission->creator->name}}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                Title
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{$commission->title}}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                Price
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                ${{number_format($commission->price,2)}}
                            </dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">
                                Description
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{$commission->description}}
                            </dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">
                                Memo
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{$commission->memo}}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                Days to Complete
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{$commission->days_to_complete}}
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                Status
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <livewire:status-button status="{{$commission->status}}"/>
                                {{$commission->status}}
                            </dd>
                        </div>


                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">
                                Attachments
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <ul class="border border-gray-200 rounded-md divide-y divide-gray-200">
                                    <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                        <div class="w-0 flex-1 flex items-center">
                                            <!-- Heroicon name: solid/paper-clip -->
                                            <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="ml-2 flex-1 w-0 truncate">
                  resume_back_end_developer.pdf
                </span>
                                        </div>
                                        <div class="ml-4 flex-shrink-0">
                                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                                Download
                                            </a>
                                        </div>
                                    </li>
                                    <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
                                        <div class="w-0 flex-1 flex items-center">
                                            <!-- Heroicon name: solid/paper-clip -->
                                            <svg class="flex-shrink-0 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="ml-2 flex-1 w-0 truncate">
                  coverletter_back_end_developer.pdf
                </span>
                                        </div>
                                        <div class="ml-4 flex-shrink-0">
                                            <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                                Download
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </dd>
                        </div>

                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">
                                Actions
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 space-x-2">
                                @livewire('commission.action-buttons', ['commission' => $commission])
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
