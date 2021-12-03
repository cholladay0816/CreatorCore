<x-app-layout class="h-full">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="">
            <div class="px-4 py-5 sm:p-6">
                @livewire('dashboard-stats')
            </div>
        </div>
    </div>
</x-app-layout>
