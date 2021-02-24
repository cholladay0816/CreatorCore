<x-app-layout>
    @if(isset($notifications))
        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @livewire('notifications', ['notifications' => $notifications])
            </div>
        </div>
    @else
        <div class="min-h-screen flex">
            <div class="pointer-events-none my-auto mx-auto font-light text-gray-500 text-2xl">You're all caught up!</div>
        </div>
    @endif

</x-app-layout>
