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
                                {{$commission->expires_at->diffForHumans(null, false, false, 2)}} [ {{ $commission->expires_at_local->format('M-d-Y h:i T') }} ]
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
                                @livewire('commission.history', ['commission' => $commission])
                            </div>
                                @livewire('commission.messager', ['commission' => $commission])
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
