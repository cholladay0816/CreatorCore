<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Commission
        </h2>
    </x-slot>

    <form method="POST">
        @csrf
        @method('POST')

    </form>
</x-app-layout>
