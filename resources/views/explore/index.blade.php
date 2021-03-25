<x-guest-layout>
    @foreach($users as $user)
        {{$user->name}}
    @endforeach
</x-guest-layout>
