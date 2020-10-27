<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Become a Creator
        </h2>
    </x-slot>
    <form method="POST" action="{{url('creator/new')}}">
        @csrf
        @method('POST')
        <input type="text" name="displayname" required />
        @error('displayname')
        <span class="text-red-500">{{$message}}</span>
        @enderror
        <input type="text" name="bio"/>
        <input type="submit"/>
    </form>
</x-app-layout>
