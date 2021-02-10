<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $commission->title }}
        </h2>
    </x-slot>
    {{ $commission->displayTitle }}
    {{ $commission->title }}
    {{ $commission->description }}
    {{ $commission->memo }}
    ${{ $commission->price }}
    {{ $commission->days_to_complete }} days

</x-app-layout>
