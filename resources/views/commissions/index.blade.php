<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    @foreach($commissions as $commission)

        <a href="{{route('commissions.show', $commission)}}">{{ $commission->title }}</a>

    @endforeach

</x-app-layout>
