<div>
    <div class="flex flex-1 justify-end pt-2">
        <a href="{{ route('tickets.create') }}" class="flex px-4 py-2 bg-sky-500 hover:bg-sky-600 text-white rounded-md">New</a>
    </div>
    <ul class="divide-y divide-gray-200 pt-4">
        @foreach($tickets as $ticket)
        <li class="py-4 bg-white rounded-lg px-3">
            <div class="flex space-x-3">
                <div class="flex-1 space-y-1">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-medium">
                            <a>{{$ticket->title}}</a> - <span class="text-gray-700">{{ ucwords($ticket->status) }}</span>
                        </h3>
                        <div class="flex flex-row gap-3 my-auto">
                            <p class="text-sm text-gray-500">{{\Illuminate\Support\Carbon::parse($ticket->created_at)->diffForHumans()}}</p>
{{--                            <a class="w-5 h-5 text-gray-400">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />--}}
{{--                                </svg>--}}
{{--                            </a>--}}
                        </div>
                    </div>
                    <p class="text-sm text-gray-500">
                        <a>
                            {{$ticket->description}}
                        </a>
                    </p>
                </div>
            </div>
        </li>
        @endforeach

    </ul>
</div>
