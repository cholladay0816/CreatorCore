<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Creator: {{$creator->displayname}}
        </h2>
    </x-slot>
    <form method="POST" action="{{url('creator/edit/'.$creator->displayname)}}">
        @csrf
        @method('PUT')
        <input type="text" name="displayname" required value="{{$creator->displayname??old('displayname')}}" />
        @error('displayname')
        <span class="text-red-500">{{$message}}</span>
        @enderror
        <input type="text" name="bio" value="{{$creator->bio??old('bio')}}" />
        <input type="submit"/>
    </form>
</x-app-layout>
