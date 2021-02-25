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
                        @if(in_array($commission->status, ['Active', 'Overdue']))
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                Order Due
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{$commission->expires_at->diffForHumans()}}
                            </dd>
                        </div>
                        @else
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                Days to Complete
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{$commission->days_to_complete}}
                            </dd>
                        </div>
                        @endif
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500">
                                Status
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <livewire:status-button status="{{$commission->status}}"/>
                                {{$commission->status}}
                            </dd>
                        </div>
                        @if(($commission->isCreator()) || ($commission->isBuyer() && in_array($commission->status, ['Completed', 'Archived'])))
                            @livewire('commission.attachments', ['commission' => $commission])
                        @endif
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">
                                Actions
                            </dt>
                            <dd class="mt-1 text-sm text-gray-900 space-x-2">
                                @livewire('commission.action-buttons', ['commission' => $commission])
                            </dd>
                        </div>
                        <div class="sm:col-span-2">

                            <!-- This example requires Tailwind CSS v2.0+ -->
                            <div class="relative py-12">
                                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center">
                                    <span class="px-2 bg-white text-sm text-gray-500">
                                      History
                                    </span>
                                </div>
                            </div>
                            <div class="flow-root pt-6">
                                <ul class="-mb-8">
                                    @foreach($commission->events as $event)
                                    <li>
                                        <div class="relative pb-8">
                                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                            <div class="relative flex space-x-3">
                                                <div>
                                                    <span class="h-8 w-8 rounded-full bg-{{$event->color}} flex items-center justify-center ring-8 ring-white">
                                                      <!-- Heroicon name: solid/user -->
                                                      <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                      </svg>
                                                    </span>
                                                </div>
                                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                    <div>
                                                        <p class="text-sm text-gray-500">{{$event->title}}</p>
                                                    </div>
                                                    <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                        <time datetime="{{$event->created_at}}">{{$event->created_at->format("M d")}}</time>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
