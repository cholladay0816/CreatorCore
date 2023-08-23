<div>

    <a href="{{ route('notifications.index') }}" class="text-gray-400 hover:text-white focus:outline-none md:ml-0 ml-2 flex justify-center">

    <!-- This example requires Tailwind CSS v2.0+ -->
        <span class="inline-block relative">
            <svg class="h-6 w-6 rounded-full" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            @if(auth()->user()->notifications->whereNull('read_at')->count() > 0)
            <span class="absolute top-0 right-0 block h-1.5 w-1.5 rounded-full ring-2 ring-white bg-sky-400"></span>
                @endif
</span>



    </a>

    <!-- This example requires Tailwind CSS v2.0+ -->
    <!-- Global notification live region, render this permanently at the end of the document -->
    <div wire:poll.10s="fetchNotifications" aria-live="assertive" class="fixed z-10 inset-0 flex items-end px-4 py-6 pointer-events-none sm:p-6 sm:items-start">
        <div class="w-full flex flex-col items-center space-y-4 sm:items-end mt-12">
            <!--
              Notification panel, dynamically insert this into the live region when it needs to be displayed

              Entering: "transform ease-out duration-300 transition"
                From: "translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                To: "translate-y-0 opacity-100 sm:translate-x-0"
              Leaving: "transition ease-in duration-100"
                From: "opacity-100"
                To: "opacity-0"
            -->
            @foreach($pushedNotifications as $notification)
            <div x-data="{ notification{{$notification['id']}}:true }" x-show="notification{{$notification['id']}}" class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto ring-1 ring-black ring-opacity-5 overflow-hidden">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: outline/check-circle -->
{{--                            <svg class="h-6 w-6 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">--}}
{{--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />--}}
{{--                            </svg>--}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <a class="ml-3 w-0 flex-1 pt-0.5" href="{{ $notification['url'] ?? '' }}">
                            <p class="text-sm font-medium text-gray-900">{{ $notification['title'] }}</p>
                            <p class="mt-1 text-sm text-gray-500">{{ $notification['description'] }}</p>
                        </a>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button @click="notification{{$notification['id']}} = false" wire:click="removeNotification({{$notification['id']}})" class="bg-white rounded-md inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <span class="sr-only">Close</span>
                                <!-- Heroicon name: solid/x -->
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
