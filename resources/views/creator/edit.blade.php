<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Page: {{ $creator->displayname }}
        </h2>
    </x-slot>
    <ul class="flex border-b">
        <li class="-mb-px mr-1">
            <a class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold" href="#">Details</a>
        </li>
        <li class="mr-1">
            <a class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold" href="#">Gallery</a>
        </li>
        <li class="mr-1">
            <a class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold" href="#">Commissions</a>
        </li>
    </ul>
    Details
    <div>

    </div>
    Gallery
    <div class="grid grid-cols-3">

    </div>
    Commission Presets
    @component('components.creator-commissions', ['creator' => $creator])
    @endcomponent


</x-app-layout>
