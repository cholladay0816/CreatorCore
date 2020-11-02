<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Explore') }}
        </h2>
    </x-slot>
    <div class="grid grid-flow-row-dense grid-cols-1 md:grid-cols-2 lg:grid-cols-3 md:gap-x-5 md:gap-y-15 py-10 gap-y-1">
    @foreach($creators as $creator)
            @component('components.creator-display', ['creator'=>$creator])
            @endcomponent
    @endforeach
    </div>
</x-app-layout>
