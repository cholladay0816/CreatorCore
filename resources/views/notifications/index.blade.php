<x-app-layout>
    @if(count($notifications))
    @foreach($notifications as $notification)
        <span>{{$notification->title}}</span>
    @endforeach

    @else

        <div class="min-h-screen flex">
            <div class="pointer-events-none my-auto mx-auto font-light text-gray-500 text-2xl">You're all caught up!</div>
        </div>

    @endif

</x-app-layout>
