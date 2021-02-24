<x-app-layout>

    @foreach($notifications as $notification)
        <span>{{$notification->title}}</span>
    @endforeach

</x-app-layout>
