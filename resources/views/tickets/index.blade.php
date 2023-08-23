<x-app-layout>
    @if(count($tickets))
        <div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @livewire('tickets', ['tickets' => $tickets])
            </div>
        </div>
    @else
        <div class="min-h-screen flex">
            <div class="pointer-events-none my-auto mx-auto font-light text-gray-500 text-2xl">You have no support tickets.  Would you like to <a href="{{ route('tickets.create') }}" class="text-blue-500 pointer-events-auto">create one?</a></div>
        </div>
    @endif

</x-app-layout>
